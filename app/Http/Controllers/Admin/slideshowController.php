<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\priceCategory;
use App\slideshow;

class slideshowController extends Controller
{
    public function index()
    {
        $lists = priceCategory::all();
        return view('admin.slideshows.index', ['lists' => $lists]);
    }

    public function management(priceCategory $category)
    {
        $slideshows = slideshow::where('category_id', $category->id)->get();
        return view('admin.slideshows.manage', ['slideshows' => $slideshows, 'category' => $category]);
    }

    public function remove(slideshow $slide)
    {
        $slide->delete();
        return redirect()->back()->withErrors(['تصویر با موفقیت حذف شد'], 'success');
    }

    public function create(priceCategory $category)
    {
        return view('admin.slideshows.create', ['category' => $category]);
    }

    public function store(priceCategory $category, Request $request)
    {
        $slideshow = new slideshow();
        $slideshow->picture = $this->uploadFile($request->picture, 'slideshows', uniqid() . '.' . $request->picture->extension());
        $slideshow->link = $request->link;
        $slideshow->category_id = $category->id;
        $slideshow->save();
        return redirect(route('admin.slideshowManagement', [$category->id]))->withErrors(['اسلایدشو با موفقیت افزوده شد'], 'success');
    }

    public function edit(slideshow $slide)
    {
        return view('admin.slideshows.edit', [
            'slideshow' => $slide
        ]);
    }

    public function update(slideshow $slide, Request $request)
    {
        if ($request->picture)
            $slide->picture = $this->uploadFile($request->picture, 'slideshows', uniqid() . '.' . $request->picture->extension());
        $slide->link = $request->link;
        $slide->save();
        return redirect(route('admin.slideshowManagement', [$slide->category_id]))->withErrors(['اسلایدشو با موفقیت افزوده شد'], 'success');

    }
}
