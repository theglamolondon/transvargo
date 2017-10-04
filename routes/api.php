<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('api')->post('/login','Api\LoginController@login');

Route::get('/refresh/token','Api\LoginController@refreshToken');

Route::middleware('api.auth')->group(function (){

    //TODO: Recevoir une notification à chaque nouvelle publication sur la plateforme à chaque nouvelle publication d'expédition

    Route::get('/expeditions/offers/list','Api\OffreController@liste');

    Route::get('/expeditions/transporteur/{transporteur}/vehicule/{typecamion}/list','Api\VehiculeController@liste');

    Route::post('/expeditions/offers/accept','Api\OffreController@acceptOffre');

    Route::get('/{transporteur}/expeditions/list','Api\TransporteurController@myExpeditions');

    Route::post('/{transporteur}/chargement/{reference}/demarrage','Api\ChargementController@startChargement');

    Route::post('{transporteur}/chargement/start','Api\ChargementController@startChargement');

    Route::post('{transporteur}/chargement/delivry','Api\ChargementController@delivry');

    Route::post('{transporteur}/chargement/delivry/otp-check','Api\ChargementController@checkOTP');
});