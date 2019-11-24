<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('api')->namespace('Api')->group(function (): void {
    Route::prefix('kost')->name('kost.')->group(function (): void {
        Route::get(
            '/',
            'Kost@index'
        )->name('index');
        Route::get(
            '/owner/{ownerId}',
            'Kost@indexByOwner'
        )->where('ownerId', '[0-9]+')->name('index');
        Route::post(
            '/filter',
            'Kost@filter'
        )->name('save');
        Route::post(
            '/',
            'Kost@store'
        )->name('save');
        Route::post(
            '/{id}',
            'Kost@update'
        )->where('id', '[0-9]+')->name('edit');
        Route::delete(
            '/{id}',
            'Kost@delete'
        )->where('id', '[0-9]+')->name('delete');
        Route::post(
            '/available-room',
            'Kost@availableRoom')
        ->name('available.room');
    });

    Route::prefix('user')->name('user.')->group(function (): void {
        Route::post(
            '/minus-credit-point',
            'User@minusCreditPoint')
        ->name('credit.point');
    });

    Route::prefix('order')->name('order.')->group(function (): void {
        Route::get(
            '/owner/{ownerId}',
            'Order@indexByOwner'
        )->where('ownerId', '[0-9]+')->name('index');
        Route::post(
            '/',
            'Order@store')
        ->name('save');
    });
});
