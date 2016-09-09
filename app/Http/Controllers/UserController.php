<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Tender;

use App\Http\Requests;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
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
       // $this->middleware('isAdmin');

    }


    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {



    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $filename=$user->avatar;
        $fullPath =  public_path('/uploads/avatars/'.$filename);
        if($fullPath == null || $fullPath=="" || $user==null || $user=="" )
        {
            return view('welcome');
        }
        else{
            return view('profile',array('user'=>Auth::user()));
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
        $this ->validate($request,array(
            'name' =>'required'

        ));
        $user= User::find($id);
        $user->name =$request['name'];
        $user->save();
        Session::flash('success','User name has been updated');
        return redirect('/');



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user=User::find($id);
        $user->delete();

        return redirect()->route('user.show',$user);

    }

    public function update_avatar(Request $request){

        if($request->hasFile('avatar'))
        {
            $avatar=$request->file('avatar');
            $filename=time().'.'.$avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300,300)->save(public_path('/uploads/avatars/'.$filename));

            $user=Auth::user();
            $user->avatar=$filename;
            $user->save();
            return view('profile',array('user'=>Auth::user()));

        }
        else{
            Session::flash('warning','Please select a profile picture');
            return redirect()->route('municipality.create');
        }


    }
    public function deleteImage($id){
        $user_image = User::find($id);
        $filename=$user_image->avatar;
        $fullPath =  public_path('/uploads/avatars/'.$filename);

        File::delete($fullPath);
        Session::flash('success','user picture was successfully deleted');
        return redirect()->route('user.show', $user_image);
        
    }

    public function profile(){

        return view('profile',array('user'=>Auth::user()));
    }

    public function makeAdmin($id){

        $user=User::find($id);

            return view('user.makeAdmin')->withUser($user);

    }
    public function admin(Request $request, $id){

        $user=User::find($id);
        $user->admin =$request['admin'];
        $user->save();
        Session::flash('success','user is an admin now');
        return view('profile',array('user'=>Auth::user()));


    }


   
}
