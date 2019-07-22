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

Auth::routes();
Route::get('/', function () {
    return view('login');
});
Route::get('admin/home', 'adminController@index');
// Route::get('device/schedule/{device_id}/{port_id}','schedulecontroller@getschedules');
// Route::post('device/schedule','schedulecontroller@setschedule');
// Route::get('schedule/cancel/{id}','schedulecontroller@cancelschedule');
// Route::get('/dashboard', 'HomeController@index');
Route::get('signin', 'applogincontroller@applogin');
Route::get('/de', 'HomeController@index');
Route::get('/getresp', 'assitantcontroller@getresp');
Route::get('/action', 'assistantactioncontroller@action');
Route::post('/acount_linking', 'assitantcontroller@account');
// Route::get('/device', 'HomeController@putdevice');
// Route::get('/devicehistory/{divice_id}', 'historycontroller@getdevicehistory');
// Route::get('/porthistory/{divice_id}/{port_id}', 'historycontroller@getporthistory');
// Route::post('/device', 'HomeController@setdevice');
// Route::post('/device/edit', 'HomeController@savedevice');
// Route::get('/device/edit/{device_id}', 'HomeController@editdevice');
// Route::post('/port/edit', 'HomeController@saveport');
// Route::get('/port/edit/{port_id}', 'HomeController@editport');
// Route::post('/sharedevice', 'shareddevicecontroller@sharedevice');
// Route::get('/cancelshare/{share_id}', 'shareddevicecontroller@cancelshare');
// Route::get('/sharedevice/{device_id}/{level}', 'shareddevicecontroller@getshareddevices');
// Route::get('/devices/{id}', 'HomeController@getdevice');
// Route::get('/getstate/{email}/{productid}', 'registercontroller@getstate');
// Route::get('/control/{id}/{productid}', 'HomeController@control');
Route::get('/admin/home', 'adminController@index');
Route::get('admin/editor', 'editorController@index');
Route::get('admin/test', 'adminController@test');
Route::get('admin', 'Admin\LoginController@showLoginForm')->name('admin.login');
Route::post('admin', 'Admin\LoginController@login');

Route::post('admin-password/email', 'Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
Route::get('admin-password/reset', 'Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
Route::post('admin-password/reset', 'Admin\ResetPasswordController@reset');
Route::get('admin-password/reset/{token}', 'Admin\ResetPasswordController@showResetForm')->name('admin.password.reset');

Route::get('{path}', "HomeController@index")->where('path','([A-z\d-\/_.]+)?');
Route::get('/devices', 'HomeController@devices');
