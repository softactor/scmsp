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

Route::get('/', function () {
    return view('welcome');
});

// calling complain type list routes
Route::get('admin/complain-type', 'scmsp\ComplainTypeController@index')->name('admin.complain-type-list');

// calling complain type create routes
Route::get('admin/create-complain-type', 'scmsp\ComplainTypeController@create')->name('admin.complain-type-create');

// calling complain type edit routes
Route::get('admin/edit-complain-type', 'scmsp\ComplainTypeController@edit')->name('admin.complain-type-edit');

// calling complain type store routes
Route::get('admin/store-complain-type', 'scmsp\ComplainTypeController@store')->name('admin.complain-type-store');

// calling complain type update routes
Route::get('admin/update-complain-type', 'scmsp\ComplainTypeController@update')->name('admin.complain-type-update');