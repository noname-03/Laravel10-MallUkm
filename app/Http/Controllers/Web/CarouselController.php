<?php

namespace App\Http\Controllers\Web;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCarouselRequest;
use App\Models\Carousel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CarouselController extends Controller
{
    public function index()
    {
        $carousels = Carousel::all();
        return view('pages.carousel.index', compact('carousels'));
    }

    public function create()
    {
        return view('pages.carousel.create');
    }

    public function store(StoreCarouselRequest $request)
    {
        $file = $request->file('photo');
        $directory = 'images/carousel';

        $filename = ImageHelper::upload($file, $directory);

        $carousel = new Carousel();
        $carousel->photo = $filename;
        $carousel->save();

        return redirect()->route('carousel.index');
    }

    public function destroy($id)
    {
        $carousel = Carousel::find($id);

        File::delete(public_path('images/carousel/' . $carousel->photo));
        $carousel->delete();

        return redirect()->route('carousel.index');
    }
}