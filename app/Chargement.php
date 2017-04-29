<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chargement extends Model
{
    protected $table = 'chargement';
    protected $guarded = [];

    public $timestamps = false;

    public function expedition(){
        return $this->hasOne('App\Expedition','expedition_id');
    }
}
