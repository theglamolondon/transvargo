<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicule extends Model
{
    protected $table = 'vehicule';
    protected $guarded = [];
    public $timestamps = false;

    public function transporteur(){
        return $this->belongsTo(Transporteur::class,'transporteur_id');
    }

    public function typeCamion(){
        return $this->belongsTo(TypeCamion::class,'typecamion_id');
    }

    public function localisation(){
        return $this->hasMany(Localisation::class,"vehicule_id");
    }
}