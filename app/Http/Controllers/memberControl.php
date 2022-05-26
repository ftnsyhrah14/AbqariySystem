<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Stroage;
use DB;
use App\Models\User;
use App\Models\Group;
use App\Models\Meeting;
use App\Models\Progress;
use App\Models\Join;
use App\Models\Attendance;
use App\Mail\sendRequestEmail;
use App\Mail\sendRejectMail;

class memberControl extends Controller
{
    public function memberProfile()
    {
        return view("member.profile");
    }

    public function leaveGroup($id)
    {
        $data = Group::findOrFail($id);
        $data->find($id)->members()->detach();
        return back();
    }

    public function sendRequest($id)
    {
        $user=Auth::user()->id;
        $data = Group::find($id);
        $add = new Join;

        $add->userID = $user;
        $add->groupID = $id;
        $add->userApprove = 0;
        $add->save();
        
        $grp = User::find($data->userID);
        $member= User::with('request')->get();
        

        Mail::send('requestEmail', array(
            'groupName' => $data->groupName,
        ), function($message) use ($grp){
            $message->from('abqariy2022@gmail.com');
            $message->to($grp->email)->subject('New User Request');
        });

       return back();
    }

    public function cancelRequest($id)
    {
        $data=Join::find($id);
        $data->delete();
        return back()->with('success', 'Request Deleted successfully');
    }

    public function detailsGroup($id)
    {
        $creator=Group::all()->where('id', $id);

        $meet=Meeting::where('groupID', $id)->with('gr')->get();
        $s=Auth::user()->groupID;
        $group=Group::all();
        $att=Attendance::with('attend')->where('userID',Auth::user()->id)->get();
        
     
       
        return view("member.group.groupdetails",['creator'=>$creator,'meet'=>$meet,'att'=>$att]);
    }

    public function updateAttendance($id)
    {
      
        $attendance = Attendance::with('attend')->find($id);

        return view("member.meeting.attendanceform",['attendance'=>$attendance]);
    }
    public function editAttendance(Request $req)
    {
        $data = Attendance::find($req->id);
        $data->userAttendance = $req->userAttendance;
        $data->save();

       return back();
    }

    public function download(Request $req,$file)
    {
        return response()->download(public_path('asset.file/'.$file));
    }



}
