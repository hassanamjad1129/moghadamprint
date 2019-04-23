<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\subCategoryFiles;
use Illuminate\Http\Request;
use App\category;
use App\subCategory;
use Illuminate\Support\Facades\Validator;

class subCategoriesController extends Controller
{

    public function create()
    {
        $categories = category::where('status', 1)->get();
        return view('admin.subCategories.create', ['categories' => $categories]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'name' => 'required',
                'category_id' => 'required'
            ], [
                'name.required' => 'عنوان زیردسته را وارد کنید',
                'category_id.required' => 'دسته پدر را وارد کنید'
            ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator, 'failed')->withInput();
        }
        $subCategory = new subCategory();
        $subCategory->name = $request->name;
        $subCategory->category_id = $request->category_id;
        $subCategory->picture = $request->picture;
        $subCategory->circulation=$request->circulation;
        $subCategory->save();
        return redirect(route('subCategories.index'))->withErrors(['زیر دسته مورد نظر با موفقیت ثبت شد'], 'success');
    }

    public function index()
    {
        $subCategory = subCategory::all();
        return view('admin.subCategories.index', ['subCategories' => $subCategory]);
    }

    public function edit(subCategory $subCategory)
    {
        $categories = category::all();
        return view('admin.subCategories.edit', ['subCategory' => $subCategory, 'categories' => $categories]);
    }

    public function update(Request $request, subCategory $subCategory)
    {
        $subCategory->category_id = $request->category_id;
        $subCategory->name = $request->name;
        $subCategory->picture = $request->picture;
        $subCategory->circulation=$request->circulation;
        $subCategory->save();
        return redirect(route('subCategories.index'))->withErrors(['زیر دسته مورد نظر با موفقیت ویرایش شد'], 'success');
    }

    public function destroy(subCategory $subCategory)
    {
        $subCategory->delete();
        return redirect()->back()->withErrors(['زیردسته مورد نظر با موفقیت حذف شد'], 'success');
    }

    public function files(subCategory $subCategory)
    {
        $files = subCategoryFiles::where('subcategory_id', $subCategory->id)->get();
        return view('admin.subCategories.files', [
            'files' => $files,
            'subCategory' => $subCategory
        ]);
    }

    public function createFiles(subCategory $subCategory)
    {
        return view('admin.subCategories.createFile', [
            'subCategory' => $subCategory
        ]);
    }

    public function storeFiles(subCategory $subCategory, Request $request)
    {
        $file = new subCategoryFiles();
        $file->front_file_label = $request->front_file_label;
        $file->back_file_label = $request->back_file_label;
        $file->subcategory_id = $subCategory->id;
        $file->save();
        return redirect(route('admin.subCategory.files', [$subCategory->id]))->withErrors(['عملیات با موفقیت انجام شد'], 'success');
    }

    public function editFiles(subCategory $subCategory, subCategoryFiles $file)
    {
        return view('admin.subCategories.editFile', [
            'subCategory' => $subCategory,
            'file' => $file
        ]);
    }

    public function updateFiles(subCategory $subCategory, subCategoryFiles $file, Request $request)
    {
        $file->front_file_label = $request->front_file_label;
        $file->back_file_label = $request->back_file_label;
        $file->save();
        return redirect(route('admin.subCategory.files', [$subCategory->id]))->withErrors(['عملیات موفقیت آمیز بود'], 'success');
    }

    public function deleteFiles(subCategory $subCategory, subCategoryFiles $file)
    {
        $file->status = 0;
        $file->save();
        return redirect(route('admin.subCategory.files', [$subCategory->id]))->withErrors(['عملیات موفقیت آمیز بود'], 'success');
    }

}
