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

/* Route::get('/home', 'HomeController@index')->name('home'); */

Route::prefix('dashboard')->group(function (): void {
    Route::middleware(['auth', 'owner'])->name('dashboard.')->group(function (): void {
        Route::get(
            '/',
            'Cms\Home'
        )->name('home');

        Route::prefix('kost')->name('kost.')->group(function (): void {
            Route::get(
                '/',
                'Cms\Kost@index'
            )->name('index');
        });
        Route::prefix('order')->name('order.')->group(function (): void {
            Route::get(
                '/',
                'Cms\Order@index'
            )->name('index');
        });
    });
});

Route::prefix('owner')->group(function (): void {
    Route::middleware(['auth'])->name('owner.')->group(function (): void {
        Route::get(
            '/add',
            'Web\Owner@add'
        )->name('add');
        Route::get(
            '/edit/{id}',
            'Web\Owner@edit'
        )->where('id', '[0-9]+')->name('edit');
    });
});

Route::prefix('order')->group(function (): void {
    Route::middleware(['auth'])->name('order.')->group(function (): void {
        Route::get(
            '/add/{id}',
            'Web\Order@add'
        )->where('id', '[0-9]+')->name('add');
        Route::get(
            '/edit/{id}',
            'Web\Order@edit'
        )->where('id', '[0-9]+')->name('edit');
    });
});

Auth::routes();

Route::get('/', 'Web\Home@index')
    ->name('homepage');
Route::get(
    '/kost/{id}',
    'Web\Kost'
)->where('id', '[0-9]+'
)->name('detail.kost');
