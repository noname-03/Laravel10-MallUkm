<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryProduct;

class CategoryProductController extends Controller
{
    public function index()
    {
        $categoryProducts = CategoryProduct::all();
        return view('pages.categoryProduct.index', compact('categoryProducts'));
    }

    public function create()
    {
        return view('pages.categoryProduct.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ]);

        CategoryProduct::create($request->all());

        return redirect()->route('categoryProduct.index');
    }

    public function edit($id)
    {
        $categoryProduct = CategoryProduct::findOrFail($id);
        return view('pages.categoryProduct.edit', compact('categoryProduct'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
        ]);

        CategoryProduct::findOrFail($id)->update($request->all());

        return redirect()->route('categoryProduct.index');
    }

    public function destroy($id)
    {
        CategoryProduct::findOrFail($id)->delete();

        return redirect()->route('categoryProduct.index');
    }
}