<?php
/**
 * Created by PhpStorm.
 * User: BW.KOFFI
 * Date: 12/04/2017
 * Time: 15:15
 */

namespace App;


use App\Work\Authenticable;

class Staff extends Authenticable
{
    const POURCENTAGE = 0.25;

    public $timestamps = false;
    protected $table = 'staff';

    public function identiteAcces(){
        return $this->belongsTo(IdentiteAccess::class,"identiteaccess_id");
    }
}