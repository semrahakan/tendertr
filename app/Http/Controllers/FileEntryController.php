<?php

namespace App\Http\Controllers;

use App\Tender;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Fileentry;

use Illuminate\Http\UploadedFile;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class FileEntryController extends Controller
{
    public function index()
    {
        $entries = Fileentry::all();
        $tender=Tender::all();

        return view('tender.file', compact('entries'))->withEntries($entries)->withTender($tender);
    }

    public function add(Request $request, $id) {
        //bunu kullanmıyorsun route takı upload ı kullanıyorsun
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
        //$destinationPath = public_path()."/uploads/".$entry->filename;

        $pathToFile=storage_path()."/app/".$entry->original_filename;
        return response()->download($pathToFile);

    }

    public function deleteFile($id){

        $contact = Fileentry::find($id);

        $filename = $contact->original_filename;

        $fullPath =storage_path()."/app/".$contact->original_filename;

        File::delete($fullPath);
        //asagısı db siler sadece
        $contact->delete();


        Session::flash('success','the file has been removed ');
        return redirect()->route('tender.index');


    }



}
