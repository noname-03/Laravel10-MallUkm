<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\CateogryProductRequest;
use App\Http\Requests\UpdateCateogryProductRequest;
use Illuminate\Http\Request;
use App\Models\CategoryProduct;
use App\Helpers\ImageHelper;

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

    public function store(CateogryProductRequest $request)
    {
        $file = $request->file('file');
        $directory = 'images/category';

        $request['photo'] = ImageHelper::upload($file, $directory);
        CategoryProduct::create($request->except(['file']));

        return redirect()->route('categoryProduct.index');
    }

    public function edit($id)
    {
        $categoryProduct = CategoryProduct::findOrFail($id);
        return view('pages.categoryProduct.edit', compact('categoryProduct'));
    }

    public function update(UpdateCateogryProductRequest $request, $id)
    {
        $category = CategoryProduct::findOrFail($id);
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $directory = 'images/category';

            $request['photo'] = ImageHelper::upload($file, $directory);
            // delete with image helper with $directory
            ImageHelper::delete($category->photo, $directory);
        } else {
            $request['photo'] = $category->photo;
        }

        $category->update($request->except(['file']));

        return redirect()->route('categoryProduct.index');
    }

    public function destroy($id)
    {
        $category = CategoryProduct::findOrFail($id);
        //delete image with image helper
        $directory = 'images/category';
        ImageHelper::delete($category->photo, $directory);
        $category->delete();
        return redirect()->route('categoryProduct.index');
    }
}