<?php
/**
 * Created by PhpStorm.
 * User: BW.KOFFI
 * Date: 30/06/2017
 * Time: 15:32
 */

namespace App\Work\Money;


use App\Expedition;
use Illuminate\Http\Request;

abstract class Payement
{
    protected $compte_id = null;
    protected $token = null;
    protected $playload = [];

    protected $returnAdress = null;
    protected $errorReturnAdress = null;

    public function __construct()
    {
        if($this->boot()){
            //Change $token and $compte_id
        }else
            throw new PayementException(PayementException::INITIALISATION_FAILED);
    }

    /**
     * @param array $playload
     * @return mixed
     * @throws PayementException
     */
    public abstract function showPartnerPage();


    /**
     * @param Request $request
     * @return mixed
     * @throws PayementException
     */
    public abstract function handleComeBack(Request $request);

    /**
     * @return boolean
     */
    public abstract function boot();
}