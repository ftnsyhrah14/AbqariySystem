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
        $attend=Attendance::with('attend')
        ->where('userID',Auth::user()->id)
        ->where('groupID', $id)
        ->get();
        $meet=Meeting::where('groupID', $id)->get();

        $count=Group::with('creators')->select('id')->where('id',$id)->first();
        $meeting = Meeting::where('groupID',$id)->count();
        $attendance=Attendance::where('groupID',$id)->where('userAttendance','=','1')->get();
        
       return view("creator.group.groupdetails",['attend'=>$attend,'approve'=>$approve,'group'=>$group,'creator'=>$creator,'user'=>$user,'gid'=>$gid,'meet'=>$meet,'users'=>$users,'meeting'=>$meeting,'attendance'=>$attendance]);
    }

    public function kickMember($id)
    {
        $data = User::findOrFail($id);
        $data->find($id)->request()->detach();
        return back();
    }

    

    public function editAttendance(Request $req)
    {
        $data = Attendance::find($req->id);
        $data->userAttendance = $req->userAttendance;
        $data->save();

       return back();
    }
    public function editGroup(Request $req)
    {
        $data = Group::find($req->id);
        $data->groupName = $req->groupName;
        $data->groupDesc = $req->groupDesc;
        $data->save();

       return redirect('redirect');
    }


    public function approveMem($userid,$groupid)
    {
        $data = User::find($userid);
        $group = Group::find($groupid);
       
        $data->save();

        $user = User::find($userid);
        $user->request()->attach($group);

        $s = DB::table("joins")->where("userID",$userid)->where("groupID",$groupid)->delete();

        $member= User::with('grp')->get();
        Mail::send('approveEmail', array(
            'groupName' => $group->groupName,
        ), function($message) use ($data){
            $message->from('abqariy2022@gmail.com');
            $message->to($data->email)->subject('Request Group Succesful');
        });

        return back();
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
        return back();
    }

    public function newSession($id)
    {
        $meet=Group::where('id', $id)->get();
        $users=Group::find($id);

        return view("creator.meeting.newmeeting",['meet'=>$meet,'users'=>$users]);

    }

    public function addsession(Request $req)
    {

        $data = new Meeting;
        $data->groupID = $req->groupID;
        $data->meetingDate = $req->meetingDate;
        $data->meetingTime = Carbon::parse($req->input('meetingDate') . ' ' . $req->input('meetingTime'));
        $data->meetingEndTime = Carbon::parse($req->input('meetingDate') . ' ' . $req->input('meetingEndTime'));
        $data->meetingDesc = $req->meetingDesc;
        $data->meetingLink = $req->meetingLink;
        $data->meetingModerator = $req->meetingModerator;
        $file = $req->meetingNotes;
        $filename = time().'.'.$file->getClientOriginalExtension();
        $req->meetingNotes->move('assets/file',$filename);
        $data->meetingNotes=$filename;
        $data->save();

         $group = Group::find($req->groupID);
        foreach($group->members as $creator)
        {
        Mail::send('newmeetingEmail', array(
            'groupName' => $req->groupName,
            'meetingDate' => $req->meetingDate,
            'meetingTime' => $req->meetingTime,
            'meetingEndTime' => $req->meetingEndTime,
            'meetingDesc' => $req->meetingDesc,
            'meetingLink' => $req->meetingLink,
            'meetingModerator' =>  $req->meetingModerator,
        ), function($message) use ($creator){
            $message->from('abqariy2022@gmail.com');
            $message->to($creator->email)->subject('Tadabbur session');
        });
        }

        $group = Group::find($req->groupID);
        foreach($group->creators as $creator)
        {
        $attend = new Attendance();
        $attend->userID = $creator->id;
        $attend->groupID = $req->groupID;
        $attend->meetingID = $data->id;
        $attend->userAttendance = '2';
        $attend->save();
        }

        $group = Group::find($req->groupID);
        foreach($group->members as $member)
        {
        $attend = new Attendance();
        $attend->userID = $member->id;
        $attend->groupID = $req->groupID;
        $attend->meetingID = $data->id;
        $attend->userAttendance = '2';
        $attend->save();
        }

        return redirect('redirect');
    }

    public function detailsMeeting($id)
    {
       
        $meeting=Meeting::find($id);
        $user = Attendance::with('member')->where('meetingID',$id)->get();
        $users=Group::find($meeting->groupID);
     
        return view("creator.meeting.meetingdetails",['meeting'=>$meeting,'user'=>$user,'users'=>$users]);
    }

    public function editMeeting(Request $req)
    {
        $data = Meeting::find($req->id);
        $data->meetingDate = $req->meetingDate;
        $data->meetingTime = $req->meetingTime;
        $data->meetingDesc = $req->meetingDesc;
        $data->meetingModerator = $req->meetingModerator;
        $data->meetingLink = $req->meetingLink;
        
        $data->save();

        $group = Group::find($req->groupID);
        
        return back();
    }

    public function deleteSession($id)
    {
        $data=Meeting::find($id);
        $data->delete();
        return back()->with('success', 'Session Deleted successfully');
    }
    public function uploadNewnote(Request $req)
    {
        $data = Meeting::find($req->id);
        $file = $req->meetingNotes;
        $filename = time().'.'.$file->getClientOriginalExtension();
        $req->meetingNotes->move('assets/file',$filename);
        $data->meetingNotes=$filename;
        $data->save();
      

       return back();
    }

    public function download(Request $req,$file)
    {
        return response()->download(public_path('assets/file/'.$file));
    }
}
