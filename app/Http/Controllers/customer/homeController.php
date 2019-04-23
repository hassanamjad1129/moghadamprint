<?php

namespace App\Http\Controllers\customer;

use App\product;
use App\productFile;
use App\subCategory;
use App\User;
use App\orderFile;
use App\profile;
use Image;
use App\slideshow;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class homeController extends Controller
{
    public function dashboard()
    {
        $slideshows=slideshow::where('category_id',16)->get();
        return view('customer.dashboard',['slideshows'=>$slideshows]);
    }
  
    private function checkIdIsUnique(int $id)
    {
        if (User::find($id))
            return true;
        return false;
    }
  
    private function checkEmailIsUnique($email)
    {
        if (User::where('email',$email)->where('id','<>',auth()->user()->id)->count())
            return true;
        return false;
    }
    
  
    public function updateProfile(Request $request){
        if ($this->checkEmailIsUnique($request->email))
                return redirect()->back()->withErrors(['خطا! این ایمیل قبلا ثبت شده است'], 'failed');
        $customer=User::find(auth()->user()->id);
        $profile = profile::find(auth()->user()->id);
        $customer->email = $request->email;
        if ($request->picture)
            $customer->avatar = $this->uploadFile($request->picture, 'userAvatar', uniqid() . '.' . $request->picture->getExtension());
        if ($request->password)
            $customer->password = bcrypt($request->password);
        $profile->phone = $request->phone;
        $profile->telephone = $request->telephone;
        $profile->address = $request->address;
        $profile->save();
        $customer->save();
        return redirect(route('customerDashboard'))->withErrors(['عملیات با موفقیت انجام شد'], 'success');
    }

    public function getSubCategories(Request $request)
    {
        return json_encode(subCategory::where('category_id', $request->category)->where('status', 1)->get());
    }

    public function fetchProducts(Request $request)
    {
        return json_encode(product::where('subcategory_id', $request->subCategory)->where('status', 1)->get());
    }

    public function fetchProductInformation(Request $request)
    {
        return json_encode(product::find($request->product));
    }

    public function getFiles(Request $request)
    {

        return json_encode(productFile::where('subcategory_id', $request->subCategory)->where('status', 1)->get());
    }

    public function checkFile(Request $request)
    {
        /*
        Error codes
        1   = image format must be jpeg or jpg
        2   = size is invalid
        3   = RGB detected  
        100 = successfully 
        */
        $product = product::find($request->product);
        $result = [];
        $perviousFront="";
        $perviousBack="";
        
        foreach ($request->all() as $key => $item) {

            if ($key == 'product' or $key == 'type' or $key == 'speed' or $key == 'qty' or $key == 'product' or $key == 'subCategory') {
                continue;
            }
            if (!$item)
                continue;
            if (!in_array($item->extension(), ['jpg', 'jpeg'])) {
                return json_encode(1);
            }
            $id = uniqid() . '.' . $item->extension();
            $image = $this->uploadFile($item, 'orders/' . auth()->user()->id, $id);

           eval('$sizes='.shell_exec('exiftool -php /home/moghadamprint/public_html/moghadamprint/public/orders/'.auth()->user()->id.'/'.$id));            
               
if($sizes[0]['ResolutionUnit']=="cm\n"){
              $sizes['x']=$sizes[0]['XResolution'];
              $sizes['y']=$sizes[0]['YResolution'];
            }else{
              $sizes['x']=$sizes[0]['XResolution']/2.54;
              $sizes['y']=$sizes[0]['YResolution']/2.54;
            }
            list($width, $height) = getimagesize($image);
            $channel=getimagesize($image)['channels'];
            if($channel==3){
                return json_encode(3);    
            }
            $x_lats = ceil(round($width / $sizes['x'] ,1) / ($product->x_size/10));
            $y_lats = ceil((round($height / $sizes['y'] ,1)) / ($product->y_size/10));
            $realWidth=round(($product->x_size*$x_lats*$sizes['x']/10));
            $realHeight=round(($product->y_size*$y_lats*$sizes['x']/10));
            $minimalWidth=round(300*$width/$realWidth);
            if (!$product->allowLats or ($x_lats==1 and $y_lats==1) ) {
                $request->session()->put($key, ['/orders/' . auth()->user()->id . '/' . $id, $x_lats, $y_lats]);
                $nesbat=round($width/$height,1);
                $nesbat3=round($realWidth/$realHeight,1);
                $nesbat2=$realWidth/$minimalWidth;
                
                Image::make(($image))->resize($minimalWidth, $minimalWidth/$nesbat)->save(public_path('/orders/' . auth()->user()->id . '/'.'test-'.$id));
                
                 eval('$sizes=' . shell_exec('exiftool -php /home/moghadamprint/public_html/moghadamprint/public/orders/'.auth()->user()->id.'/test-'.$id));
              if($sizes[0]['ResolutionUnit']=="cm\n"){
                $sizes['x']=$sizes[0]['XResolution'];
                $sizes['y']=$sizes[0]['YResolution'];
              }else{
                $sizes['x']=$sizes[0]['XResolution']/2.54;
                $sizes['y']=$sizes[0]['YResolution']/2.54;
              }
            $sizes['x']=$sizes['x'];
                $fileInf=explode('-',$key);
                if($fileInf[2]=='front'){
                  if(!$perviousFront){
                    $file=productFile::find($fileInf[1]);
                    $perviousFront='/orders/' . auth()->user()->id . '/test-' . $id;
                    $result[] = [300, 300/$nesbat3, '/orders/' . auth()->user()->id . '/test-' . $id, round(((3/10) *$sizes['x']), 1), round((3/10  * $sizes['x']), 1),"",$file->front_file_label];
                  }else{
                    $file=productFile::find($fileInf[1]);
                    $result[] = [300, 300/$nesbat3, '/orders/' . auth()->user()->id . '/test-' . $id, round(((3/10 ) *$sizes['x']), 1), round((3/10  * $sizes['x']), 1),$perviousFront,$file->front_file_label];  
                  }
                }else{
                  if(!$perviousBack){
                    $file=productFile::find($fileInf[1]);
                    $perviousBack='/orders/' . auth()->user()->id . '/test-' . $id;  
                    $result[] = [300, 300/$nesbat3, '/orders/' . auth()->user()->id . '/test-' . $id, round(((3/10 )*$sizes['x']), 1), round((3/10  * $sizes['x']), 1),"",$file->back_file_label];
                  }else{
                      $file=productFile::find($fileInf[1]);
                      $result[] = [300, 300/$nesbat3, '/orders/' . auth()->user()->id . '/test-' . $id, round(((3/10 )*$sizes['x']), 1), round((3/10  * $sizes['x']), 1),$perviousBack,$file->back_file_label];
                  }
                }
            } else
                return json_encode(2);
        }
        return json_encode($result);
    }

    public static function getImageDpi($filename)
    {
        if (!empty($filename) && file_exists($filename)) {
            $dpi = 0;
            $fp = @fopen($filename, 'rb');

            if ($fp) {
                if (fseek($fp, 6) == 0) {
                    if (($bytes = fread($fp, 16)) !== false) {
                        if (substr($bytes, 0, 4) == "JFIF") {
                            $JFIF_density_unit = ord($bytes[7]);
                            $JFIF_X_density = ord($bytes[8]) * 256 + ord($bytes[9]);
                            $JFIF_Y_density = ord($bytes[10]) * 256 + ord($bytes[11]);

                            if ($JFIF_X_density == $JFIF_Y_density) {
                                    $dpi = $JFIF_X_density;
                                
                            }
                        }
                    }
                }
                fclose($fp);
            }

            if (empty($dpi)) {
                if ($exifDpi = self::getImageDpiFromExif($filename)) {
                    $dpi = $exifDpi;
                }
            }

            if (!empty($dpi)) {
                return array(
                    'x' => $dpi,
                    'y' => $dpi,
                );
            } else {
                return array(
                    'x' => 72,
                    'y' => 72,
                );
            }

        } else {
            Throw new \Exception('Invalid parameters');
        }
    }

    public static function getImageDpiFromExif($filename)
    {

        if (!empty($filename)
            && file_exists($filename)
        ) {
            if (function_exists('exif_read_data')) {
                if ($exifData = exif_read_data($filename)) {
                    if (isset($exifData['XResolution'])) {
                        if (strpos($exifData['XResolution'], '/') !== false) {
                            if ($explode = explode('/', $exifData['XResolution'])) {
                                return (float)((int)$explode[0] / (int)$explode[1]);
                            }
                        } else {
                            return (int)$exifData['XResolution'];
                        }
                    } else if (isset($exifData['YResolution'])) {
                        if (strpos($exifData['YResolution'], '/') !== false) {
                            if ($explode = explode('/', $exifData['YResolution'])) {
                                return (float)((int)$explode[0] / (int)$explode[1]);
                            }
                        } else {
                            return (int)$exifData['YResolution'];
                        }
                    }
                }
            } else {
                Throw new \Exception('Incompatible system.');
            }
        } else {
            Throw new \Exception('Invalid parameters.');
        }

        return false;

    }

}
