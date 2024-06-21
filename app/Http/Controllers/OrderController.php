<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Package;
use App\Models\Setting;
use Illuminate\Http\Request;

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
        if($order->is_payment_confirmed)
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
        dd('I got here. Now let us verify the payment for order: '.$id);
        $curl = curl_init();
  
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/transaction/verify/:reference",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer SECRET_KEY",
            "Cache-Control: no-cache",
            ),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response;
        }
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
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
