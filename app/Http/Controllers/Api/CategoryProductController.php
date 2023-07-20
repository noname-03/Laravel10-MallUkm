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
}