<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\state;
use App\city;
use Illuminate\Support\Facades\DB;
use App\sendMethod;
use Illuminate\Database\QueryException;

class sendMethodController extends Controller{
  
    public function index(){
      $sendMethods = sendMethod::all();
      return view('admin.sendMethod.index',compact('sendMethods'));
    }
  
//   public function cityAjax(Request $request){
//       if($request->has('state')){
//           $state = state::find($request->state);
//           if($state){
//             return $state->cities;
//           }
//       }
//   }
  
//   public function showAjax(Request $request){
//       if($request->has('city')){
//           $city = city::find($request->city);
//         if($city){
//           return $city->sendMethods;
//         }
//       }
//   }
  
  
  public function delete(sendMethod $sendMethod){
      $sendMethod->delete();
      return redirect()->route('admin.sendMethod.index')->withErrors('عملیات با موفقیت انجام شد','success');
  }
  
  
  public function edit(sendMethod $sendMethod){ 
    return view('admin.sendMethod.edit',compact('sendMethod'));
  }
  
  public function create(){
      return view('admin.sendMethod.create');
  }
  
  private function validationStore(Request $request){
    return Validator::make($request->all(),[
        'sendMethod' => ['required']
    ]);
  }
  
  public function store(Request $request){
    $validation = $this->validationStore($request);
    if($validation->fails())
      return redirect()->route('admin.sendMethod.create')->withErrors($validation,'failed');
    
    DB::beginTransaction();
    try {
      $sendMethod = new sendMethod();
      $sendMethod->name = $request->sendMethod;
      $sendMethod->save(); 
      DB::commit();
    } catch (QueryException $exception) {
        DB::rollBack();
        return redirect()->route('admin.sendMethod.create')->withErrors($exception->getMessage(), 'failed');
    }
    return redirect()->route('admin.sendMethod.index')->withErrors('عملیات با موفقیت انجام شد','success');
  }
  
  public function update(Request $request,sendMethod $sendMethod){
    $validation = $this->validationStore($request);
    if($validation->fails())
      return redirect()->route('admin.sendMethod.edit',[$sendMethod])->withErrors($validation,'failed');
    
    DB::beginTransaction();
    try {
      $sendMethod->name = $request->sendMethod;
      $sendMethod->save();
        DB::commit();
    } catch (QueryException $exception) {
        DB::rollBack();
        return redirect()->route('admin.sendMethod.edit',[$sendMethod])->withErrors('خطا سمت سرور', 'failed');
    }
    return redirect()->route('admin.sendMethod.index')->withErrors('عملیات با موفقیت انجام شد','success');
  }  
  
}