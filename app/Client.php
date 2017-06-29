<?php
/**
 * Created by PhpStorm.
 * User: BW.KOFFI
 * Date: 12/04/2017
 * Time: 15:14
 */

namespace App;


use App\Work\Authenticable;

class Client extends Authenticable
{
    protected $table = 'client';
    protected $guarded = [];
    public $timestamps = false;

    public function identiteAccess(){
        return $this->belongsTo(IdentiteAccess::class,'identiteaccess_id');
    }

    public function validBy(){
        return $this->belongsTo(Staff::class,"valid_by","identiteaccess_id");
    }
}