<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomesController extends Controller
{
    public function top()
    {
        return view('homes.top');
    }
}
