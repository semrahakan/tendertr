<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhasesTender extends Model
{
    protected $table='phases_tenders';

    public function tenders(){

        return $this ->hasOne('App\Tender','phases_id');
    }
}
