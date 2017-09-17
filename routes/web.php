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
Route::get('/transporteur/inscription.html','Auth\RegisterController@showRegistrationForm')->name('register.transporteur');
Route::post('/transporteur/inscription.html','Auth\RegisterController@registerTransporteur');
//Staff
Route::get('/admin/inscription.html','Auth\RegisterController@showRegistrationForm')->name('register.transporteur');
Route::post('/admin/inscription.html','Auth\RegisterController@registerTransporteur');

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
Route::post('/contact.html', 'SiteController@sendResponseContact');
Route::get('/a-propos.html', 'SiteController@showAboutUs')->name('apropos');
Route::get('validation/{token}', 'SiteController@validation')->name('register.confirmation');
//Route::get('/transporteur/conditions-utilisation.html', 'SiteController@showTransporteurTermOfUsesPage')->name('terms.transporteur');
/* end site route */

/*Client*/
Route::group(['middleware' => 'client', "prefix" => "tableau-bord"],function (){
    //Route::get('/tableau-bord.html','ClientController@showDashboard')->name('client.tableaubord');
    Route::get('/nouvelle-expedition.html','ClientController@showNewExpeditionForm')->name('client.newexpedition');
    Route::post('/nouvelle-expedition.html','ExpeditionController@saveNewExpedition');
    Route::get('/commande/{reference}.html','ClientController@showCommande')->name('client.commande');
    Route::post('/commande/{reference}.html','ExpeditionController@publishExpedition');
    Route::get('/mes-expeditions.html','ClientController@showExpeditions')->name('client.expeditions');
    //Route::get('/expedition/{refrence}/details.html','ExpeditionController@showDetailsExpeditions')->name('client.myexpedition');
    Route::get('/mes-factures.html','ClientController@showInvoices')->name('client.myinvoice');
    Route::get('/mon-compte.html','ClientController@showMyAccount')->name('client.myaccount');
    Route::get('/facture/pdf/{reference}.html','Admin\Invoice\InvoiceController@showPDF')->name('client.pdf.facture');
});

/*Payment*/
Route::group(["middleware" => "auth", "prefix" => "billing"],function (){
    Route::get("expedition/{reference}/option-de-paiement.html",'Finance\PaymentController@showChoosePayment')->name("payment.choice");
    Route::post("orange-money/purchase/success.html",'Finance\PaymentController@omPaySuccess')->name("payment.om.success");
    Route::post("orange-money/purchase/error.html",'Finance\PaymentController@omPayError')->name("payment.om.error");
});

/*Transporteur*/
Route::group(['middleware' => 'transporteur', 'prefix' => 'transporteur'],function (){
    Route::get('tableau-bord.html','Carrier\TransporteurController@showDashboard')->name('transporteur.tableaubord');
    Route::get('offres-map.html','Carrier\TransporteurController@showOffersOnMap')->name('transporteur.offres.map');
    Route::get('offres-liste.html','Carrier\TransporteurController@showOfferOnListView')->name('transporteur.offres.liste');
    Route::post('vehicule/ajouter.html','VehiculeController@addNewVehicle')->name('transport.ajoutervehicule');
    Route::get('offres/{reference}/accepter.html','Carrier\TransporteurController@showAcceptOfferForm')->name('transport.accept');
    Route::post('offres/{reference}/accepter.html','ExpeditionController@acceptOffer');
    Route::get('chargements.html','Carrier\TransporteurController@showChargement')->name('transporteur.chargement');
});

/*Staff*/
Route::group(['middleware' => 'staff', 'prefix' => 'staff'],function (){
    Route::get('tableau-bord.html','Admin\StaffController@showDashboard')->name('admin.tableaubord');
    Route::get('transporteurs/recents.html','Admin\StaffController@showRecentCarrier')->name('admin.transporteur.recents');
    Route::get('transporteurs.html','Admin\StaffController@showCarriers')->name('admin.transporteur.all');
    Route::get('transporteurs/fiche/{token}.html','Admin\StaffController@showValidateFormCarrier')->name('staff.valid.transporteur');
    Route::post('transporteurs/fiche/{token}.html','Admin\StaffController@validTransporteurAccount');

    Route::get('grand-compte/recherche.html','Admin\GrandCompteController@searchClient')->name('staff.gc.search');
    Route::get('grand-compte.html','Admin\GrandCompteController@showList')->name('staff.gc.liste');

    Route::post('client/switch/grand-compte.html','Admin\GrandCompteController@switchGrandClient')->name('staff.switch.gc');

    Route::get('invoice/grang-compte/0000-{id}.html','Admin\Invoice\InvoiceController@showInvoiceBoard')->name('staff.invoice');
});

/*Newsletter*/
Route::post('/newsletter/sign-up','NewsLetter\SignUpController@register')->name('newsletter.add');

/*AJAX*/
Route::post('/ajax/distanceMatrix','AjaxController@getDistanceMatrix')->name('ajax.distancematrix');
Route::get('/ajax/transporteur/offers','AjaxController@getOffersToJson')->name('ajax.offers');