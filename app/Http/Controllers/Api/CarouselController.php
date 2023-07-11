<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Carousel;

class CarouselController extends Controller
{
    public function index()
    {
        $carousels = Carousel::all();
        $carousels->map(function ($carousel) {
            $carousel->photo = asset('images/carousel/' . $carousel->photo);
            return $carousel;
        });
        return response()->json([
            'code' => 200,
            'message' => 'Berhasil Mengambil Data Carousel',
            'data' => $carousels
        ], 200);
    }
}