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
Route::get('/services.html', 'SiteController@showServicePage')->name('services');
Route::get('/conditions-utilisation.html', 'SiteController@showTermOfUsesPage')->name('terms');
Route::get('/contact.html', 'SiteController@showContactPage')->name('contact');
Route::post('/contact.html', 'SiteController@sendResponseContact');
Route::get('/a-propos.html', 'SiteController@showAboutUs')->name('apropos');
Route::get('validation/{token}', 'SiteController@validation')->name('register.confirmation');
/* end site route */

/*Client*/
Route::group(['middleware' => ['auth','client'], "prefix" => "account"],function (){
    Route::get('/nouvelle-expedition.html','ClientController@showNewExpeditionForm')->name('client.newexpedition');
    Route::post('/nouvelle-expedition.html','ExpeditionController@saveNewExpedition');
    Route::get('/commande/{reference}.html','ClientController@showCommande')->name('client.commande');
    Route::post('/commande/{reference}.html','ExpeditionController@publishExpedition');
    Route::get('/mes-expeditions.html','ClientController@showExpeditions')->name('client.expeditions');
    Route::get('/mes-expeditions/encours.html','ClientController@showExpeditionsEnCours')->name('client.expeditions.encours');
    Route::get('/mes-expeditions/programmees.html','ClientController@showExpeditionsProgrammees')->name('client.expeditions.programmees');
    Route::get('/mes-expeditions/livrees.html','ClientController@showExpeditionsLivrees')->name('client.expeditions.livrees');
    Route::get('/mes-expeditions/annulees.html','ClientController@showExpeditionsAnnulees')->name('client.expeditions.annulees');
    Route::get('mes-expeditions/{reference}/details.html','ClientController@details')->name('client.expeditions.details');
    Route::get('expedition/{reference}/itineraire.html','ClientController@showItineraire')->name('client.expeditions.itineraire');
    Route::get('/mes-factures.html','ClientController@showInvoices')->name('client.myinvoice');
    Route::get('/mon-compte.html','ClientController@showMyAccount')->name('client.myaccount');
    Route::post('/mon-compte.html','Auth\UpdateProfileController@updateClient');
    Route::get('/facture/pdf/{reference}.html','ClientController@showFacturePDF')->name('client.pdf.facture');
    Route::get('/bonlivraison/pdf/{reference}.html','ClientController@showBonLivraisonPDF')->name('client.pdf.bonlivraison');
});

/*Payment*/
Route::group(["middleware" => ["auth","client"], "prefix" => "billing"],function (){
    Route::get("expedition/{reference}/option-de-paiement.html",'Finance\PaymentController@showChoosePayment')->name("payment.choice");
    Route::post("orange-money/purchase/success.html",'Finance\PaymentController@omPaySuccess')->name("payment.om.success");
    Route::post("orange-money/purchase/error.html",'Finance\PaymentController@omPayError')->name("payment.om.error");
});

/*Transporteur*/
Route::group(['middleware' => ['auth','transporteur'], 'prefix' => 'transporteur' ],function (){
    Route::get('tableau-bord.html','Carrier\TransporteurController@showDashboard')->name('transporteur.tableaubord');
    Route::get('offres-map.html','Carrier\TransporteurController@showOffersOnMap')->name('transporteur.offres.map');
    Route::get('offres-liste.html','Carrier\TransporteurController@showOfferOnListView')->name('transporteur.offres.liste');
    Route::post('vehicule/ajouter.html','VehiculeController@addNewVehicle')->name('transport.ajoutervehicule');
    Route::get('expedition/{reference}/accepter.html','Carrier\TransporteurController@showAcceptOfferForm')->name('transport.accept');
    Route::post('expedition/{reference}/accepter.html','ExpeditionController@acceptOffer');
    Route::post('expedition/{reference}/change-statut.action','Carrier\TransporteurController@startChargement')->name('chargement.change.statut');
    Route::post('expedition/{reference}/livrer.html','Carrier\TransporteurController@delivry')->name('chargement.livrer');
    Route::post('expedition/{reference}/livraison/valider','Carrier\TransporteurController@validerLivraison')->name('chargement.valide.livraison');
    Route::get('chargements.html','Carrier\TransporteurController@showChargement')->name('transporteur.chargement');
    Route::get('profile.html','Auth\UpdateProfileController@getViewTransporteurProfile')->name('update.transporteur');
    Route::post('profile.html','Auth\UpdateProfileController@updateTransporteur');
});

/*Staff*/
Route::group(['middleware' => ['auth','staff'], 'prefix' => 'staff'],function (){
    Route::get('tableau-bord.html','Admin\StaffController@showDashboard')->name('admin.tableaubord');
    Route::get('transporteurs/recents.html','Admin\StaffController@showRecentCarrier')->name('admin.transporteur.recents');
    Route::get('transporteurs.html','Admin\StaffController@showCarriers')->name('admin.transporteur.all');
    Route::get('transporteurs/fiche/{token}','Admin\StaffController@showValidateFormCarrier')->name('staff.valid.transporteur');
    Route::post('transporteurs/fiche/{token}','Admin\StaffController@validTransporteurAccount');
    Route::post('transporteurs/fiche/{token}/do.update','Admin\StaffController@updateTransporteurAccount')->name("staff.transporteur.update");

    Route::get('expediteurs.html','Admin\ExpediteurController@showExpediteursListe')->name('admin.expediteur.all');
    Route::get('expediteur/{email}/fiche.html','Admin\ExpediteurController@showExpediteurFiche')->name('admin.expediteur.fiche');

    Route::get('grand-compte/recherche.html','Admin\GrandCompteController@searchClient')->name('staff.gc.search');
    Route::get('grand-compte.html','Admin\GrandCompteController@showList')->name('staff.gc.liste');

    Route::post('client/switch/grand-compte.html','Admin\GrandCompteController@switchGrandClient')->name('staff.switch.gc');
    Route::get('invoice/grang-compte/0000-{id}.html','Admin\Invoice\InvoiceController@showInvoiceBoard')->name('staff.invoice');
    Route::get('offres.html','Admin\OffreController@liste')->name('staff.offres');
    Route::get('offre/{reference}/affectation.html','Admin\MapExpedition@affectExpeditionToCarrier')->name('staff.offre.affect');
    Route::post('offre/{reference}/affectation.html','Admin\OffreController@saveAffect');
    Route::get('offre/{reference}/details.html','Admin\OffreController@details')->name('staff.offre.details');
    Route::get('cartographie/expeditions.html','Admin\MapExpedition@showMap')->name('staff.map.expedition');
    Route::get('expeditions/localisations','Admin\MapExpedition@ajaxGetLocatisation')->name('staff.expeditions.localisation');
    Route::get('vehicule/{immatriculation}/mission/{reference}/itinaraire.html','Admin\MapExpedition@showInitenaireExpedition')->name('staff.expeditions.itineraire');

    Route::get('pdf/facture/{reference}','Admin\Invoice\InvoiceController@showFacturePDF')->name('staff.pdf.facture');
    Route::get('pdf/bon-livraison/{reference}','Admin\Invoice\InvoiceController@showBonLivraisonPDF')->name('staff.pdf.bonlivraison');

    Route::get('account/nouveau.html','Admin\UserController@ajouter')->name('staff.user.ajout');
    Route::post('account/nouveau.html','Admin\UserController@create');
    Route::get('account/{email}/modifier.html','Admin\UserController@modifier')->name('staff.user.modifier');
    Route::post('account/{email}/modifier.html','Admin\UserController@update');
    Route::get('account/liste.html','Admin\UserController@liste')->name('staff.user.liste');
});

/*Newsletter*/
Route::post('/newsletter/sign-up','NewsLetter\SignUpController@register')->name('newsletter.add');

/*AJAX*/
Route::post('/ajax/distanceMatrix','AjaxController@getDistanceMatrix')->name('ajax.distancematrix');
Route::get('/ajax/transporteur/offers','AjaxController@getOffersToJson')->name('ajax.offers');

Route::get('/test',"SiteController@test");