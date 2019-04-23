<?php

namespace App\Http\Controllers\Admin;

use App\download;
use App\downloadCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class downloadController extends Controller
{
    public function createCategory()
    {
        return view('admin.downloads.createCategory');
    }

    public function storeCategory(Request $request)
    {
        $category = new downloadCategory();
        $category->name = $request->name;
        $category->save();
        return redirect(route('admin.downloads.categories'))->withErrors(['عملیات با موفقیت انجام شد'], 'success');
    }

    public function editCategory(downloadCategory $category)
    {
        return view('admin.downloads.editCategory', [
            'category' => $category
        ]);
    }

    public function updateCategory(downloadCategory $category, Request $request)
    {
        $category->name = $request->name;
        $category->save();
        return redirect(route('admin.downloads.categories'))->withErrors(['عملیات با موفقیت انجام شد'], 'success');
    }

    public function deleteCategory(downloadCategory $category)
    {
        $category->delete();
        return redirect(route('admin.downloads.categories'))->withErrors(['عملیات با موفقیت انجام شد'], 'success');
    }

    public function categories()
    {
        $categories = downloadCategory::all()->reverse();
        return view('admin.downloads.categories', [
            'categories' => $categories
        ]);
    }

    public function create()
    {
        $categories = downloadCategory::all()->reverse();
        return view('admin.downloads.create', [
            'categories' => $categories
        ]);
    }

    public function store(Request $request)
    {
        $download = new download();
        $download->title = $request->title;
        $download->icon = $this->uploadFile($request->icon, 'downloadFiles', uniqid() . '.' . $request->icon->extension());
        $download->description = $request->description;
        $download->file = $this->uploadFile($request->file, 'downloadFiles', uniqid() . '.' . $request->file->extension());
        $download->category_id = $request->category;
        $download->save();
        return redirect(route('downloads.index'))->withErrors(['عملیات با موفقیت انجام شد'], 'success');
    }

    public function edit(download $download)
    {
        $categories = downloadCategory::all();
        return view('admin.downloads.edit', [
            'categories' => $categories,
            'download' => $download
        ]);
    }

    public function update(download $download, Request $request)
    {
        $download->title = $request->title;
        if ($request->icon)
            $download->icon = $this->uploadFile($request->icon, 'downloadFiles', uniqid() . '.' . $request->icon->extension());
        $download->description = $request->description;
        if ($request->file)
            $download->file = $this->uploadFile($request->file, 'downloadFiles', uniqid() . '.' . $request->file->extension());
        $download->category_id = $request->category;
        $download->save();
        return redirect(route('downloads.index'))->withErrors(['عملیات با موفقیت انجام شد'], 'success');
    }

    public function destroy(download $download)
    {
        $download->delete();
        return redirect(route('downloads.index'));
    }

    public function index()
    {
        $downloads = download::all()->reverse();
        return view('admin.downloads.index', [
            'downloads' => $downloads
        ]);
    }

    public function downloadFile(download $download)
    {
        return response()->download($download->file);
    }


}
