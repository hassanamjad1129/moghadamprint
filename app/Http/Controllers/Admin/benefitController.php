<?php

namespace App\Http\Controllers\Admin;

use App\benefit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class benefitController extends Controller
{
    public function create()
    {
        return view('admin.benefits.create');
    }

    public function store(Request $request)
    {
        $benefit = new benefit();
        $benefit->min = str_replace(",", "", $request->min);
        $benefit->max = $request->max?str_replace(",", "", $request->max):null;
        $benefit->percentage = $request->percentage;
        $benefit->save();
        return redirect(route('benefits.index'))->withErrors(['آیتم مورد نظر با موفقیت ثبت شد.'], 'success');
    }

    public function edit(benefit $benefit)
    {
        return view('admin.benefits.edit', [
            'benefit' => $benefit
        ]);
    }

    public function update(benefit $benefit, Request $request)
    {
        $benefit->min = str_replace(",", "", $request->min);
        $benefit->max = $request->max?str_replace(",", "", $request->max):null;
        $benefit->percentage = $request->percentage;
        $benefit->save();
        return redirect(route('benefits.index'))->withErrors(['آیتم مورد نظر با موفقیت بروزرسانی شد'], 'success');
    }

    public function destroy(benefit $benefit)
    {
        $benefit->delete();
        return redirect(route('benefits.index'))->withErrors(['آیتم مورد نظر با موفقیت حذف شد'], 'failed');
    }

    public function index()
    {
        $benefits = benefit::all()->reverse();
        return view('admin.benefits.index', [
            'benefits' => $benefits
        ]);
    }
}
