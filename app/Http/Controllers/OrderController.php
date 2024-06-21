<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Package;
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
        dd('I got here');
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
