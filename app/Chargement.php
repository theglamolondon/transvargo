<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chargement extends Model
{
    protected $table = 'chargement';
    protected $guarded = [];
    protected $hidden = ['otp', 'dateheureotp'];

    public $timestamps = false;

    public function expedition(){
        return $this->belongsTo(Expedition::class);
    }

    public function vehicule(){
        return $this->belongsTo(Vehicule::class,"vehicule_id");
    }
}
