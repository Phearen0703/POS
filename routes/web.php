<?php

use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;




Route::group(['prefix' => '/admin'], function () {
    Auth::routes(['register' => false]);
});

    // change lang 

    Route::get('/change-language/{lang}','App\Http\Controllers\LanguageController@SwitchLang')->name('change_language');

//backend or admin
Route::group(['namespace'=>'App\Http\Controllers\Backends', 'prefix'=>'/admin'],function(){
    Route::get('/', 'HomeController@index')->name('admin.home');
    Route::get('/product', 'ProductController@index')->name('admin.product');
    Route::get('/product/category', 'ProductCategoryController@index')->name('admin.product.category');



});




//frontend
Route::group(['namespace'=>'App\Http\Controllers\Frontends'],function(){
    Route::get('/', 'HomeController@index')->name('home');
});



Route::fallback(function(){
    redirect('admin.home');
});

