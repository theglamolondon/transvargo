<?php
/**
 * Created by PhpStorm.
 * User: BW.KOFFI
 * Date: 30/06/2017
 * Time: 16:40
 */

namespace App\Work\Money\Partner;

use App\Work\Money\Payement;
use App\Work\Money\PayementException;
use Illuminate\Http\Request;

class OmPay extends Payement
{
    const URL_BASE = "https://ompay.orange.ci/e-commerce_test_gw";

    const URL_INIT = self::URL_BASE."/init.php";
    const URL_SENT_DATA = self::URL_BASE;

    private $logo_url;
    private $site_title;

    protected $returnAdress = "";
    protected $errorReturnAdress = "";
    protected $compte_id= "cfcbeaa9434303d208a5e4b681f94714e4ea47bdef1f8fe1cb21697e5baf9345";

    public $amount;
    private $sessionid ;
    public $purchaseref;
    public $description;
    public $tag;
    public $contact_partenaire;

    public function __construct()
    {
        $this->logo_url = config("app.url")."images/transvargo-logo.png";
        $this->site_title = config("app.name");
        $this->sessionid = \Illuminate\Support\Facades\Request::cookie("laravel_session");
        $this->returnAdress = route("payment.om.success");
        $this->errorReturnAdress = route("payment.om.error");

        parent::__construct();
    }

    /**
     * @return mixed
     * @throws PayementException
     */
    public function showPartnerPage()
    {
        // TODO: Implement showPartnerPage() method.
    }



    /**
     * @param Request $request
     * @return mixed
     * @throws PayementException
     */
    public function handleComeBack(Request $request)
    {
        // TODO: Implement handleComeBack() method.
    }

    /**
     * @return boolean
     */
    public function boot()
    {
        $handle = curl_init(self::URL_INIT);
        curl_setopt_array($handle,[
            CURLOPT_POST => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS => [
                "merchantid" => $this->compte_id,
                "amount" => 50000,
                "sessionid" => $this->sessionid,
                "purchaseref" => "REF",
                "description" =>  "Nothing"
            ]
        ]);

        $this->token = curl_exec($handle);

        return ! $this->token === false;
    }

    /**
     * @return string
     */
    public function getComteId()
    {
        return $this->compte_id;
    }

    /**
     * @return string
     */
    public function getLogoUrl()
    {
        return $this->logo_url;
    }

    /**
     * @return mixed
     */
    public function getSiteTitle()
    {
        return $this->site_title;
    }

    /**
     * @return string
     */
    public function getReturnAdress()
    {
        return $this->returnAdress;
    }

    /**
     * @return string
     */
    public function getErrorReturnAdress()
    {
        return $this->errorReturnAdress;
    }

    /**
     * @return mixed
     */
    public function getSessionid()
    {
        return $this->sessionid;
    }

    /**
     * @return null
     */
    public function getCompteId()
    {
        return $this->compte_id;
    }

    /**
     * @return null
     */
    public function getToken()
    {
        return $this->token;
    }
}