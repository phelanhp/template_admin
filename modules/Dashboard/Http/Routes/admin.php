<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'DashboardController@index')->name('dashboard');
Route::get('/403.html', 'DashboardController@errorPage')->name('error.page');
Route::get('/change-locale/{key}', 'DashboardController@changeLocale')->name('change_locale');

