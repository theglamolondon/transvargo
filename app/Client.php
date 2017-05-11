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
        return $this->belongsTo('App\IdentiteAccess','identiteaccess_id');
    }
}