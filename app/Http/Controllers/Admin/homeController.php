<?php

namespace App\Http\Controllers\Admin;

use App\subCategory;
use App\User;
use App\notification;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class homeController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    protected function validator(Request $request)
    {
        return Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'nullable|string|min:6|confirmed',
        ]);
    }

    public function updateProfile(Request $request)
    {
        $validator = $this->validator($request);
        if ($validator->fails())
            return redirect()->back()->withErrors($validator, 'failed');
        $user = User::find(auth()->user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password)
            $user->password = bcrypt($request->password);
        if ($request->avatar)
            $user->avatar = $this->uploadFile($request->avatar, 'userAvatar', uniqid() . '.' . $request->avatar->getExtension());
        $user->save();
        return redirect(route('adminDashboard'))->withErrors(['مشخصات پروفایل کاربری با موفقیت بروزرسانی شد'], 'success');
    }

    public function fetchSubCategories(Request $request)
    {
        $sub_categories = subCategory::select(['id', 'name'])->where('status', 1)->where('category_id', $request->category_id)->get();
        return json_encode($sub_categories);
    }

    public function checkOrders(){
      return json_encode(notification::where('seen',0)->where('category','order')->orderBy('id','desc')->get()->map(function ($item){
        return ['created_at'=>jdate(strtotime($item->created_at))->ago(),'link'=>$item->link,'description'=>$item->description,'id'=>$item->id];
      }));
    }

    public function checkUsers(){
      return json_encode(notification::where('seen',0)->where('category','register')->orderBy('id','desc')->get()->map(function ($item){
        return ['created_at'=>jdate(strtotime($item->created_at))->ago(),'link'=>$item->link,'description'=>$item->description,'id'=>$item->id];
      }));
    }
  
    public function checkTickets(){
      return json_encode(notification::where('seen',0)->where('category','ticket')->orderBy('id','desc')->get()->map(function ($item){
        return ['created_at'=>jdate(strtotime($item->created_at))->ago(),'link'=>$item->link,'description'=>$item->description,'id'=>$item->id];
      }));
    }
  
    public function seenNotification(Request $request){
      $notification=notification::find($request->id);
      $notification->seen=1;
      $notification->save();
    }
  
}
