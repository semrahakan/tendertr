<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Support\Facades\Session;

class EmailController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $user =User::all();
        return view('emails.send')->withUsers($user);
    }
    public function sendEmail(Request $request)
    {
        $this ->validate($request,array( 'receiver' =>'required', ));
        $receiver= $request->input('receiver');
        $content=$request->input('contents');
        $emails=Auth::user()->email;
        $title =$request->title;

        $name=Auth::user()->name;


        Mail::raw($content, function ($message) use( $content,$emails,$name,$receiver,$title) {
            $message->from($emails,$name);

            $message->to( $receiver )->subject($title);
        });
        Session::flash('success','Your email was sent');
        return view('emails.send');
    }

    public function autocomplete(Request $request)
    {
        $term=$request->term;
        $data = DB::table('contacts')->select('contactEmail')->where('contactEmail','LIKE','%'.$term.'%')->get();
        $result=array();
        foreach ($data as $key=>$value)
        {
            $request[]=['id'=>$value->id, 'value'=>$value->contactEmail];

        }
        return response()->json($result);


    }
   
}
