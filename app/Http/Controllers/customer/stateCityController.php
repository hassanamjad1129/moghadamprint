<?php

namespace App\Http\Controllers\customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\state;
use App\city;
use Illuminate\Support\Facades\Validator;
use App\deliverie;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\sendMethod;
use App\orderItem;
use App\deliverieOrder;

class stateCityController extends Controller
{
  public function index(){
    $states = state::all();
    $orderItems = auth()->user()->orderItems()->where('status',7)->where('verified',1)->get();
    $sendMethods = sendMethod::all();
    return view('customer.stateCity.index',compact('states','orderItems','sendMethods'));
  }
  
  public function cityAjax(Request $request){
      if($request->has('state')){
          $state = state::find($request->state);
          if($state){
            return $state->cities;
          }
      }
  }
  
//   public function sendMethodAjax(Request $request){
//       if($request->has('city')){
//           $city = city::find($request->city);
//         if($city){
//           return $city->sendMethods;
//         }
//       }
//   }
  
  private function validationStore(Request $request){
    return Validator::make($request->all(),[
      'state' => ['required'],
      'city' => ['required'],
      'sendMethod' => ['required'],
      'sendCode' => ['array','required']
    ],[
      'sendMethod.required' => 'انتخاب باربری الزامی است',
      'sendCode.required' => 'انتخاب سفارش الزامی است'
    ]);
  }
  
  public function store(Request $request){
    $validation = $this->validationStore($request);
    if($validation->fails())
      return redirect()->route('customer.state.city')->withErrors($validation,'failed');
    
    $send_method = sendMethod::findOrFail($request->sendMethod);
    $sendCodes = orderItem::whereIn('id',$request->sendCode)->where('status',7)->where('verified',1)->where('user_id',auth()->user()->id)->get();
    
    DB::beginTransaction();
        try {
            $deliverie = new deliverie();
            $deliverie->city_id = $request->city;
            $deliverie->send_method_id = $send_method->id;
          $deliverie->user_id = auth()->user()->id;
            if($request->description)
              $deliverie->description = $request->description;
            $deliverie->save();
          foreach($sendCodes as $sendCode){
            $deliverieOrder = new deliverieOrder();
            $deliverieOrder->deliverie_id = $deliverie->id;
            $deliverieOrder->order_item_id = $sendCode->id;
            $deliverieOrder->save();
          }
          DB::commit();
        } catch (QueryException $exception) {
            DB::rollBack();
            return redirect()->route('customer.state.city')->withErrors([$exception->getMessage()], 'failed')->withInput();
        }
        return redirect()->route('customer.state.city')->withErrors(['عملیات با موفقیت انجام شد'], 'success');
  }
}