<?php

namespace App\Http\Controllers\Admin;

use App\Events\sendMoneyBagSmsEvent;
use App\Events\adminRegisterSMSEvent;
use App\moneybagReport;
use App\orderItem;
use App\product;
use Hash;
use App\profile;
use App\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;
use App\Events\verifyUserEvent;
use Morilog\Jalali\CalendarUtils;

class customerController extends Controller
{
    public function index()
    {
        $customers = User::where('level', '<>', 'admin')->where('active', '<>', 0)->get();
        return view('admin.customers.index', [
            'customers' => $customers
        ]);
    }

    public function edit(User $customer)
    {
        if ($customer->level == 'admin')
            return abort(403);
        $profile = profile::find($customer->id);
        return view('admin.customers.edit', ['user' => $customer, 'profile' => $profile]);
    }

    private function checkIdIsUnique(int $id)
    {
        if (User::find($id))
            return true;
        return false;
    }

    public function update(User $customer, Request $request)
    {
        if ($customer->level == 'admin')
            return abort(403);
        if ($customer->id != $request->id)
            if ($this->checkIdIsUnique($request->id))
                return redirect()->back()->withErrors(['خطا! این کد کاربری قبلا ثبت شده است'], 'failed');
        $profile = profile::find($customer->id);
        $customer->id = $request->id;
        if ($customer->active != 1) {
            event(new verifyUserEvent($customer));
        }
        $customer->active = 1;
        $customer->name = $request->name;
        $customer->email = $request->email;
        if ($request->picture)
            $customer->avatar = $this->uploadFile($request->picture, 'userAvatar', uniqid() . '.' . $request->picture->getExtension());
        if ($request->password)
            $customer->password = bcrypt($request->password);
        $profile->phone = $request->phone;
        $profile->telephone = $request->telephone;
        $profile->address = $request->address;
        $profile->reagent = $request->reagent;
        $profile->gender = $request->gender;
        $profile->save();
        $customer->save();
        return redirect(route('customers.index'))->withErrors(['عملیات با موفقیت انجام شد'], 'success');
    }

    public function destroy(User $customer)
    {
        if ($customer->level == 'admin')
            return abort(403);
        $customer->active = -1;
        $customer->save();
        return redirect(route('customers.index'))->withErrors(['عملیات با موفقیت انجام شد'], 'success');
    }

    public function unblock(User $customer)
    {
        if ($customer->level == 'admin')
            return abort(403);
        $customer->active = 1;
        $customer->save();
        return redirect(route('customers.index'))->withErrors(['عملیات با موفقیت انجام شد'], 'success');
    }

    public function orders(User $customer, Request $request)
    {
        $orders = orderItem::where('order_items.user_id', $customer->id)->join('orders', 'orders.id', '=', 'order_items.order_id');

        if ($request->has('start')) {
            $startTime = CalendarUtils::createCarbonFromFormat('Y/m/d', $request->start)->toDateTimeString();
            $orders = $orders->where('orders.created_at', '>=', $startTime);
        }
        if ($request->has('end')) {
            $finishTime = CalendarUtils::createCarbonFromFormat('Y/m/d', $request->end)->addDays(1)->toDateTimeString();
            $orders = $orders->where('orders.created_at', '<', $finishTime);
        }
        $orders = $orders->select(['order_items.*'])->get();
        return view('admin.customers.orders', ['orders' => $orders, 'customer' => $customer]);
    }

    public function notVerified()
    {
        $customers = User::where('level', '<>', 'admin')->where('active', 0)->get();
        return view('admin.customers.notVerified', [
            'customers' => $customers
        ]);
    }

    public function show(User $customer)
    {
        return view('admin.customers.show', ['user' => $customer]);
    }

    public function setCustomer(User $customer)
    {
        $customer->level = 'customer';
        $customer->save();
        return redirect()->back()->withErrors(['عملیات با موفقیت انجام شد.'], 'success');
    }

    public function setRepresentation(User $customer)
    {
        return view('admin.customers.setRepresentation', ['customer' => $customer]);
    }

    public function storeRepresentation(User $customer, Request $request)
    {
        $customer->percentage = $request->percentage;
        $customer->level = "representation";
        $customer->save();
        return redirect(route('customers.index'))->withErrors(['عملیات با موفقیت انجام شد']);
    }

    public function setCreditlyCustomer()
    {

    }


    public function loginToUserAccount(User $customer, Request $request)
    {
        $request->session()->put('prevUser', auth()->user()->id);
        auth()->loginUsingId($customer->id);
        return redirect('/customer');
    }

    public function moneybag(User $customer)
    {
        $moneybags = moneybagReport::where('user_id', $customer->id)->where('showMessage', 1)->orderBy('id', 'desc')->get();
        return view('admin.customers.moneybag', [
            'moneybags' => $moneybags,
            'customer' => $customer
        ]);
    }

    public function storeMoneyBag(User $customer, Request $request)
    {
        $price = str_replace(',', '', $request->price);
        if ($price <= 0) {
            return redirect()->back()->withErrors(['خطا! مبلغ می بایست بیشتر از 0 باشد'], 'failed');
        }
        if ($request->operation != 'increase' and $request->operation != 'decrease') {
            return redirect()->back()->withErrors(['خطا! داده نامعتبر'], 'failed');
        }
        DB::beginTransaction();
        $description = $request->description ? $request->description : "";
        try {
            $this->adjustMoneyBag($customer, $price, $request->operation, $description, $request->showMessage ? $request->showMessage : 0, $request->subject);
            $this->createMoneyBagReport($customer, $price, $request->operation, $description, $request->showMessage ? $request->showMessage : 0, $request->subject);
            if ($request->sendMessage)
                event(new sendMoneyBagSmsEvent($customer, $request->description));
        } catch (QueryException $exception) {
            DB::rollback();
            return redirect()->back()->withErrors([$exception->getMessage()], 'failed');
        }
        DB::commit();
        return redirect()->back()->withErrors(['عملیات با موفقیت انجام شد'], 'success');
    }

    /**
     * @param User $customer
     * @param int $price
     * @param string $operation
     * @param string $description
     */
    private function adjustMoneyBag(User $customer, float $price, string $operation, string $description, $showMessage, $subject)
    {
        $profile = profile::find($customer->id);
        if ($operation == "decrease") {
            $profile->decrement($subject, $price);
        } elseif ($operation == 'increase') {
            $profile->increment($subject, $price);
        }
        $profile->save();
    }

    /**
     * @param User $customer
     * @param int $price
     * @param string $operation
     * @param string $description
     */
    private function createMoneyBagReport(User $customer, float $price, string $operation, string $description, $showMessage, $subject)
    {
        $report = new moneybagReport();
        $report->user_id = $customer->id;
        $report->price = $price;
        $report->description = $description;
        $report->operation = $operation;
        $report->showMessage = $showMessage;
        $report->save();
    }

    public function deleteUser(User $customer)
    {
        $customer->delete();
        return redirect()->back()->withErrors(['مشتری با موفقیت حذف شد'], 'success');
    }

    public function sendMessage(Request $request)
    {
        $url = "37.130.202.188/services.jspd";
        $rcpt_nm = array(User::find($request->user)->profile->phone);
        $param = array
        (
            'uname' => 'مقدم چاپ',
            'pass' => '22501792',
            'from' => '100020400',
            'message' => $request->description,
            'to' => json_encode($rcpt_nm),
            'op' => 'send'
        );

        $handler = curl_init($url);
        curl_setopt($handler, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($handler, CURLOPT_POSTFIELDS, $param);
        curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
        $response2 = curl_exec($handler);

        $response2 = json_decode($response2);
        $res_code = $response2[0];
        $res_data = $response2[1];
        return redirect()->back()->withErrors(['پیام مورد نظر با موفقیت ارسال شد'], 'success');
    }

    public function sendGroupMessage()
    {
        return view('admin.groupMessage');
    }

    public function sendMessageToAll(Request $request)
    {
        $url = "37.130.202.188/services.jspd";
        $rcpt_nm = (User::where('level', '<>', 'admin')->where('active', 1)->join('user_profile', 'user_profile.user_id', '=', 'users.id')->pluck('user_profile.phone')->toArray());
        $param = array
        (
            'uname' => 'مقدم چاپ',
            'pass' => '22501792',
            'from' => '100020400',
            'message' => $request->description,
            'to' => json_encode($rcpt_nm),
            'op' => 'send'
        );

        $handler = curl_init($url);
        curl_setopt($handler, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($handler, CURLOPT_POSTFIELDS, $param);
        curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
        $response2 = curl_exec($handler);

        $response2 = json_decode($response2);
        $res_code = $response2[0];
        $res_data = $response2[1];
        return redirect()->back()->withErrors(['پیام مورد نظر با موفقیت ارسال شد'], 'success');

    }

    public function signup(Request $request)
    {
        return view('admin.customers.signup');
    }

    protected function generateCode($codeLength)
    {
        $min = pow(10, $codeLength);
        $max = $min * 10 - 1;
        $code = mt_rand($min, $max);
        return $code;
    }

    protected function user_id()
    {
        $code = $this->generateCode(3);
        if (User::find($code))
            return $this->user_id();
        else
            return $code;
    }


    public function storeUser(Request $request)
    {
        $id = $this->user_id();
        DB::beginTransaction();
        try {
            $user = User::create([
                'id' => $id,
                'name' => $request->name,
                'email' => $request->phone,
                'password' => Hash::make("123456"),
                'level' => 'customer'
            ]);
            $profile = new profile();
            $profile->user_id = $id;
            $profile->telephone = null;
            $profile->phone = $request->phone;
            $profile->address = $request->address;
            $profile->gender = $request->gender;
            $profile->reagent = null;
            $profile->save();
            event(new adminRegisterSMSEvent($user));
        } catch (QueryException $exception) {
            DB::rollback();
            return redirect()->back()->withErrors(['خطا! لطفا دوباره تلاش کنید'], 'failed');
        }
        DB::commit();
        return redirect()->back()->withErrors(['عملیات با موفقیت انجام شد'], 'success');
    }
}
