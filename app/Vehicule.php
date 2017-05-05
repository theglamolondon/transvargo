<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicule extends Model
{
    protected $table = 'vehicule';
    protected $guarded = [];
    public $timestamps = false;

    public function transporteur(){
        return $this->belongsTo('App\Transporteur');
    }

    public function typeCamion(){
        return $this->belongsTo('App\TypeCamion','typecamion_id');
    }
}
