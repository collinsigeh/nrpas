<?php

namespace App\Http\Controllers;

use App\Mail\AccountConfirmation;
use App\Models\Tempuser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function register()
    {
        return view('register');
    }

    public function regPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:tempusers|unique:users',
            'password' => 'required|string|min:8|confirmed'
        ]);

        $confirmation_code = md5(uniqid(rand()));

        $tempuser = Tempuser::firstOrCreate(
            [
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ],
            [
                'confirm_code' => $confirmation_code
            ]
        );

        if(!$tempuser)
        {
            return back()->with('error_message', '<p>Account Not Created!</p>Your NRPAS account could not be created. Please try again.');
        }
        
        Mail::to($tempuser->email)->send(new AccountConfirmation($tempuser));

        return to_route('web.reply', 'registation_received');
    }

    public function confirmReg(Request $request, $confirmation_code)
    {
        $tempuser = Tempuser::where('confirm_code', $confirmation_code)->first();

        if(!$tempuser)
        {
            return to_route('web.reply', 'expired_confirmation_link');
        }

        $user = User::firstOrCreate(
            [
                'email' => $tempuser->email,
                'password' => $tempuser->password
            ]
        );

        if(!$user)
        {
            return to_route('web.reply', 'account_activation_failed');
        }

        $tempuser->delete();
        $user->reg_no = 'NRPAS-'.$user->id;
        $user->save();
        

        return to_route('web.reply', 'account_activation_success');
    }

    public function login()
    {
        return view('login');
    }

    public function loginPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        
        if(Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ]))
        {
            $request->session()->regenerate();
 
            return redirect()->intended('dashboard');
        }
        else
        {
            return redirect(route('login'))->with('error_message', 'Invalid login details.');
        }
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        Auth::logout();
        return to_route('login');
    }

    public function forgotPassword()
    {
        return view('forgot_password');
    }

    public function recoverPassword(Request $request)
    {
        //
    }

    public function webReply($case = null)
    {
        if($case == 'registation_received')
        {
            $message = '<div class="alert alert-success text-center">
                <p>Your NRPAS comfirmation link has been sent to the email address you registered with.<p>
                Please, click on the link to activate your account.
                </div>
            ';
        }
        elseif($case == 'expired_confirmation_link')
        {
            $message = '<div class="alert alert-danger text-center">
                This confirmtion link has expired.
                </div>
                <div class="mt-4 text-center">
                    <a href="'.route('login').'" class="my-custom-link">Login to Account</a> |
                    <a href="'.route('register').'" class="my-custom-link">Create New Account</a>
                </div>
            ';
        }
        elseif($case == 'account_activation_failed')
        {
            $message = '<div class="alert alert-danger text-center">
                <p>Your account activation failed.<p>
                Please contact '.config('app.name').' admin for help.
                </div>
                <div class="mt-4 text-center">
                    <a href="'.route('login').'" class="my-custom-link">Login to Account</a> |
                    <a href="'.route('register').'" class="my-custom-link">Create New Account</a>
                </div>
            ';
        }
        elseif($case == 'account_activation_success')
        {
            $message = '<div class="alert alert-success text-center">
                <p>Your account has been activated successfully.<p>
                Please login to proceed.
                </div>
                <div class="mt-4 text-center">
                    <a href="'.route('login').'" class="my-custom-link">Login to Account</a> |
                    <a href="'.route('register').'" class="my-custom-link">Create New Account</a>
                </div>
            ';
        }

        return view('web_reply', [
            'message' => $message
        ]);
    }
    
    public function dashboard()
    {
        dd('Logged in as: '.auth()->user()->email);
    }
}
