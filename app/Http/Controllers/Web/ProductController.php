<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\CategoryProduct;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Helpers\ImageHelper;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;


class ProductController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $search = $request->input('search');
            $sortBy = $request->input('sortBy');

            $query = Product::query();

            if (!empty($search)) {
                $query->where('title', 'like', '%' . $search . '%');
            }

            switch ($sortBy) {
                case '1': // Populer
                    $query->orderBy('created_at', 'asc');
                    break;
                case '2': // Harga Rendah
                    $query->orderBy('price', 'asc');
                    break;
                case '3': // Harga Tinggi
                    $query->orderBy('price', 'desc');
                    break;
                case '4': // Stok Habis
                    $query->where('qty', 0);
                    break;
                default:
                    // Tanpa pengurutan
                    break;
            }

            // Paginasi hasil dengan 8 item per halaman
            $products = $query->paginate(8);

            // Ubah foto produk menjadi URL lengkap
            $products->getCollection()->transform(function ($product) {
                $photos = explode(',', $product->photo);
                $product->photo = $photos[0];
                return $product;
            });

            // Jangan gunakan pemetaan pada setiap produk jika foto tetap berupa string

            // Kembalikan data produk dan link paginasi dalam format JSON sebagai respons AJAX
            return response()->json([
                'data' => $products,
                'links' => $products->links()->toHtml(), // Mengambil link paginasi dalam bentuk HTML
            ]);
        }

        // Jika bukan permintaan AJAX, lakukan rendering tampilan normal

        // Ambil query pencarian dari permintaan (request)
        $search = $request->input('search');

        // Terapkan query pencarian pada kueri basis data
        $query = Product::query();
        if (!empty($search)) {
            $query->where('title', 'like', '%' . $search . '%');
        }

        // Paginasi hasil dengan 8 item per halaman
        $products = $query->paginate(8);

        $products->getCollection()->transform(function ($product) {
            $photos = explode(',', $product->photo);
            $product->photo = $photos[0];
            return $product;
        });

        // Kembalikan tampilan dengan produk yang dipaginasi dan query pencarian
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

            // Lakukan apa pun yang perlu Anda lakukan dengan path gambar, misalnya menyimpannya ke database
        }
        $product = new Product();
        $product->category_id = $request->category_id;
        $product->title = $request->title;
        $product->price = $request->price;
        $product->price_retail = $request->price_retail;
        $product->qty = $request->qty;
        $product->weight = $request->weight;
        $product->promo = $request->promo;
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


    public function update(UpdateProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);

        $data = $request->except('_token', '_method', 'photo');

        // Update product data
        $product->update($data);

        if ($request->hasFile('photo')) {
            $currentPhotos = explode(',', $product->photo);
            $uploadedPhotos = [];

            foreach ($request->file('photo') as $photo) {

                $filename = ImageHelper::upload($photo, 'images/product');
                $uploadedPhotos[] = $filename;
            }

            // Gabungkan foto yang di-upload dengan foto yang sudah ada
            $mergedPhotos = array_merge($currentPhotos, $uploadedPhotos);
            $product->photo = implode(',', $mergedPhotos);
            $product->save();
        }

        return redirect()->route('Product.index')->with('success', 'Produk berhasil diperbarui.');
    }



    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->photo = explode(',', $product->photo);
        foreach ($product->photo as $item) {
            File::delete(public_path('images/product/' . $item));
        }
        $product->delete();
        return redirect()->route('Product.index');
    }

    public function deletePhoto(Request $request, $id)
    {
        $photoName = $request->input('photo_name');

        // Hapus foto dari database
        $product = Product::find($id);
        $photos = explode(',', $product->photo);
        $updatedPhotos = array_diff($photos, [$photoName]);
        $product->photo = implode(',', $updatedPhotos);
        $product->save();

        // Hapus foto dari server

        File::delete(public_path('images/product/' . $photoName));

        return redirect()->back();
    }
}