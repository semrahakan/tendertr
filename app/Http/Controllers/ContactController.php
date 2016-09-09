<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;

use App\Http\Requests;
use Symfony\Component\HttpFoundation\Session\Flash;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
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

    public function index(Request $request)
    {
        $contact= Contact::all();

        return view('contact.index')->withContact($contact);
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
            'contactName' =>'required',
            'contactPhone' =>'required',
            'contactEmail' =>'required',
            'address'=>'required',
        ));
        //creating new instance of model
        $contact= new Contact;
        $contact->contactName= $request->contactName;
        $contact->contactPhone= $request->contactPhone;
        $contact->contactEmail= $request->contactEmail;
        $contact->address = $request->address;

        $contact->save();
        
        Session::flash('success','new contract has been successfully created');

        //redirect
        return redirect() ->route('contact.index'); //this goes to show method
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contact =Contact::find($id);
        return view('contact.send')->withContact($contact);

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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {    $contact= Contact::find($id);
        $contact->delete();
        //Session::flash('success','deleted');
        return redirect()->route('contact.index');

    }
    
    public function sendEmailContact(Request $request,$id )
    {
        $this ->validate($request,array(
            'contactEmail' =>'required|email',
            'title' =>' required',
            'contents' =>'required'
        ));



        $title =$request->title;

        $contents=$request->contents;

        $contactEmail= $request->contactEmail;
        $emails=Auth::user()->email;
        $name=Auth::user()->name;



        Mail::raw($contents, function ($message) use( $contents,$emails,$name,$contactEmail,$title) {
            $message->from($emails,$name);

            $message->to( $contactEmail )->subject($title);
        });
        $contact =Contact::find($id);
        Session::flash('success','Your email was sent');
        return view('contact.send')->withContacts($contactEmail)->withContact($contact);



    }
    public function indexEmail ()
    {

        $contact = Contact::all();
        return view('contact.send')->withContacts($contact);

    }

    public function autocomplete(Request $request)
    {
            $term =$request->term;

            $contacts = Contact::where('contactName', 'like', '%' . $term . '%')
                // filter by keyword entered
                 ->take(5)
                ->get();

            // convert to json
            $results = [];
            foreach ($contacts as $contact) {
                $results[] = ['id' => $contact->id, 'value' => $contact->contactName];
            }
            return response()->json($results);
        }



}
