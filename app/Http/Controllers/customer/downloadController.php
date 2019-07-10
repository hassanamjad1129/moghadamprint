<?php

namespace App\Http\Controllers\customer;

use App\download;
use App\downloadCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class downloadController extends Controller
{
    public function downloadFile(download $download)
    {
        return response()->download($download->file);
    }

    public function index()
    {
        $categories = downloadCategory::orderBy('id', 'desc')->get();
        return view('customer.downloads.index', [
            'categories' => $categories
        ]);
    }

    public function files(downloadCategory $category)
    {
        $downloads = download::where('category_id', $category->id)->get();
        return view('customer.downloads.files', [
            'downloads' => $downloads
        ]);
    }

}
