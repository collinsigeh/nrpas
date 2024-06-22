<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Package;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth()->user();
        if($user->acc_type != 'A')
        {
            return to_route('dashboard');
        }
        
        return view('orders.index', [
            'orders' => Order::orderBy('created_at', 'desc')->get()
        ]);
    }

    public function my_subscriptions()
    {
        $user = Auth()->user();
        
        return view('orders.my_subscriptions', [
            'subscriptions' => Order::where('user_id', $user->id)->orderBy('created_at', 'desc')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth()->user();

        $packages = Package::where('is_active', 1)->orderBy('validity', 'asc')->get();
        if($packages->count() < 1)
        {
            return back()->with('error_message', 'There is no subscription package available for puchase. Please contact the admin.');
        }
        
        return view('orders.create', [
            'packages' => $packages
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'package_id' => 'required|integer|min:1'
        ]);

        $package = Package::findOrFail($request->package_id);

        $order = Order::create(
            [
                'package_id' => $package->id,
                'validity' => $package->validity,
                'user_id' => $user->id,
                'price' => $package->price,
                'discount_amount' => 0,
                'final_amount' =>$package->price
            ]
        );

        return to_route('subscriptions.make_payment', $order->id)->with('success_message', 'Order saved. Please make payment for this order.');
    }

    /**
     * Display page to make payment for order with the specified id
     */
    public function make_payment(string $id)
    {
        $order = Order::findOrFail($id);
        if($order->is_payment_confirmed && $order->amount_paid >= $order->final_amount)
        {
            return to_route('subscriptions.index');
        }

        return view('orders.make_payment', [
            'order' => $order,
            'setting' => Setting::first()
        ]);
    }

    public function payment_confirmed($id)
    {
        $order = Order::findOrFail($id);
        if($order->is_activated)
        {
            return to_route('dashboard')->with('error_message', 'Subscription activated since: '.date('d M, Y', strtotime($order->activated_at)));
        }
        elseif($order->is_payment_confirmed)
        {
            return to_route('dashboard')->with('error_message', 'Payment confirmed since: '.date('d M, Y', strtotime($order->payment_confirmed_at)));
        }

        $setting = Setting::first();
        if(!$setting)
        {
            return to_route('dashboard')->with('An unexpected error occured due to missing settings. Please contact admin.');
        }
        $curl = curl_init();
  
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/transaction/verify/".$order->id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer ".$setting->paystack_secret_key,
            "Cache-Control: no-cache",
            ),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        
        if ($err) {
            return to_route('dashboard')->with('error_message', 'cURL Error #:'.$err);
        } 
        
        $response = json_decode($response);
        if($response->data->status != 'success' || $response->data->reference != $order->id)
        {
            return to_route('dashboard')->with('error_message', 'Payment could not be confirmed.');
        }
        if($response->data->amount < $order->final_amount)
        {
            return to_route('dashboard')->with('error_message', 'There is disparity in the payment amount received.');
        }

        $order->amount_paid = $response->data->amount / 100;
        $order->is_payment_confirmed = 1;
        $order->payment_confirmed_at = date('Y-m-d H:i:s', strtotime($response->data->paid_at));

        $order->save();

        $activated_at = date('Y-m-d H:i:s', time());

        $user = User::findOrFail($order->user_id);
        
        $user->registered_at = $activated_at;
        $user->order_id = $order->id;
        $user->validity = $order->validity;

        $user->save();

        $order->is_activated = 1;
        $order->activated_at = $activated_at;

        $order->save();

        return to_route('dashboard')->with('success_message', 'Payment confirmed and subscription activated successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = Auth()->user();
        if($user->acc_type != 'A')
        {
            return to_route('dashboard');
        }
        
        return view('orders.edit', [
            'order' => Order::findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = Auth()->user();
        if($user->acc_type != 'A')
        {
            return to_route('dashboard');
        }

        $order = Order::findOrFail($id);

        $request->validate([
            'amount_paid' => 'required|numeric|min:0',
            'status' => 'required|in:Activate,Do NOT activate'
        ]);

        $activation_time = date('Y-m-d H:i:s', time());
        
        $order->amount_paid = $request->amount_paid;
        $order->is_payment_confirmed = 1;
        $order->payment_confirmed_at = $activation_time;
        if($request->status == 'Activate')
        {
            $buyer = User::findOrFail($order->user_id);

            $buyer->registered_at = $activation_time;
            $buyer->order_id = $order->id;
            $buyer->validity = $order->validity;

            $buyer->save();

            $order->is_activated = 1;
            $order->activated_at = $activation_time;
        }
        $order->save();
        return to_route('orders.index')->with('success_message', 'Update saved!');
    }

    public function activate($id)
    {
        $order = Order::findOrFail($id);

        if($order->is_activated)
        {
            return back()->with('error_message', 'The specified subscription was activated since '.date('d M, Y', strtotime($order->activated_at).'.'));
        }
        if(!$order->is_payment_confirmed)
        {
            return back()->with('error_message', 'Activation failed becasue the payment for the specified order has NOT been confirmed.');
        }
        if($order->amount_paid < $order->final_amount)
        {
            return back()->with('error_message', 'Activation fialed because the amount paid is less than the amount billed.');
        }

        $activation_time = date('Y-m-d H:i:s', time());

        $user = User::findOrFail($order->user_id);
        $user->registered_at = $activation_time;
        $user->order_id = $order->id;
        $user->validity = $order->validity;

        $user->save();

        $order->is_activated = 1;
        $order->activated_at = $activation_time;

        $order->save();
        return to_route('dashboard')->with('success_message', 'Subscription activated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = Auth()->user();

        $order = order::findOrFail($id);

        if($order->is_payment_confirmed)
        {
            return  back()->with('error_message', 'This order cannot be deleted because it has been paid for.');
        }
        if($order->user_id != $user->id)
        {
            return  back()->with('error_message', 'You do not have permission to delete this order.');
        }

        $order->delete();
        return to_route('subscriptions.index')->with('success_message', 'Cancelled and deleted successfully');
    }
}
