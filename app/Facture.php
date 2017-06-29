<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    public $timestamps = false;
    protected $table = "facture";
    protected $guarded = ["id"];

    public function client(){
        return $this->belongsTo(Client::class,"client_id","identiteaccess_id");
    }

    public function staff(){
        return $this->belongsTo(Staff::class,"staff_id","identiteaccess_id");
    }

    public function expeditions(){
        return $this->hasMany(Expedition::class,"facture_id");
    }
}
