<?php

namespace App\Http\Controllers;

use App\Tender;
use Illuminate\Http\Request;

use App\Fileentry;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class FileEntryController extends Controller
{
    //the source code was taken from here: https://www.codetutorial.io/laravel-5-file-upload-storage-download/
    public function index()
    {
        $entries = Fileentry::all();
        $tender=Tender::all();

        return view('tender.file', compact('entries'))->withEntries($entries)->withTender($tender);
    }

    public function add(Request $request, $id) {
        $tender=Tender::find($id);
        $file = $request->file('file');
        $destinationPath =storage_path()."/app/";
        $filename = $file->getClientOriginalName();
        $upload_success = Input::file('file')->move($destinationPath, $filename);
        if ( $upload_success){
            $entry = new Fileentry();
            $entry->mime = $file->getClientMimeType();
            $entry->original_filename = $file->getClientOriginalName();
            $entry->filename = $file->getFilename().'.'.$filename;
            $entry->tender_id= $tender;
            $entry->user_id=Auth::user()->id;
            $entry->save();
        }

        return \Response::json(array('success' =>true));

    }

    public function get($original_filename){

        $entry = Fileentry::where('original_filename', '=', $original_filename)->firstOrFail();
        $pathToFile=storage_path()."/app/".$entry->original_filename;
        return response()->download($pathToFile);

    }

    public function deleteFile($id){

        $contact = Fileentry::find($id);

        $filename = $contact->original_filename;

        $fullPath =storage_path()."/app/".$contact->original_filename;

        File::delete($fullPath);

        $contact->delete();


        Session::flash('success','the file has been removed ');
        return redirect()->route('tender.index');


    }



}
