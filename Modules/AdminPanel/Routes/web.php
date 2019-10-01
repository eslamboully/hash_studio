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
Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {

	Route::prefix('admin')->middleware('admin:admin')->group(function () {

		Route::get('/', 'AdminPanelController@index')->name('admin.dashboard');

		Route::get('quick-email', 'AdminPanelController@quick_email')->name('admin_quick_email');

	});
});
