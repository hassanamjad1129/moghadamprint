<?php

namespace App\Http\Controllers\customer;

use App\gallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\galleryCategory;

class galleryController extends Controller
{

    public function index()
    {
        $categories = galleryCategory::all();
        $galleries = gallery::orderBy('id', 'desc')->get();
        return view('customer.gallery.index', [
            'galleries' => $galleries,
            'categories' => $categories
        ]);
    }

    public function pictures(galleryCategory $category)
    {
        $pictures = gallery::where('category_id', $category->id)->get();
        return view('customer.gallery.pictures', ['pictures' => $pictures]);
    }

}
