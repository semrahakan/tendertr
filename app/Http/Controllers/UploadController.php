<?php

namespace App\Http\Controllers;

use App\Tender;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
class UploadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function upload(Request $request){

       $files=$request->file('file');
        if(!empty($files)):
            foreach ($files as $file):
                Storage::put($file->getClientOriginalName(),file_get_contents($file));

                endforeach;

            endif;
        return \Response::json(array('success' =>true));
    }



   
}
