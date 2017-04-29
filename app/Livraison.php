<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Livraison extends Model
{
    protected $table = 'livraison';
    protected $guarded = [];

    public $timestamps = false;

    public function expedition(){
        return $this->hasOne('App\Livraison','expedition_id');
    }
}
