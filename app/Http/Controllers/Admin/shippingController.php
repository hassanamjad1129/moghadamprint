<?php

namespace App\Http\Controllers\Admin;

use App\shipping;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class shippingController extends Controller
{
    public function create()
    {
        return view('admin.shippings.create');
    }

    public function store(Request $request)
    {
        $shipping = new shipping();
        $shipping->name = $request->name;
        $shipping->description = $request->description;
        $shipping->icon = $request->filepath;
        $shipping->save();
        return redirect(route('shippings.index'))->withErrors(['عملیات با موفقیت انجام شد'], 'success');
    }

    public function edit(shipping $shipping)
    {
        return view('admin.shippings.edit', ['shipping' => $shipping]);
    }

    public function update(shipping $shipping, Request $request)
    {
        $shipping->name = $request->name;
        $shipping->description = $request->description;
        $shipping->icon = $request->filepath;
        $shipping->save();
        return redirect(route('shippings.index'))->withErrors(['عملیات با موفقیت انجام شد.'], 'success');
    }

    public function index()
    {
        $shippings = shipping::all();
        return view('admin.shippings.index', ['shippings' => $shippings]);
    }

    public function destroy(shipping $shipping)
    {
        $shipping->status = 1;
        $shipping->save();
        return redirect(route('shippings.index'))->withErrors(['عملیات با موفقیت انجام شد'], 'success');
    }

    public function restore(shipping $shipping)
    {
        $shipping->status = 0;
        $shipping->save();
        return redirect(route('shippings.index'))->withErrors(['عملیات با موفقیت انجام شد'], 'success');
    }

}
