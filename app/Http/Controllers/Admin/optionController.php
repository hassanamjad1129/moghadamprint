<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\option;

class optionController extends Controller
{
    public function index(){
      $options=option::all();
      return view('admin.options.index',['options'=>$options]);
    }
  
    public function update(Request $request){
      
      foreach($request->except('_token') as $index=>$option){
        $thisOption=option::find($index);
        if($thisOption->option_name=='priceList'){
          $thisOption->option_value=$this->uploadFile($request->file($index),'settings',uniqid().'.'.$request->file($index)->extension());
        }
        else  
          $thisOption->option_value=$option;
        $thisOption->save();
      }
      return back()->withErrors(['عملیات با موفقیت انجام شد'],'success');
    }
}
