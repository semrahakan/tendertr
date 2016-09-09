<?php

namespace App\Http\Controllers;

use App\Municipality;
use App\Reminder;
use App\Tender;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class ReminderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        //using auth middleware so only registered users can see
        $this->middleware('auth');

    }

    public function index()
    {
        $reminder= Reminder::all();
        return view('reminder.index')->withReminder($reminder);


    }


    public function indexfor(){

        $reminder=DB::table('reminders')->orderBy('id','desc')->get();

        return view('/reminder.indexfor')->withReminder($reminder);

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this ->validate($request,array(
            'user_reminder' =>'required',


        ));
        //creating new instance of model
        $reminder= new Reminder();
        $reminder->user_reminder = $request->user_reminder;
        $reminder -> user_id= Auth::user()->id;


        $reminder->save();
        Session::flash('success','the reminder is successfully saved');

        return redirect() ->route('reminder.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reminder=Reminder::find($id);
        if($reminder ==null || $reminder =="")
        {
            $reminder= Reminder::all();
            return view('reminder.index')->withReminder($reminder);

    }
        else{
            return view('reminder.show')->withReminder($reminder);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reminder=Reminder::find($id);
        $reminder->delete();
        Session::flash('success','the reminder was deleted');
        return redirect() ->route('reminder.show',$reminder);

    }

}
