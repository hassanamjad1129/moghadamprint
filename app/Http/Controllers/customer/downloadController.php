<?php

namespace App\Http\Controllers\customer;

use App\download;
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
        $downloads = download::orderBy('id', 'desc')->get();
        return view('customer.downloads.index', [
            'downloads' => $downloads
        ]);
    }

}
