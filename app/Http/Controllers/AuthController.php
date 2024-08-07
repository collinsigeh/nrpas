<?php

namespace App\Http\Controllers;

use App\Mail\AccountConfirmation;
use App\Mail\PasswordRecovery;
use App\Models\Order;
use App\Models\Package;
use App\Models\Profile;
use App\Models\Rpas;
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

    public function regPostWithoutConfirmation(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:tempusers|unique:users',
            'password' => 'required|string|min:8|confirmed'
        ]);

        $confirmation_code = md5(uniqid(rand()));

        $user = User::firstOrCreate(
            [
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]
        );

        if(!$user)
        {
            return back()->with('error_message', '<p>Account Not Created!</p>Your NRPAS account could not be created. Please try again.');
        }

        $user->reg_no = 'NRPAS-'.$user->id;
        $user->registered_at = date('Y-m-d H:i:s', time());
        $user->save();

        return to_route('login')->with('success_message', 'Account created successfully. Please log in to proceed.');
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

    public function confirmReg($confirmation_code)
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
        $user->registered_at = date('Y-m-d H:i:s', time());
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
        $request->validate([
            'email' => 'required|email'
        ]);

        $user = User::where('email', $request->email)->first();

        if(!$user)
        {
            return back()->with('error_message', 'The email "<b>'.$request->email.'</b>" is not recognized.');
        }

        $confirmation_code = md5(uniqid(rand()));

        $tempuser = Tempuser::firstOrCreate(
            [
                'email' => $user->email
            ],
            [
                'confirm_code' => $confirmation_code,
                'password' => $user->password
            ]
        );

        if(!$tempuser)
        {
            return to_route('web.reply', 'error');
        }
        
        Mail::to($tempuser->email)->send(new PasswordRecovery($tempuser));

        return to_route('web.reply', 'password_reset_link');
    }

    public function resetPassword($confirmation_code)
    {
        $tempuser = Tempuser::where('confirm_code', $confirmation_code)->first();

        if(!$tempuser)
        {
            return to_route('web.reply', 'expired_password_reset_link');
        }

        $user = User::where('email', $tempuser->email)->first();

        if(!$user)
        {
            return to_route('web.reply', 'expired_password_reset_link');
        }

        return view('reset_password', [
            'confirmation_code' => $confirmation_code
        ]);
    }

    public function resetPasswordPost(Request $request)
    {
        $request->validate([
            'confirmation_code' => 'required',
            'password' => 'required|string|min:8|confirmed'
        ]);

        $tempuser = Tempuser::where('confirm_code', $request->confirmation_code)->first();

        if(!$tempuser)
        {
            return to_route('web.reply', 'expired_password_reset_link');
        }

        $user = User::where('email', $tempuser->email)->first();

        if(!$user)
        {
            return to_route('web.reply', 'expired_password_reset_link');
        }

        $user->password = Hash::make($request->password);
        $user->save();
        $tempuser->delete();
    
        return to_route('web.reply', 'password_reset_success');
    }

    public function webReply($case = null)
    {
        $message = '';

        if($case == 'registation_received')
        {
            $message = '<h2 class="my-custom-title text-center pb-3">Confirm Your Email</h2>
                <div class="alert alert-success text-center">
                    <p>Your NRPAS comfirmation link has been sent to the email address you registered with.<p>
                    Please, click on the link to activate your account.
                </div>
            ';
        }
        elseif($case == 'expired_confirmation_link')
        {
            $message = '<h2 class="my-custom-title text-center pb-3">Expired Link</h2>
                <div class="alert alert-danger text-center">
                    This confirmtion link has expired.
                </div>
            ';
        }
        elseif($case == 'account_activation_failed')
        {
            $message = '<h2 class="my-custom-title text-center pb-3">Account Activation Failed</h2>
                <div class="alert alert-danger text-center">
                    <p>Your account activation failed.<p>
                    Please contact '.config('app.name').' admin for help.
                </div>
            ';
        }
        elseif($case == 'account_activation_success')
        {
            $message = '<h2 class="my-custom-title text-center pb-3">Account Activated</h2>
                <div class="alert alert-success text-center">
                    <p>Your account has been activated successfully.<p>
                    Please login to proceed.
                </div>
            ';
        }
        elseif($case == 'password_reset_link')
        {
            $message = '<h2 class="my-custom-title text-center pb-3">Check Your Email</h2>
                <div class="alert alert-success text-center">
                    <p>Your password reset link has been sent to the email you provided.<p>
                    Please, click on the link to change your account password.
                </div>
            ';
        }
        elseif($case == 'expired_password_reset_link')
        {
            $message = '<h2 class="my-custom-title text-center pb-3">Expired Link</h2>
                <div class="alert alert-danger text-center">
                    This password reset link has expired.
                </div>
            ';
        }
        elseif($case == 'password_reset_success')
        {
            $message = '<h2 class="my-custom-title text-center pb-3">Password Updated</h2>
                <div class="alert alert-success text-center">
                    <p>Your password has been changed successfully.<p>
                    Please login to proceed.
                </div>
            ';
        }
        elseif($case == 'suspended_certificate_type')
        {
            if(Auth()->user()->acc_type == 'A')
            {
                $message = '<h2 class="my-custom-title text-center pb-3">Suspended Certificate</h2>
                <div class="alert alert-danger text-center">
                    <p class="pt-4">The requested certificate has been suspended due to expired subscription.<p>
                    <a href="'.route('rpas.all').'" class="my-custom-primary-web-button"><i class="bi bi-arrow-left-short mr-2"></i>Back</a>
                </div>
            ';
            }
            else
            {
                $message = '<h2 class="my-custom-title text-center pb-3">Suspended Certificate</h2>
                <div class="alert alert-danger text-center">
                    <p>The requested certificate has been suspended.<p>
                    <p>Please renew your subscription to reactive this certificate.</p>
                    <a href="'.route('orders.create').'" class="my-custom-primary-web-button">Subscribe Now</a>
                    <a href="'.route('rpas.index').'" class="my-custom-secondary-web-button"><i class="bi bi-arrow-left-short mr-2"></i>Back</a>
                </div>
            ';
            }
        }
        elseif($case == 'error')
        {
            $message = '<h2 class="my-custom-title text-center pb-3">Oops!</h2>
                <div class="alert alert-danger text-center">
                    <p>An unexpected error has occured.<p>
                    Please try again.
                </div>
            ';
        }

        return view('web_reply', [
            'message' => $message
        ]);
    }
    
    public function dashboard()
    {
        $user = auth()->user();

        if(!$user->profile_complete)
        {
            return to_route('profile.create');
        }
        if(!$user->acc_type_set)
        {
            return to_route('profile.type');
        }
        if($user->acc_type == 'A')
        {
            return view('admin_dashboard',  [
                'user' => $user,
                'total_users' => User::where('acc_type', '!=', 'A')->count(),
                'total_rpas' => Rpas::count(),
                'total_orders' => Order::count(),
                'active_packages' => Package::where('is_active', 1)->count(),
                'all_packages' => Package::count()
            ]);
        }

        $time_used = time() - strtotime($user->registered_at);
        $days_used = 0;
        $days_remaining = 365 * $user->validity;
        $license_active = 1;

        if($time_used >= (24 * 60 * 60))
        {
            $days_used = floor($time_used / (24 * 60 * 60));
        }

        if($days_used < $days_remaining)
        {
            $days_remaining = $days_remaining - $days_used;
        }
        else
        {
            $days_remaining = 0;
            $license_active = 0;
        }

        $unpaid_subs = 0;
        foreach ($user->orders as $sub_order) {
            if(!$sub_order->is_payment_confirmed)
            {
              $unpaid_subs++;
            }
        }
        
        return view('dashboard',  [
            'user' => $user,
            'days_remaining' => $days_remaining,
            'license_active' => $license_active,
            'unpaid_subs' => $unpaid_subs
        ]);
    }

    public function updateMPData()
    {
        dd('Finaly');
    }
}
