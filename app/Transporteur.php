<?php
/**
 * Created by PhpStorm.
 * User: BW.KOFFI
 * Date: 12/04/2017
 * Time: 15:14
 */

namespace App;

use App\Work\Authenticable;

class Transporteur extends Authenticable
{
    const LIMITE_CHAUFFEUR_PATRON = 1;
    const LIMITE_TRANSPORTEUR_FLOTTE = null;

    protected $table = 'transporteur';
    protected $guarded = [];

    public $timestamps = false;

    public function identiteAccess(){
        return $this->belongsTo(IdentiteAccess::class,'identiteaccess_id');
    }
}