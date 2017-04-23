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

/* Authentication routes */
// Authentication Routes...
Route::get('connexion.html', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('connexion.html', 'Auth\LoginController@login');
Route::get('deconnexion.html', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('inscription.html', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('inscription.html', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');
/*End authentication route*/


/*Site route*/
Route::get('/', 'SiteController@index');
Route::get('/accueil.html', 'SiteController@index')->name('accueil');
Route::get('/conditions-utilisation.html', 'SiteController@showTermOfUsesPage')->name('terms');
Route::get('/contact.html', 'SiteController@showContactPage')->name('contact');
/* end site route */

/*Client*/
Route::get('/tableau-bord.html','DashboardController@showDashboard')->name('client.tableaubord');
Route::get('/tableau-bord/{id}-nouvelle-expedition.html','DashboardController@showDashboard')->name('client.tableaubord.newexpedition')->where(['id' => '[0-9]{3}']);
Route::get('/tableau-bord/{id}-mes-expeditions.html','DashboardController@showDashboard')->name('client.tableaubord.myexpedition')->where(['id' => '[0-9]{3}']);
Route::get('/tableau-bord/{id}-mes-factures.html','DashboardController@showDashboard')->name('client.tableaubord.myinvoice')->where(['id' => '[0-9]{3}']);
Route::get('/tableau-bord/{id}-mon-compte.html','DashboardController@showDashboard')->name('client.tableaubord.myaccount')->where(['id' => '[0-9]{3}']);

/*AJAX*/
Route::post('/ajax/distanceMatrix','AjaxController@getDistanceMatrix')->name('ajax_distancematrix');