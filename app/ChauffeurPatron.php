<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChauffeurPatron extends Model
{
    protected $table = "chauffeurpatron";
    protected $primaryKey = "transport_id";
    public $timestamps = false;

    protected function transporteur(){
        return $this->belongsTo(Transporteur::class,'transport_id','identiteaccess_id');
    }
}
