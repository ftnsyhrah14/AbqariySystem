<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Group;
use DB;
use Carbon;

class adminControl extends Controller
{
    public function creatorList(Request $request)
    {
        $user=User::paginate(10);
        if($request->has('view_deleted'))
        {
            $user = User::onlyTrashed()->get();
        }

        
        return view("admin.creatorlist",['user'=>$user]);
    }

    function creatorSearch(Request $request)
    {
            // Get the search value from the request
            $search = $request->input('search');
        
            // Search in the title and body columns from the posts table
            $user = User::query()
                ->where('name', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%")
                ->get();
        
            // Return the search view with the resluts compacted
            if(count($user)>0){
                
                return view('admin.creatorlist', [ 'user'=>$user]);
            }
            else
            {
            return back()->with('error','No results found!');
            }
    }

    public function memberList(Request $request)
    {
        $user=User::with('request')->get();
        if($request->has('view_deleted'))
        {
            $user = User::onlyTrashed()->get();
        }

        
        return view("admin.memberlist",['user'=>$user]);
    }

    function memberSearch(Request $request)
    {
            // Get the search value from the request
            $search = $request->input('search');
        
            // Search in the title and body columns from the posts table
            $user = User::query()
                ->where('name', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%")
                ->get();
        
            // Return the search view with the resluts compacted
            if(count($user)>0){
                
                return view('admin.memberlist', [ 'user'=>$user]);
            }
            else
            {
            return back()->with('error','No results found!');
            }

            
    }

    public function delete($id)
    {
        User::find($id)->delete();


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
}
