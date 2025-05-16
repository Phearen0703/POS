<?php

use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\ActiveUser;





Route::group(['prefix' => '/admin'], function () {
    Auth::routes(['register' => false, 'logout'=>false]);
    Route::post('/logout', 'App\Http\Controllers\Auth\LogoutControllers@index')->name('logout');
});

    // change lang 

    Route::get('/change-language/{lang}','App\Http\Controllers\LanguageController@SwitchLang')->name('change_language');

    //backend or admin
    Route::group(['namespace'=>'App\Http\Controllers\Backends', 'prefix'=>'/admin', 'middleware'=>[ActiveUser::class]], function () {
    Route::get('/', 'HomeController@index')->name('admin.home');




    //product
    Route::get('/product', 'ProductController@index')->name('admin.product')->middleware('UserPermission:product,view');
    Route::get('/product/create', 'ProductController@create')->name('admin.product.create')->middleware('UserPermission:product,create');
    Route::post('/product/store', 'ProductController@store')->name('admin.product.store')->middleware('UserPermission:product,create');
    Route::get('/product/{product_id}/edit', 'ProductController@edit')->name('admin.product.edit')->middleware('UserPermission:product,edit');
    Route::post('/product/{product_id}/update', 'ProductController@update')->name('admin.product.update')->middleware('UserPermission:product,edit');
    Route::get('/product/{product_id}/delete', 'ProductController@delete')->name('admin.product.delete')->middleware('UserPermission:product,delete');



    //product category
    Route::get('/product/category', 'ProductCategoryController@index')->name('admin.product.category')->middleware('UserPermission:prodcuct_category,view');
    Route::get('/product/category/create', 'ProductCategoryController@create')->name('admin.product_category.create')->middleware('UserPermission:prodcuct_category,create');
    Route::post('/product/category/store', 'ProductCategoryController@store')->name('admin.product_category.store')->middleware('UserPermission:prodcuct_category,create');
    Route::get('/product/category/{category_id}/edit', 'ProductCategoryController@edit')->name('admin.product_category.edit')->middleware('UserPermission:prodcuct_category,edit');
    Route::post('/product/category/{category_id}/update', 'ProductCategoryController@update')->name('admin.product_category.update')->middleware('UserPermission:prodcuct_category,edit');
    Route::get('/product/category/{category_id}/delete', 'ProductCategoryController@delete')->name('admin.product_category.delete')->middleware('UserPermission:prodcuct_category,delete');


    //role
    Route::get('/role','RoleController@index')->name('admin.role')->middleware('UserPermission:role,view');
    Route::get('/role/{role_id}/edit','RoleController@edit')->name('admin.role.edit')->middleware('UserPermission:role,edit');
    Route::post('/role/{role_id}/update','RoleController@update')->name('admin.role.update')->middleware('UserPermission:role,edit');
    Route::get('/role/{role_id}/delete','RoleController@delete')->name('admin.role.delete')->middleware('UserPermission:role,delete');
    Route::get('/role/create','RoleController@create')->name('admin.role.create')->middleware('UserPermission:role,create');
    Route::post('/role/store','RoleController@store')->name('admin.role.store')->middleware('UserPermission:role,create');

    //role permission
    Route::get('/role/{role_id}/permission','RoleController@permission')->name('admin.role.permission')->middleware('UserPermission:role,edit');
    Route::get('/role/{role_id}/permission/update','RoleController@updatePermission')->name('admin.role.permission.update')->middleware('UserPermission:role,edit');


    // permission
    Route::get('/permission','PermissionController@index')->name('admin.permission')->middleware('IsDeveloper');
    Route::get('/permission/create','PermissionController@create')->name('admin.permission.create')->middleware('IsDeveloper');
    Route::post('/permission/store','PermissionController@store')->name('admin.permission.store')->middleware('IsDeveloper');
    Route::get('/permission/{permission_id}/edit','PermissionController@edit')->name('admin.permission.edit')->middleware('IsDeveloper');
    Route::get('/permission/{permission_id}/delete','PermissionController@delete')->name('admin.permission.delete')->middleware('IsDeveloper');
    Route::post('/permission/{permission_id}/update','PermissionController@update')->name('admin.permission.update')->middleware('IsDeveloper');


    //user
    Route::get('/user', 'UserController@index')->name('admin.user')->middleware('UserPermission:user,view');
    Route::get('/user/{user_id}/edit', 'UserController@edit')->name('admin.user.edit')->middleware('UserPermission:user,edit');
    Route::post('/user/{user_id}/update', 'UserController@update')->name('admin.user.update')->middleware('UserPermission:user,edit');
    Route::get('/user/{user_id}/delete', 'UserController@delete')->name('admin.user.delete')->middleware('UserPermission:user,delete');
    Route::get('/user/create', 'UserController@create')->name('admin.user.create')->middleware('UserPermission:user,create');
    Route::post('/user/store', 'UserController@store')->name('admin.user.store')->middleware('UserPermission:user,store');



    //company
    Route::get('/company', 'CompanyController@index')->name('admin.company')->middleware('UserPermission:company,view');
    Route::get('/company/edit', 'CompanyController@edit')->name('admin.company.edit')->middleware('UserPermission:company,edit');
    Route::post('/company/update', 'CompanyController@update')->name('admin.company.update')->middleware('UserPermission:company,edit');


    //no permission
    Route::get('/admin.no_permission', function () {
        return view('backends.no_permission');
    })->name('admin.no_permission');


    });




    //frontend
    Route::group(['namespace'=>'App\Http\Controllers\Frontends'],function(){
        Route::get('/', 'HomeController@index')->name('home');
    });



    Route::fallback(function(){
        redirect('admin.home');
    });

