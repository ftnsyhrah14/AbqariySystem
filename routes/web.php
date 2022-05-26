<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\homeControl;
use App\Http\Controllers\creatorControl;
use App\Http\Controllers\adminControl;
use App\Http\Controllers\memberControl;
use Inertia\Inertia;
use App\Mail\newMeeting;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('home');
});
Route::get("/redirect",[homeControl::class,"redirectFunct"]);

Route::get("/redirect",[homeControl::class,"redirectFunct"]);
Route::group(['middleware' => ['prevent-back-history', 'auth']],function(){
    
Route::get("/redirect",[homeControl::class,"redirectFunct"])->name('post.groupList');

//admin management
Route::get("/listcreator",[adminControl::class,"creatorList"]);
Route::any('/creatorSearch', [adminControl::class,"creatorSearch"])->name('creatorsearch');
Route::any('/memberSearch', [adminControl::class,"memberSearch"])->name('membersearch');
Route::get("/listcreator",[adminControl::class,"creatorList"])->name('post.creatorList');
Route::get("/listmember",[adminControl::class,"memberList"])->name('post.memberList');

Route::delete('post/{id}', [adminControl::class, 'delete'])->name('post.delete');

Route::get('post/restore/one/{id}', [adminControl::class, 'restore'])->name('post.restore');

Route::get('post/restore_all', [adminControl::class, 'restore_all'])->name('post.restore_all');

//creator management

Route::get("/creatorprofile",[creatorControl::class,"creatorProfile"]);
Route::get("/groupform",[creatorControl::class,"newGroup"]);
Route::get('/groupSearch', [creatorControl::class,"groupSearch"])->name('groupsearch');
Route::get("/groupdetail/{id}",[creatorControl::class,"detailsGroup"]);
Route::get("/kickmember/{id}",[creatorControl::class,"kickMember"]);
Route::get("/updattendance/{id}",[creatorControl::class,"updateAttendance"]);
Route::POST("/updateattendance",[creatorControl::class,"editAttendance"]);
Route::POST("/editgroup",[creatorControl::class,"editGroup"]);
Route::POST("/addgroup",[creatorControl::class,"addgroup"]);
Route::get("insert/{userID}/{groupID}",[creatorControl::class,"approveMem"]);
Route::get("reject/{userID}/{groupID}",[creatorControl::class,"rejectMem"]);
Route::get("/sessionform/{id}",[creatorControl::class,"newSession"]);
Route::POST("/addsession",[creatorControl::class,"addsession"]);
Route::get("/meetingdetails/{id}",[creatorControl::class,"detailsMeeting"]);
Route::get("/delete/{id}",[creatorControl::class,"deleteSession"]);
Route::POST("/editmeeting",[creatorControl::class,"editMeeting"]);
Route::POST("/uploadnewnote",[creatorControl::class,"uploadNewnote"]);
Route::get("/download/{file}",[creatorControl::class,"download"]);

//membermanagement
Route::get("/memberprofile",[memberControl::class,"memberProfile"]);
Route::get("/leave/{id}",[memberControl::class,"leaveGroup"]);
Route::get("/join/{id}",[memberControl::class,"sendRequest"]);
Route::get("/groupdetails/{id}",[memberControl::class,"detailsGroup"]);
Route::get("/updattendance/{id}",[memberControl::class,"updateAttendance"]);
Route::get("/cancelrequest/{id}",[memberControl::class,"cancelRequest"]);
Route::POST("/updateattend",[memberControl::class,"editAttendance"]);
Route::get("/downloads/{file}",[creatorControl::class,"download"]);

});
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('Dashboard');
})->name('dashboard');

