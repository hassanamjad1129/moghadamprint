<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\priceCategory;
use App\priceFile;


class priceListController extends Controller
{
    public function index(){
      $lists=priceCategory::all();
      return view('admin.priceLists.index',['lists'=>$lists]);
    }
  
    public function updateList(Request $request){
      $priceFile=priceFile::find($request->category_id);
      $priceFile->file=$this->uploadFile($request->file,'priceFiles',uniqid().'.'.$request->file->extension());
      $priceFile->save();
      return redirect()->back()->withErrors(['لیست قیمت بروزرسانی شد'],'success');
    }
  
    
}
