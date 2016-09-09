<?php

namespace App\Http\Controllers;

use App\Municipality;

use  App\Tender;
use App\PhasesTender;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;


class MunicipalityController extends Controller
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
        //creating a variable that holds list of items from the db
        $list= Municipality::orderBy('id','desc')->paginate(7);
        $tender= Tender::all();
        return view('municipality.index')->withList($list)->withTender($tender);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tender= Tender::all();
        $phases=PhasesTender::all();
        return view('municipality.create')->withTender($tender)->withPhases($phases);
    }
    
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate the data
        $this ->validate($request,array(
            'address' =>'required|max:255',
            'muniName' =>'required',
            'city'=>'required',
            'phone'=>'required',
            'personName'=>'required',
            'personPhone'=>'required',
            'personMail'=>'required'

        ));

        //store the items to the database using eloquent

        //creating new instance of model
        $municipality= new Municipality();
        $municipality->muniName = $request->muniName;
        $municipality->address=$request->address;
        $municipality->city=$request->city;
        $municipality->phone=$request->phone;
        $municipality->personName=$request->personName;
        $municipality->personPhone=$request->personPhone;
        $municipality->personMail=$request->personMail;

        $municipality->save();

        Session::flash('success','municipality information is successfully saved');

        //redirect
        return redirect() ->route('tender.create'); //this goes to show method
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $municipality = Municipality::find($id);
        if($municipality == null || $municipality==""){
            $list= Municipality::orderBy('id','desc')->paginate(7);
            $tender= Tender::all();
            return view('municipality.index')->withList($list)->withTender($tender);
        }
        else{
            return view('municipality.show')->with('municipality',$municipality);
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
        //find the post in the database and save as a variable
        $municipality = Municipality::find($id);
        //return the view make sure you have that view as edit in municipality folder
        return view('municipality.edit')->with('municipality',  $municipality );


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
        //validate the data
        $this ->validate($request,array(
            'address' =>'required|max:255',
            'muniName' =>'required',
            'city'=>'required',
            'phone'=>'required',
            'personName'=>'required',
            'personPhone'=>'required',
            'personMail'=>'required|email'

        ));

        $municipality = Municipality::find($id);
        $municipality->muniName = $request->input('muniName');
        $municipality->address=$request->input('address');
        $municipality->city =$request->input('city');
        $municipality->phone =$request->input('phone');
        $municipality->personName =$request->input('personName');
        $municipality->personPhone=$request->input('personPhone');
        $municipality->personMail =$request->input('personMail');
        $municipality->save();

        Session::flash('success','municipality information was updated!');

        return redirect()->route('municipality.show',$municipality->id);



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $municipality=Municipality::find($id);
        $municipality->delete();
        Session::flash('success','the information for municipality was deleted');
        return redirect()->route('municipality.show',$municipality);

       // return response()->json(array('sms'=>'deleted'));
    }
}
