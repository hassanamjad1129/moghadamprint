<?php

namespace App\Http\Controllers\Admin;

use App\category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class productSpecificationController extends Controller
{
    public function create()
    {
        $categories = category::where('status', 1)->get();
        return view('admin.productSpecification.create', [
            'categories' => $categories
        ]);
    }
}
