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
//TODO: Gérer dans l'application Android comment faire le mécanisme de refresh du token JWT

Route::middleware('api.auth')->group(function (){

    //TODO: Recevoir une notification à chaque nouvelle publication sur la plateforme à chaque nouvelle publication d'expédition

    Route::get('/expeditions/offers/list','Api\OffreController@liste');
    Route::get('/expeditions/transporteur/{transporteur}/vehicule/{typecamion}/list','Api\VehiculeController@liste');

    Route::post('/expeditions/offers/accept','Api\OffreController@acceptOffre');
    //TODO: Donner la possibilité d'accepter sur l'appareil Android
});


