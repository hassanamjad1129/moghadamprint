<?php

namespace App\Http\Controllers\customer;

use App\chargeRequest;
use App\moneybagReport;
use App\profile;
use Illuminate\Http\Request;
use League\Flysystem\Exception;
use Rasulian\ZarinPal\Payment;
use App\Http\Controllers\Controller;

class moneybagController extends Controller
{
    protected $zarinPal;

    public function __construct(Payment $zarinPal)
    {
        $this->zarinPal = $zarinPal;
    }

    public function increase()
    {
        return view('customer.moneybag.increase');
    }

    public function storeRequest(Request $request)
    {

    }

    public function doPayment(Request $request)
    {
        $chargeRequest = new chargeRequest();
        $chargeRequest->user_id = auth()->user()->id;
        $chargeRequest->amount = $request->amount;
        $chargeRequest->status = 0;
        $chargeRequest->save();
        // Doing the payment
        $payment = $this->zarinPal->request(

        // The total price for the order
            $request->amount / 10,

            // Pass any parameter you want when the customer successfully do the payment
            // and gets back to your site
            ['paymentId' => $chargeRequest->id],

            // Callback URL
            route('customer.moneybag.verifyPayment'),

            // A summary of your product or application
            'شارژ کیف پول'
        );

        // Throw an exception if the payment request result had any error
        if ($payment->get('result') == 'warning')
            throw new Exception($payment->get('error'));

        // Redirect the customer to the ZarinPal gateway to do the payment
        return redirect()->away($payment->get('url'));
    }

    public function verifyPayment(Request $request)
    {
        $authority = $request->input('Authority');
        $chargeRequest = chargeRequest::find($request->input('paymentId'));
        $verify = $this->zarinPal->verify($chargeRequest->amount / 10, $authority);

        if ($verify->get('result') == 'success') {
            $chargeRequest->status = $verify->get('code');
            // Do the needed stuff If the verify was success
            $chargeRequest->Authority = $authority;
            // If not, we can check which status code is given back to us from the ZarinPal gateway
            // and show a message error correspond to the status code.
            $chargeRequest->save();
            $profile = profile::find($chargeRequest->user_id);
            $profile->increment('money_bag', $chargeRequest->amount);
            $profile->save();

            $log = new moneybagReport();
            $log->user_id = auth()->user()->id;
            $log->price = $chargeRequest->amount;
            $log->type = "payment";
            $log->operation = "increase";
            $log->description = "افزایش اعتبار از طریق درگاه";
            $log->save();
            return redirect(route('customer.moneybag.index'))->withErrors(['پرداخت با موفقیت انجام شد'], 'success');
        } else {
            return redirect(route('customer.moneybag.index'))->withErrors([$verify->get('error')], 'failed');
        }
    }

    public function index()
    {
        $logs = moneybagReport::where('user_id', auth()->user()->id)->where('showMessage', 1)->orderBy('id', 'desc')->get();
        return view('customer.moneybag.index', [
            'logs' => $logs
        ]);
    }
}
