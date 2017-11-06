<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Localisation extends Model
{
    protected $table = "localisation";
    public $timestamps = false;

    public function vehicule(){
        return $this->belongsTo(Vehicule::class, "vehicule_id");
    }
}
