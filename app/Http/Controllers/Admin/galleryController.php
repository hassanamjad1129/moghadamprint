<?php 

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\galleryCategory;
use App\gallery;
use Validator;

class galleryController extends Controller{
  
  public function createCategory(){
    return view('admin.gallery.category.create');
  } 
  
  private function categoryValidation(Request $request){
    return Validator::make($request->all(),[
      'name'=>'required'
    ],[
      'name.required'=>'نام الزامی است'
    ]);
  }
  
  public function storeCategory(Request $request){
    $validate=$this->categoryValidation($request);
    if($validate->fails())
      return redirect()->back()->withErrors($validate,'failed');
    $category=new galleryCategory();
    $category->name=$request->name;
    $category->save();
    return redirect(route('admin.galleryCategory.index'))->withErrors(['عملیات با موفیت انجام شد'],'success');
  }
  
  public function editCategory(galleryCategory $category){
    return view('admin.gallery.category.edit',['category'=>$category]);
  }
  
  public function updateCategory(galleryCategory $category,Request $request){
    $validate=$this->categoryValidation($request);
    if($validate->fails())
      return redirect()->back()->withErrors($validate,'failed');
    $category->name=$request->name;
    $category->save();
    return redirect(route('admin.galleryCategory.index'))->withErrors(['عملیات با موفیت انجام شد'],'success');  
  }
  
  public function destroyCategory(galleryCategory $category){
    $category->delete();
    return redirect(route('admin.galleryCategory.index'))->withErrors(['عملیات با موفیت انجام شد'],'success');
  }
  
  public function indexCategory(){
    $categories=galleryCategory::all();
    return view('admin.gallery.category.index',['categories'=>$categories]);
  }
  
  public function create(){
    $categories=galleryCategory::all();
    return view('admin.gallery.create',['categories'=>$categories]);  
  }
  
 
  public function store(Request $request){
    $gallery=new gallery();
    $gallery->picture=$this->uploadFile($request->picture, 'gallery', uniqid() . '.' . $request->picture->extension());
    $gallery->category_id=$request->category;
        $gallery->title1=$request->title1;
    $gallery->title2=$request->title2;
    $gallery->save();
    return redirect(route('admin.gallery.index'))->withErrors(['عملیات با موفقیت انجام شد'],'success');
  }
  
  public function edit(gallery $gallery){
    $categories=galleryCategory::all();
    return view('admin.gallery.edit',['categories'=>$categories,'gallery'=>$gallery]);  
  }
  
 public function update(Request $request,gallery $gallery){
    if($request->picture)
      $gallery->picture=$this->uploadFile($request->picture, 'gallery', uniqid() . '.' . $request->picture->extension());
    $gallery->category_id=$request->category;
    $gallery->title1=$request->title1;
    $gallery->title2=$request->title2;
    $gallery->save();
    return redirect(route('admin.gallery.index'))->withErrors(['عملیات با موفقیت انجام شد'],'success');
  }
  
  
  public function destroy(gallery $gallery){
    $gallery->delete();
    return redirect(route('admin.gallery.index'))->withErrors(['عملیات با موفقیت انجام شد'],'success');
  }
  
  public function index(){
    $galleries=gallery::all();
    return view('admin.gallery.index',['galleries'=>$galleries]);
  }
  
}

?>