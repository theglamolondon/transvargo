<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tonnage extends Model
{
    protected $table = 'tonnage';
    public $timestamps = false;

    public function typeCamion(){
        return $this->belongsTo(TypeCamion::class,'typecamion_id');
    }
}
