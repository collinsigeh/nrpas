<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function edit()
    {
        $user = Auth()->user();
        if($user->acc_type != 'A')
        {
            return to_route('dashboard');
        }
        
        return view('settings.edit', [
            'setting' => Setting::first()
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth()->user();
        if($user->acc_type != 'A')
        {
            return to_route('dashboard');
        }

        $request->validate([
            'paystack_public_key' => 'required|string|min:5',
            'paystack_secret_key' => 'required|string|min:5',
        ]);

        Setting::updateOrCreate(
            [],
            [
                'paystack_public_key' => $request->paystack_public_key,
                'paystack_secret_key' => $request->paystack_secret_key,
            ]
        );

        return back()->with('success_message', 'Update saved!');
    }
}
