<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use function GuzzleHttp\Psr7\str;
use Illuminate\Http\Request;
use App\category;
use App\subCategory;
use App\product;
use App\attributes;
use App\paper;
use App\attr_value;
use App\product_price;
use App\product_upload;
use Input;

class productsController extends Controller
{

    public function create()
    {
        $categories = category::all();
        return view('admin.products.create', ['categories' => $categories]);
    }

    public function store(Request $request)
    {
        $product = new product();
        $product->name = $request->name;
        $product->subcategory_id = $request->subcategory_id;
        $product->single_price = $request->single_price;
        $product->double_price = $request->double_price;
        $product->fast_single_price = $request->fast_single_price;
        $product->fast_double_price = $request->fast_double_price;
        $product->x_size = $request->x_size;
        $product->y_size = $request->y_size;
        $product->fast_delivery = $request->fast_delivery;
        $product->normal_delivery = $request->normal_delivery;
        $product->allowLats = $request->allowLats;

        $product->save();
        return redirect(route('products.index'))->withErrors(['عملیات موفقیت آمیز بود'], 'success');
    }

    public function edit(product $product)
    {
        $category = category::all();
        $subCategories = subCategory::where('category_id', $product->subcategory->category->id)->get();
        return view('admin.products.edit', ['product' => $product, 'categories' => $category, 'subCategories' => $subCategories]);
    }

    public function update(Request $request, product $product)
    {
        $product->subcategory_id = $request->subcategory_id;
        $product->name = $request->name;
        $product->single_price = $request->single_price;
        $product->double_price = $request->double_price;
        $product->fast_single_price = $request->fast_single_price;
        $product->fast_double_price = $request->fast_double_price;
        $product->x_size = $request->x_size;
        $product->y_size = $request->y_size;
        $product->fast_delivery = $request->fast_delivery;
        $product->normal_delivery = $request->normal_delivery;
        $product->allowLats = $request->allowLats;

        $product->save();
        return redirect(route('products.index'))->withErrors(['محصول با موفقیت بروزرسانی شد'], 'success');
    }

    public function destroy(product $product)
    {
        $product->delete();
        return redirect(route('products.index'))->withErrors(['محصول مورد نظر حذف شد.'], 'success');
    }

    public function index()
    {
        $products = product::orderBy('id', 'desc')->get();
        return view('admin.products.index', ['products' => $products]);
    }

}

