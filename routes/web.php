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

Route::get('/', 'MailController@index')->name('mail.index');

Route::post('mail/send', 'MailController@send')->name('mail.send');

Route::get('mail/{id}/show', 'MailController@show')->name('mail.show');

Route::get('mails/export/{type}', 'MailController@export')->name('mail.export');

