<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Models\CategoryProduct;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Helpers\ImageHelper;

class ProductController extends Controller
{
    public function index()
    {
        $string = "apple";
        $pieces = explode(",", $string);
        $firstElement = $pieces[0];
        $products = Product::paginate(8);
        $products->map(function ($product) { // mengmabil foto pertama
            $toArray = explode(',', $product->photo);
            $product->photo = $toArray[0];
            return $product;
        });
        return view('pages.product.index', compact('products'));
    }

    public function create()
    {
        $category = CategoryProduct::all();
        return view('pages.product.create', compact('category'));
    }

    public function store(Request $request)
    {
        if ($request->hasFile('photo')) {
            $files = $request->file('photo');
            $directory = 'images/product'; // Direktori penyimpanan gambar

            $filenames = [];

            foreach ($files as $file) {
                $filename = ImageHelper::upload($file, $directory);
                $filenames[] = $filename;
            }
            $ToString = array_map('strval', $filenames);
            $NameImageString = implode(',', ($ToString));
            // dd($a);

            // Lakukan apa pun yang perlu Anda lakukan dengan path gambar, misalnya menyimpannya ke database
        }
        $product = new Product();
        $product->category_id = $request->category_id;
        $product->title = $request->title;
        $product->price = $request->price;
        $product->price_retail = $request->price_retail;
        $product->qty = $request->qty;
        $product->unit = $request->unit;
        $product->unit_variant = $request->unit_variant;
        $product->description = $request->description;
        $product->photo = $NameImageString;
        $product->save();

        return redirect()->route('Product.index');
    }

    public function show($id)
    {
        $product = Product::findOrFail($id); // mengmabil foto pertama
        $product->photo = explode(',', $product->photo);
        $product->discount = round((($product->price_retail - $product->price) / $product->price_retail) * 100);
        $product->unit_variant = explode(',', $product->unit_variant);

        if ($product->qty > 0) {
            $product->status = "Tersedia";
        } else {
            $product->status = "Tidak Tersedia";
        }

        // dd($product);
        return view('pages.product.show', compact('product'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $category = CategoryProduct::all();
        return view('pages.product.edit', compact('product', 'category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
        ]);

        Product::findOrFail($id)->update($request->all());

        return redirect()->route('product.index');
    }

    public function destroy($id)
    {
        Product::findOrFail($id)->delete();

        return redirect()->route('Product.index');
    }
}