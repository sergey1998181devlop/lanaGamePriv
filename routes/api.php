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
Route::post('auth/password/email',   'Api\RegisterController@resetPassword' );
Route::post('auth/register',   'Api\RegisterController@create' );
Route::post('/auth/send_sms', 'Api\RegisterController@sendSMS');
Route::post('/auth/verify_sms', 'Api\RegisterController@verifySMS');
Route::get('/auth/user', 'Api\RegisterController@getUserData');
Route::post('/profile/update', 'Api\personalController@update');
Route::post('/profile/sendSMS', 'Api\personalController@sendSMS');
Route::post('/profile/verifySMS', 'Api\personalController@verifySMS');
Route::post('/auth/resetPasswordViaPhone', 'Api\RegisterController@resetPasswordViaPhone');
Route::get('/profile/get-liked-clubs', 'Api\clubsController@likedClubs');

Route::get('/getHomeData', 'Api\HomeController@index');
Route::get('/getHomeClubs', 'Api\HomeController@getClubs');
Route::get('/searchCities', 'Api\HomeController@searchCities');

Route::get('/getPosts', 'Api\postsController@allposts');
Route::get('/getPost/{id}', 'Api\postsController@post');
Route::get('/getPostComments/{id}', 'Api\postsController@getPostComments');
Route::post('post/comments/addComment', 'Api\postsController@storeComment');
Route::post('post/comments/add-image','Api\postsController@saveImage' );
Route::post('post/comments/like', 'Api\postsController@like')->name('like');
Route::post('post/comments/dislike', 'Api\postsController@unlike')->name('unlike');
Route::get('/getClub/{id}', 'Api\clubsController@index');
Route::post('clubs/like-club','Api\clubsController@likeClub');
Route::post('clubs/unlike-club','Api\clubsController@unLikeClub');
Route::get('/user_agreement', function(){
    return response()->json([
        'status' => true,
        'data' => view('about.user_agreement_text')->render()
    ]); 
});
Route::get('/policy', function(){
    return response()->json([
        'status' => true,
        'data' => view('about.policy_text')->render()
    ]); 
});