<?php

namespace App\Http\Controllers;

use App\Material_List;
use App\PhasesTender;
use App\Tender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Http\Requests;

class MaterialListController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tender=Tender::all();
        $material=Material_List::all();
        return view('materials.index')->withTender($tender)->withMaterial($material);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $material =Material_List::all();
        $phases =PhasesTender::all();
        $tender=Tender::all();
        return view('materials.create')->withMaterial($material)->withPhases($phases)->withTender($tender);
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
            'material_name' =>'required|max:255'
        ));
        $material = new Material_List();
        $material->material_name = $request->material_name;
        $material->save();

        Session::flash('success',' material details were saved!');
        return redirect() ->route('materials.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $material=Material_List::find($id);
        return view('materials.create')->withMaterial($material);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $material=Material_List::find($id);
        return view('materials.edit')->withMaterial($material);

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
            'material_name' =>'required|max:255',));

        $material=Material_List::find($id);
        $material->material_name = $request->input('material_name');
        $material->save();
        Session::flash('success','material item was updated');
        return redirect()->route('materials.create');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $material=Material_List::find($id);
        $material->tender()->detach();
        $material->delete();
        Session::flash('success','material item was deleted');
        return redirect()->route('materials.create');
    }

    public function autocompletematerial(Request $request)
    {
        $term =$request->term;

        $contacts = Material_List::where('material_name', 'like', '%' . $term . '%')
            // filter by keyword entered
            ->take(5)
            ->get();

        // convert to json
        $results = [];
        foreach ($contacts as $contact) {
            $results[] = ['id' => $contact->id, 'value' => $contact->material_name];
        }
        return response()->json($results);
    }
}
