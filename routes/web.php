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
    return view('login');
});
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth'], function () {
    Route::get('dashboard', 'scmsp\DashboardController@index')->name('dashboard');
    // calling complain type list routes
    Route::get('complain-type-list', 'scmsp\ComplainTypeController@index')->name('complain-type-list');

    // calling complain type create routes
    Route::get('create-complain-type', 'scmsp\ComplainTypeController@create')->name('complain-type-create');

    // calling complain type edit routes
    Route::get('complain-type-edit/{id}', 'scmsp\ComplainTypeController@edit')->name('complain-type-edit');

    // calling complain type store routes
    Route::post('store-complain-type', 'scmsp\ComplainTypeController@store')->name('complain-type-store');

    // calling complain type update routes
    Route::post('update-complain-type', 'scmsp\ComplainTypeController@update')->name('complain-type-update');
    // calling complain type delete routes
    Route::post('complain-type-delete', 'scmsp\ComplainTypeController@delete')->name('complain-type-delete');

    // calling department list routes
    Route::get('department-list', 'scmsp\DepartmentController@index')->name('department-list');

    // calling department create routes
    Route::get('department-create', 'scmsp\DepartmentController@create')->name('department-create');

    // calling department edit routes
    Route::get('department-edit/{id}', 'scmsp\DepartmentController@edit')->name('department-edit');

    // calling department store routes
    Route::post('department-store', 'scmsp\DepartmentController@store')->name('department-store');

    // calling department update routes
    Route::post('department-update', 'scmsp\DepartmentController@update')->name('department-update');

    // calling department delete routes
    Route::post('department-delete', 'scmsp\DepartmentController@delete')->name('department-delete');
    //Division Routes Start 
    // calling division list routes
    Route::get('division-list', 'scmsp\DivisionController@index')->name('division-list');
    // calling division create routes
    Route::get('division-create', 'scmsp\DivisionController@create')->name('division-create');
    // calling division edit routes
    Route::get('division-edit/{id}', 'scmsp\DivisionController@edit')->name('division-edit');
    // calling division store routes
    Route::post('division-store', 'scmsp\DivisionController@store')->name('division-store');
    // calling division update routes
    Route::post('division-update', 'scmsp\DivisionController@update')->name('division-update');
    // calling division delete routes
    Route::post('division-delete', 'scmsp\DivisionController@delete')->name('division-delete');
    // start role routes
    // calling role list routes
    Route::get('role-list', 'scmsp\RoleController@index')->name('role-list');
    // calling role create routes
    Route::get('role-create', 'scmsp\RoleController@create')->name('role-create');
    // calling role edit routes
    Route::get('role-edit/{id}', 'scmsp\RoleController@edit')->name('role-edit');
    // calling role store routes
    Route::post('role-store', 'scmsp\RoleController@store')->name('role-store');
    // calling role update routes
    Route::post('role-update', 'scmsp\RoleController@update')->name('role-update');
    // calling role delete routes
    Route::post('role-delete', 'scmsp\RoleController@delete')->name('role-delete');

    // start users routes
    // calling user list routes
    Route::get('user-list', 'scmsp\UserController@index')->name('user-list');
    // calling user create routes
    Route::get('user-create', 'scmsp\UserController@create')->name('user-create');
    // calling user edit routes
    Route::get('user-edit', 'scmsp\UserController@edit')->name('user-edit');
    // calling user store routes
    Route::get('user-store', 'scmsp\UserController@store')->name('user-store');
    // calling user update routes
    Route::get('user-update', 'scmsp\UserController@update')->name('user-update');
    // calling user delete routes
    Route::post('user-delete', 'scmsp\UserController@delete')->name('user-delete');

    // start user role routes
    // calling user-role list routes
    Route::get('user-role-list', 'scmsp\UserRoleController@index')->name('user-role-list');
    // calling user-role create routes
    Route::get('user-role-create', 'scmsp\UserRoleController@create')->name('user-role-create');
    // calling user-role edit routes
    Route::get('user-role-edit/{id}', 'scmsp\UserRoleController@edit')->name('user-role-edit');
    // calling user-role store routes
    Route::post('user-role-store', 'scmsp\UserRoleController@store')->name('user-role-store');
    // calling user-role update routes
    Route::post('user-role-update', 'scmsp\UserRoleController@update')->name('user-role-update');
    // calling user-role delete routes
    Route::post('user-role-delete', 'scmsp\UserRoleController@delete')->name('user-role-delete');

    // start complain status routes
    // calling complain-status list routes
    Route::get('complain-status-list', 'scmsp\ComplainStatusController@index')->name('complain-status-list');
    // calling complain-status create routes
    Route::get('complain-status-create', 'scmsp\ComplainStatusController@create')->name('complain-status-create');
    // calling complain-status edit routes
    Route::get('complain-status-edit/{id}', 'scmsp\ComplainStatusController@edit')->name('complain-status-edit');
    // calling complain-status store routes
    Route::post('complain-status-store', 'scmsp\ComplainStatusController@store')->name('complain-status-store');
    // calling complain-status update routes
    Route::post('complain-status-update', 'scmsp\ComplainStatusController@update')->name('complain-status-update');
    // calling complain-status delete routes
    Route::post('complain-status-delete', 'scmsp\ComplainStatusController@delete')->name('complain-status-delete');

    // start complain details routes
    // calling complain-details list routes
    Route::get('complain-details-list', 'scmsp\ComplainDetailsController@index')->name('complain-details-list');
    // calling complain-details create routes
    Route::get('complain-details-create', 'scmsp\ComplainDetailsController@create')->name('complain-details-create');
    // calling complain-details edit routes
    Route::get('complain-details-edit/{id}', 'scmsp\ComplainDetailsController@edit')->name('complain-details-edit');
    // calling complain-details store routes
    Route::post('complain-details-store', 'scmsp\ComplainDetailsController@store')->name('complain-details-store');
    // calling complain-details update routes
    Route::post('complain-details-update', 'scmsp\ComplainDetailsController@update')->name('complain-details-update');
    // calling complain-details delete routes
    Route::post('complain-details-delete', 'scmsp\ComplainDetailsController@delete')->name('complain-details-delete');

    // start feedback details routes
    // calling feedback-details list routes
    Route::get('feedback-details-list', 'scmsp\FeedbackDetailsController@index')->name('feedback-details-list');
    // calling feedback-details create routes
    Route::get('feedback-details-create', 'scmsp\FeedbackDetailsController@create')->name('feedback-details-create');
    // calling feedback-details edit routes
    Route::get('feedback-details-edit/{id}', 'scmsp\FeedbackDetailsController@edit')->name('feedback-details-edit');
    // calling feedback-details store routes
    Route::post('feedback-details-store', 'scmsp\FeedbackDetailsController@store')->name('feedback-details-store');
    // calling feedback-details update routes
    Route::post('feedback-details-update', 'scmsp\FeedbackDetailsController@update')->name('feedback-details-update');
    // calling feedback-details delete routes
    Route::post('feedback-details-delete', 'scmsp\FeedbackDetailsController@delete')->name('feedback-details-delete');
    
     // start module routes
    // calling module list routes
    Route::get('module-list', 'scmsp\ModuleController@index')->name('module-list');
    // calling module create routes
    Route::get('module-create', 'scmsp\ModuleController@create')->name('module-create');
    // calling module edit routes
    Route::get('module-edit/{id}', 'scmsp\ModuleController@edit')->name('module-edit');
    // calling module store routes
    Route::post('module-store', 'scmsp\ModuleController@store')->name('module-store');
    // calling module update routes
    Route::post('module-update', 'scmsp\ModuleController@update')->name('module-update');
    // calling module delete routes
    Route::post('module-delete', 'scmsp\ModuleController@delete')->name('module-delete');
    
      // start permission routes
    // calling permission list routes
    Route::get('permission-list', 'scmsp\PermissionController@index')->name('permission-list');
    // calling permission create routes
    Route::get('permission-create', 'scmsp\PermissionController@create')->name('permission-create');
    // calling permission edit routes
    Route::get('permission-edit/{id}', 'scmsp\PermissionController@edit')->name('permission-edit');
    // calling permission store routes
    Route::post('permission-store', 'scmsp\PermissionController@store')->name('permission-store');
    // calling permission update routes
    Route::post('permission-update', 'scmsp\PermissionController@update')->name('permission-update');
    // calling permission delete routes
    Route::post('permission-delete', 'scmsp\PermissionController@delete')->name('permission-delete');
    
    
    
    Route::get('autocomplete',array('as'=>'autocomplete','uses'=>'AutoCompleteController@index'));
Route::get('searchajax',array('as'=>'searchajax','uses'=>'AutoCompleteController@autoComplete'));

});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
