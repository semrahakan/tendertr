<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material_List extends Model
{
    //
    protected $table='material__lists';

    public function tender(){
        return $this->belongsToMany('App\Tender','material_tender','tender_id','material_id');
    }


}

