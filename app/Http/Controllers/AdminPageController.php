<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class AdminPageController extends Controller
{
    public function __construct()
    {
        $this->middleware('isAdmin');
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function page()
    {
        return view('adminpage');
    }
    public function indexUser()
    {
        $user= User::all();
        return view('user.index')->withUser($user);

    }

    public function postSignUp(Request $request){
        $this ->validate($request,array(
            'name' =>'required',
            'email'=>'required',
            'password'=>'required',
        ));
        

        // this is for signup button
        $name = $request['name'];
        $email = $request['email'];
        $password = bcrypt($request['password']);


        $user = new User(); // new instance of user object

        // accessing the database fields
        $user -> name=  $name ;
        $user -> email = $email;
        $user -> password =  $password;


        $user ->save();// write to database
        Session::flash('success','user has been created!');

        return redirect('/adminpage');

    }
}
