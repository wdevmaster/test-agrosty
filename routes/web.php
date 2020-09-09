<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'MailController@index');

Route::get('mail', 'MailController@index')->name('mail.index');

Route::get('mail/form', 'MailController@form')->name('mail.form');

Route::post('mail/send', 'MailController@send')->name('mail.send');

Route::get('mail/{id}/show', 'MailController@show')->name('mail.show');

