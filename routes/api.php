<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('auth/login',   'Api\RegisterController@login' );
Route::post('auth/register',   'Api\RegisterController@create' );
Route::post('/auth/send_sms', 'Api\RegisterController@sendSMS');
Route::post('/auth/verify_sms', 'Api\RegisterController@verifySMS');
Route::get('/auth/user', 'Api\RegisterController@getUserData');


Route::get('/getHomeData', 'Api\HomeController@index');
Route::get('/getHomeClubs', 'Api\HomeController@getClubs');
Route::get('/searchCities', 'Api\HomeController@searchCities');

Route::get('/getPosts', 'Api\postsController@allposts');
Route::get('/getPost/{id}', 'Api\postsController@post');

