<?php
/**
 * Created by PhpStorm.
 * User: BW.KOFFI
 * Date: 11/04/2017
 * Time: 18:39
 */

namespace App\Services;


class IpGeolocalisation
{
    protected $IP;


    //the geoPlugin server
    protected $host = 'http://www.geoplugin.net/php.gp?ip={IP}&base_currency={CURRENCY}';

    //the default base currency
    protected $currency = 'XOF';

    //initiate the geoPlugin vars
    protected $ip = null;
    protected $city = null;
    protected $region = null;
    protected $areaCode = null;
    protected $dmaCode = null;
    protected $countryCode = null;
    protected $countryName = null;
    protected $continentCode = null;
    protected $latitude = null;
    protected $longitude = null;
    protected $currencyCode = null;
    protected $currencySymbol = null;
    protected $currencyConverter = null;

    public function locate($ip = null) {

        global $_SERVER;

        if ( is_null( $ip ) ) {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        $host = str_replace( '{IP}', $ip, $this->host );
        $host = str_replace( '{CURRENCY}', $this->currency, $host );

        $data = [];

        $response = $this->fetch($host);

        $data = unserialize($response);

        //set the geoPlugin vars
        $this->ip = $ip;
        $this->city = $data['geoplugin_city'];
        $this->region = $data['geoplugin_region'];
        $this->areaCode = $data['geoplugin_areaCode'];
        $this->dmaCode = $data['geoplugin_dmaCode'];
        $this->countryCode = $data['geoplugin_countryCode'];
        $this->countryName = $data['geoplugin_countryName'];
        $this->continentCode = $data['geoplugin_continentCode'];
        $this->latitude = $data['geoplugin_latitude'];
        $this->longitude = $data['geoplugin_longitude'];
        $this->currencyCode = $data['geoplugin_currencyCode'];
        $this->currencySymbol = $data['geoplugin_currencySymbol'];
        $this->currencyConverter = $data['geoplugin_currencyConverter'];

    }

    function fetch($host) {

        if ( function_exists('curl_init') )
        {
            //use cURL to fetch data
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $host);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_USERAGENT, 'geoPlugin PHP Class v1.0');
            $response = curl_exec($ch);
            curl_close ($ch);

        } else if ( ini_get('allow_url_fopen') ) {
            //fall back to fopen()
            $response = file_get_contents($host, 'r');
        } else {
            throw new \Exception ('geoPlugin class Error: Cannot retrieve data. Either compile PHP with cURL support or enable allow_url_fopen in php.ini ');
        }

        return $response;
    }

    function convert($amount, $float=2, $symbol=true)
    {

        //easily convert amounts to geolocated currency.
        if ( !is_numeric($this->currencyConverter) || $this->currencyConverter == 0 ) {
            throw new \Exception('geoPlugin class Notice: currencyConverter has no value.');
        }
        if ( !is_numeric($amount) ) {
            throw new \Exception ('geoPlugin class Warning: The amount passed to geoPlugin::convert is not numeric.');
        }
        if ( $symbol === true ) {
            return $this->currencySymbol . round( ($amount * $this->currencyConverter), $float );
        } else {
            return round( ($amount * $this->currencyConverter), $float );
        }
    }

    function nearby($radius=10, $limit=null)
    {
        if ( !is_numeric($this->latitude) || !is_numeric($this->longitude) ) {
            throw new \Exception ('geoPlugin class Warning: Incorrect latitude or longitude values.');
        }

        $host = "http://www.geoplugin.net/extras/nearby.gp?lat=" . $this->latitude . "&long=" . $this->longitude . "&radius={$radius}";

        if ( is_numeric($limit) )
            $host .= "&limit={$limit}";

        return unserialize( $this->fetch($host) );

    }
}