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
    Route::get('/product', 'ProductController@index')->name('admin.product')->middleware('UserPermission:product,view');
    Route::get('/product/category', 'ProductCategoryController@index')->name('admin.product.category')->middleware('UserPermission:prodcuct_category,view');


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

