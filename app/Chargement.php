<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chargement extends Model
{
    protected $table = 'chargement';
    protected $guarded = [];

    public $timestamps = false;

    public function expedition(){
        return $this->belongsTo('App\Expedition');
    }

    public function vehicule(){
        return $this->belongsTo('App\Vehicule');
    }
}
