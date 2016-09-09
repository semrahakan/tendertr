<?php

namespace App\Http\Controllers;

use App\Fileentry;
use App\Material_List;
use App\Municipality;
use App\PhasesTender;
use App\Tender;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;



class TenderController extends Controller
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
        $tender= Tender::orderBy('id','desc')->paginate(7);

        $user= User::all();
        $municipality=Municipality::all();
        $phase =PhasesTender::all();
        $entries = Fileentry::all();

        return view('tender.index', compact('entries'))->withTender($tender)->withUser($user)->withMunicipality($municipality)->withPhase($phase)->withEntries($entries);;



    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $phases = PhasesTender::all();//takes all phases from the db
        $tender= Tender::all();
        $users =User::all();
        $material = Material_List::all();
        return view('tender.create')->withPhases($phases)->withUsers($users)->withMaterial($material)->withTender($tender);
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
            'number' =>'required|max:255',
            'name' =>'required',
            'type'=>'required',
            'date'=>'required',
            'method'=>'required',
            'agreement'=>'required',
            'priority'=>'required',
            'state'=>'required',
            'details'=>'required'


        ));


        $number = $request['number'];
        $name =$request['name'];
        $type=$request['type'];
        $date=$request['date'];
        $method=$request['method'];
        $agreement=$request['agreement'];
        $priority=$request['priority'];
        $state=$request['state'];
        $details=$request['details'];
        $phases_id=$request['phases_id'];
        $user_id =$request['user_id'];
        $user_id2 =$request['user_id2'];


        $tender = new Tender();
        $tender->number = $number;
        $tender->name = $name;
        $tender->type = $type;
        $tender->date = $date;
        $tender->method = $method;
        $tender->agreement = $agreement;
        $tender->priority = $priority;
        $tender->state = $state;
        $tender->details = $details;

        $tender->phases_id=$phases_id;
        $tender->user_id=$user_id;
        $tender->user_id2=$user_id2;


        $tender -> created_user_id= Auth::user()->id;
       $municipality_id = DB::table('municipalities')->max('id');
       $tender->municipality_id=$municipality_id;

        $tender->save();

       $tender->material()->sync($request->material_list,false);

        Session::flash('success',' tender details were saved!');

        $phases = PhasesTender::all();//takes all phases from the db
        $tender= Tender::all();
        $users =User::all();
        $material = Material_List::all();
        return view('tender.create')->withPhases($phases)->withUsers($users)->withMaterial($material)->withTender($tender);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $tender = Tender::find($id); // find is for finding the primary id in db
        $municipality = Municipality::all();
        $tenders=Tender::all();
        $phase=PhasesTender::all();
        if($tender ==null || $tender=="")
        {
            return view('welcome');
        }
        else {
            return view('tender.show')->with('tender', $tender)->withMunicipality($municipality)->withPhase($phase);
        }

    }


    public function fileUpload($id)
    {
        //for second file upload
        $tender = Tender::find($id);
        $municipality = Municipality::all();
        $tenders=Tender::all();
        $phase=PhasesTender::all();
        $entry=Fileentry::all();
        return view('tender.fileUpload')->with('tender', $tender)->withMunicipality($municipality)->withPhase($phase)->withEntry($entry);
    }

    public function files(Request $request, $id){

        $tender=Tender::find($id);
        $file=Fileentry::all();
        return view('tender.file')->withTender($tender)->withFile($file);

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
        $tender = Tender::find($id);
        $phases= PhasesTender::all();
        $tphase=array();
        foreach($phases as $phase){
            $tphase[$phase->id] = $phase->name;
        }
        $tags=Material_List::all();
        $tags2=array();
        foreach ($tags as $tag ){

            $tags2[$tag->id]=$tag->material_name;
        }



        //return the view make sure you have that view as edit in municipality folder
        return view('tender.edit')->with('tender',  $tender )->withPhases($tphase)->withTags($tags2);
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
            'number' =>'required|max:255',
            'name' =>'required',
            'type'=>'required',
            'date'=>'required',
            'method'=>'required',
            'agreement'=>'required',
            'priority'=>'required',
            'state'=>'required',
            'details'=>'required'

        ));

        $tender= Tender::find($id);
        $tender->number = $request->input('number');
        $tender->name=$request->input('name');
        $tender->type =$request->input('type');
        $tender->date =$request->input('date');
        $tender->method =$request->input('method');
        $tender->agreement=$request->input('agreement');
        $tender->priority =$request->input('priority');
        $tender->phases_id =$request->input('phases_id');

        $tender->state =$request->input('state');
        $tender->details =$request->input('details');
        $tender->updated_user_id =Auth::user()->id;
        $tender->save();



        //sending emails when there is an update

        $user=User::all();
        $assigneduser_email="";
        $assigneduser2_email="";
        $created_user_mail="";
        foreach ($user as $users){//degısıklıgı yapan assigned user degılse
            if( $tender->user_id !== Auth::user()->id )
            {
                if ($users->id == $tender->user_id){
                    $assigneduser_email=$users->email;
                }
            }
            else {
                $assigneduser_email="trafftec@gmail.com";
            }
            //degisikligi yapan 2.user degilse
            if ( $tender->user_id2 !== Auth::user()->id)
            {
                if ($users->id == $tender->user_id2){
                    $assigneduser2_email=$users->email;
                }
            }
            else{
                $assigneduser2_email="trafftec@gmail.com";
            }
            if( $tender->created_user_id !== Auth::user()->id){
                $created_user_mail=$users->email;
            }
            else
            {
                $created_user_mail="trafftec@gmail.com";
            }

        }
        $changed_item= $tender->name;

        Mail::raw($changed_item, function ($m) use( $assigneduser_email,$assigneduser2_email,$created_user_mail)
        {
            $m->from('trafftec@gmail.com','traff-tec');

            $m->to( $assigneduser_email)->subject('There is some changes!');
            $m->to( $assigneduser2_email)->subject('There is some changes!');
            $m->to( $created_user_mail)->subject('There is some changes!');

        });

        Session::flash('success','tender information is successfully updated');
        return redirect()->route('tender.show',$tender->id);

    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tender=Tender::find($id);
        //this i for many to many relation
        $tender->material()->detach();

        $tender->delete();
        Session::flash('success',' tender was deleted');
        return redirect()->route('tender.show',$tender);

        //   return response()->json(array('sms'=>'deleted'));
    }


    public function autocompleteTender(Request $request)
    {
        $term =$request->term;

        $tender = Tender::where('name', 'like', '%' . $term . '%')
            // filter by keyword entered
            ->take(5)
            ->get();

        // convert to json
        $results = [];
        foreach ($tender as $tenders) {
            $results[] = ['id' => $tenders->id, 'value' => $tenders->name];
        }
        return response()->json($results);
    }

    public function phaseEdit($id){

        $tender = Tender::find($id);
        $phases= PhasesTender::all();
        $tphase=array();
        foreach($phases as $phase){
            $tphase[$phase->id] = $phase->name;
        }

        return view('tender.phaseEdit')->with('tender',  $tender )->withPhases($tphase);
    }

    public function phaseUpdate(Request $request, $id){
        $tender= Tender::find($id);
        $tender->phases_id =$request->input('phases_id');
        $tender->updated_user_id =Auth::user()->id;
        $tender->save();
        $products = Tender::all();
        $user=User::all();
        return view('tender.deneme')->withProducts($products)->withUser($user);
    }


    public function commentSave(Request $request, $id){
        $tender= Tender::find($id);
        $tender->comment =$request->input('comment');
        $tender->save();
        return redirect()->route('tender.show',$tender->id);
    }

    public function tenderPrint($id){
        $tender=Tender::find($id);
        return view('tender.printPage')->withTender($tender);
    }

    public function material($id)
    {
        //find the post in the database and save as a variable
        $tender = Tender::find($id);
        $phases= PhasesTender::all();
        $tphase=array();
        foreach($phases as $phase){
            $tphase[$phase->id] = $phase->name;
        }

        $tags=Material_List::all();
        $tags2=array();
        foreach ($tags as $tag ){

            $tags2[$tag->id]=$tag->material_name;
        }
        //return the view make sure you have that view as edit in municipality folder
        return view('tender.editMaterial')->with('tender',  $tender )->withPhases($tphase)->withTags($tags2);
    }


    public function materialUpdate(Request $request, $id)
    {
        $tender= Tender::find($id);

        if (isset($request->materials)){
            $tender->material()->sync($request->materials);
        }
        else{
            $tender->material()->sync(array());
        }
        Session::flash('success','material list is successfully updated');
        return redirect() ->route('materials.create');



    }





}
