<?php
/**
 * Created by PhpStorm.
 * User: BW.KOFFI
 * Date: 23/04/2017
 * Time: 16:18
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Expedition extends Model
{
    protected $table = "expedition";
    public $timestamps = false;
    const UNIT_PRICE = 1000;

    public function typeCamion(){
        return $this->belongsTo('App\TypeCamion');
    }

    public function nature(){
        return $this->belongsTo('App\Nature');
    }

    public function client(){
        return $this->belongsTo('App\Client');
    }
}