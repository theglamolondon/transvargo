<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChauffeurPatron extends Model
{
    protected $table = "chauffeurpatron";
    protected $primaryKey = "transport_id";
    protected $guarded = [];
    public $timestamps = false;

    public function transporteur(){
        return $this->belongsTo(Transporteur::class,'transport_id','identiteaccess_id');
    }
}
