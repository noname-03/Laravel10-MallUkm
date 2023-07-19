<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // get product qty > 0
        $products = Product::where('qty', '>', 0)->get();

        // $products = Product::all();

        $products->map(function ($product) {
            $unit_variant = explode(',', $product->unit_variant);

            $photoUrls = [];
            $photos = explode(',', $product->photo);
            foreach ($photos as $photo) {
                $photoUrls[] = asset('images/product/' . $photo);
            }

            $product->photo = $photoUrls;
            $product->unit_variant = $unit_variant;
            return $product;
        });

        return response()->json([
            'code' => 200,
            'message' => 'Berhasil Mengambil Data Product',
            'data' => $products
        ], 200);
    }

    public function recomendation($params)
    {
        $products = Product::inRandomOrder()->limit($params)->get();
        $products->map(function ($product) {
            $photos = explode(',', $product->photo);
            $photoUrls = [];
            $unit_variant = explode(',', $product->unit_variant);

            foreach ($photos as $photo) {
                $photoUrls[] = asset('images/product/' . $photo);
            }

            $product->photo = $photoUrls;
            $product->unit_variant = $unit_variant;
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

        $product->category = $product->categoryProduct->title;
        unset($product->categoryProduct);
        return response()->json([
            'code' => 200,
            'message' => 'Berhasil Mengambil Data Product',
            'data' => $product
        ], 200);
    }

    public function promo()
    {
        $products = Product::whereNotNull('promo')->get();

        $products->map(function ($product) {
            $photos = explode(',', $product->photo);
            $photoUrls = [];
            $unit_variant = explode(',', $product->unit_variant);

            foreach ($photos as $photo) {
                $photoUrls[] = asset('images/product/' . $photo);
            }

            $product->photo = $photoUrls;
            $product->unit_variant = $unit_variant;
            return $product;
        });

        return response()->json([
            'code' => 200,
            'message' => 'Berhasil Mengambil Data Product Promo',
            'data' => $products
        ], 200);
    }
}