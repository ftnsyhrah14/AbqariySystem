<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\homeControl;
use App\Http\Controllers\creatorControl;
use App\Http\Controllers\memberControl;
use Inertia\Inertia;

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

//creator management
Route::get("/creatorprofile",[creatorControl::class,"creatorProfile"]);
Route::get("/groupform",[creatorControl::class,"newGroup"]);

//membermanagement
Route::get("/memberprofile",[memberControl::class,"memberProfile"]);


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');
