<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('app/getusers/', 'adminusercontroller@index');
Route::post('admin/getuserdata/', 'adminusercontroller@getuserdata');
Route::post('admin/saveuser/', 'adminusercontroller@saveuser');
Route::get('admin/home/', 'admindevicecontroller@index');
Route::get('app/getpatients/', 'Usercontroller@getpatients');
Route::get('app/getmedicalhistory/', 'doctorcontroller@getmedicalhistory');
Route::get('app/getprofiles/', 'Usercontroller@getprofiles');
Route::post('app/getdoctors/', 'Usercontroller@getdoctors');
Route::post('app/assignroom/', 'Usercontroller@assignroom');
Route::post('app/endsession/', 'Usercontroller@endsession');
Route::post('app/register/', 'applogincontroller@register');
Route::post('app/getdata/', 'doctorcontroller@getdata');
Route::post('app/getqueue/', 'doctorcontroller@getqueue');
Route::post('app/savedata/', 'doctorcontroller@savedata');
Route::post('app/medicalhistory/', 'doctorcontroller@medicalhistory');
Route::post('app/getmedicalreport/', 'doctorcontroller@getmedicalreport');
Route::post('app/createprofile/', 'Usercontroller@createprofile');
Route::post('app/addqueue', 'HomeController@addqueue');