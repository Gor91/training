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
Route::get('/verify/{key}', 'Frontend\VerifyController@indax');
Route::get('/contact', 'Frontend\PageController@get');

\Illuminate\Support\Facades\Auth::routes();

Route::get('verify/{key}', 'Frontend\AuthController@verify');


//backend
//Route::prefix('/backend')->
//name('backend.')
//    ->namespace('Auth')->group(function () {

Route::get('/backend/password/request', 'Auth\ForgotPasswordController@showLinkRequestForm')
    ->name('password.request');

Route::get('/backend', 'Auth\LoginController@showLoginForm')->name('login');
Route::get('/backend/login/', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/backend/doLogin/', 'Auth\LoginController@doLogin')->name('doLogin');
Route::get('/backend/logout/', 'Auth\LoginController@logout')->name('logout');
Route::post('/backend/logout/', 'Auth\LoginController@logout')->name('logout');
Route::get('/backend/verify/{key}', 'Auth\VerifyController@');
//pages
Route::get('/backend/dashboard/', 'Backend\DashboardController@index')->name('dashboard');
Route::resource('/backend/admin', 'Backend\AdminController');
Route::match(['put', 'patch'], '/backend/changePassword/{id}', 'Backend\AdminController@changePassword');
Route::post('/backend/sendEmail', 'Backend\BaseController@sendEmail');
Route::post('/backend/sendEmails', 'Backend\BaseController@sendEmails');

//videos
Route::resource('/backend/videos', 'Backend\VideoController');
Route::post( '/delete-video', 'Backend\VideoController@removeVideo');
Route::post( '/backend/videos/{id}', 'Backend\VideoController@update');

//images S3
Route::resource('/backend/image', 'Backend\ImageController');
Route::post( '/delete-image', 'Backend\ImageController@removeImage');

//books
Route::resource('/backend/book', 'Backend\BookController');
Route::post( '/delete-book', 'Backend\BookController@removeBook');
Route::post('/backend/book/{id}', 'Backend\BookController@update');

//courses
Route::get('/backend/course/result', 'Backend\CoursesController@result');
Route::get('/backend/course/result-speciality', 'Backend\CoursesController@resultSpeciality');
Route::resource('/backend/course', 'Backend\CoursesController');
Route::post('/backend/course/{id}', 'Backend\CoursesController@update');

//accounts
Route::get('/backend/account/{role}', 'Backend\AccountController@index', ['only' => [
    'index'
]])->where('role', 'user|lecture');
Route::get('/backend/account/create', 'Backend\AccountController@create');
Route::post('/backend/account/{role}', 'Backend\AccountController@store')->name('account.store');
Route::match(['put', 'patch'],'/backend/account/{id}', 'Backend\AccountController@update')->name('account.update');
Route::match(['put', 'patch'],'/backend/updateAccount/{id}', 'Backend\AccountController@updateAccount')->name('account.edit');
Route::get('/backend/account/{id}', 'Backend\AccountController@show')->name('account.show');
Route::get('/backend/account_tests/{id}', 'Backend\AccountTestController@index')->name('test.tests');
Route::post('/backend/change_status', 'Backend\AccountController@changeStatus')->name('account.member_of_palace');
Route::get('/backend/account_test/{a_id}/{id}', 'Backend\AccountTestController@show')->name('test.show');
Route::post('/backend/accountCheck', 'Backend\AccountController@checkAccount')->name('account.check');
Route::delete('/backend/account', 'Backend\AccountController@destroy')->name('account.destroy');
Route::get('/backend/account/{id}/edit', 'Backend\AccountController@edit')->name('account.edit');
Route::post('/backend/sendEmail', 'Backend\BaseController@sendEmail');
Route::post('/backend/sendAttachment', 'Backend\AccountTestController@sendAttachment');

//specialty
Route::resource('/backend/type', 'Backend\TypeController');
//generate pdf
Route::get('/backend/admin_gdPDF', 'Backend\AdminController@gdPDF');
Route::get('/backend/admin_gdExcel', 'Backend\AdminController@gdExcel');
Route::get('/backend/course_gdPDF', 'Backend\CoursesController@gdPDF');
Route::get('/backend/course_gdExcel', 'Backend\CoursesController@gdExcel');
Route::get('/backend/type_gdPDF', 'Backend\TypeController@gdPDF');
Route::get('/backend/type_gdExcel', 'Backend\TypeController@gdExcel');
Route::get('/backend/account_gdPDF', 'Backend\AccountController@gdPDFRole');
Route::get('/backend/account_gdExcel', 'Backend\AccountController@gdExcel');
Route::get('/backend/tests_gdPDF/{id}', 'Backend\AccountTestController@gdPDF');
Route::get('/backend/test_gdPDF/{a_id}/{id}', 'Backend\AccountTestController@gdPDFTest');

//settings
Route::resource('/backend/message', 'Backend\MessageController')->except(['destroy']);
Route::get('/backend/account_gdPDF/{id}', 'Backend\AccountController@gdPDF');
Route::resource('backend/logs', 'Backend\LogController')->only([
    'index', 'show'
]);

//    });

//ajax

//tests
Route::get('backend/test/getCourses', "Backend\TestsController@getCourses");
Route::resource('/backend/test', 'Backend\TestsController');
Route::post('/backend/test/{id}', 'Backend\TestsController@update');

Route::post('/territory', 'Backend\AccountController@getTerritory');
//todo compare with SpecialtyController
Route::post('/edu', 'Backend\AccountController@getEducation');
Route::post('/spec', 'Backend\AccountController@getSpecialty');
Route::post('/updateSpec', 'Backend\SpecialtyController@updateSpecialty');
Route::post('/specialty', 'Backend\SpecialtyController@getSpecialty');
Route::post('/backend/specialtyCheck', 'Backend\SpecialtyController@checkSpecialty');
Route::post('/backend/ajaxImageUpload', 'Backend\BaseController@ajaxImageUpload');
Route::delete('/backend/ajaxRemoveImage', 'Backend\BaseController@ajaxRemoveImage');

//check specialty
Route::post('/backend/typeCheck', 'Backend\TypeController@typeCheck');

Route::get('/backend/specialty/list', "Backend\SpecialtyController@list");
Route::resource('/backend/specialty', 'Backend\SpecialtyController');

Route::resource('/backend/pages', 'Backend\PageController');
Route::resource('/backend/comments', 'Backend\CommentController');
Route::post('/commentstatus', 'Backend\CommentController@commentstatus');
//Route::get( '/backend/index/{id}', 'Backend\CoursesController@edit');
