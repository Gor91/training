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
Route::get('/route-cache', function() {
    $exitCode = \Illuminate\Support\Facades\Artisan::call('route:cache');
    return 'Routes cache cleared';
});

//Clear config cache:
Route::get('/config-cache', function() {
    $exitCode = \Illuminate\Support\Facades\Artisan::call('config:cache');
    return 'Config cache cleared';
});

// Clear application cache:
Route::get('/clear-cache', function() {
    $exitCode = \Illuminate\Support\Facades\Artisan::call('cache:clear');
    return 'Application cache cleared';
});

// Clear view cache:
Route::get('/view-clear', function() {
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
Route::get('/(any)', 'Frontend\SingleController@index')->where('any', '.*');
Route::get('(any)', function () {
    return view('welcome');
}
)->where('any', '.*');

//backend
//Route::prefix('/backend')->
//name('backend.')
//    ->namespace('Auth')->group(function () {
Route::get('password/request', 'Auth\ForgotPasswordController@sendResetLinkEmail')
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
//Route::post('/backend/editCourses', 'Backend\CoursesController@editCourses');
Route::post('upload', "Backend\CoursesController@fileUpload");
Route::get('backend/courses/getSpecialities/', "Backend\CoursesController@getSpecialities");

//generate pdf
Route::get('/backend/admin_gdPDF', 'Backend\AdminController@gdPDF');
Route::get('/backend/admin_gdExcel', 'Backend\AdminController@gdExcel');
//    });
