<?php

namespace App\Http\Controllers;

use App\Models\Rpas;
use App\Models\Rpastype;
use Illuminate\Http\Request;

class RpasController extends Controller
{
    public function safetyAgreement()
    {
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

        $rpas->cert_no = 'NRPAS/CERT/'.$rpas->id;
        $rpas->save();
        $request->session()->forget('safety_agreement');

        return to_route('dashboard')->with('success_message', 'Your RPAS has been added successfully.');
    }
}
