<?php

use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;




Route::group(['prefix' => '/admin'], function () {
    Auth::routes(['register' => false, 'logout'=>false]);
    Route::post('/logout', 'App\Http\Controllers\Auth\LogoutControllers@index')->name('logout');
});

    // change lang 

    Route::get('/change-language/{lang}','App\Http\Controllers\LanguageController@SwitchLang')->name('change_language');

//backend or admin
Route::group(['namespace'=>'App\Http\Controllers\Backends', 'prefix'=>'/admin'],function(){
    Route::get('/', 'HomeController@index')->name('admin.home');
    Route::get('/product', 'ProductController@index')->name('admin.product');
    Route::get('/product/category', 'ProductCategoryController@index')->name('admin.product.category');

//role

Route::get('/role','RoleController@index')->name('admin.role');
Route::get('/role/{role_id}/edit','RoleController@edit')->name('admin.role.edit');
Route::post('/role/{role_id}/update','RoleController@update')->name('admin.role.update');
Route::get('/role/{role_id}/delete','RoleController@delete')->name('admin.role.delete');
Route::get('/role/create','RoleController@create')->name('admin.role.create');
Route::post('/role/store','RoleController@store')->name('admin.role.store');


});




//frontend
Route::group(['namespace'=>'App\Http\Controllers\Frontends'],function(){
    Route::get('/', 'HomeController@index')->name('home');
});



Route::fallback(function(){
    redirect('admin.home');
});

