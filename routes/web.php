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

Route::get('/', 'HomeController@index')->name('home');

// регистрация и авторизация
Auth::routes();
Route::post('/register/send_sms', 'Auth\registerController@sendSMS');
Route::post('/register/verify_sms', 'Auth\registerController@verifySMS');
Route::post('/register/create', 'Auth\registerController@create');

// Route::get('/home', 'HomeController@index')->name('home');

// личный кабинет

Route::get('personal/profile', 'personalController@profile');
Route::post('profile/sendSMS', 'personalController@sendSMS');
Route::post('profile/verify', 'personalController@verifySMS');
Route::post('profile/update', 'personalController@update');
Route::get('personal/clubs', 'clubsController@clubs');
Route::get('personal/club/{id}/toggle', 'clubsController@toggle');
Route::get('personal/club/{id}/edit', 'clubsController@edit');

// посты
Route::get('post/read/{id}/{url}','postsController@post');
Route::get('posts','postsController@allposts');

// клубы
Route::get('clubs/{id}/{url}','clubsController@index');
Route::post('clubs/add', 'clubsController@addClub');
Route::post('clubs/add-draft', 'clubsController@addDraftClub');
Route::post('clubs/add-list','clubsController@savePriceList' );
Route::post('clubs/add-image','clubsController@saveImage' );


// прочие страницы
Route::get('/langame-software', function () {
    return view('about.langame_software');
});
Route::get('/contacts', function () {
    return view('about.contacts');
});

Route::get('/privacy_policy', function () {
    return view('about.privacy_policy');
});
Route::get('/terms_of_use', function () {
    return view('about.terms_of_use');
});
Route::get('/about-us', function () {
    return view('about.about_us');
});



Auth::routes();


////// панель админа  \\\\\\\


Route::get('/panel', 'panel\adminController@index');


// users
Route::get('panel/users','panel\usersController@index');
Route::post('users/register','panel\usersController@register');
Route::post('users/edit','panel\usersController@edit');
Route::post('users/delete','panel\usersController@delete');
Route::get('users/toggleadmin/{id}','panel\usersController@toggleadmin');

Route::get('post/new',function(){
    return view('admin.posts.add');
})->middleware('rule:1');

// посты
Route::post('post/create','panel\postsController@store' );
Route::get('post/edit/{id}','panel\postsController@postToUpdste');
Route::post('post/update/{id}','panel\postsController@update');
Route::post('post/saveImage','panel\postsController@saveImage' );
Route::post('post/delete/{id}','panel\postsController@delete' );
Route::post('post/edit/saveImage','panel\postsController@saveImage' );

// клубы
Route::get('panel/clubs/new-clubs','panel\clubsController@new_clubs');
Route::get('club/{id}/active','panel\clubsController@active');
Route::post('club/{id}/comment','panel\clubsController@comment');