<?php
/**
 * Created by PhpStorm.
 * User: BW.KOFFI
 * Date: 23/04/2017
 * Time: 16:16
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class TypeCamion extends Model
{
    protected $table = "typecamion";
    public $timestamps = false;

    public function tonnage(){
        return $this->hasMany(Tonnage::class, 'typecamion_id');
    }
}