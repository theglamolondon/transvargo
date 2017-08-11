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

    protected $table = 'staff';
}