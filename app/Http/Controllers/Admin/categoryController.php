<?php

namespace App\Http\Controllers\Admin;

use App\category;
use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;

class categoryController extends Controller
{
    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $validation = $this->categoriesValidate($request);
        if ($validation->fails())
            return redirect()->back()->withErrors($validation, 'failed')->withInput();
        $categories = new category();
        $categories->name = $request->name;
        $categories->picture = $request->filepath;
        $categories->description = $request->description;
        $categories->save();
        return redirect(route('categories.index'));
    }

    private function categoriesValidate(Request $request)
    {
        return Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'nullable',
            'filepath' => 'nullable'
        ]);
    }

    public function index()
    {
        $categories = category::all();
        return view('admin.categories.index', ['categories' => $categories]);
    }

    public function edit(category $category)
    {
        return view('admin.categories.edit', ['category' => $category]);
    }

    public function update(category $category, Request $request)
    {
        $validation = $this->categoriesValidate($request);
        if ($validation->fails())
            return redirect()->back()->withErrors($validation, 'failed')->withInput();
        $category->name = $request->name;
        $category->picture = $request->filepath;
        $category->description = $request->description;
        $category->save();
        return redirect(route('categories.index'))->withErrors(['دسته بندی مورد نظر با موفقیت بروزرسانی شد'], 'success');
    }

    public function destroy(category $category)
    {
        if (!$category->deletable)
            return redirect()->back()->withErrors(['این دسته قابل حذف نیست'], 'failed');
        $category->delete();
        return redirect(route('categories.index'))->withErrors(['دسته بندی مورد نظر با موفقیت حذف شد'], 'success');
    }

    public function show(category $category)
    {
        return view('admin.categories.show', ['category' => $category]);
    }

}
