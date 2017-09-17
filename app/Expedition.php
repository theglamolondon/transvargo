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
    protected $guarded = [];
    protected $table = "expedition";
    protected $casts = [
        "fragile" => "boolean"
    ];

    public $timestamps = false;

    const UNIT_PRICE = 1000;

    public function typeCamion(){
        return $this->belongsTo(TypeCamion::class,'typecamion_id');
    }

    public function client(){
        return $this->belongsTo(Client::class,'client_id');
    }

    public function chargement(){
        return $this->hasOne(Chargement::class);
    }

    public function facture(){
        return $this->belongsTo(Facture::class);
    }

    public function __toString()
    {
        return sprintf("Expédition N° %s de %s à %s (Distance %s km)",
            $this->reference, $this->lieudepart, $this->lieuarrivee, $this->distance);
    }
}