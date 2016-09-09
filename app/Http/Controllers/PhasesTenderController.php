<?php

namespace App\Http\Controllers;

use App\PhasesTender;
use App\Tender;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class PhasesTenderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //display a view of all of our categories
        //it will also have a from to create

        $phases = PhasesTender::all();

        return view('phases.index')->withPhases( $phases);
    }
    
    public function winsIndex()
    {
        $phases = PhasesTender::all();
        $tender =Tender::all();
        $user=User::all();
        return view('phases.wins')->withPhases( $phases)->withTender($tender)->withUser($user);

    }
    
    public function lossesIndex()
    {
        $tender =Tender::all();
        $user=User::all();

        return view('phases.losses')->withTender($tender)->withUser($user);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //save a new phase
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $phase = PhasesTender::find($id); // find is for finding the primary id in db
        $tender=Tender::all();
        $den =Tender::find($id);
        return view('phases.show')->with('phase',$phase)->withTender($tender)->withDen($den);
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
       

        $tender =Tender::find($id);




        $tender->save();

        return redirect() ->route('phases.index')->withTender($tender);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
          }
    
    
}
