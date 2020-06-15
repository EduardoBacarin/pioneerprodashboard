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

Route::get('/', 'Site\HomeController@index');

Route::prefix('painel')->group(function(){
    Route::get('/', 'Admin\HomeController@index')->name('admin');

    Route::get('login', 'Admin\Auth\LoginController@index')->name('login');
    Route::post('login', 'Admin\Auth\LoginController@authenticate');

    Route::get('register', 'Admin\Auth\RegisterController@index')->name('register');
    Route::post('register', 'Admin\Auth\RegisterController@register');

    Route::post('logout', 'Admin\Auth\LoginController@logout')->name('logout');

    Route::resource('users', 'Admin\UserController');
    Route::resource('pages', 'Admin\PageController');
    
    Route::get('profile', 'Admin\ProfileController@index')->name('profile');
    Route::put('profilesave', 'Admin\ProfileController@save')->name('profile.save');

    Route::get('settings', 'Admin\SettingController@index')->name('settings');
    Route::put('settingssave', 'Admin\SettingController@save')->name('settings.save');

    //Rotas do Fleet Things começa aqui
    Route::resource('ftusers', 'Admin\FtusersController');
    Route::get('ftuserssave', 'Admin\FtusersController@save')->name('ftusers.save');

    Route::resource('ftorders', 'Admin\FtordersController');
    Route::get('ftorderssave', 'Admin\FtordersController@save')->name('ftorders.save');
    
    //rotas dos filtros
    Route::post('forderssearch', 'Admin\FtordersController@search')->name('ftorders.search');
    //Route::any('ftorders/filter', 'Admin\FtordersController@filter')->name('ftorders.filter');
    
    Route::resource('ftshippings', 'Admin\FtShippingsController');
    

    //Route::post('store', 'Admin\FtordersController@store')->name('store');

    Route::get('ftinventory', 'Admin\FtinventoryController@index');
    Route::post('ftinventoryimport', 'Admin\FtinventoryController@import')->name('ftinventory.import');


    Route::delete('ftinventorytruncate', 'Admin\FtinventoryController@truncate')->name('ftinventory.truncate');

    //Route::delete('ftinventory/truncate',array('as'=>'ftinventory.truncate', 'uses'=>'FtinventoryController@truncate'));
    
    });

Route::fallback('Site\PageController@index');
