<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class homeControl extends Controller
{
    public function index()
    {
        return view("home");
    }
    public function redirectFunct()
    {
        $role=Auth::user()->role;
        $group=Auth::user()->groupID;

        if($role=='2')
        {
            return view('creator.dashboard');

        }
        if($role=='3')
        {
            return view('member.dashboard');

        }

    }

}
