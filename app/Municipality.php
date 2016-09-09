<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{
    //saying which table to use
    protected $table='municipalities';

    public function tenders(){

        return $this->hasMany('App\Tender');
    }
}
