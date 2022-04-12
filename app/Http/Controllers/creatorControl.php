<?php

namespace App\Http\Controllers;
use Response;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Stroage;
use DB;
use App\Models\User;
use App\Models\Group;
use App\Models\Meeting;
use App\Models\Progress;
use App\Models\Join;
use App\Models\Feedback;
use App\Models\Attendance;
use App\Mail\sendApproveEmail;
use App\Mail\sendRejectEmail;

class creatorControl extends Controller
{
    public function newGroup()
    {
        return view("creator.group.newgroup",);
    }

    public function creatorProfile()
    {
        return view("creator.profile");
    }

    public function addgroup(Request $req)
    {
        $group = new Group;

        $group->groupName = $req->groupName;
        $group->groupDesc = $req->groupDesc;
        $group->userID = $req->userID;
        $group->save();


        $user = User::find($req->userID);
        $group->creators()->attach($user);

        return redirect('redirect');

        
    }
    function groupSearch(Request $request)
    {
            // Get the search value from the request
            $search = $request->input('search');
        
            // Search in the title and body columns from the posts table
            $posts = Group::query()
                ->where('groupName', 'LIKE', "%{$search}%")
                ->get();
        
            // Return the search view with the resluts compacted
            if(count($posts)>0){
                $group=User::find(Auth::user()->id);
                return view('creator.dashboard', ['data'=>$posts, 'group'=>$group]);
            }
            else
            {
            return back()->with('error','No results found!');
            }
    }

    public function detailsGroup($id)
    {
        $approve=Join::with('user')->get();
        $group=Group::find($id);
        $users=Group::find($id);
        $creator=Group::where('id', $id)->get();
        $user= User::with('grp')->get();
        $gid=$id;
       
        $meet=Meeting::where('groupID', $id)->get();
        return view("creator.group.groupdetails",['approve'=>$approve,'group'=>$group,'creator'=>$creator,'user'=>$user,'gid'=>$gid,'meet'=>$meet,'users'=>$users]);
    }
    public function editGroup(Request $req)
    {
        $data = Group::find($req->id);
        $data->groupName = $req->groupName;
        $data->groupDesc = $req->groupDesc;
        $data->save();

       return redirect('redirect');
    }

    public function delete($userid,$groupid)
    {
        $user = User::find($userid)->grp()->findOrFail($groupid);
        $user->detach();
        
        return back()->with('success', 'User Deleted successfully');
    }
    public function restore($id)
    {
        User::withTrashed()->find($id)->restore();

        return back()->with('success', 'User Restore successfully');
    }

    public function restore_all()
    {
        User::onlyTrashed()->restore();

        return back()->with('success', 'All User Restored successfully');
    }

    public function approveMem($userid,$groupid)
    {
        $data = User::find($userid);
        $group = Group::find($groupid);
       
        $data->save();

        $user = User::find($userid);
        $group->creators()->attach($user);

        $s = DB::table("joins")->where("userID",$userid)->where("groupID",$groupid)->update([
            "userApprove"=>"1"
        ]);
        $member= User::with('grp')->get();
        Mail::send('approveEmail', array(
            'groupName' => $group->groupName,
        ), function($message) use ($data){
            $message->from('abqariy2022@gmail.com');
            $message->to($data->email)->subject('Request Group Succesful');
        });

        return redirect('redirect');
    }

    public function rejectMem($id,$groupid)
    {
        $data = User::find($id);
        $group = Group::find($groupid);
        DB::table('joins')->where('userID', $id)-> delete();
        // $member= User::with('grp')->get();
        // Mail::to($data->email)->send(new sendRejectEmail($member));
        Mail::send('rejectEmail', array(
            'groupName' => $group->groupName,
        ), function($message) use ($data){
            $message->from('abqariy2022@gmail.com');
            $message->to($data->email)->subject('Request Group Unsuccesful');
        });
        return redirect('redirect');
    }

    public function newSession($id)
    {
        $meet=Group::where('id', $id)->get();

        return view("creator.meeting.newmeeting",['meet'=>$meet]);

    }

    public function addsession(Request $req)
    {
        $data = new Meeting;

        $data->groupID = $req->groupID;
        $data->meetingDate = $req->meetingDate;
        $data->meetingTime = $req->meetingTime;
        $data->meetingDesc = $req->meetingDesc;
        $data->meetingLink = $req->meetingLink;
        $data->meetingModerator = $req->meetingModerator;
        $file = $req->meetingNotes;
        $filename = time().'.'.$file->getClientOriginalExtension();
        $req->meetingNotes->move('assets/file',$filename);
        $data->meetingNotes=$filename;
        
        $data->save();

         $group = Group::find($req->groupID);
        // foreach($group->creators as $creator)
        // {
        // Mail::send('newmeetingEmail', array(
        //     'groupName' => $req->groupName,
        //     'meetingDate' => $req->meetingDate,
        //     'meetingTime' => $req->meetingTime,
        //     'meetingDesc' => $req->meetingDesc,
        //     'meetingLink' => $req->meetingLink,
        //     'meetingModerator' => $req->meetingModerator,
        // ), function($message) use ($creator){
        //     $message->from('abqariy2022@gmail.com');
        //     $message->to($creator->email)->subject('Tadabbur session');
        // });
        // }
        foreach($group->creators as $creator)
        {
        $attend = new Attendance();
        $attend->userID = $creator->id;
        $attend->groupID = $req->groupID;
        $attend->meetingID = $data->id;
        $attend->userFeedback = NULL;
        $attend->userAttendance = 'Not Attend';
        $attend->save();
        }
        return redirect('redirect');
    }

    public function detailsMeeting($id)
    {
       
        $meeting=Meeting::find($id);
        $user = Attendance::with('member')->where('meetingID',$id)->get();
        return view("creator.meeting.meetingdetails",['meeting'=>$meeting,'user'=>$user]);
    }

    public function editMeeting(Request $req)
    {
        $data = Meeting::find($req->id);
        $data->meetingDate = $req->meetingDate;
        $data->meetingTime = $req->meetingTime;
        $data->meetingDesc = $req->meetingDesc;
        $data->meetingModerator = $req->meetingModerator;
        $data->meetingLink = $req->meetingLink;
        $file = $req->meetingNotes;
        $filename = time().'.'.$file->getClientOriginalExtension();
        $req->meetingNotes->move('assets/file',$filename);
        $data->meetingNotes=$filename;
        $data->save();

       return redirect('redirect');
    }

    public function download(Request $req,$file)
    {
        return response()->download(public_path('assets/file/'.$file));
    }
}
