<?php

use App\Http\Controllers\panel\adminController;
use App\Http\Controllers\panel\clubsController;
use App\Http\Controllers\panel\emailController;
use App\Http\Controllers\panel\offersController;
use App\Http\Controllers\panel\usersController;
use App\Http\Controllers\panel\postsController;
use Illuminate\Support\Facades\Artisan;
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

Route::post('clubs/saveCountBooking','clubsController@sendBooking');

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


//база email оплаты
Route::get('/payments', 'paymentsController@front');
// проверка оплаты
Route::get('/payments-check', 'paymentsController@check');


Auth::routes();
Route::post('auth/login',   'Auth\LoginController@loginUser' );

////// панель админа  \\\\\\\
Route::group(['prefix' => 'panel' , 'namespace' => '\App\Http\Controllers\panel'] , function (){
    Route::get('/',  [adminController::class , 'index']);
    //Справочник конфигураций
    Route::get('configuration/directory' , [adminController::class , 'configurationDirectory']);
    Route::post('configuration/directory/save' , [adminController::class , 'configurationDirectorySave']);
    Route::group(['prefix' => 'users'] , function (){
        Route::get('/', [usersController::class , 'index']);
    });
    Route::get('find-user',[usersController::class , 'find']);
    Route::get('players', [usersController::class , 'players']);
    Route::group(['prefix' => 'posts'] , function (){
        Route::get('all', [postsController::class , 'index']);
        Route::post('order_no', [postsController::class , 'reOrderPost']);
    });
    Route::post('comment/delete', [postsController::class , 'deleteComment']);

    Route::group(['prefix' => 'offers'] , function (){
        Route::get('all', [offersController::class , 'index']);
        Route::get('allClub', [offersController::class , 'indexClub']);
        Route::get('order_no',[offersController::class , 'reOrderOffer']);
    });
    //база email оплаты
    Route::group(['prefix' => 'emails'] , function (){
        Route::get('all', [emailController::class , 'index']);
        Route::get('add', [emailController::class , 'add']);
        Route::post('create', [emailController::class , 'store']);
        Route::post('update', [emailController::class , 'store']);
        Route::get('edit/{id}', [emailController::class , 'edit']);
        Route::get('active/{id}', [emailController::class , 'active']);
        Route::get('deactive/{id}', [emailController::class , 'deactive']);
        Route::post('update/{id}', [emailController::class , 'update']);
    });
    Route::post('message/delete', [adminController::class , 'deleteMessage']);

    Route::get('club-get-report', [adminController::class , 'clubGetReport']);
    Route::get('club-error-reports', [adminController::class , 'clubErrorReports']);
    Route::post('/club-error-reports/delete', [adminController::class , 'deleteClubErrorReport']);
// cron
    Route::get('comments/send-mails', [clubsController::class , 'sendMails']);

    Route::group(['prefix' => 'club'] , function (){
        Route::post('{id}/change-user', [clubsController::class , 'changeClubUser']);
        Route::post('{id}/delete', [clubsController::class , 'deleteClub']);
        Route::get('{id}/recover', [clubsController::class , 'recoverClub']);
        Route::post('toggle-closed', [clubsController::class , 'toggleClosed']);
    });
    Route::get('export_clubs', [clubsController::class , 'exportClubs']);
    // клубы
    Route::group(['prefix' => 'clubs'] , function (){
        Route::get('hidded-clubs', [clubsController::class , 'hidded_clubs']);
        Route::get('deleted-clubs', [clubsController::class , 'deleted_clubs']);
        Route::get('clubs', [clubsController::class , 'clubs']);

        Route::get('new-clubs', [clubsController::class , 'new_clubs']);
        Route::resource('drafts' , 'Admin\Drafts\DraftsController')
            ->names('admin.clubs');
    });
    // обратная связь
    Route::get('contacts',  [adminController::class , 'contacts']);
    Route::get('getMessage', [adminController::class , 'getMessage']);
    Route::get('error-reports', [adminController::class , 'errorReports']);
    Route::get('get-report',  [adminController::class , 'getReports']);

    Route::group(['prefix' => 'langame-requests'] , function (){
        Route::get('/', [adminController::class , 'langameRequests']);
        Route::post('delete', [adminController::class , 'deleteRequest']);
        Route::get('toggle/{id}', [adminController::class , 'langameRequestsToggle']);
    });
});
//##  END ADMIN ##

Route::get('{id}_computerniy_club_{url}_{city}/active','panel\clubsController@active');


// users
Route::post('club/{id}/comment','panel\clubsController@comment');
Route::post('club/{club_id}/remove_comment','panel\clubsController@removeComment');

Route::post('users/register','panel\usersController@register');
Route::post('users/edit','panel\usersController@edit');
Route::post('users/delete','panel\usersController@delete');
Route::get('users/toggleadmin/{id}','panel\usersController@toggleadmin');


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

Route::post('clubs-offers/add', 'offersController@addFromUser');






Route::get('/clear', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('backup:clean');
    return "Кэш очищен.";
});


// редиректы
Route::get('/register', function(){ return Redirect::to('/register_club', 301); });
Route::get('clubs/{id}/{url}','clubsController@redirectOldClubsURLS');
Route::get('post/read/{id}/{url}', function($id, $url){ return Redirect::to($id.'_statia_'.$url, 301); });

Route::get('/computerniy_club_{city}', 'HomeController@index')->name('home')->middleware('city');

// должен быть последным, иначе остальные ссылки не сработают, потому что '/{city}' совпадает со всеми ссылками
Route::get('/{city}','HomeController@redirectOldCitiesURLs');
