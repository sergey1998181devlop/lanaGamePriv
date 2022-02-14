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


// Route::get('/test',  'HomeController@sendNotification');

Route::get('/', 'HomeController@homePage');
Route::get('/sitemap.xml','HomeController@siteMap' );
// регистрация и авторизация
Auth::routes();
Route::post('/register/send_sms', 'Auth\RegisterController@sendSMS');
Route::post('/register/verify_sms', 'Auth\RegisterController@verifySMS');
Route::post('/register/create', 'Auth\RegisterController@create');
Route::get('email/verify/{token}','Auth\RegisterController@verifyEmail')->name('user.verify');
Route::get('/register_club', ['as' => 'auth.register', 'uses' => 'Auth\RegisterController@showRegistrationForm']);

// личный кабинет
Route::get('personal/profile', 'personalController@profile');
Route::get('personal/liked', 'personalController@likedClubs');
Route::post('profile/sendSMS', 'personalController@sendSMS');
Route::post('profile/verify', 'personalController@verifySMS');
Route::post('profile/update', 'personalController@update');
Route::get('profile/verify/resend', 'personalController@resendVerfyEmail');
// посты
Route::get('{id}_statia_{url}','postsController@post');
Route::get('posts','postsController@allposts');
Route::post('/comment/store', 'CommentController@store')->name('comment.add');
Route::post('post/like', 'CommentController@like')->name('like');
Route::post('post/dislike', 'CommentController@unlike')->name('unlike');
// объявления
Route::get('{id}_offer_{url}','offersController@offer');

// клубы
Route::get('personal/clubs', 'clubsController@clubs');
Route::get('personal/club/{id}/toggle', 'clubsController@toggle');
Route::get('personal/club/{id}/edit', 'clubsController@edit');
Route::post('personal/club/{id}/update', 'clubsController@update');
Route::post('personal/club/{id}/update-draft', 'clubsController@updateDraft');
//Route::get('clubs/{id}/{url}','clubsController@index');
Route::get('{id}_computerniy_club_{url}_{city}','clubsController@index');
Route::post('clubs/add', 'clubsController@addClub');
Route::post('clubs/add-draft', 'clubsController@addDraftClub');
Route::post('clubs/add-list','clubsController@savePriceList' );
Route::post('clubs/add-image','clubsController@saveImage' );

Route::get('searchCities','HomeController@searchCities');
Route::get('searchMetro','HomeController@searchMetro');
Route::post('like-club','clubsController@likeClub');
Route::post('unlike-club','clubsController@unLikeClub');


// обратная связь
Route::post('messages/send','mailController@storeFromContacts');
Route::post('langame/request','mailController@langameRequest');
Route::post('report_error/send','mailController@reportError');
Route::post('report_error','mailController@reportErrorSpam');
Route::post('report_club_error','mailController@reportClubError');
Route::post('subscribe','mailController@subscribe');

// прочие страницы
 Route::get('/langame-software','HomeController@redirect_to_software');
 Route::get('/contacts','HomeController@contacts');
 Route::get('/policy','HomeController@policy');
 Route::get('/user-agreement','HomeController@user_agreement');
 Route::get('/software','HomeController@langame_software');
 Route::get('/about-us','HomeController@about_us');
 Route::get('/clubs-offers','HomeController@clubs_offers');
 Route::get('/cities','HomeController@cities_list');
 Route::get('/registration','Auth\RegisterController@registration');




Auth::routes();
Route::post('auth/login',   'Auth\LoginController@loginUser' );

////// панель админа  \\\\\\\


Route::get('/panel', 'panel\adminController@index');


// users
Route::get('panel/users','panel\usersController@index');
Route::get('panel/players','panel\usersController@players');
Route::post('users/register','panel\usersController@register');
Route::post('users/edit','panel\usersController@edit');
Route::post('users/delete','panel\usersController@delete');
Route::get('users/toggleadmin/{id}','panel\usersController@toggleadmin');
Route::get('panel/find-user','panel\usersController@find');

Route::get('post/new','panel\postsController@newPost');
Route::get('offers/newBrand','panel\offersController@newOffer');
Route::get('offers/newbrand','panel\offersController@newOffer');
Route::get('offers/newClub','panel\offersController@newOfferClub');
Route::get('offers/newclub','panel\offersController@newOfferClub');
Route::post('users/sendMail','panel\usersController@sendMail');



// посты
Route::post('post/create','panel\postsController@store' );
Route::get('post/edit/{id}','panel\postsController@postToUpdste');
Route::post('post/update/{id}','panel\postsController@update');
Route::post('post/saveImage','panel\postsController@saveImage' );
Route::post('post/delete/{id}','panel\postsController@delete' );
Route::post('post/edit/saveImage','panel\postsController@saveImage' );
Route::get('panel/posts/all','panel\postsController@index');
Route::post('panel/posts/order_no','panel\postsController@reOrderPost');
Route::post('panel/comment/delete', 'panel\postsController@deleteComment');
// объявления
Route::post('offer/create','panel\offersController@store' );
Route::get('offer/edit/{id}','panel\offersController@offerToUpdste');
Route::post('offer/update/{id}','panel\offersController@update');
Route::get('offer/views/{id}','offersController@views');
Route::get('offer/views_click/{id}','offersController@views_click');
Route::post('offer/saveImage','panel\offersController@saveImage' );
Route::get('offer/delete/{id}','panel\offersController@delete' );
Route::get('offer/active/{id}','panel\offersController@active' );
Route::get('offer/deactive/{id}','panel\offersController@deactive' );
Route::post('offer/edit/saveImage','panel\offersController@saveImage' );
Route::get('panel/offers/all','panel\offersController@index');
Route::get('panel/offers/allClub','panel\offersController@indexClub');
Route::get('panel/offers/allclub','panel\offersController@indexClub');
Route::get('panel/offers/order_no','panel\offersController@reOrderOffer');
Route::post('clubs-offers/add', 'offersController@addFromUser');


// клубы
Route::get('panel/export_clubs', 'panel\clubsController@exportClubs');
Route::get('panel/clubs/new-clubs','panel\clubsController@new_clubs');
Route::get('panel/clubs/hidded-clubs','panel\clubsController@hidded_clubs');
Route::get('panel/clubs/drafts','panel\clubsController@drafts');
Route::get('panel/clubs/deleted-clubs','panel\clubsController@deleted_clubs');
Route::get('panel/clubs/clubs','panel\clubsController@clubs');
Route::get('{id}_computerniy_club_{url}_{city}/active','panel\clubsController@active');
Route::post('club/{id}/comment','panel\clubsController@comment');
Route::post('club/{club_id}/remove_comment','panel\clubsController@removeComment');
Route::post('panel/club/{id}/change-user','panel\clubsController@changeClubUser');
Route::post('panel/club/{id}/delete','panel\clubsController@deleteClub');
Route::get('panel/club/{id}/recover','panel\clubsController@recoverClub');
Route::post('panel/club/toggle-closed','panel\clubsController@toggleClosed');


// обратная связь
Route::get('/panel/contacts', 'panel\adminController@contacts');
Route::get('/panel/getMessage', 'panel\adminController@getMessage');
Route::post('panel/message/delete', 'panel\adminController@deleteMessage');

Route::get('/panel/error-reports', 'panel\adminController@errorReports');
Route::get('/panel/get-report', 'panel\adminController@getReports');
Route::post('panel/error-reports/delete', 'panel\adminController@deleteErrorReport');

Route::get('/panel/langame-requests', 'panel\adminController@langameRequests');
Route::post('/panel/langame-requests/delete', 'panel\adminController@deleteRequest');
Route::get('/panel/langame-requests/toggle/{id}', 'panel\adminController@langameRequestsToggle');

Route::get('/panel/club-error-reports', 'panel\adminController@clubErrorReports');
Route::get('/panel/club-get-report', 'panel\adminController@clubGetReport');
Route::post('panel/club-error-reports/delete', 'panel\adminController@deleteClubErrorReport');
// cron

Route::get('panel/comments/send-mails', 'panel\clubsController@sendMails');

// редиректы
Route::get('/register', function(){ return Redirect::to('/register_club', 301); });
Route::get('clubs/{id}/{url}','clubsController@redirectOldClubsURLS');
Route::get('post/read/{id}/{url}', function($id, $url){ return Redirect::to($id.'_statia_'.$url, 301); });

Route::get('/computerniy_club_{city}', 'HomeController@index')->name('home')->middleware('city');

// должен быть последным, иначе остальные ссылки не сработают, потому что '/{city}' совпадает со всеми ссылками
Route::get('/{city}','HomeController@redirectOldCitiesURLs');
