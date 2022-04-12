<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use DB;
use App\Models\User;
use App\Models\Group;
use App\Models\Meeting;
use App\Models\Progress;
use App\Models\Join;
use App\Models\Feedback;

class homeControl extends Controller
{
    public function index()
    {
        return view("home");
    }
    public function redirectFunct()
    {
        $role=Auth::user()->role;
        $userid=Auth::user()->id;

        if($role=='1')
        {   
            $participant = User::where('role','=','3')->count();
            $creator = User::where('role','=','2')->count();
            $group = Group::All()->count();
            $total = User::All()->count();
            return view('admin.dashboard', ['participant'=>$participant, 'creator'=>$creator, 'total'=>$total, 'group'=>$group]);

        }

        if($role=='2')
        {
            $group=User::find(Auth::user()->id);
            return view('creator.dashboard',['group'=>$group]);

        }
        if($role=='3')
        {
            $user = User::find(Auth::user()->id);
            $groups=Group::with('creators');
           
            $exists = Group::whereDoesntHave('creators', function ($query) {
                $query->where('user_id', '=', Auth::user()->id);
            })->get();

            $request = Join::where('userApprove','=','0')->where('userID',$userid)->get();

           
           
            return view('member.dashboard',['user'=>$user,'groups'=>$groups,'exists'=>$exists,'request'=>$request]);
        }

    }

}
