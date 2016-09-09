<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tender extends Model
{
    protected $table='tenders';

    protected $dates = ['dob'];

    public function municipality(){

        return $this->belongsTo('App\Municipality');
    }

    public function phases(){

        return $this->belongsTo('App\PhasesTender');
    }
    public function userst(){

        return $this->belongsTo('App\User');
    }
    public function material(){
        return $this->belongsToMany('App\Material_List','material_tender','tender_id','material_id');
    }

    public function fileentry(){
        return $this->hasOne('App\Fileentry');
    }
}
