<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Stripe;
use App\Models\User;
use App\Models\UserPayment;
use Razorpay\Api\Api;

class SubscriptionController extends Controller
{
    public function plans()
    {
        return view('customer.payment.plans');
    }

    public function planSubmit(Request $request)
    {
        if($request->gateway==0)
        {
            // $api = new Api(env('RAZORPAY_KEY_ID'), env('RAZORPAY_KEY_SECRET'));
            // $order = $api->order->create(array('receipt' => time(), 'amount' => 20500, 'currency' => 'INR', 'notes'=> array('userId'=> auth()->id(),'email'=> auth()->user()->email)));
            //  Order Create Returns
            //     Razorpay\Api\Order {#1311 ▼
            //       #attributes: array:12 [▼
            //         "id" => "order_IzUsjZqN7Yzhw8"
            //         "entity" => "order"
            //         "amount" => 100
            //         "amount_paid" => 0
            //         "amount_due" => 100
            //         "currency" => "INR"
            //         "receipt" => "123"
            //         "offer_id" => null
            //         "status" => "created"
            //         "attempts" => 0
            //         "notes" => Razorpay\Api\Order {#1295 ▶}
            //         "created_at" => 1645629461
            //       ]
            //     } 
            // return view('customer.payment.razor', compact('order'));
            /* Razorpay */
            redirect()->back()->with(['status'=>'error','message'=>'Razorpay payment gateway is disabled, please try another payment gateway...']);
        }
        if($request->gateway==2)
        {
            $key = env('PAYU_KEY');
            $salt = env('PAYU_SALT');
            $txnid = time().'_'.auth()->id();
            $amount = 205;
            $productInfo = 'Lifetime subscription of Rana Marriage Bureau with unlimited access.';
            $firstName = auth()->user()->personal_detail->first_name;
            $email = auth()->user()->email;
            $udf1 = auth()->id();
            $udf2 = '';
            $udf3 = '';
            $udf4 = '';
            $udf5 = '';
            $phone = json_decode(auth()->user()->personal_detail->contact)[0];

            // dd($key,$txnid,$amount,$productInfo,$firstName,$email,$udf1,$udf2,$udf3,$udf4,$udf5,$salt);

            $str = $key.'|'.$txnid.'|'.$amount.'|'.$productInfo.'|'.$firstName.'|'.$email.'|'.$udf1.'|'.$udf2.'|'.$udf3.'|'.$udf4.'|'.$udf5.'||||||'.$salt;

            $hash = hash ("sha512", $str);
            return view('customer.payment.payu',compact('key','salt','txnid','amount','productInfo','firstName','email','udf1','udf2','udf3','udf4','udf5','phone','hash'));
        }
        /* elseif ($request->gateway==1) */
        /* Stripe */
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        $checkout_session = Stripe\Checkout\Session::create([
            'success_url' => route('subscription.plans.stripe.success').'?session_id={CHECKOUT_SESSION_ID}&userId='.auth()->id(),
            'cancel_url' => route('subscription.plans.stripe.fail'),
            'payment_method_types' => [
                'card',
              // 'alipay',
              // 'ideal',
                // 'sepa_debit',
                // 'giropay',
            ],
            'mode' => 'payment',
            'line_items' => [[
                'price_data' => [
                    'currency' => 'inr',
                    'unit_amount' => 20500,
                    'product_data' => [
                        'name' => 'Rana Marriage Bureau Lifetime Subscription',
                        'images' => [asset('/assets/img/marriage.jpg')],
                    ],
                ],
                'quantity' => 1,
            ]]
        ]);
        return view('customer.payment.stripe',compact('checkout_session'));
    }

    public function razorPostBack(Request $request)
    {
        /* success
        array:6 [▼
          "_token" => "mmdqpRKyUOCqS7gpfqHNdABvoWayeVgMMw8m1dcZ"
          "razorpay_payment_id" => "pay_IGGwJkXhjkh3Xs"
          "org_logo" => null
          "org_name" => "Razorpay Software Private Ltd"
          "checkout_logo" => "https://cdn.razorpay.com/logo.png"
          "custom_branding" => "false"
        ] */
        $user = auth()->user();

        if(empty($user))
        {
            return redirect()->back()->with(['status'=>'error','message'=>'Error while checking user']);
        }


        // $api = new Api(env('RAZORPAY_KEY_ID'), env('RAZORPAY_KEY_SECRET'));
        $sig = hash_hmac('sha256',$request->razorpay_order_id.'|'.$request->razorpay_payment_id, env('RAZORPAY_KEY_SECRET'));
        if($sig == $request->razorpay_signature)
        {

            $user->update(['subscribed'=>1]);

            $payment = UserPayment::create([
                'user_id'=>$user->id,
                'json'=>json_encode($request->all()),
                'gateway'=>'RAZORPAY']);
        
            return redirect()->route('dashboard')->with(['status'=>'success','message'=>'Subscribed successfully, Now Connect as many as you want to get to know each other and find perfect match']);
        }
        return redirect()->route('dashboard')->with(['status'=>'error','message'=>'Error while verifying payment, please contact us if payment deducted from your account, Reference order id:'.$request->razorpay_order_id]);
    }

    public function payuSuccess(Request $request)
    {
        if($request->status=='success')
        {
            $userId = $request->udf1;
            $user = User::find($userId);

            if(empty($user))
            {
                return redirect()->route('subscription.plans')->with(['status'=>'error','message'=>'Error while checking user']);
            }

            if(auth()->guest())
            {
                auth()->loginUsingId($userId);
            }

            $user->update(['subscribed'=>1]);

            $payment = UserPayment::create([
                'user_id'=>$userId,
                'json'=>json_encode($request->all()),
                'gateway'=>'PAYU']);


            return redirect()->route('dashboard')->with(['status'=>'success','message'=>'Subscribed successfully, Now Connect as many as you want to get to know each other to find perfect match']);
        }
        return redirect()->route('subscription.plans')->with(['status'=>'error','message'=>'Error while receiving payment']);
    }

    public function payuFail(Request $request)
    {
        $userId = $request->udf1;
        $user = User::find($userId);

        if(empty($user))
        {
            return redirect()->route('subscription.plans')->with(['status'=>'error','message'=>'Error while checking user']);
        }

        if(auth()->guest())
        {
            auth()->loginUsingId($userId);
        }
        return redirect()->route('subscription.plans')->with(['status'=>'error','message'=>'Error while receiving payment']);

    }

    public function stripeSuccess(Request $request)
    {
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET_KEY'));
        $response = [];
        try {
            $response = $stripe->checkout->sessions->retrieve(
              $request->session_id,
              []
            );
        }
        catch(\Stripe\Exception\InvalidRequestException | \Stripe\Exception\InvalidArgumentException $e)
        {
            return redirect()->back()->with(['status'=>'error','message'=>'Error while checking for payment']);
        }

        $userId = $request->userId;
        $user = User::find($userId);

        if(empty($user))
        {
            return redirect()->back()->with(['status'=>'error','message'=>'Error while checking user']);
        }

        $user->update(['subscribed'=>1]);

        $payment = UserPayment::create([
            'user_id'=>$userId,
            'json'=>json_encode($response),
            'gateway'=>'STRIPE']);
        
        return redirect()->route('dashboard')->with(['status'=>'success','message'=>'Subscribed successfully, Now Connect as many as you want to get to know each other to find perfect match']);

    }

    public function stripeFail(Request $request)
    {
        return view('customer.error',['title'=>'Payment Failed','message'=>'Payment Cancelled']);
    }

    public function paymentSuccess(Request $request)
    {
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET_KEY'));
        $response = [];
        try {
            $response = $stripe->checkout->sessions->retrieve(
              $request->session_id,
              []
            );
        }
        catch(\Stripe\Exception\InvalidRequestException | \Stripe\Exception\InvalidArgumentException $e)
        {
            return redirect()->back()->with(['status'=>'error','message'=>'Error while checking for payment']);
        }

        $userId = $request->userId;
        $user = User::find($userId);

        if(empty($user))
        {
            return redirect()->back()->with(['status'=>'error','message'=>'Error while checking user']);
        }

        $user->update(['subscribed'=>1]);

        $payment = UserPayment::create([
            'user_id'=>$userId,
            'json'=>json_encode($response)]);
        
        return redirect()->route('dashboard')->with(['status'=>'success','message'=>'Subscribed successfully, Now Connect as many as you want to get to know each other to find perfect match']);
    }

    public function paymentFail(Request $request)
    {
        return view('customer.error',['title'=>'Payment Failed','message'=>'Something went wrong while making payment']);
    }
}
