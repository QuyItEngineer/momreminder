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


Route::get('/reader', 'ReaderController@index');
Route::get('/social/{provider}/redirect', 'Auth\LoginController@redirect')->name('auth.social.redirect');
Route::get('/social/{provider}/callback', 'Auth\LoginController@callback')->name('auth.social.callback');

Auth::routes();

Route::group(['middleware' => ['auth']], function () {

    Route::get('/', 'HomeController@index');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/dashboard/horizon', 'HomeController@horizon')->name('dashboard.horizon');

    Route::resource('users', 'UserController');
    Route::resource('roles', 'RoleController');
    Route::resource('permissions', 'PermissionController');
    Route::resource('templates', 'TemplateController');
    Route::resource('activities', 'ActivityController');
    Route::post('/records/upload', 'RecordController@upload')->name('records.upload');
    Route::resource('records', 'RecordController');
    Route::post('campaigns/bulk', 'CampaignController@bulk')->name('campaigns.bulk');
    Route::get('campaigns/unsubscribed', 'CampaignController@unsubscribed')->name('campaigns.unsubscribed');
    Route::resource('campaigns', 'CampaignController');
    Route::resource('groups', 'GroupController');
//    Route::put('/api/contacts/', 'api/ContactController@update');
    Route::get('contacts/import', 'ContactController@import')->name('contacts.import');
    Route::post('contacts/import_data', 'ContactController@import_data')->name('contacts.import_data');
    Route::resource('contacts', 'ContactController');
    Route::resource('activities', 'ActivityController');
    Route::get('settings/emailer','SettingController@show_emailer')->name('settings.emailer');
    Route::post('settings/store_emailer','SettingController@store_emailer')->name('settings.store_emailer');
    Route::post('settings/test_emailer','SettingController@testEmailer')->name('settings.test_emailer');
    Route::resource('settings', 'SettingController');
    Route::get('messages','MessageController@index')->name('messages.index');
    Route::get('calls','CallController@index')->name('calls.index');
    Route::post('emailQueues/test-email-setting', 'EmailQueueController@updateTestEmailSettings')->name('emailQueues.test_email_setting');
    Route::post('emailQueues/index', 'EmailQueueController@index');
    Route::resource('emailQueues', 'EmailQueueController');

    Route::get('purchase','CreditCardController@purchase_credit')->name('credit_card.purchase');
    Route::post('update_card','CreditCardController@update_card')->name('credit_card.update_card');

    Route::get('/profile', 'ProfileController@index')->name('profile.index');
    Route::post('/profile', 'ProfileController@update')->name('profile.update');
    Route::get('/buyCredit', 'PackageController@buyCredit')->name('packages.buy_credit');
    Route::resource('packages', 'PackageController');

    Route::get('/export/download', 'ContactController@download_example')->name('export.download');

});

Route::get('file', 'FileController@index')->name('file.index');