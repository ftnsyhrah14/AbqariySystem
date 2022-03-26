<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class creatorControl extends Controller
{
    public function newGroup()
    {
        return view("creator.group.newgroup");
    }

    public function creatorProfile()
    {
        return view("creator.profile");
    }

}
