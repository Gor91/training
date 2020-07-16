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
//Clear route cache:
Route::get('/route-cache', function () {
    $exitCode = \Illuminate\Support\Facades\Artisan::call('route:cache');
    return 'Routes cache cleared';
});

//Clear config cache:
Route::get('/config-cache', function () {
    $exitCode = \Illuminate\Support\Facades\Artisan::call('config:cache');
    return 'Config cache cleared';
});

// Clear application cache:
Route::get('/clear-cache', function () {
    $exitCode = \Illuminate\Support\Facades\Artisan::call('cache:clear');
    return 'Application cache cleared';
});

// Clear view cache:
Route::get('/view-clear', function () {
    $exitCode = \Illuminate\Support\Facades\Artisan::call('view:clear');
    return 'View cache cleared';
});
/*Route::get('/{any}', 'Frontend\SinglePageController@index')->where('any', '.*');*/

Route::get('/{any}', function () {
    return view('welcome');
})->where('any', '^(?!backend).*$');

Route::get('/edit{id}', 'Frontend\AccountController@edit')->name('edit');
Route::get('/about', 'Frontend\PageController@get');
Route::get('/contact', 'Frontend\PageController@get');

\Illuminate\Support\Facades\Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');


//backend
//Route::prefix('/backend')->
//name('backend.')
//    ->namespace('Auth')->group(function () {
Route::get('/backend/password/request', 'Auth\ForgotPasswordController@showLinkRequestForm')
    ->name('password.request');
//Route::get('/home', 'Frontend\HomeController@index')->name('home');
Route::get('/backend', 'Auth\LoginController@showLoginForm')->name('login');
Route::get('/backend/login/', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/backend/doLogin/', 'Auth\LoginController@doLogin')->name('doLogin');
Route::get('/backend/logout/', 'Auth\LoginController@logout')->name('logout');
Route::post('/backend/logout/', 'Auth\LoginController@logout')->name('logout');
//pages
Route::get('/backend/dashboard/', 'Backend\DashboardController@index')->name('dashboard');
Route::resource('/backend/admin', 'Backend\AdminController');
Route::match(['put', 'patch'], '/backend/changePassword/{id}', 'Backend\AdminController@changePassword');
Route::post('/backend/sendEmail', 'Backend\BaseController@sendEmail');

//courses
Route::resource('/backend/courses/', 'Backend\CoursesController');
Route::get( '/backend/getCourse/{id}', 'Backend\CoursesController@getCourse');
Route::get( '/backend/editCourse/{id}', 'Backend\CoursesController@editCourse');
Route::get('/backend/deleteCourse/{id}','Backend\CoursesController@destroy');
Route::post('upload', "Backend\CoursesController@fileUpload");
Route::get('backend/courses/getSpecialities/', "Backend\CoursesController@getSpecialities");

//accounts
Route::get('/backend/account/{role}', 'Backend\AccountController@index', ['only' => [
    'index'
]])->where('role', 'user|lecture');
Route::get('/backend/account/create', 'Backend\AccountController@create');
Route::post('/backend/account/{role}', 'Backend\AccountController@store')->name('account.store');
Route::match(['put', 'patch'],'/backend/account/{id}', 'Backend\AccountController@update')->name('account.update');
Route::get('/backend/account/{id}', 'Backend\AccountController@show')->name('account.show');
Route::delete('/backend/account/{id}', 'Backend\AccountController@destroy')->name('account.destroy');
Route::get('/backend/account/{id}/edit', 'Backend\AccountController@edit')->name('account.edit');

Route::post('/backend/sendEmail', 'Backend\BaseController@sendEmail');
//generate pdf
Route::get('/backend/admin_gdPDF', 'Backend\AdminController@gdPDF');
Route::get('/backend/admin_gdExcel', 'Backend\AdminController@gdExcel');

//settings
Route::resource('/backend/message', 'Backend\MessageController')->except(['destroy']);
Route::get('/backend/account_gdPDF/{id}', 'Backend\AccountController@gdPDF');

//    });

//ajax

Route::post('/territory', 'Backend\AccountController@getTerritory');
Route::post('/spec', 'Backend\AccountController@getSpecialty');
Route::post('/backend/ajaxImageUpload', 'Backend\BaseController@ajaxImageUpload');
Route::delete('/backend/ajaxRemoveImage', 'Backend\BaseController@ajaxRemoveImage');