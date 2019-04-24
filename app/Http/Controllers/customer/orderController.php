<?php

namespace App\Http\Controllers\customer;

use App\category;
use App\Jobs\orderSubmit;
use App\order;
use App\orderFile;
use App\User;
use App\orderItem;
use App\product;
use App\profile;
use App\subCategoryFiles;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use League\Flysystem\Exception;
use App\Events\verifyOrderEvent;
use App\service;
use App\itemService;
use Zarinpal\Laravel\Facade\Zarinpal;

use App\Http\Controllers\Controller;

class orderController extends Controller
{

    public function __construct()
    {

    }

    public function create()
    {
        $categories = category::where('status', 1)->get();
        $services = service::all();
        return view('customer.order', [
            'categories' => $categories,
            'services' => $services
        ]);
    }

    public function store(Request $request)
    {
        $product = product::find($request->product);
        $files = subCategoryFiles::where('subcategory_id', $product->subcategory->id)->get();

        if ($request->type == 'double') {
            foreach ($files as $file) {
                if (!$request->session()->has('file-' . $file->id . '-front') or !$request->session()->has('file-' . $file->id . '-back')) {
                    return json_encode(1);
                }
            }
        } else {
            foreach ($files as $file) {
                if (!$request->session()->has('file-' . $file->id . '-front')) {
                    return json_encode(1);
                }
            }
        }
        $item = new orderItem();
        $item->product_id = $request->product;
        $item->user_id = auth()->user()->id;
        $item->qty = $request->qty;
        if ($request->description)
            $item->description = $request->description;
        $product = product::find($request->product);
        $files = subCategoryFiles::where('subcategory_id', $product->subcategory->id)->get();
        $x_lat = 0;
        $y_lat = 0;
        $item->speed = $request->speed;
        $item->type = $request->type;
        if ($request->type == 'single') {
            if ($request->speed == 'normal') {
                $item->unit_price = $product->single_price;
            } elseif ($request->speed == 'fast') {
                $item->unit_price = $product->fast_single_price;
            }
        } elseif ($request->type == 'double') {
            if ($request->speed == 'normal') {
                $item->unit_price = $product->double_price;
            } elseif ($request->speed == 'fast') {
                $item->unit_price = $product->fast_double_price;
            }
        }
        $item->discount = 0;
        $item->save();
        if ($request->type == 'double') {
            foreach ($files as $file) {

                $front = $request->session()->get('file-' . $file->id . '-front');
                $x_lat < $front[1] ? $x_lat = $front[1] : $x_lat = $x_lat;
                $y_lat < $front[2] ? $y_lat = $front[2] : $y_lat = $y_lat;
                $request->session()->forget('file-' . $file->id . '-front');
                $back = $request->session()->get('file-' . $file->id . '-back');
                $x_lat < $back[1] ? $x_lat = $back[1] : $x_lat = $x_lat;
                $y_lat < $back[2] ? $y_lat = $back[2] : $y_lat = $y_lat;
                $request->session()->forget('file-' . $file->id . '-back');
                $orderFile = new orderFile();
                $orderFile->item_id = $item->id;
                $orderFile->file_id = $file->id;
                $orderFile->front = $front[0];
                $orderFile->back = $back[0];
                $orderFile->save();
            }
        } else {
            foreach ($files as $file) {
                $front = $request->session()->get('file-' . $file->id . '-front');
                $x_lat < $front[1] ? $x_lat = $front[1] : $x_lat = $x_lat;
                $y_lat < $front[2] ? $y_lat = $front[2] : $y_lat = $y_lat;
                $request->session()->forget('file-' . $file->id . '-front');
                $orderFile = new orderFile();
                $orderFile->item_id = $item->id;
                $orderFile->file_id = $file->id;
                $orderFile->front = $front[0];
                $orderFile->save();
            }
        }
        $item->lats = $x_lat * $y_lat;
        if ($request->services)
            foreach ($request->services as $service) {
                $serv = service::find($service);
                $itemService = new itemService();
                $itemService->service_id = $service;
                $itemService->qty = 1;
                $itemService->item_id = $item->id;
                $itemService->price = $serv->single_price;
                $itemService->description = $request->input('description-' . $service);
                $itemService->save();

            }
        $item->save();
        return json_encode(100);
    }

    public static function getImageDpi($filename)
    {
        if (!empty($filename) && file_exists($filename)) {
            return self::getImageJpgDpi($filename);
        } else {
            Throw new \Exception('Invalid parameters');
        }
    }


    /**
     * @param string $filename
     * @return array
     * @throws Exception
     */
    public static function getImageJpgDpi($filename)
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
                                if ($JFIF_density_unit == 1) {
                                    $dpi = $JFIF_X_density;
                                } else if ($JFIF_density_unit == 2) {
                                    $dpi = $JFIF_X_density * 2.54;
                                }
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

    /**
     * @static
     * @param string $filename
     * @return array
     * @throws Exception
     */
    public static function getImagePngDpi($filename)
    {
        if (!empty($filename)
            && file_exists($filename)
        ) {

            $fh = fopen($filename, 'rb');

            if (!$fh) {
                return false;
            }

            $buf = array();

            $x = 0;
            $y = 0;
            $units = 0;

            while (!feof($fh)) {
                array_push($buf, ord(fread($fh, 1)));
                if (count($buf) > 13)
                    array_shift($buf);
                if (count($buf) < 13)
                    continue;
                if ($buf[0] == ord('p') &&
                    $buf[1] == ord('H') &&
                    $buf[2] == ord('Y') &&
                    $buf[3] == ord('s')) {
                    $x = ($buf[4] << 24) + ($buf[5] << 16) + ($buf[6] << 8) + $buf[7];
                    $y = ($buf[8] << 24) + ($buf[9] << 16) + ($buf[10] << 8) + $buf[11];
                    $units = $buf[12];
                    break;
                }
            }

            fclose($fh);

            if ($x != false
                && $units == 1
            ) {
                $x = round($x * 0.0254);
            }

            if ($y != false
                && $units == 1
            ) {
                $y = round($y * 0.0254);
            }

            if (empty($x)
                && empty($y)
            ) {
                if ($exifDpi = self::getImageDpiFromExif($filename)) {
                    $x = $exifDpi;
                    $y = $exifDpi;
                }
            }

            if (!empty($x)
                || !empty($y)
            ) {
                return array(
                    'x' => $x,
                    'y' => $y,
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

    /**
     * Read EXIF data.
     *
     * @static
     * @param string $filename
     * @return bool|float
     * @throws \Exception
     */
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

    public function cart()
    {
        $items = orderItem::where('user_id', auth()->user()->id)->where('verified', 0)->get();
        return view('customer.cart', [
            'items' => $items
        ]);
    }

    public function removeCart($id)
    {
        $item = orderItem::find($id)->delete();
        return redirect(route('customer.cart'))->withErrors(['آیتم مورد نظر با موفقیت حذف شد'], 'success');
    }

    public function finalStep(Request $request)
    {
        if ($request->select)
            $items = orderItem::whereIn('id', $request->select)->get();
        else
            $items = [];
        return view('customer.finalStep', [
            'items' => $items
        ]);
    }

    public function storeOrder(Request $request)
    {
        $sum = 0;
        foreach ($request->item as $value) {
            $orderItem = orderItem::find($value);
            $price = 0;
            if ($orderItem->itemServices->count())
                foreach ($orderItem->itemServices as $service) {
                    $price += $service->price * (($orderItem->lats * $orderItem->qty * $orderItem->product->subcategory->circulation) / $service->service->capacity) * $orderItem->lats * $orderItem->qty;
                }
            if ($orderItem->speed == "fast") {
                if ($orderItem->type == "single")
                    $unitPrice = $orderItem->product->fast_single_price;
                else
                    $unitPrice = $orderItem->product->fast_double_price;
            } else {
                if ($orderItem->type == "single")
                    $unitPrice = $orderItem->product->single_price;
                else
                    $unitPrice = $orderItem->product->double_price;
            }
            $sum += ($unitPrice * $orderItem->lats * $orderItem->qty + $price);
        }
        $order = new order();
        $order->user_id = auth()->user()->id;
        $order->shipping_id = null;
        $order->delivery_address = $request->address == "office" ? "تحویل در چاپخانه" : auth()->user()->profile->address;
        $order->total_price = $sum;
        $order->discount = 0;
        $order->payment_method = $request->payment;
        $order->verified = 0;
        $order->save();
        foreach ($request->item as $value) {
            $orderItem = orderItem::find($value);
            $orderItem->order_id = $order->id;
            $orderItem->save();
        }
        $profile = auth()->user()->profile;
        if ($profile->allow_buy == 0) {
            if ($profile->complex_money_bag >= $sum) {
                $profile = profile::find(auth()->user()->id);
                $profile->decrement('complex_money_bag', $sum);
                $profile->save();
                foreach ($request->item as $value) {
                    $orderItem = orderItem::find($value);
                    $orderItem->verified = 1;
                    if ($orderItem->speed == "fast") {
                        if ($orderItem->type == "single")
                            $unitPrice = $orderItem->product->fast_single_price;
                        else
                            $unitPrice = $orderItem->product->fast_double_price;
                    } else {
                        if ($orderItem->type == "single")
                            $unitPrice = $orderItem->product->single_price;
                        else
                            $unitPrice = $orderItem->product->double_price;
                    }
                    $orderItem->unit_price = $unitPrice;
                    $orderItem->save();
                }
                $order->verified = 1;
                $order->save();
                foreach ($request->item as $value) {
                    $orderItem = orderItem::find($value);
                    $orderItem->order_id = $order->id;
                    $orderItem->created_at = date('Y-m-d H:i:s');
                    $orderItem->save();
                    event(new verifyOrderEvent(User::find(auth()->user()->id), $orderItem));
                }

                return redirect(route('customerDashboard'))->withErrors(['سفارش شما با موفقیت ثبت شد'], 'success');
            }
        } elseif ($request->payment == 'online') {
            foreach ($request->item as $value) {
                $orderItem = orderItem::find($value);
                if ($orderItem->speed == "fast") {
                    if ($orderItem->type == "single")
                        $unitPrice = $orderItem->product->fast_single_price;
                    else
                        $unitPrice = $orderItem->product->fast_double_price;
                } else {
                    if ($orderItem->type == "single")
                        $unitPrice = $orderItem->product->single_price;
                    else
                        $unitPrice = $orderItem->product->double_price;
                }
                $orderItem->unit_price = $unitPrice;
                $orderItem->save();
            }
            $results = Zarinpal::request(
                url(route('customer.verifyOrder')),
                $sum / 10,
                "پرداخت فاکتور شماره " . $order->id . " \n مجتمع مقدم چاپ",
                "info@moghadampprint.com",
                auth()->user()->profile->phone,
                ['paymentId' => $order->id]
            );

            $order->authority = $results['Authority'];

            $order->save();
            Zarinpal::redirect();

        } else {
            foreach ($request->item as $value) {
                $orderItem = orderItem::find($value);
                if ($orderItem->speed == "fast") {
                    if ($orderItem->type == "single")
                        $unitPrice = $orderItem->product->fast_single_price;
                    else
                        $unitPrice = $orderItem->product->fast_double_price;
                } else {
                    if ($orderItem->type == "single")
                        $unitPrice = $orderItem->product->single_price;
                    else
                        $unitPrice = $orderItem->product->double_price;
                }
                $orderItem->unit_price = $unitPrice;
                $orderItem->save();
            }
            $profile = auth()->user()->profile;
            if ($profile->gift_money_bag >= $sum) {
                $profile = profile::find(auth()->user()->id);
                $profile->decrement('gift_money_bag', $sum);
                $profile->save();
                foreach ($request->item as $value) {
                    $orderItem = orderItem::find($value);
                    $orderItem->verified = 1;
                    $orderItem->save();
                }
                $order->verified = 1;
                $order->save();
                foreach ($request->item as $value) {
                    $orderItem = orderItem::find($value);
                    $orderItem->order_id = $order->id;
                    $orderItem->created_at = date('Y-m-d H:i:s');
                    $orderItem->save();
                    event(new verifyOrderEvent(User::find(auth()->user()->id), $orderItem));
                }

                return redirect(route('customerDashboard'))->withErrors(['سفارش شما با موفقیت ثبت شد'], 'success');
            } else {
                foreach ($request->item as $value) {
                    $orderItem = orderItem::find($value);
                    if ($orderItem->speed == "fast") {
                        if ($orderItem->type == "single")
                            $unitPrice = $orderItem->product->fast_single_price;
                        else
                            $unitPrice = $orderItem->product->fast_double_price;
                    } else {
                        if ($orderItem->type == "single")
                            $unitPrice = $orderItem->product->single_price;
                        else
                            $unitPrice = $orderItem->product->double_price;
                    }
                    $orderItem->unit_price = $unitPrice;
                    $orderItem->save();
                }
                if ($profile->gift_money_bag + $profile->money_bag >= $sum) {
                    $sum = $sum - $profile->gift_money_bag;
                    $profile = profile::find(auth()->user()->id);
                    $profile->gift_money_bag = 0;
                    $profile->decrement('money_bag', $sum);
                    $profile->save();
                    foreach ($request->item as $value) {
                        $orderItem = orderItem::find($value);
                        $orderItem->verified = 1;
                        $orderItem->save();
                    }
                    $order->real_price = $sum;
                    $order->verified = 1;
                    $order->save();
                    foreach ($request->item as $value) {
                        $orderItem = orderItem::find($value);
                        $orderItem->order_id = $order->id;
                        $orderItem->created_at = date('Y-m-d H:i:s');
                        $orderItem->save();
                        event(new verifyOrderEvent(User::find(auth()->user()->id), $orderItem));

                    }

                    return redirect(route('customerDashboard'))->withErrors(['سفارش شما با موفقیت ثبت شد'], 'success');
                } else {
                    return redirect(route('customerDashboard'))->withErrors(['عدم موجودی ! لطفا کیف پول خود را شارژ کنید'], 'failed');
                }
            }
        }
    }

    public function inCompleteOrders()
    {
        $orders = orderItem::where('status', '<=', 7)->where('user_id', auth()->user()->id)->where('verified', 1)->orderBy('created_at', 'desc')->get();
        return view('customer.orders.incomplete', [
            'orders' => $orders
        ]);
    }

    public function completedOrders()
    {
        $orders = orderItem::where('status', '>', 7)->where('user_id', auth()->user()->id)->where('verified', 1)->orderBy('id', 'desc')->get();
        return view('customer.orders.orders', [
            'orders' => $orders
        ]);
    }

    public function orderDetail(orderItem $order)
    {
        return view('customer.orders.detail', [
            'order' => $order
        ]);
    }


    public function verifyPayment(Request $request)
    {
        $authority = $request->input('Authority');
        $order = order::where('authority', $authority)->firstOrFail();
        $response = (Zarinpal::verify('OK', $order->total_price / 10, $authority));
        if ($response['Status'] == 'success') {
            $order->verified = 1;
            $order->save();

            $items = orderItem::where('order_id', $order->id)->get();
            foreach ($items as $item) {
                $item->verified = 1;
                $item->created_at = date('Y-m-d H:i:s');
                $item->save();
                $job = (new orderSubmit($item, 1))->delay(60 * 2);
                $this->dispatch($job);
                $job = (new orderSubmit($item, 2))->delay(60 * 10);
                $this->dispatch($job);
                event(new verifyOrderEvent(User::find(auth()->user()->id), $item));

            }
            return redirect(route('customerDashboard'))->withErrors(['پرداخت با موفقیت انجام شد'], 'success');
        } else {
            return redirect(route('customerDashboard'))->withErrors("خطایی در حین پرداخت رخ داده است", 'failed');
        }
    }

    public function getFactor(orderItem $orderItem)
    {
        if ($orderItem->user_id != auth()->user()->id)
            return abort(404);
        return view('customer.factor', ['orderItem' => $orderItem]);
    }

}
