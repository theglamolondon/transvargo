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

Route::middleware('api.auth')->group(function (){

    //TODO: Recevoir une notification à chaque nouvelle publication sur la plateforme à chaque poste d'expédition

    Route::get('/refresh/token','Api\LoginController@refreshToken');
    //TODO: Gérer dans l'application Android comment faire le mécanisme de refresh du token JWT

    Route::get('/expeditions/offers/list','Api\OffreController@liste');

    Route::post('/expeditions/offres/{reference}/accept','Api\OffreController@accept');
    //TODO: Donner la possibilité d'accepter sur l'appareil Android
});


