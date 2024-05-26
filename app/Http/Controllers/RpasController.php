<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RpasController extends Controller
{
    public function safetyAgreement()
    {
        return view('rpas.safety_agreement', [
            'user' => auth()->user()
        ]);
    }
}
