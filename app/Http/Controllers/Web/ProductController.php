<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('pages.product.index', compact('products'));
    }

    public function create()
    {
        return view('pages.product.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ]);

        Product::create($request->all());

        return redirect()->route('product.index');
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('pages.product.show', compact('product'));
    }

    public function edit($id)
    {
        // $product = Product::findOrFail($id);
        // return view('pages.product.edit', compact('product'));
        return view('pages.product.edit');
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

        return redirect()->route('product.index');
    }
}