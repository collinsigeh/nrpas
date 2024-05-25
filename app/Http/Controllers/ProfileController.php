<?php

namespace App\Http\Controllers;

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
        //
    }
}
