<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCartRequest;
use App\Models\Cart;
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

    public function delete($id)
    {
        $user = auth()->guard('api')->user();
        $cart = Cart::where('user_id', $user->id)->where('id', $id)->first();
        if ($cart == null) {
            return response()->json([
                'code' => 404,
                'message' => 'Data Product Tidak Ditemukan'
            ]);
        }
        $cart->delete();
        return response()->json([
            'code' => 200,
            'message' => 'Data Product Berhasil Dihapus Dari Keranjang'
        ]);
    }
}