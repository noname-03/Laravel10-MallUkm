<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCartRequest;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function index()
    {
        $user = auth()->guard('api')->user();
        $cart = Cart::with('product')->where('user_id', $user->id)->get();

        $cart->map(function ($item) {
            $toArray = explode(',', $item->product->photo);
            $item->photo = asset('images/product/' . $toArray[0]);
            $item->price = $item->product->price;
            $item->price_retail = $item->product->price_retail;
            $item->title = $item->product->title;
            $item->weight = $item->product->weight;

            unset($item->product); // Menghapus field "product"

            return $item;
        });

        return response()->json([
            'code' => 200,
            'message' => 'Data Keranjang Berhasil Diambil',
            'data' => $cart
        ]);
    }

    public function store(StoreCartRequest $request)
    {
        $user = auth()->guard('api')->user();
        $product = Product::where('id', $request->product_id)->first();

        if ($product == null) { // Jika product tidak ditemukan
            return response()->json([
                'code' => 404,
                'message' => 'Data Product Tidak Ditemukan'
            ]);
        }

        if ($request->qty > $product->qty) { // Jika qty yang dimasukkan melebihi stok
            return response()->json([
                'code' => 400,
                'message' => 'Jumlah Produk Yang Anda Masukkan Melebihi Stok Produk'
            ]);
        }

        $cart = Cart::where('user_id', $user->id)
            ->where('product_id', $request->product_id)
            ->where('unit_variant', $request->unit_variant)
            ->first(); // Cek apakah data Cart sudah ada atau belum

        if ($cart) { // Jika data Cart sudah ada, lakukan update pada stok
            $cart->qty += $request->qty;
            $cart->save();

            return response()->json([
                'code' => 200,
                'message' => 'Stok Keranjang Berhasil Diupdate'
            ]);
        }

        // Jika data Cart belum ada, simpan sebagai data baru
        $cart = new Cart;
        $cart->user_id = $user->id;
        $cart->product_id = $request->product_id;
        $cart->unit_variant = $request->unit_variant;
        $cart->qty = $request->qty;
        $cart->save();

        return response()->json([
            'code' => 200,
            'message' => 'Data Product Berhasil Ditambahkan Kedalam Keranjang'
        ]);
    }


    public function update($id, Request $request)
    {
        $cart = Cart::where('id', $id)->first();
        if ($cart == null) {
            return response()->json([
                'code' => 404,
                'message' => 'Data Keranjang Tidak Ditemukan'
            ]);
        }

        $product = Product::where('id', $request->product_id)->first();

        if ($product == null) { // Jika product tidak ditemukan
            return response()->json([
                'code' => 404,
                'message' => 'Data Product Tidak Ditemukan'
            ]);
        }

        if ($request->qty > $product->qty) { // Jika qty yang dimasukkan melebihi stok
            return response()->json([
                'code' => 400,
                'message' => 'Jumlah Produk Yang Anda Masukkan Melebihi Stok Produk'
            ]);
        }

        // Melakukan update stok pada Cart
        $cart->qty = $cart->qty + $request->qty;
        $cart->save();

        return response()->json([
            'code' => 200,
            'message' => 'Stok Keranjang Berhasil Diperbarui',
            'data' => $cart
        ]);
    }

    public function delete($id)
    {
        $user = auth()->guard('api')->user();
        $cart = Cart::where('user_id', $user->id)->where('id', $id)->first();
        if ($cart == null) {
            return response()->json([
                'code' => 404,
                'message' => 'Data Product Tidak Ditemukan Pada Keranjang'
            ]);
        }
        $cart->delete();
        return response()->json([
            'code' => 200,
            'message' => 'Data Product Berhasil Dihapus Dari Keranjang'
        ]);
    }
}