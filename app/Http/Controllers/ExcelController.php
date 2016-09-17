<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Tender;

use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    public function getExport2(){

        $exports=Tender::select('id','number','name','type','date','method','agreement','state')->get();

        Excel::create('Export Tender',function ($excel) use($exports)
        {
            $excel->sheet('Sheet 1',function ($sheet) use($exports){
                $sheet->fromArray($exports);
            });
        })->export('xlsx');}
}
