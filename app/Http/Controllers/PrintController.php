<?php

namespace App\Http\Controllers;

use App\Tender;
use Illuminate\Http\Request;

use App\Http\Requests;

class PrintController extends Controller
{
    public function printPage($id){
        $tender=Tender::find($id);
        return view('tender.printPage')->withTender($tender);
    }
}
