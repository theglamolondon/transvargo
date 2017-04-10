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
$this->get('connexion.html', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('connexion.html', 'Auth\LoginController@login');
$this->post('deconnexion.html', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
$this->get('inscription.html', 'Auth\RegisterController@showRegistrationForm')->name('register');
$this->post('inscription.html', 'Auth\RegisterController@register');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset');
/*End authentication route*/


/*Site route*/
Route::get('/', 'SiteController@index');
Route::get('/accueil.html', 'SiteController@index')->name('accueil');
Route::get('/conditions-utilisation.html', 'SiteController@showTermOfUsesPage')->name('terms');
Route::get('/contact.html', 'SiteController@showContactPage')->name('contact');
/* end site route */