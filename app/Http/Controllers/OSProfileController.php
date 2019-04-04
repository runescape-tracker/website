<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OSProfileController extends Controller
{
    public function index(Request $request)
    {
        $rsn = $request->input('rsn');

        return view('profile.rs3');
    }

}
