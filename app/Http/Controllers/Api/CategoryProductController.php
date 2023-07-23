<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryProduct;

class CategoryProductController extends Controller
{
    public function index()
    {
        $category = CategoryProduct::all();
        $category->map(function ($category) {
            $category->photo = asset('images/category/' . $category->photo);
            return $category;
        });
        return response()->json([
            'code' => 200,
            'message' => 'Berhasil Mengambil Data Kategory',
            'data' => $category
        ], 200);
    }

    public function show($id)
    {
        // find with product
        $category = CategoryProduct::with('products')->find($id);
        if (!$category) {
            return response()->json([
                'code' => 404,
                'message' => 'Kategory Tidak Ditemukan',
            ], 404);
        }
        $category->photo = asset('images/category/' . $category->photo);
        // map category product map photo
        $category->products->map(function ($product) {
            // string to array with explode and get first array
            $product->photo = explode(',', $product->photo)[0];
            $product->photo = asset('images/product/' . $product->photo);
            return $product;
        });
        return response()->json([
            'code' => 200,
            'message' => 'Berhasil Mengambil Data Kategory',
            'data' => $category
        ], 200);
    }

    public function recomendation()
    {
        $category = CategoryProduct::with('products')->get();
        $category->map(function ($category) {
            $category->photo = asset('images/category/' . $category->photo);
            $category->products->map(function ($product) {
                $product->photo = explode(',', $product->photo)[0];
                $product->photo = asset('images/product/' . $product->photo);
                return $product;
            });
            return $category;
        });
        return response()->json([
            'code' => 200,
            'message' => 'Berhasil Mengambil Data Kategory',
            'data' => $category
        ], 200);
    }
}