<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ville extends Model
{
    protected $table = 'ville';
    public $timestamps = false;

    public function pays(){
        return $this->belongsTo('App\Pays');
    }
}
