<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $products->map(function ($product) {
            $photos = explode(',', $product->photo);
            $photoUrls = [];

            foreach ($photos as $photo) {
                $photoUrls[] = asset('images/product/' . $photo);
            }

            $product->photo = $photoUrls;

            return $product;
        });

        return response()->json([
            'code' => 200,
            'message' => 'Berhasil Mengambil Data Product',
            'data' => $products
        ], 200);
    }

    public function recomendation()
    {
        $products = Product::inRandomOrder()->limit(12)->get();
        $products->map(function ($product) {
            $photos = explode(',', $product->photo);
            $photoUrls = [];

            foreach ($photos as $photo) {
                $photoUrls[] = asset('images/product/' . $photo);
            }

            $product->photo = $photoUrls;

            return $product;
        });

        return response()->json([
            'code' => 200,
            'message' => 'Berhasil Mengambil Data Rekomendasi Product',
            'data' => $products
        ], 200);
    }


    public function show($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json([
                'code' => 404,
                'message' => 'Product Tidak Ditemukan',
                'data' => ''
            ], 404);
        }

        $photos = explode(',', $product->photo);
        $photoUrls = [];

        foreach ($photos as $photo) {
            $photoUrls[] = asset('images/product/' . $photo);
        }

        $product->photo = $photoUrls;

        $product->discount = round((($product->price_retail - $product->price) / $product->price_retail) * 100);
        $product->unit_variant = explode(',', $product->unit_variant);

        if ($product->qty > 0) {
            $product->status = "Tersedia";
        } else {
            $product->status = "Tidak Tersedia";
        }

        return response()->json([
            'code' => 200,
            'message' => 'Berhasil Mengambil Data Product',
            'data' => $product
        ], 200);

    }


}