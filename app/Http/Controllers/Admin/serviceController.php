<?php

namespace App\Http\Controllers\Admin;

use App\subCategory;
use App\User;
use App\notification;
use App\service;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class serviceController extends Controller
{
    public function index()
    {
        $services=service::all();
        return view('admin.services.index',[
          'services'=>$services
        ]);
    }

    public function create(){
      return view('admin.services.create');
    }
  
    public function store(Request $request){
      $validator=$this->serviceValidation($request);
      if($validator->fails()){
        return redirect()->back()->withErrors($validator,'failed');
      }
      $service=new service();
      $service->name=$request->name;
      $service->capacity=$request->capacity;
      $service->single_price=$request->single_price;
      $service->double_price=$request->double_price;
      $service->save();
      return redirect(route('admin.services.index'))->withErrors(['خدمت جدید با موفقیت ایجاد شد'],'success');
    }
  
    protected function serviceValidation(Request $request){
      return Validator::make($request->all(),[
        'name'=>'required',
        'capacity'=>'required|integer|min:1',
        'single_price'=>'required|integer|min:0',
        'double_price'=>'required|integer|min:0'
      ],[
        'name.required'=>'نام خدمت را وارد کنید',
        'capacity.required'=>'ظرفیت حداقل خدمت را مشخص کنید',
        'capacity.integer'=>'ظرفیت حداقل خدمت را به صورت عددی مشخص کنید',
        'capacity.min'=>'ظرفیت حداقل خدمت باید بیشتر از یک باشد',
        'single_price.required'=>'قیمت خدمت را مشخص کنید',
        'single_price.integer'=>'قیمت خدمت را به صورت عددی مشخص کنید',
        'single_price.min'=>'قیمت خدمت حداقل می بایست صفر باشد',
      
        'double_price.required'=>'قیمت خدمت را مشخص کنید',
        'double_price.integer'=>'قیمت خدمت را به صورت عددی مشخص کنید',
        'double_price.min'=>'قیمت خدمت حداقل می بایست صفر باشد'
      ]);
    }
  
    public function edit(service $service){
      return view('admin.services.edit',['service'=>$service]);
    }
  
    public function update(service $service,Request $request){
      $validator=$this->serviceValidation($request);
      if($validator->fails()){
        return redirect()->back()->withErrors($validator,'failed');
      }
      $service->name=$request->name;
      $service->capacity=$request->capacity;
      $service->single_price=$request->single_price;
      $service->double_price=$request->double_price;
      $service->save();
      return redirect(route('admin.services.index'))->withErrors(['خدمت مورد نظر با موفقیت حذف شد'],'success');
    }
  
    public function destroy(service $service){
      $service->delete();
      return redirect()->back()->withErrors(['خدمت مورد نظر با موفقیت حذف شد'],'success');
    }
    
}
