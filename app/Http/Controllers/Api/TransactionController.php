<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Support\Str;
use App\Models\Address;
use App\Models\Cart;


class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with(['detailTransaction.product'])->where('user_id', auth()->guard('api')->user()->id)->get();
        $transactions->map(function ($transaction) {
            $transaction->product_name = $transaction->detailTransaction[0]->product->title;
            $transaction->product_qty = $transaction->detailTransaction[0]->qty;
            $transaction->product_variant = $transaction->detailTransaction[0]->variant;
            $photos = explode(',', $transaction->detailTransaction[0]->product->photo);
            $transaction->product_photo = asset('images/product/' . $photos[0]);
            unset($transaction->detailTransaction);
            return $transaction;
        });
        return $this->successResponse('Data Transaksi Berhasil Ditampilkan', $transactions);
    }

    public function show($id)
    {
        $transaction = Transaction::with(['detailTransaction'])->find($id);

        if (!$transaction) {
            return $this->notFoundResponse('Data Transaksi Tidak Ditemukan');
        }

        // Set atribut tambahan untuk transaksi
        $transaction->user_username_sender = $transaction->user->name;
        $transaction->address_username = $transaction->address->username;
        $transaction->address_phone = $transaction->address->phone;
        $transaction->address_in_address = $transaction->address->address;
        $transaction->address_address_detail = $transaction->address->address_detail;

        // Melakukan pemetaan pada detailTransaction dan mengatur atribut product_photo dan product_name
        $transaction->detailTransaction->map(function ($detailTransaction) {
            $photos = explode(',', $detailTransaction->product->photo);
            $photoUrls = array_map(function ($photo) {
                return asset('images/product/' . $photo);
            }, $photos);

            $detailTransaction->product_photo = $photoUrls[0];
            $detailTransaction->product_name = $detailTransaction->product->title;
            unset($detailTransaction->product);
            return $detailTransaction;
        });

        // Menghapus relasi yang tidak diperlukan
        unset($transaction->address);
        unset($transaction->user);

        return $this->successResponse('Data Transaksi Berhasil Ditampilkan', $transaction);

    }

    public function sortByStatus($params)
    {
        $transaction = Transaction::with(['detailTransaction.product'])->where('user_id', auth()->guard('api')->user()->id)->where('status', $params)->get();
        $transaction->each(function ($transaction) {
            $transaction->detailTransaction->each(function ($detailTransaction) {
                $detailTransaction->unsetRelation('product');
            });
        });

        if (!$transaction) {
            return $this->notFoundResponse('Data Transaksi Tidak Ditemukan');
        }
        return $this->successResponse('Data Transaksi Berhasil Ditampilkan', $transaction);
    }

    public function callback(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashed = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . $serverKey);
        if ($hashed == $request->signature_key) {
            if ($request->transaction_status == 'capture' || 'settlement') {
                $transaction = Transaction::where('order_id', $request->order_id)->first();
                $transaction->update([
                    'status' => 'paid',
                ]);

                // Mengurangi kuantitas produk untuk setiap detail transaksi pada transaksi ini
                foreach ($transaction->detailTransaction as $detailTransaction) {
                    $product = $detailTransaction->product;

                    // Pastikan kuantitas produk tidak kurang dari nol
                    $newQty = max(0, $product->qty - $detailTransaction->qty);
                    $product->update([
                        'qty' => $newQty,
                    ]);
                }

            } else if ($request->transaction_status == 'expire') {
                $transaction = Transaction::where('order_id', $request->order_id)->first();
                $transaction->update([
                    'status' => 'canceled',
                ]);
            }
        }
    }

    public function createPayment(Request $request)
    {
        $address = $this->findAddress($request->address_id);
        if (!$address) {
            return $this->notFoundResponse('Data Alamat Tidak Ditemukan');
        }

        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $uuid = $this->generateUuid();
        $transaction = $this->createTransaction($request, $uuid);
        $detailTransaction = $this->createDetailTransaction($request->products, $transaction);

        $params = $this->buildTransactionParams($request, $uuid, $address, $detailTransaction);
        $snapToken = $this->createSnapTransaction($params);
        if (!$snapToken) {
            return $this->errorResponse('Data Transaksi Gagal Ditambahkan');
        }

        $transaction->update([
            'payment_url' => $snapToken->redirect_url,
        ]);

        return $this->successResponse('Data Transaksi Berhasil Ditambahkan!', $transaction);
    }

    private function findAddress($addressId)
    {
        return Address::find($addressId);
    }

    private function generateUuid()
    {
        return Str::uuid();
    }

    private function createTransaction($request, $uuid)
    {
        return Transaction::create([
            'user_id' => auth()->guard('api')->user()->id,
            'address_id' => $request->address_id,
            'order_id' => $uuid,
            'courier' => $request->courier,
            'cost_courier' => $request->cost_courier,
            'receipt_number' => null,
            'total' => $request->total,
            'status' => 'unpaid'
        ]);
    }

    private function createDetailTransaction($products, $transaction)
    {
        $detailTransaction = [];
        foreach ($products as $product) {
            $cart = $this->findCart($transaction->user_id, $product['product_id'], $product['variant']);
            if ($cart) {
                $this->deleteCart($transaction->user_id, $product['product_id'], $product['variant']);
            }

            $detailTransaction[] = [
                'product_id' => $product['product_id'],
                'qty' => $product['quantity'],
                'price' => $product['price'],
                'subtotal' => $product['quantity'] * $product['price'],
                'variant' => $product['variant']
            ];
        }

        return $transaction->detailTransaction()->createMany($detailTransaction);
    }

    private function findCart($user_id, $product_id, $variant)
    {
        return Cart::where('user_id', $user_id)
            ->where('product_id', $product_id)
            ->where('unit_variant', $variant)
            ->first();
    }

    private function deleteCart($user_id, $product_id, $variant)
    {
        Cart::where('user_id', $user_id)
            ->where('product_id', $product_id)
            ->where('unit_variant', $variant)
            ->delete();
    }

    private function buildTransactionParams($request, $uuid, $address, $detailTransaction)
    {

        return [
            'transaction_details' => [
                'order_id' => $uuid,
                'gross_amount' => $request->total,
            ],
            'customer_details' => [
                'first_name' => auth()->guard('api')->user()->name,
                'email' => auth()->guard('api')->user()->email,
                'phone' => $address->phone,
            ],
            'expiry' => [
                'start_time' => date('Y-m-d H:i:s T'),
                'unit' => "minutes",
                'duration' => 1440
            ]
        ];
    }

    private function createSnapTransaction($params)
    {
        return Snap::createTransaction($params);
    }

    private function notFoundResponse($message)
    {
        return response()->json([
            'code' => 200,
            'message' => $message,
        ]);
    }

    private function errorResponse($message)
    {
        return response()->json([
            'code' => '400',
            'message' => $message,
        ]);
    }

    private function successResponse($message, $data)
    {
        return response()->json([
            'code' => 200,

            'message' => $message,
            'data' => $data
        ]);
    }
}
