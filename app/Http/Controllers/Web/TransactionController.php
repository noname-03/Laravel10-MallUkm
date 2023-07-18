<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::all();
        return view('pages.transaction.index', compact('transactions'));
    }

    // edit
    public function edit($id)
    {
        $transaction = Transaction::findOrFail($id);
        return view('pages.transaction.edit', compact('transaction'));
    }

    //update
    public function update(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->update([
            'status' => $request->status,
            'receipt_number' => $request->receipt_number,
        ]);
        return redirect()->route('transaction.index');
    }

    //show
    public function show($id)
    {
        $transaction = Transaction::findOrFail($id);
        return view('pages.transaction.show', compact('transaction'));
    }

    public function payment()
    {
        Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        Config::$isProduction = false;
        // Set sanitization on (default)
        Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => rand(),
                'gross_amount' => 100000,
            ],

            'item_details' => [
                [
                    'id' => 1,
                    'price' => 200000,
                    'quantity' => 1,
                    'name' => 'name',
                ],
                [
                    'id' => 2,
                    'price' => 200000,
                    'quantity' => 1,
                    'name' => 'name',
                ],
            ],

            'customer_details' => [
                'first_name' => 'auth name',
                'email' => 'test@mail.com',
                'phone' => '0',
            ],

            'expiry' => [
                'start_time' => date('Y-m-d H:i:s T'),
                'unit' => "minutes",
                'duration' => 1440
            ]
        ];

        $snapToken = Snap::createTransaction($params);
        dd($snapToken);
        // return view('pages.payment.index', compact('snapToken'));
    }
}