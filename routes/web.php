<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/user-registration', [
    'uses'=>'UserRegistrationController@showRegistrationForm',
    'as'=> 'user-registration'
]);

    Route::post('/user-registration', [
    'uses'=>'UserRegistrationController@userSave',
    'as'=> 'user-save'
]);

    Route::get('/user-list', [
    'uses'=>'UserRegistrationController@userList',
    'as'=> 'user-list'
]);

    Route::get('/user-profile/{userId}', [
    'uses'=>'UserRegistrationController@userProfile',
    'as'=> 'user-profile'
]);
    Route::get('/change-user-info/{id}', [
    'uses'=>'UserRegistrationController@changeUserInfo',
    'as'=> 'change-user-info'
]);
    Route::post('/user-info-update', [
    'uses'=>'UserRegistrationController@userInfoUpdate',
    'as'=> 'user-info-update'
]);
    Route::get('/change-user-avatar/{id}', [
    'uses'=>'UserRegistrationController@changeUserAvatar',
    'as'=> 'change-user-avatar'
]);
    Route::post('/update-user-photo', [
    'uses'=>'UserRegistrationController@updateUserPhoto',
    'as'=> 'update-user-photo'
]);
    Route::get('/change-user-password/{id}', [
    'uses'=>'UserRegistrationController@changeUserPassword',
    'as'=> 'change-user-password'
]);
    Route::post('/user-password-update', [
    'uses'=>'UserRegistrationController@userPasswordUpdate',
    'as'=> 'user-password-update'
]);

    // General Section
    Route::get('/add-header-footer', [
    'uses'=>'HomePageController@addHeaderFooterForm',
    'as'=>'add-header-footer'
]);
    Route::post('/add-header-footer', [
    'uses'=>'HomePageController@headerAndFooterSave',
    'as'=>'header-and-footer-save'
]);
    Route::get('/manage-header-footer/{id}', [
    'uses'=>'HomePageController@manageHeaderFooter',
    'as'=>'manage-header-footer'
]);
    Route::post('/header-and-footer-update', [
    'uses'=>'HomePageController@headerAndFooterUpdate',
    'as'=>'header-and-footer-update'
]);

    // Slider Section Start
    Route::get('/add-slide', [
    'uses'=>'SliderController@addSlide',
    'as'=>'add-slide'
]);
    Route::post('/add-slide', [
    'uses'=>'SliderController@uploadSlide',
    'as'=>'upload-slide'
]);
    Route::get('/manage-slide', [
    'uses'=>'SliderController@manageSlide',
    'as'=>'manage-slide'
]);
    Route::get('/slide-unpublished/{id}', [
    'uses'=>'SliderController@slideUnpublished',
    'as'=>'slide-unpublished'
]);
    Route::get('/slide-published/{id}', [
    'uses'=>'SliderController@slidePublished',
    'as'=>'slide-published'
]);
    Route::get('/photo-gallery', [
    'uses'=>'SliderController@photoGallery',
    'as'=>'photo-gallery'
]);
    Route::get('/slide-edit/{id}', [
    'uses'=>'SliderController@slideEdit',
    'as'=>'slide-edit'
]);
    Route::post('/update-slide', [
    'uses'=>'SliderController@updateSlide',
    'as'=>'update-slide'
]);
    Route::get('/slide-delete/{id}', [
    'uses'=>'SliderController@slideDelete',
    'as'=>'slide-delete'
]);
    // Slider Section End
});


Auth::routes(['register'=>false]);

Route::get('/home', 'HomeController@index')->name('home');
