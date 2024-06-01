<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function learn_more()
    {
        return view('pages.learn_more');
    }

    public function help()
    {
        return view('pages.help');
    }
}
