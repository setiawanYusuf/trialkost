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

Route::get('/', 'Web\Home@index');

/* Route::get('/home', 'HomeController@index')->name('home'); */

Route::prefix('dashboard')->group(function (): void {
    Route::middleware(['auth'])->name('dashboard.')->group(function (): void {
        Route::get(
            '/',
            'Cms\Home'
        )->name('home');
        Route::get(
            '/owner/add',
            'Cms\Owner@add'
        )->name('owner.add');
    });
});

Auth::routes();
