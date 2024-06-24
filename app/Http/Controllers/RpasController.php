<?php

namespace App\Http\Controllers;

use App\Models\Rpas;
use App\Models\Rpastype;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RpasController extends Controller
{
    public function all_rpas()
    {
        $user = Auth()->user();
        if($user->acc_type != 'A')
        {
            return to_route('dashboard');
        }
        
        return view('rpas.all', [
            'rpases' => Rpas::orderBy('nickname', 'asc')->get()
        ]);
    }

    public function safetyAgreement()
    {
        $user = Auth()->user();
        $total_days = $user->validity * 365;
        $days_used = floor((time() - strtotime($user->registered_at)) / (24 * 60 * 60));
        $days_remaining = $total_days - $days_used;
        if($days_remaining <= 0)
        {
            return to_route('dashboard')->with('error_message', 'Your license has expired. Please <a href="'.route('orders.create').'" style="color: #6F1010;">subscribe<a> to continue.');
        }

        return view('rpas.safety_agreement');
    }

    public function safetyAgreementPost(Request $request)
    {
        $request->validate([
            'I-will-fly-below-400-feet' => 'required',
            'I-will-fly-within-visual-line-of-sight' => 'required',
            'I-will-be-aware-of-NCAA-airspace-requirements' => 'required',
            'I-will-not-fly-directly-over-people' => 'required',
            'I-will-not-fly-directly-over-stadiums-and-sports-events' => 'required',
            'I-will-not-fly-near-emergency-response-efforts-such-as-fires' => 'required',
            'I-will-not-fly-near-aircrafts-especially-near-airports' => 'required',
            'I-will-not-fly-under-the-influence' => 'required',
        ]);

        $request->session()->put('safety_accepted', true);
        return to_route('rpas.create');
    }

    public function create()
    {
        if(!session('safety_accepted') || session('safety_accepted') != 1)
        {
            return to_route('rpas.safety')->with('error_message', 'Please agree to all the safety conditions before adding your RPAS (drone)');
        }

        $user = Auth()->user();
        $total_days = $user->validity * 365;
        $days_used = floor((time() - strtotime($user->registered_at)) / (24 * 60 * 60));
        $days_remaining = $total_days - $days_used;
        if($days_remaining <= 0)
        {
            return to_route('dashboard')->with('error_message', 'Your license has expired. Please <a href="'.route('orders.create').'" style="color: #6F1010;">subscribe<a> to continue.');
        }

        return view('rpas.create', [
            'rpastypes' => Rpastype::all()
        ]);
    }

    public function store(Request $request)
    {
        if(!session('safety_accepted') || session('safety_accepted') != 1)
        {
            return to_route('rpas.safety')->with('error_message', 'Please agree to all the safety conditions before adding your RPAS (drone)');
        }
        $user = Auth()->user();
        $total_days = $user->validity * 365;
        $days_used = floor((time() - strtotime($user->registered_at)) / (24 * 60 * 60));
        $days_remaining = $total_days - $days_used;
        if($days_remaining <= 0)
        {
            return to_route('dashboard')->with('error_message', 'Your license has expired. Please <a href="'.route('orders.create').'" style="color: #6F1010;">subscribe<a> to continue.');
        }

        $request->validate([
            'rpas_type' => 'required',
            'manufacturer' => 'required|string',
            'serial_no' => 'required|string|min:2|max:65',
            'model_no' => 'required|string|min:2|max:65',
            'nickname' => 'required|string|min:2|max:65',
        ]);

        $rpastype = Rpastype::find($request->rpas_type);
        if(!$rpastype)
        {
            return back()->with('error_message', 'An invalid RPAS Type was selection. Please try again.');
        }

        $rpas = Rpas::firstOrCreate(
            [
                'user_id' => $request->user()->id,
                'rpastype_id' => $rpastype->id,
                'manufacturer' => $request->manufacturer,
                'serial_no' => $request->serial_no,
                'model_no' => $request->model_no,
                'nickname' => $request->nickname,
            ],
            [
                'safety_agreement' => 1
            ]
        );

        if(!$rpas)
        {
            return back()->with('error_message', 'An unexpected error occured. Please try again.');
        }

        $rpas->cert_no = 'NRPAS/CERT2/'.$rpas->id;
        $rpas->registered_at = date('Y-m-d H:i:s', time());
        $rpas->save();
        $request->session()->forget('safety_agreement');

        return to_route('dashboard')->with('success_message', 'Your RPAS has been added successfully.');
    }

    public function index()
    {
        return view('rpas.index');
    }

    public function certificate($id)
    {
        $rpas = Rpas::findOrFail($id);

        $total_days = $rpas->user->validity * 365;
        $days_used = floor((time() - strtotime($rpas->user->registered_at)) / (24 * 60 * 60));
        $days_remaining = $total_days - $days_used;
        if($days_remaining < 0)
        {
            $days_remaining = 0;
        }

        if($days_remaining == 0)
        {
            return to_route('web.reply', 'suspended_certificate_type');
        }

        $certificate_expiration = strtotime($rpas->user->registered_at) + ($rpas->user->validity * 365 * 24 * 60 * 60);

        if($rpas->user->acc_type == 'R')
        {
            return view('rpas.certificate.recreational', [
                'rpas' => $rpas,
                'certificate_expiration' => $certificate_expiration
            ]);
        }
        elseif($rpas->user->acc_type == 'C')
        {
            return view('rpas.certificate.commercial', [
                'rpas' => $rpas,
                'certificate_expiration' => $certificate_expiration
            ]);
        }
        return to_route('dashboard');
    }

    public function verify(Request $request)
    {
        $rpas = null;
        if($request->cert_id)
        {
            $rpas = Rpas::where('cert_no', $request->cert_id)->first();
        }
        
        return view('rpas.certificate.verification', [
            'rpas' => $rpas,
            'search_parameter' => $request->cert_id
        ]);
    }
}
