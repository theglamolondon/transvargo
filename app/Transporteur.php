<?php
/**
 * Created by PhpStorm.
 * User: BW.KOFFI
 * Date: 12/04/2017
 * Time: 15:14
 */

namespace App;

use App\Work\Authenticable;
use Illuminate\Notifications\Notifiable;

class Transporteur extends Authenticable
{
    const LIMITE_CHAUFFEUR_PATRON = 1;
    const LIMITE_TRANSPORTEUR_FLOTTE = null;
    const POURCENTAGE = 1;

    protected $table = 'transporteur';
    protected $guarded = [];

    public $timestamps = false;

    use Notifiable;

    public function identiteAccess(){
        return $this->belongsTo(IdentiteAccess::class,'identiteaccess_id');
    }

    public function typeTransporteur(){
        return $this->belongsTo(TypeTransporteur::class,'typetransporteur_id');
    }

    public function extension(){
        return $this->hasOne(ChauffeurPatron::class,'transport_id');
    }

    public function vehicules(){
        return $this->hasMany(Vehicule::class,'transporteur_id');
    }
}