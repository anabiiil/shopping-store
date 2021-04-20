<?php

namespace App\Http\Controllers\Dashboard;

use PayPal\Api\Item;
use App\Models\Order;
use PayPal\Api\Payer;
use PayPal\Api\Amount;
use App\Models\Country;
use PayPal\Api\Details;
use PayPal\Api\Payment;
use PayPal\Api\ItemList;
use PayPal\Api\Transaction;
use PayPal\Rest\ApiContext;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use PayPal\Api\RedirectUrls;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use PayPal\Auth\OAuthTokenCredential;
use Illuminate\Support\Facades\Session;
use Cartalyst\Stripe\Laravel\Facades\Stripe;

class PaymentController extends Controller
{


    private $apiContext;
    private $secret;
    private $clientId;

    public function __construct(){
        $this->clientId = config('paypal.sandbox.client_id');
        $this->secret = config('paypal.sandbox.secret');
        $this->apiContext = new ApiContext(new OAuthTokenCredential($this->clientId , $this->secret));
        $this->apiContext->setConfig(config('paypal.settings'));
    }


    public function paypal(Request $request){
        $orderDetails = Order::where('id',Session::get('order_id'))->first();
        $getCountryCode = Country::where('name' ,$orderDetails->country )->first();
        $user_email = Auth::user()->email;
        DB::table('carts')->where('user_email',$user_email)->delete();
        return view('front.orders.paypal',compact('orderDetails','getCountryCode'));
    }

    public function thanksPaypal(){
        return view('front.orders.thanks_paypal');
    }

    public function cancelPaypal(){
        return view('front.orders.cancel_paypal');
    }

    public function paypalSdk(Request $request)
    {

        $orderDetails = Order::where('id',Session::get('order_id'))->first();
        $getCountryCode = Country::where('name' ,$orderDetails->country )->first();
        $user_email = Auth::user()->email;
        DB::table('carts')->where('user_email',$user_email)->delete();
        return view('front.orders.paybalSdk',compact('orderDetails','getCountryCode'));
    }

    public function payWithPaypal(Request $request)
    {


        // return $request->all();
        // integrate paypal
        $apiContext = new \PayPal\Rest\ApiContext(
        new \PayPal\Auth\OAuthTokenCredential(
            'AfOhL23TMvbhAK27fk2ET0jwdU2tJpb0flImHpf5RpUnz4tTD-1F3O-l4p6KbJp_3ZbyjVeD49yFVjWl',
            'ECBvd1p0aLwI9pFTrBR6eGXzAgrAARm5wp9uw6jqSifCjkzCu_KOELFCwRDfZa4YkAXhqEgkJCWq4pUx'
            )
        );

        $payer = new Payer();
        $payer->setPaymentMethod("paypal");
        //Itemized information (Optional) Lets you specify item wise information

        $item1 = new Item();
        $item1->setName('mustafa')
        ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice(17);

        $itemList = new ItemList();
        $itemList->setItems(array($item1));

        $details = new Details();
        $details->setShipping(1)
            ->setTax(2)
            ->setSubtotal(17);

        $amount = new Amount();
        $amount->setCurrency("USD")
            ->setTotal(20)
            ->setDetails($details);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription("Payment description")
            ->setInvoiceNumber(uniqid());


        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl("http://paypal.local/status")
            ->setCancelUrl("http://paypal.local/canceled");

        $payment = new Payment();


        $payment->setIntent("order")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));
        //For Sample Purposes Only.

        $request = clone $payment;

        try {
            $paymentdetail = $payment->create($apiContext);

        } catch(PayPal\Exception\PayPalConnectionException $ex){
            die($ex);
          }
        //Get redirect url
        //The API response provides the url that you must redirect the buyer to. Retrieve the url from the $payment->getApprovalLink() method

        $approvalUrl = $payment->getApprovalLink();
        //NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY

        // ResultPrinter::printResult("Created Payment Order Using PayPal. Please visit the URL to Approve.", "Payment", "<a href='$approvalUrl' >$approvalUrl</a>", $request, $payment);

        return redirect($approvalUrl);

    }

    public function status(){

    }
    public function canceled(){

        return "payment canceled";
    }
    public function stripe(Request $request)
    {
        $orderDetails = Order::where('id',Session::get('order_id'))->first();
        $getCountryCode = Country::where('name' ,$orderDetails->country )->first();
        $user_email = Auth::user()->email;
        DB::table('carts')->where('user_email',$user_email)->delete();
        return view('front.orders.stripe',compact('orderDetails','getCountryCode'));
    }
    public function payWithStripe(Request $request)
    {
        // dd($request->stripeToken);
        // dd($request->all());
        $charge = Stripe::charges()->create([
            'currency' => 'USD',
            'source' => $request->stripeToken,
            'amount'   => $request->amount,
            'description' => ' Test from laravel new app'
        ]);

        $chargeId = $charge['id'];

        if ($chargeId) {
            // // save order in orders table ...
            // auth()->user()->orders()->create([
            //     'cart' => serialize(session()->get('cart'))
            // ]);
            // clearn cart
            session()->flash('success', 'Payment was done. Thanks');
            return redirect('/cart');
        }else{
            return redirect()->back();
        }
    }


}
