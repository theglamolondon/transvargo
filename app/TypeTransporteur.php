<?php
/**
 * Created by PhpStorm.
 * User: BW.KOFFI
 * Date: 26/04/2017
 * Time: 10:49
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class TypeTransporteur extends Model
{
    const TYPE_CHAUFFEUR_PATRON = 1;
    const TYPE_PROPRIETAIRE_FLOTTE = 2;

    protected $table = "typetransporteur";
    public $timestamps = false;
}