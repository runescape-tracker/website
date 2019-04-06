<?php

namespace App\Http\Controllers;

use App\RS3Player;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $trackingUsersCount = RS3Player::all()->count();
        return view('welcome', compact('trackingUsersCount'));
    }
}
