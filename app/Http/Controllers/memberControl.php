<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class memberControl extends Controller
{
    public function newGroup()
    {
        return view("member.group.newgroup");
    }

    public function memberProfile()
    {
        return view("member.profile");
    }
}
