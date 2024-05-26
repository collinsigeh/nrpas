<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function create()
    {
        $user = auth()->user();

        if($user->profile_complete)
        {
            return to_route('dashboard');
        }

        return view('profile.create', [
            'user' => $user
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'suffix' => 'required|string|min:2',
            'firstname' => 'required|string|min:2|max:65',
            'lastname' => 'required|string|min:2|max:65',
            'phone' => 'required|string|min:2|max:20',
            'country' => 'required|string|min:2|max:65',
            'street_address' => 'required|string|min:2|max:160',
            'city' => 'required|string|min:2|max:65',
            'state' => 'required|string|min:2|max:65',
        ]);

        $user = $request->user();

        $profile = Profile::firstOrCreate(
            [
                'user_id' => $user->id
            ],
            [
                'suffix' => $request->suffix,
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'middlename' => $request->middlename ? $request->middlename : null,
                'phone' => $request->phone,
                'country' => $request->country,
                'street_address' => $request->street_address,
                'apt_no' => $request->apt_no ? $request->apt_no : null,
                'city' => $request->city,
                'state' => $request->state,
                'postcode' => $request->postcode ? $request->postcode : null,
                'org_name' => $request->org_name ? $request->org_name : null,
                'rcc_no' => $request->rcc_no ? $request->rcc_no : null,
            ]
        );

        if(!$profile)
        {
            return back()->with('error_message', 'An unexpected error occured. Please try again.');
        }

        $user->profile_complete = 1;
        $user->save();

        return to_route('dashboard');
    }

    public function accountTypeSelection()
    {
        $user = auth()->user();

        if($user->acc_type_set)
        {
            return to_route('dashboard');
        }

        return view('profile.account_type', [
            'user' => $user
        ]);
    }

    public function accountTypePost(Request $request, $type)
    {
        $user = $request->user();

        if($user->acc_type_set)
        {
            return to_route('dashboard');
        }
        
        if($type == 'recreational')
        {
            $user->acc_type = 'R';
        }
        elseif($type == 'commercial')
        {
            $user->acc_type = 'C';
        }
        else
        {
            return back()->with('error_message', 'Invalid type selection.');
        }
        
        $user->acc_type_set = 1;
        $user->save();

        return to_route('rpas.safety');
    }
}
