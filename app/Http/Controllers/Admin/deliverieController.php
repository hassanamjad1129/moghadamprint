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
use App\deliverie;
use App\User;

class deliverieController extends Controller{
  
    public function index($type="index"){
      if($type == 'index')
          $deliveries = deliverie::where('status',0)->get();
      elseif($type == 'record')
          $deliveries = deliverie::where('status',1)->get();
      
      return view('admin.deliverie.index',compact('deliveries','type'));
    }
  
 
  public function detailDeliverie(deliverie $deliverie){
    $user = $deliverie->user;
   // $sendMethod = sendMethod::findOrFail($deliverie->send_method_id);
    return view('admin.deliverie.detail',compact('deliverie','user'));
  }
  
  public function accept(deliverie $deliverie){
    $deliverie->status = 1;
    $deliverie->save();
    return redirect()->route('admin.deliverie.index')->withErrors('عملیات با موفقیت انجام شد','success');
  }
  
}