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

// calling department list routes
Route::get('admin/department-list', 'scmsp\DepartmentController@index')->name('admin.department-list');

// calling department create routes
Route::get('admin/department-create', 'scmsp\DepartmentController@create')->name('admin.department-create');

// calling department edit routes
Route::get('admin/department-edit', 'scmsp\DepartmentController@edit')->name('admin.department-edit');

// calling department store routes
Route::get('admin/department-store', 'scmsp\DepartmentController@store')->name('admin.department-store');

// calling department update routes
Route::get('admin/department-update', 'scmsp\DepartmentController@update')->name('admin.department-update');

// calling department delete routes
Route::get('admin/department-delete', 'scmsp\DepartmentController@delete')->name('admin.department-delete');
//Division Routes Start 
// calling division list routes
Route::get('admin/division-list', 'scmsp\DivisionController@index')->name('admin.division-list');
// calling division create routes
Route::get('admin/division-create', 'scmsp\DivisionController@create')->name('admin.division-create');
// calling division edit routes
Route::get('admin/division-edit', 'scmsp\DivisionController@edit')->name('admin.division-edit');
// calling division store routes
Route::get('admin/division-store', 'scmsp\DivisionController@store')->name('admin.division-store');
// calling division update routes
Route::get('admin/division-update', 'scmsp\DivisionController@update')->name('admin.division-update');
// calling division delete routes
Route::get('admin/division-delete', 'scmsp\DivisionController@delete')->name('admin.division-delete');
// start role routes
// calling role list routes
Route::get('admin/role-list', 'scmsp\RoleController@index')->name('admin.role-list');
// calling role create routes
Route::get('admin/role-create', 'scmsp\RoleController@create')->name('admin.role-create');
// calling role edit routes
Route::get('admin/role-edit', 'scmsp\RoleController@edit')->name('admin.role-edit');
// calling role store routes
Route::get('admin/role-store', 'scmsp\RoleController@store')->name('admin.role-store');
// calling role update routes
Route::get('admin/role-update', 'scmsp\RoleController@update')->name('admin.role-update');
// calling role delete routes
Route::get('admin/role-delete', 'scmsp\RoleController@delete')->name('admin.role-delete');

// start users routes
// calling user list routes
Route::get('admin/user-list', 'scmsp\UserController@index')->name('admin.user-list');
// calling user create routes
Route::get('admin/user-create', 'scmsp\UserController@create')->name('admin.user-create');
// calling user edit routes
Route::get('admin/user-edit', 'scmsp\UserController@edit')->name('admin.user-edit');
// calling user store routes
Route::get('admin/user-store', 'scmsp\UserController@store')->name('admin.user-store');
// calling user update routes
Route::get('admin/user-update', 'scmsp\UserController@update')->name('admin.user-update');
// calling user delete routes
Route::get('admin/user-delete', 'scmsp\UserController@delete')->name('admin.user-delete');

// start user role routes
// calling user-role list routes
Route::get('admin/user-role-list', 'scmsp\UserRoleController@index')->name('admin.user-role-list');
// calling user-role create routes
Route::get('admin/user-role-create', 'scmsp\UserRoleController@create')->name('admin.user-role-create');
// calling user-role edit routes
Route::get('admin/user-role-edit', 'scmsp\UserRoleController@edit')->name('admin.user-role-edit');
// calling user-role store routes
Route::get('admin/user-role-store', 'scmsp\UserRoleController@store')->name('admin.user-role-store');
// calling user-role update routes
Route::get('admin/user-role-update', 'scmsp\UserRoleController@update')->name('admin.user-role-update');
// calling user-role delete routes
Route::get('admin/user-role-delete', 'scmsp\UserRoleController@delete')->name('admin.user-role-delete');

// start complain status routes
// calling complain-status list routes
Route::get('admin/complain-status-list', 'scmsp\ComplainStatusController@index')->name('admin.complain-status-list');
// calling complain-status create routes
Route::get('admin/complain-status-create', 'scmsp\ComplainStatusController@create')->name('admin.complain-status-create');
// calling complain-status edit routes
Route::get('admin/complain-status-edit', 'scmsp\ComplainStatusController@edit')->name('admin.complain-status-edit');
// calling complain-status store routes
Route::get('admin/complain-status-store', 'scmsp\ComplainStatusController@store')->name('admin.complain-status-store');
// calling complain-status update routes
Route::get('admin/complain-status-update', 'scmsp\ComplainStatusController@update')->name('admin.complain-status-update');
// calling complain-status delete routes
Route::get('admin/complain-status-delete', 'scmsp\ComplainStatusController@delete')->name('admin.complain-status-delete');

// start complain details routes
// calling complain-details list routes
Route::get('admin/complain-details-list', 'scmsp\ComplainDetailsController@index')->name('admin.complain-details-list');
// calling complain-details create routes
Route::get('admin/complain-details-create', 'scmsp\ComplainDetailsController@create')->name('admin.complain-details-create');
// calling complain-details edit routes
Route::get('admin/complain-details-edit', 'scmsp\ComplainDetailsController@edit')->name('admin.complain-details-edit');
// calling complain-details store routes
Route::get('admin/complain-details-store', 'scmsp\ComplainDetailsController@store')->name('admin.complain-details-store');
// calling complain-details update routes
Route::get('admin/complain-details-update', 'scmsp\ComplainDetailsController@update')->name('admin.complain-details-update');
// calling complain-details delete routes
Route::get('admin/complain-details-delete', 'scmsp\ComplainDetailsController@delete')->name('admin.complain-details-delete');

// start feedback details routes
// calling feedback-details list routes
Route::get('admin/feedback-details-list', 'scmsp\FeedbackDetailsController@index')->name('admin.feedback-details-list');
// calling feedback-details create routes
Route::get('admin/feedback-details-create', 'scmsp\FeedbackDetailsController@create')->name('admin.feedback-details-create');
// calling feedback-details edit routes
Route::get('admin/feedback-details-edit', 'scmsp\FeedbackDetailsController@edit')->name('admin.feedback-details-edit');
// calling feedback-details store routes
Route::get('admin/feedback-details-store', 'scmsp\FeedbackDetailsController@store')->name('admin.feedback-details-store');
// calling feedback-details update routes
Route::get('admin/feedback-details-update', 'scmsp\FeedbackDetailsController@update')->name('admin.feedback-details-update');
// calling feedback-details delete routes
Route::get('admin/feedback-details-delete', 'scmsp\FeedbackDetailsController@delete')->name('admin.feedback-details-delete');