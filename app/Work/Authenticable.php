<?php
/**
 * Created by PhpStorm.
 * User: BW.KOFFI
 * Date: 12/04/2017
 * Time: 15:09
 */

namespace App\Work;


use Illuminate\Database\Eloquent\Model;

abstract class Authenticable extends Model
{
    protected $raisonsociale;
    protected $nom;
    protected $prenoms;
    protected $primaryKey = 'identiteaccess_id';
    protected $guarded = [];

    public $timestamps = false;
}