<?php

use Illuminate\Support\Facades\Route;

/*
------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your aplication. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'auth'],
    function ($router) {
        Route::post('register', 'Frontend\AuthController@register');
        Route::post('login', 'Frontend\AuthController@login');
        Route::post('verify/{id}/{key}', 'Frontend\VerifyController@verify');

    });
Route::group(['prefix' => 'auth',
    'middleware' => ['api', 'jwt.auth'],
], function ($router) {
    Route::post('logout', 'Frontend\AuthController@logout');
    Route::post('refresh', 'Frontend\AuthController@refresh');
    Route::match(['put', 'patch'], 'avatar/{id}', 'Frontend\AccountController@avatar');
    Route::match(['put', 'patch'],'update/{id}', 'Frontend\AccountController@update');
    Route::match(['put', 'patch'], 'approve/{id}', 'Frontend\AccountController@editApprove');
    Route::post('me', 'Frontend\AuthController@me');

    Route::post('getaccountbyid', 'Frontend\AccountController@getAccountById');
    Route::get('edit/{id}', 'Frontend\AccountController@editProfile');
    Route::post('getstatus', 'Frontend\AccountController@getStatus');
    Route::match(['put', 'patch'], 'edit/{id}', 'Frontend\AccountController@updateProfile');
    Route::match(['put', 'patch'], 'changePass/{id}', 'Frontend\AccountController@changePassword');
    Route::post('coursedetails', 'Frontend\CourseAppController@coursedetails');
    Route::post('getcoursebyspec', 'Frontend\CourseAppController@getCourseBySpec');
    Route::post('getcoursesinfo', 'Frontend\CourseAppController@getCourseInfo');
    Route::post('getbook', 'Frontend\CourseAppController@getBookById');
    Route::post('gettests', 'Frontend\CourseAppController@getTestsById');
    Route::post('gettestsbyaid', 'Frontend\AccountCourseController@getTestsResult');
    Route::post('getresult', 'Frontend\AccountCourseController@getResult');
    Route::post('getcpcourse', 'Frontend\AccountCourseController@getCPCourse');
    Route::post('gettitle', 'Frontend\CourseAppController@getCourseTitleById');
    Route::post('finishedvideo', 'Frontend\CourseController@finishedCount');

    Route::post('videoinfo', 'Frontend\AccountVideoController@getVideoById');
    Route::post('addpoint', 'Frontend\AccountVideoController@addPointById');
});


Route::post('about', 'Frontend\PageController@about');

Route::post('coursestitle', 'Frontend\PageController@coursestitle');
Route::post('applicantcount', 'Frontend\PageController@applicantcount');
Route::post('coursescount', 'Frontend\PageController@coursescount');
Route::post('allcourses', 'Frontend\CourseController@allcourses');


//get courses

Route::post('comment', 'Frontend\PageController@savecomment');


Route::post('regions', 'Frontend\AddressController@index');
Route::post('prof', 'Frontend\ExpertController@profession');
//Route::get('verify/{id}/{key}', 'Frontend\VerifyController@indax');
Route::post('edu', 'Frontend\ExpertController@education');
Route::post('educate/', 'Frontend\ExpertController@educate');
Route::post('spec', 'Frontend\ExpertController@specialty');
Route::post('territory', 'Frontend\AddressController@territories');
//        Route::get('reset-password', 'AuthController@sendPasswordResetLink');
Route::post('reset-password', 'Frontend\PasswordResetController@sendPasswordResetLink');
Route::post('reset/password', 'Frontend\PasswordResetController@callResetPassword');


