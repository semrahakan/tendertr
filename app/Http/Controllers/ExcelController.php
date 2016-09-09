<?php

namespace App\Http\Controllers;

use App\Municipality;
use App\Order;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Tender;
use App\Contact;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Input;

class ExcelController extends Controller
{

    public function getExport(){

        
       $export=Tender::select('id','name','type','agreement')->get();
        Excel::create('Export Customer',function ($excel) use($export)
        {
            $excel->sheet('Sheet 1',function ($sheet) use($export){
                    $sheet->fromArray($export);
            });

        })->export('xlsx');
    }

    public function getExport2(){

        $exports=Tender::select('id','number','name','type','date','method','agreement','state')->get();

        Excel::create('Export Customer',function ($excel) use($exports)
        {
            $excel->sheet('Sheet 1',function ($sheet) use($exports){
                $sheet->fromArray($exports);
            });


        })->export('xlsx');}



}
