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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')->group(function () {

    Route::prefix('kategori')->group(function () {
        //tampilan
        Route::get('/', 'KategoriController@index')->name('kategori-index');
        Route::get('/search','KategoriController@search')->name('kategori-search');
        // Route::get('create', 'ProjectController@add')->name('project-add');
        // Route::get('edit/{id}', 'ProjectController@edit')->name('project-edit');
        Route::get('/{idKategori}', 'KategoriController@byId')->name('kategori-by-id');

        //crud
        Route::post('/publish', 'KategoriController@publish')->name('kategori-publish');
        Route::post('/put', 'KategoriController@put')->name('kategori-put');
        Route::post('/remove', 'KategoriController@remove')->name('kategori-remove');
    });
    Route::prefix('kerudung')->group(function () {
        //tampilan
        Route::get('/', 'KerudungController@index')->name('kerudung-index');
        Route::get('/search','KerudungController@search')->name('kerudung-search');
        // Route::get('create', 'ProjectController@add')->name('project-add');
        // Route::get('edit/{id}', 'ProjectController@edit')->name('project-edit');
        // Route::get('/{idKerudung}', 'KerudungController@byId')->name('kerudung-by-id');

        //crud
        Route::post('/publish', 'KerudungController@publish')->name('kerudung-publish');
        Route::post('/put', 'KerudungController@put')->name('kerudung-put');
        Route::post('/remove', 'KerudungController@remove')->name('kerudung-remove');
    });

    Route::prefix('detail-kerudung')->group(function () {
        Route::get('/{idKerudung}', 'KerudungController@byId')->name('kerudung-by-id');
        Route::get('/by-kategori/{idKategori}', 'KerudungController@byKategori')->name('mom-by-kategori');
    });


});
