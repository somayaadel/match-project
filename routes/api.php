<?php

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

Route::get('/test', '\App\Http\Controllers\TestController@test');
Route::resource('/job', '\App\Http\Controllers\JobController');

Route::group([
    'middleware' => '\App\Http\Middleware\ApplicationKey',
], function () {
    Route::get('auth/create', '\App\Http\Controllers\AuthController@create');
    Route::post('auth/login', '\App\Http\Controllers\AuthController@login');
    Route::post('auth/signup', '\App\Http\Controllers\AuthController@signup');
    Route::post('auth/socialLogin', '\App\Http\Controllers\AuthController@socialLogin');
    Route::post('auth/send-mail', '\App\Http\Controllers\AuthController@sendResetMail');
    Route::post('auth/show-form/{token}', '\App\Http\Controllers\AuthController@redirectToForm');

    Route::post('auth/rest-password', '\App\Http\Controllers\AuthController@resetPassword');

});

Route::group([
    'middleware' => ['auth:api',
        '\App\Http\Middleware\ApplicationKey',
    ],
], function () {
    Route::post('/search-followers', '\App\Http\Controllers\UserController@myFollowersSearch');
    Route::post('/search-followings', '\App\Http\Controllers\UserController@myFollowingsSearch');

    Route::post('/send', '\App\Http\Controllers\AuthController@sendCodeToUserPhone');
    Route::post('/checkCode', '\App\Http\Controllers\AuthController@checkPhoneConfirmationCode');
    Route::get('/getInteractions/{company_id}', '\App\Http\Controllers\InteractionController@index');
    Route::put('/seenInteractions', '\App\Http\Controllers\InteractionController@seen');
    Route::post('/get-profile','\App\Http\Controllers\UserController@getProfile');
    Route::post('/update-profile','\App\Http\Controllers\UserController@updateProfile');
    Route::post('/update-password','\App\Http\Controllers\UserController@updatePassword');

    Route::get('/filterCreate', '\App\Http\Controllers\InteractionController@filterCreate');
    Route::post('/filterUsers/{company_id}', '\App\Http\Controllers\InteractionController@filterUsers');


    Route::post('/follow', '\App\Http\Controllers\UserController@follow');
    Route::get('/myfollowers', '\App\Http\Controllers\UserController@myFollowers');
    Route::get('/myfollowings', '\App\Http\Controllers\UserController@myFollowings');
    Route::post('/block', '\App\Http\Controllers\UserController@block');
    Route::post('/unblock', '\App\Http\Controllers\UserController@unBlock');
    Route::get('/myBlockList', '\App\Http\Controllers\UserController@myBlockList');
    Route::get('/all-reports', '\App\Http\Controllers\ReportController@getReports');
    Route::post('/upload/photo/', '\App\Http\Controllers\UploadController@uploadPhoto');
    Route::get('/upload/{id}/{type}', '\App\Http\Controllers\UploadController@getmedia');
    Route::post('/upload/video/', '\App\Http\Controllers\UploadController@uploadVideo');
    Route::post('/user/{id}/toggle-block', '\App\Http\Controllers\UserController@toggleBlock');
    Route::post('/user/{id}/update-package', '\App\Http\Controllers\UserController@updatePackage');
    Route::post('/user/{id}/update-category', '\App\Http\Controllers\UserController@updateCategory');
    Route::get('/user/available-fields', '\App\Http\Controllers\UserController@availableFields');
    Route::get('/blocked_users', '\App\Http\Controllers\UserController@blockedUsers');
    Route::get('/free_users', '\App\Http\Controllers\UserController@freeUsers');
    Route::get('/company_users', '\App\Http\Controllers\UserController@companyUsers');
    Route::get('/premium_users', '\App\Http\Controllers\UserController@premiumUsers');
    Route::get('/allStaff', '\App\Http\Controllers\UserController@allStaff');

    // Route::put('/user_data/{user_data}' , '\App\Http\Controllers\UserDataController@update');
    Route::resource('/user_data', '\App\Http\Controllers\UserDataController')->parameters([
        'user_data' => 'user_data',
    ]);

    Route::get('/permission', '\App\Http\Controllers\PermissionController@index')->withoutMiddleware(['auth:api']);
    Route::post('/permission', '\App\Http\Controllers\PermissionController@store');
    Route::get('/permission/{permission}', '\App\Http\Controllers\PermissionController@show');
    Route::put('/permission/{permission}', '\App\Http\Controllers\PermissionController@update');
    Route::delete('/permission/{permission}', '\App\Http\Controllers\PermissionController@destroy');

    Route::resource('/city', '\App\Http\Controllers\CityController');
    Route::resource('/country', '\App\Http\Controllers\CountryController');
    Route::resource('/application', '\App\Http\Controllers\ApplicationController');
    Route::resource('/report', '\App\Http\Controllers\ReportController');
    Route::resource('/category', '\App\Http\Controllers\CategoryController');
    Route::resource('/categoryType', '\App\Http\Controllers\categoryTypeController');
    Route::resource('/faq', '\App\Http\Controllers\FaqController');
    Route::put('/generalSetting/{id}', '\App\Http\Controllers\GeneralSettingController@update');

    Route::post('/importCateg', '\App\Http\Controllers\CategoryController@importCateg');

    Route::put('field', '\App\Http\Controllers\FieldController@updateMultiple');
    Route::resource('/field', '\App\Http\Controllers\FieldController');
    Route::resource('/feature', '\App\Http\Controllers\FeatureController');
    Route::get('/package', '\App\Http\Controllers\PackageController@index')->withoutMiddleware(['auth:api']);
    Route::get('/package/create', '\App\Http\Controllers\PackageController@create');
    Route::post('/package', '\App\Http\Controllers\PackageController@store');
    Route::get('/package/{package}', '\App\Http\Controllers\PackageController@show');
    Route::put('/package/{package}', '\App\Http\Controllers\PackageController@update');
    Route::delete('/package/{package}', '\App\Http\Controllers\PackageController@destroy');

    Route::get('/recentEarnings', '\App\Http\Controllers\EarningController@recentEarnings');
    Route::resource('/earning', '\App\Http\Controllers\EarningController');
    Route::resource('/emailTemplate', '\App\Http\Controllers\Email_templateController');

    Route::resource('/contact_message', '\App\Http\Controllers\ContactMessageController');
    Route::put('/user/{user_id}/update-profile', '\App\Http\Controllers\UserDataController@update');
    Route::get('/user/create/', '\App\Http\Controllers\UserController@create')->withoutMiddleware(['auth:api']);
    Route::post('/user', '\App\Http\Controllers\UserController@store');
    Route::get('/user', '\App\Http\Controllers\UserController@index');
    Route::get('/user/{user}', '\App\Http\Controllers\UserController@show');
    Route::put('/user/{user}', '\App\Http\Controllers\UserController@update');
    Route::delete('/user/{user}', '\App\Http\Controllers\UserController@destroy');
    //Notification APIs
    Route::post('add-token-notification', '\App\Http\Controllers\NotificationController@addTokenNotification');
    Route::get('send-all-notification', '\App\Http\Controllers\NotificationController@sendAllNotifications');
    Route::get('send-notifications', '\App\Http\Controllers\NotificationController@sendNotifications');
    Route::get('seen-notifications', '\App\Http\Controllers\NotificationController@seenNotifications');
    Route::get('send-new-notifications', '\App\Http\Controllers\NotificationController@sendNewNotifications');
    Route::post('test-notification', '\App\Http\Controllers\NotificationController@testFcm');

    // Route::resource('/user','\App\Http\Controllers\UserController');

    Route::post('/userPermission/{user_id}', '\App\Http\Controllers\UserController@updateUserPermission');
    Route::get('/userPermission/show/{user_id}', '\App\Http\Controllers\UserController@showUserPermission');

    Route::post('/talanted_search', '\App\Http\Controllers\SearchController@talantedSearch')->middleware('\App\Http\Middleware\IsCompany');

});

Route::group(['middleware' => ['web']], function () {
    // your routes here

    Route::get('/auth/redirect/{provider}', '\App\Http\Controllers\AuthController@redirect');
    Route::post('/callback/{provider}', '\App\Http\Controllers\AuthController@callback');
});
