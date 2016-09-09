<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fileentry extends Model
{
    //
    protected $table='fileentries';

    public function tender(){

        return $this->belongsTo('App\Tender');
    }
}
