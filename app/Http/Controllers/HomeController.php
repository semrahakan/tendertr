<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\PhasesTender;
use App\Tender;
use App\Municipality;
use App\User;
use App\Reminder;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tender= Tender::orderBy('id','desc')->take(3)->get();
        $user= User::all();
        $municipality=Municipality::all();
        $phases =PhasesTender::all();
       $reminder=Reminder::orderBy('id','desc')->take(3)->get();


        $today = Carbon::now();
        
        return view('home')->withTender($tender)->withUser($user)->withMunicipality($municipality)->withReminder($reminder)->withPhases($phases)->withToday($today);
    }

}
