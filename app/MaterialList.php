<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaterialList extends Model
{
    protected $table='material_tender';

    public function tender(){
        return $this->belongsToMany('App\Tender','material_tender','tender_id','material_id');
    }
}
