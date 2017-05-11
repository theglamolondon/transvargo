<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/******************************************************************************* Authentication routes ****************************************************/
// Authentication Routes...
Route::get('connexion.html', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('connexion.html', 'Auth\LoginController@login');
Route::get('deconnexion.html', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
//Client
Route::get('inscription.html', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('inscription.html', 'Auth\RegisterController@register');
//Transporteur
Route::get('/transporteur/inscription.html','Auth\RegisterController@showTransporteurRegistrationForm')->name('register.transporteur');
Route::post('/transporteur/inscription.html','Auth\RegisterController@registerTransporteur');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');
/***************************************************************************** End authentication route **************************************************/

/*Site route*/
Route::get('/', 'SiteController@index');
Route::get('/accueil.html', 'SiteController@index')->name('accueil');
Route::get('/conditions-utilisation.html', 'SiteController@showTermOfUsesPage')->name('terms');
Route::get('/contact.html', 'SiteController@showContactPage')->name('contact');
Route::get('validation/{token}', 'SiteController@validation')->name('register.confirmation');
//Route::get('/transporteur/conditions-utilisation.html', 'SiteController@showTransporteurTermOfUsesPage')->name('terms.transporteur');
/* end site route */

/*Client*/

Route::group(['middleware' => 'client'],function (){
    Route::get('/tableau-bord.html','ClientController@showDashboard')->name('client.tableaubord');
    Route::get('/tableau-bord/nouvelle-expedition.html','ExpeditionController@showNewExpeditionForm')->name('client.newexpedition');
    Route::post('/tableau-bord/nouvelle-expedition.html','ExpeditionController@saveNewExpedition');
    Route::get('/tableau-bord/mes-expeditions.html','ExpeditionController@showExpeditions')->name('client.myexpedition');
    //Route::get('/tableau-bord/expedition/{refrence}/details.html','ExpeditionController@showDetailsExpeditions')->name('client.myexpedition');
    Route::get('/tableau-bord/mes-factures.html','ClientController@showDashboard')->name('client.myinvoice');
    Route::get('/tableau-bord/mon-compte.html','ClientController@showMyAccount')->name('client.myaccount');
});


/*Transporteur*/
Route::group(['middleware' => 'transporteur', 'prefix' => 'transporteur'],function (){
    Route::get('tableau-bord.html','Carrier\TransporteurController@showDashboard')->name('transporteur.tableaubord');
    Route::get('offres.html','Carrier\TransporteurController@showOffersOnMap')->name('transporteur.offres');
    Route::post('vehicule/ajouter.html','VehiculeController@addNewVehicle')->name('transport.ajoutervehicule');
    Route::get('offres/{reference}/accepter.html','Carrier\TransporteurController@showAcceptOfferForm')->name('transport.accept');
    Route::post('offres/{reference}/accepter.html','ExpeditionController@acceptOffer');
});

/*AJAX*/
Route::post('/ajax/distanceMatrix','AjaxController@getDistanceMatrix')->name('ajax.distancematrix');
Route::get('/ajax/transporteur/offers','AjaxController@getOffers')->name('ajax.offers');