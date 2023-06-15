<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'WelcomeController@index')->name('welcome');
Route::get('public_letter/{param}', 'AllotmentLetterController@public_letter')->name('public-letter');
Route::get('/qrcode/{text}', [
    'uses' => 'QRController@makeQrCode',
    'as'   => 'qrcode'
]);

Route::get('set-locale/{locale}', 'Controller@set_locale')->name('locale');

Route::get('/', 'WelcomeController@index')->name('welcome');

Auth::routes();


Route::group(['middleware' => ['auth', 'language']], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::post('/get_total_amounts', 'HomeController@get_total_amounts')->name('get-total-amounts');
    Route::post('/get_all_code_total_amounts', 'HomeController@get_all_code_total_amounts')->name('get-all-code-total-amounts');
    Route::post('/get_chart', 'GraphChartController@get_chart')->name('get-chart');
    Route::post('/show_transaction_list', 'HomeController@show_transaction_list')->name('show-transaction-list');
    Route::get('/replace-linked/{table}/{column}/{replaceable}/{replacing_with}', ['as' => 'replace_linked', 'middleware' => ['permission:replace-linked'], 'uses' => 'HomeController@replace_linked']);
    Route::get('/profile-edit', ['as' => 'profile_edit', 'middleware' => ['permission:edit-profile'], 'uses' => 'UserDetailController@profile_edit']);
    Route::patch('/profile-update', ['as' => 'profile_update', 'middleware' => ['permission:edit-profile'], 'uses' => 'UserDetailController@profile_update']);
    Route::get('/change-password', ['as' => 'change_password', 'middleware' => ['permission:change-password'], 'uses' => 'UserDetailController@change_password']);
    Route::patch('/update-password', ['as' => 'update_password', 'middleware' => ['permission:change-password'], 'uses' => 'UserDetailController@update_password']);
    Route::post('register_excel', ['uses' => 'UserDetailController@register_excel'])->name('register_excel');

    Route::group(['prefix' => 'code', 'as' => 'code'], function () {
        Route::get('/list', ['as' => '.index', 'middleware' => ['permission:read-code'], 'uses' => 'CodeController@index']);
        Route::get('/add', ['as' => '.create', 'middleware' => ['permission:create-code'], 'uses' => 'CodeController@create']);
        Route::post('/store', ['as' => '.store', 'middleware' => ['permission:create-code'], 'uses' => 'CodeController@store']);
        Route::get('/edit/{code}', ['as' => '.edit', 'middleware' => ['permission:edit-code'], 'uses' => 'CodeController@edit']);
        Route::patch('/update/{code}', ['as' => '.update', 'middleware' => ['permission:edit-code'], 'uses' => 'CodeController@update']);
        Route::post('/get-list', ['as' => '.get_index', 'middleware' => ['permission:read-code'], 'uses' => 'CodeController@get_index']);
        Route::delete('/{code}', ['as' => '.destroy', 'middleware' => ['permission:delete-code'], 'uses' => 'CodeController@destroy']);
        Route::post('/get-unapproved_balance', ['as' => '.get_unapproved_balance', 'middleware' => ['permission:read-code'], 'uses' => 'CodeController@get_unapproved_balance']);
    });

    //    Route::group(['prefix'=>'recipient','as'=>'recipient'],function () {
    //        Route::get('/list',['as'=>'.index','middleware'=>['permission:read-recipient'],'uses'=>'RecipientController@index']);
    //        Route::get('/add',['as'=>'.create','middleware'=>['permission:create-recipient'],'uses'=>'RecipientController@create']);
    //        Route::post('/store',['as'=>'.store','middleware'=>['permission:create-recipient'],'uses'=>'RecipientController@store']);
    //        Route::get('/{recipient}',['as'=>'.show','middleware'=>['permission:read-recipient'],'uses'=>'RecipientController@show']);
    //        Route::get('/edit/{recipient}',['as'=>'.edit','middleware'=>['permission:edit-recipient'],'uses'=>'RecipientController@edit']);
    //        Route::patch('/update/{recipient}',['as'=>'.update','middleware'=>['permission:edit-recipient'],'uses'=>'RecipientController@update']);
    //        Route::post('/get-list', ['as' => '.get_index', 'middleware' => ['permission:read-recipient'], 'uses' => 'RecipientController@get_index']);
    //        Route::delete('/{recipient}',['as'=>'.destroy','middleware'=>['permission:delete-recipient'],'uses'=>'RecipientController@destroy']);
    //        Route::post('/get-recipient-by-search-key', ['as' => '.get_recipient_by_search_key', 'middleware' => ['permission:read-recipient'], 'uses' => 'RecipientController@get_recipient_by_search_key']);
    //    });

    Route::group(['prefix' => 'unit', 'as' => 'unit'], function () {
        Route::get('/list', ['as' => '.index', 'middleware' => ['permission:read-unit'], 'uses' => 'UnitController@index']);
        Route::get('/add', ['as' => '.create', 'middleware' => ['permission:create-unit'], 'uses' => 'UnitController@create']);
        Route::post('/store', ['as' => '.store', 'middleware' => ['permission:create-unit'], 'uses' => 'UnitController@store']);
        Route::get('/{unit}', ['as' => '.show', 'middleware' => ['permission:read-unit'], 'uses' => 'UnitController@show']);
        Route::get('/edit/{unit}', ['as' => '.edit', 'middleware' => ['permission:edit-unit'], 'uses' => 'UnitController@edit']);
        Route::patch('/update/{unit}', ['as' => '.update', 'middleware' => ['permission:edit-unit'], 'uses' => 'UnitController@update']);
        Route::post('/get-list', ['as' => '.get_index', 'middleware' => ['permission:read-unit'], 'uses' => 'UnitController@get_index']);
        Route::delete('/{unit}', ['as' => '.destroy', 'middleware' => ['permission:delete-unit'], 'uses' => 'UnitController@destroy']);
        Route::post('/get-unit-by-search-key', ['as' => '.get_unit_by_search_key', 'middleware' => ['permission:read-unit'], 'uses' => 'UnitController@get_unit_by_search_key']);
    });

    Route::group(['prefix' => 'code-allotment', 'as' => 'code-allotment'], function () {
        Route::get('/list', ['as' => '.index', 'middleware' => ['permission:read-code-allotment'], 'uses' => 'CodeAllotmentController@index']);
        Route::get('/add', ['as' => '.create', 'middleware' => ['permission:create-code-allotment'], 'uses' => 'CodeAllotmentController@create']);
        Route::post('/store', ['as' => '.store', 'middleware' => ['permission:create-code-allotment'], 'uses' => 'CodeAllotmentController@store']);
        Route::get('/{code_allotment}', ['as' => '.show', 'middleware' => ['permission:read-code-allotment'], 'uses' => 'CodeAllotmentController@show']);
        Route::get('/edit/{code_allotment}', ['as' => '.edit', 'middleware' => ['permission:edit-code-allotment'], 'uses' => 'CodeAllotmentController@edit']);
        Route::patch('/update/{code_allotment}', ['as' => '.update', 'middleware' => ['permission:edit-code-allotment'], 'uses' => 'CodeAllotmentController@update']);
        Route::post('/get-list', ['as' => '.get_index', 'middleware' => ['permission:read-code-allotment'], 'uses' => 'CodeAllotmentController@get_index']);
        Route::delete('/{code_allotment}', ['as' => '.destroy', 'middleware' => ['permission:delete-code-allotment'], 'uses' => 'CodeAllotmentController@destroy']);
        Route::post('/approved', ['as' => '.approved', 'middleware' => ['permission:approved-code-allotment'], 'uses' => 'CodeAllotmentController@approved']);
        Route::post('/unapproved', ['as' => '.unapproved', 'middleware' => ['permission:unapproved-code-allotment'], 'uses' => 'CodeAllotmentController@unapproved']);
    });

    Route::group(['prefix' => 'code-surrender', 'as' => 'code-surrender'], function () {
        Route::get('/list', ['as' => '.index', 'middleware' => ['permission:read-code-surrender'], 'uses' => 'CodeSurrenderController@index']);
        Route::get('/add', ['as' => '.create', 'middleware' => ['permission:create-code-surrender'], 'uses' => 'CodeSurrenderController@create']);
        Route::post('/store', ['as' => '.store', 'middleware' => ['permission:create-code-surrender'], 'uses' => 'CodeSurrenderController@store']);
        Route::get('/{code_surrender}', ['as' => '.show', 'middleware' => ['permission:read-code-surrender'], 'uses' => 'CodeSurrenderController@show']);
        Route::get('/edit/{code_surrender}', ['as' => '.edit', 'middleware' => ['permission:edit-code-surrender'], 'uses' => 'CodeSurrenderController@edit']);
        Route::patch('/update/{code_surrender}', ['as' => '.update', 'middleware' => ['permission:edit-code-surrender'], 'uses' => 'CodeSurrenderController@update']);
        Route::post('/get-list', ['as' => '.get_index', 'middleware' => ['permission:read-code-surrender'], 'uses' => 'CodeSurrenderController@get_index']);
        Route::delete('/{code_surrender}', ['as' => '.destroy', 'middleware' => ['permission:delete-code-surrender'], 'uses' => 'CodeSurrenderController@destroy']);
        Route::post('/approved', ['as' => '.approved', 'middleware' => ['permission:approved-code-surrender'], 'uses' => 'CodeSurrenderController@approved']);
        Route::post('/unapproved', ['as' => '.unapproved', 'middleware' => ['permission:unapproved-code-surrender'], 'uses' => 'CodeSurrenderController@unapproved']);
    });

    Route::group(['prefix' => 'master-surrender-letter', 'as' => 'master-surrender-letter'], function () {
        Route::get('/edit', ['as' => '.edit', 'middleware' => ['permission:edit-master-surrender-letter'], 'uses' => 'MasterSurrenderLetterController@edit']);
        Route::patch('/update', ['as' => '.update', 'middleware' => ['permission:edit-master-surrender-letter'], 'uses' => 'MasterSurrenderLetterController@update']);
    });

    Route::group(['prefix' => 'code-surrender-letter', 'as' => 'code-surrender-letter'], function () {
        Route::get('/list', ['as' => '.index', 'middleware' => ['permission:read-surrender-letter'], 'uses' => 'SurrenderLetterController@index']);
        Route::get('/add', ['as' => '.create', 'middleware' => ['permission:create-surrender-letter'], 'uses' => 'SurrenderLetterController@create']);
        Route::post('/store', ['as' => '.store', 'middleware' => ['permission:create-surrender-letter'], 'uses' => 'SurrenderLetterController@store']);
        Route::post('/get_unlinked_surrender_by_search_key', ['as' => '.get_unlinked_surrender_by_search_key', 'middleware' => ['permission:read-surrender-letter'], 'uses' => 'SurrenderLetterController@get_unlinked_surrender_by_search_key']);
        //        Route::post('/get_letter_acknowledgement_recipient_by_search_key',['as'=>'.get_letter_acknowledgement_recipient_by_search_key','middleware'=>['permission:create-surrender-letter'],'uses'=>'SurrenderLetterController@get_letter_acknowledgement_recipient_by_search_key']);
        Route::get('/{surrender_letter}', ['as' => '.show', 'middleware' => ['permission:read-surrender-letter'], 'uses' => 'SurrenderLetterController@show']);
        Route::get('/edit/{surrender_letter}', ['as' => '.edit', 'middleware' => ['permission:edit-surrender-letter'], 'uses' => 'SurrenderLetterController@edit']);
        Route::patch('/update/{surrender_letter}', ['as' => '.update', 'middleware' => ['permission:edit-surrender-letter'], 'uses' => 'SurrenderLetterController@update']);
        Route::post('/get-list', ['as' => '.get_index', 'middleware' => ['permission:read-surrender-letter'], 'uses' => 'SurrenderLetterController@get_index']);
        Route::delete('/{surrender_letter}', ['as' => '.destroy', 'middleware' => ['permission:delete-surrender-letter'], 'uses' => 'SurrenderLetterController@destroy']);
        //        Route::post('get-generate-letter-recipient-html',['as'=>'.get_generate_letter_recipient_html','middleware'=>['permission:create-surrender-letter'],'uses'=>'SurrenderLetterController@get_generate_letter_recipient_html']);
        Route::post('surrender-letter-sent-mail', ['as' => '.surrender_letter_sent_mail', 'middleware' => ['permission:read-mail'], 'uses' => 'SurrenderLetterController@surrender_letter_sent_mail']);
        Route::post('surrender-letter-sent-sms', ['as' => '.surrender_letter_sent_sms', 'middleware' => ['permission:read-sms'], 'uses' => 'SurrenderLetterController@surrender_letter_sent_sms']);
    });

    Route::group(['prefix' => 'unit-allotment', 'as' => 'unit-allotment'], function () {
        Route::get('/list', ['as' => '.index', 'middleware' => ['permission:read-unit-allotment'], 'uses' => 'UnitAllotmentController@index']);
        Route::get('/add', ['as' => '.create', 'middleware' => ['permission:create-unit-allotment'], 'uses' => 'UnitAllotmentController@create']);
        Route::post('/store', ['as' => '.store', 'middleware' => ['permission:create-unit-allotment'], 'uses' => 'UnitAllotmentController@store']);
        Route::get('/{unit_allotment}', ['as' => '.show', 'middleware' => ['permission:read-unit-allotment'], 'uses' => 'UnitAllotmentController@show']);
        Route::get('/edit/{unit_allotment}', ['as' => '.edit', 'middleware' => ['permission:edit-unit-allotment'], 'uses' => 'UnitAllotmentController@edit']);
        Route::patch('/update/{unit_allotment}', ['as' => '.update', 'middleware' => ['permission:edit-unit-allotment'], 'uses' => 'UnitAllotmentController@update']);
        Route::post('/get-list', ['as' => '.get_index', 'middleware' => ['permission:read-unit-allotment'], 'uses' => 'UnitAllotmentController@get_index']);
        Route::delete('/{unit_allotment}', ['as' => '.destroy', 'middleware' => ['permission:delete-unit-allotment'], 'uses' => 'UnitAllotmentController@destroy']);
        Route::post('/approved', ['as' => '.approved', 'middleware' => ['permission:approved-unit-allotment'], 'uses' => 'UnitAllotmentController@approved']);
        Route::post('/unapproved', ['as' => '.unapproved', 'middleware' => ['permission:unapproved-unit-allotment'], 'uses' => 'UnitAllotmentController@unapproved']);
    });

    Route::group(['prefix' => 'master-allotment-letter', 'as' => 'master-allotment-letter'], function () {
        Route::get('/edit', ['as' => '.edit', 'middleware' => ['permission:edit-master-allotment-letter'], 'uses' => 'MasterAllotmentLetterController@edit']);
        Route::patch('/update', ['as' => '.update', 'middleware' => ['permission:edit-master-allotment-letter'], 'uses' => 'MasterAllotmentLetterController@update']);
    });

    Route::group(['prefix' => 'unit-allotment-letter', 'as' => 'unit-allotment-letter'], function () {
        Route::get('/list', ['as' => '.index', 'middleware' => ['permission:read-allotment-letter'], 'uses' => 'AllotmentLetterController@index']);
        Route::get('/add', ['as' => '.create', 'middleware' => ['permission:create-allotment-letter'], 'uses' => 'AllotmentLetterController@create']);
        Route::post('/store', ['as' => '.store', 'middleware' => ['permission:create-allotment-letter'], 'uses' => 'AllotmentLetterController@store']);
        Route::post('/get_unlinked_allotment_by_search_key', ['as' => '.get_unlinked_allotment_by_search_key', 'middleware' => ['permission:read-allotment-letter'], 'uses' => 'AllotmentLetterController@get_unlinked_allotment_by_search_key']);
        Route::post('/get_letter_acknowledgement_recipient_by_search_key', ['as' => '.get_letter_acknowledgement_recipient_by_search_key', 'middleware' => ['permission:create-allotment-letter'], 'uses' => 'AllotmentLetterController@get_letter_acknowledgement_recipient_by_search_key']);
        Route::get('/{allotment_letter}', ['as' => '.show', 'middleware' => ['permission:read-allotment-letter'], 'uses' => 'AllotmentLetterController@show']);
        Route::get('/edit/{allotment_letter}', ['as' => '.edit', 'middleware' => ['permission:edit-allotment-letter'], 'uses' => 'AllotmentLetterController@edit']);
        Route::patch('/update/{allotment_letter}', ['as' => '.update', 'middleware' => ['permission:edit-allotment-letter'], 'uses' => 'AllotmentLetterController@update']);
        Route::post('/get-list', ['as' => '.get_index', 'middleware' => ['permission:read-allotment-letter'], 'uses' => 'AllotmentLetterController@get_index']);
        Route::delete('/{allotment_letter}', ['as' => '.destroy', 'middleware' => ['permission:delete-allotment-letter'], 'uses' => 'AllotmentLetterController@destroy']);
        Route::post('/get-memo-by-search-key', ['as' => '.get_memo_by_search_key', 'middleware' => ['permission:read-allotment-letter'], 'uses' => 'AllotmentLetterController@get_memo_by_search_key']);
        Route::post('get-generate-letter-recipient-html', ['as' => '.get_generate_letter_recipient_html', 'middleware' => ['permission:create-allotment-letter'], 'uses' => 'AllotmentLetterController@get_generate_letter_recipient_html']);
        Route::post('allotment-letter-sent-mail', ['as' => '.allotment_letter_sent_mail', 'middleware' => ['permission:read-mail'], 'uses' => 'AllotmentLetterController@allotment_letter_sent_mail']);
        Route::post('allotment-letter-sent-sms', ['as' => '.allotment_letter_sent_sms', 'middleware' => ['permission:read-sms'], 'uses' => 'AllotmentLetterController@allotment_letter_sent_sms']);
    });

    Route::group(['prefix' => 'unit-surrender', 'as' => 'unit-surrender'], function () {
        Route::get('/list', ['as' => '.index', 'middleware' => ['permission:read-unit-surrender'], 'uses' => 'UnitSurrenderController@index']);
        Route::get('/add', ['as' => '.create', 'middleware' => ['permission:create-unit-surrender'], 'uses' => 'UnitSurrenderController@create']);
        Route::get('/add-unitExpense', ['as' => '.create-expense', 'middleware' => ['permission:create-unit-surrender'], 'uses' => 'UnitSurrenderController@create_unitExpense']);
        Route::get('/expense-list', ['as' => '.expense-list', 'middleware' => ['permission:create-unit-surrender'], 'uses' => 'UnitSurrenderController@expense_list']);
        Route::post('/store', ['as' => '.store', 'middleware' => ['permission:create-unit-surrender'], 'uses' => 'UnitSurrenderController@store']);
        Route::post('/store_expense', ['as' => '.store_expense', 'middleware' => ['permission:create-unit-surrender'], 'uses' => 'UnitSurrenderController@store_expense']);
        Route::get('/{unit_surrender}', ['as' => '.show', 'middleware' => ['permission:read-unit-surrender'], 'uses' => 'UnitSurrenderController@show']);

        Route::get('/edit/{unit_surrender}', ['as' => '.edit', 'middleware' => ['permission:edit-unit-surrender'], 'uses' => 'UnitSurrenderController@edit']);
        Route::patch('/update/{unit_surrender}', ['as' => '.update', 'middleware' => ['permission:edit-unit-surrender'], 'uses' => 'UnitSurrenderController@update']);
        Route::post('/get-list', ['as' => '.get_index', 'middleware' => ['permission:read-unit-surrender'], 'uses' => 'UnitSurrenderController@get_index']);
        Route::post('/get-expense', ['as' => '.get_expense', 'middleware' => ['permission:read-unit-surrender'], 'uses' => 'UnitSurrenderController@get_expense']);
        Route::delete('/{unit_surrender}', ['as' => '.destroy', 'middleware' => ['permission:delete-unit-surrender'], 'uses' => 'UnitSurrenderController@destroy']);

        Route::post('/approved', ['as' => '.approved', 'middleware' => ['permission:approved-unit-surrender'], 'uses' => 'UnitSurrenderController@approved']);
        Route::post('/unapproved', ['as' => '.unapproved', 'middleware' => ['permission:unapproved-unit-surrender'], 'uses' => 'UnitSurrenderController@unapproved']);
    });
    Route::group(['prefix' => 'unit-expense', 'as' => 'unit-expense'], function () {
        Route::get('/edit_expense/{unit_expense}', ['as' => '.edit_expense', 'middleware' => ['permission:edit-unit-surrender'], 'uses' => 'UnitSurrenderController@edit_expense']);
        Route::get('/{unit_expense}', ['as' => '.show_expense', 'middleware' => ['permission:read-unit-surrender'], 'uses' => 'UnitSurrenderController@show_expense']);
        Route::patch('/update_expense/{unit_expense}', ['as' => '.update_expense', 'middleware' => ['permission:edit-unit-surrender'], 'uses' => 'UnitSurrenderController@update_expense']);
        Route::delete('/{unit_expense}', ['as' => '.delete', 'middleware' => ['permission:delete-unit-surrender'], 'uses' => 'UnitSurrenderController@delete']);
    });

    // // create new menu
    // Route::group(['prefix' => ])

    Route::group(['prefix' => 'email', 'as' => 'email'], function () {
        Route::get('/list', ['as' => '.index', 'middleware' => ['permission:read-mail'], 'uses' => 'EmailController@index']);
        Route::post('/get-list', ['as' => '.get_index', 'middleware' => ['permission:read-mail'], 'uses' => 'EmailController@get_index']);
    });

    Route::group(['prefix' => 'sms', 'as' => 'sms'], function () {
        Route::get('/list', ['as' => '.index', 'middleware' => ['permission:read-sms'], 'uses' => 'SMSController@index']);
        Route::post('/get-list', ['as' => '.get_index', 'middleware' => ['permission:read-sms'], 'uses' => 'SMSController@get_index']);
    });

    Route::group(['prefix' => 'report', 'as' => 'report'], function () {
        Route::get('/allotment_report', ['as' => '.allotment-report', 'middleware' => ['permission:read-allotment-report'], 'uses' => 'ReportController@allotment_report']);
        Route::get('/allotment-report-new', ['as' => '.allotment-report-new', 'middleware' => ['permission:read-allotment-report'], 'uses' => 'ReportController@allotment_report_new']);
        Route::post('/get_allotment_report', ['as' => '.get-allotment-report', 'middleware' => ['permission:read-allotment-report'], 'uses' => 'ReportController@get_allotment_report']);
        Route::post('/get_allotment_report_neww', ['as' => '.get-allotment-report-neww', 'middleware' => ['permission:read-allotment-report'], 'uses' => 'ReportController@get_allotment_report_new']);
        Route::get('/top_sheet', ['as' => '.top-sheet', 'middleware' => ['permission:read-top-sheet'], 'uses' => 'ReportController@top_sheet']);
        Route::get('/top_sheet_new', ['as' => '.top-sheet-new', 'middleware' => ['permission:read-top-sheet'], 'uses' => 'ReportController@top_sheet_new']);
        Route::post('/get_top_sheet', ['as' => '.get-top-sheet', 'middleware' => ['permission:read-top-sheet'], 'uses' => 'ReportController@get_top_sheet']);
        Route::post('/get_top_sheet_new', ['as' => '.get-top-sheet-neww', 'middleware' => ['permission:read-top-sheet'], 'uses' => 'ReportController@get_top_sheet_new']);
    });

    Route::group(['prefix' => 'settings', 'as' => 'settings'], function () {
        Route::get('/edit', ['as' => '.edit', 'middleware' => ['permission:edit-setting'], 'uses' => 'SettingController@edit']);
        Route::patch('/update', ['as' => '.update', 'middleware' => ['permission:edit-setting'], 'uses' => 'SettingController@update']);
        Route::group(['prefix' => 'user', 'as' => '.user'], function () {
            Route::get('/list', ['as' => '.index', 'middleware' => ['permission:read-user'], 'uses' => 'UserDetailController@index']);
            Route::post('/get-list', ['as' => '.get_index', 'middleware' => ['permission:read-user'], 'uses' => 'UserDetailController@get_index']);
            Route::post('/get-detail-modal', ['as' => '.get_detail_modal', 'middleware' => ['permission:read-user'], 'uses' => 'UserDetailController@get_detail_modal']);
            Route::post('/get-permission-modal', ['as' => '.get_permission_modal', 'middleware' => ['permission:assign-user-permission'], 'uses' => 'UserDetailController@get_permission_modal']);
            Route::post('/role-change', ['as' => '.role_change', 'middleware' => ['permission:edit-role'], 'uses' => 'UserDetailController@role_change']);
            Route::post('/permissions-change', ['as' => '.permissions_change', 'middleware' => ['permission:assign-user-permission'], 'uses' => 'UserDetailController@permissions_change']);
        });

        Route::group(['prefix' => 'backup', 'as' => '.backup'], function () {
            Route::get('/all', ['as' => '.all', 'middleware' => ['permission:backup'], 'uses' => 'Controller@all_backup']);
            Route::get('/db', ['as' => '.db', 'middleware' => ['permission:backup'], 'uses' => 'Controller@db_backup']);
            Route::get('/files', ['as' => '.files', 'middleware' => ['permission:backup'], 'uses' => 'Controller@files_backup']);
        });
        Route::group(['prefix' => 'log', 'as' => '.log'], function () {
            Route::get('/list', ['as' => '.index', 'middleware' => ['permission:read-log'], 'uses' => 'LogController@index']);
            Route::post('/get-list', ['as' => '.get_index', 'middleware' => ['permission:read-log'], 'uses' => 'LogController@get_index']);
        });
        Route::group(['prefix' => 'role', 'as' => '.role'], function () {
            Route::get('/list', ['as' => '.index', 'middleware' => ['permission:read-role'], 'uses' => 'RolePermissionController@role_index']);
            Route::get('/add', ['as' => '.create', 'middleware' => ['permission:create-role'], 'uses' => 'RolePermissionController@role_create']);
            Route::post('/store', ['as' => '.store', 'middleware' => ['permission:create-role'], 'uses' => 'RolePermissionController@role_store']);
            Route::get('/edit/{role}', ['as' => '.edit', 'middleware' => ['permission:edit-role'], 'uses' => 'RolePermissionController@role_edit']);
            Route::patch('/update/{role}', ['as' => '.update', 'middleware' => ['permission:edit-role'], 'uses' => 'RolePermissionController@role_update']);
            Route::post('/get-list', ['as' => '.get_index', 'middleware' => ['permission:read-role'], 'uses' => 'RolePermissionController@get_role_index']);
        });
        Route::group(['prefix' => 'permission', 'as' => '.permission'], function () {
            Route::get('/list', ['as' => '.index', 'middleware' => ['permission:read-permission'], 'uses' => 'RolePermissionController@permission_index']);
            Route::get('/add', ['as' => '.create', 'middleware' => ['permission:create-permission'], 'uses' => 'RolePermissionController@permission_create']);
            Route::post('/store', ['as' => '.store', 'middleware' => ['permission:create-permission'], 'uses' => 'RolePermissionController@permission_store']);
            Route::get('/edit/{permission}', ['as' => '.edit', 'middleware' => ['permission:edit-permission'], 'uses' => 'RolePermissionController@permission_edit']);
            Route::patch('/update/{permission}', ['as' => '.update', 'middleware' => ['permission:edit-permission'], 'uses' => 'RolePermissionController@permission_update']);
            Route::post('/get-list', ['as' => '.get_index', 'middleware' => ['permission:read-permission'], 'uses' => 'RolePermissionController@get_permission_index']);
        });
        Route::group(['prefix' => 'user_tables_combination', 'as' => '.user_tables_combination'], function () {
            Route::post('/get-user-tables-combination', ['as' => '.getCombination', 'middleware' => ['permission:read-user-tables-combination'], 'uses' => 'UserTablesCombinationController@getCombination']);
            Route::post('/set-user-tables-combination', ['as' => '.setCombination', 'middleware' => ['permission:read-user-tables-combination'], 'uses' => 'UserTablesCombinationController@setCombination']);
        });
        Route::group(['prefix' => 'lookup', 'as' => '.lookup'], function () {
            Route::get('/list', ['as' => '.index', 'middleware' => ['permission:read-lookup'], 'uses' => 'LookupController@index']);
            Route::get('/add', ['as' => '.create', 'middleware' => ['permission:create-lookup'], 'uses' => 'LookupController@create']);
            Route::post('/store', ['as' => '.store', 'middleware' => ['permission:create-lookup'], 'uses' => 'LookupController@store']);
            Route::get('/edit/{lookup}', ['as' => '.edit', 'middleware' => ['permission:edit-lookup'], 'uses' => 'LookupController@edit']);
            Route::patch('/update/{lookup}', ['as' => '.update', 'middleware' => ['permission:edit-lookup'], 'uses' => 'LookupController@update']);
            Route::post('/get-list', ['as' => '.get_index', 'middleware' => ['permission:read-lookup'], 'uses' => 'LookupController@get_index']);
            Route::delete('/{lookup}', ['as' => '.destroy', 'middleware' => ['permission:delete-lookup'], 'uses' => 'LookupController@destroy']);
        });
    });

    Route::get('/developer', function () {
        echo "<a href='https://www.facebook.com/ta.pigeon/'>Toukir Ahamed Pigeon</a>";
    });
    Route::post('check_unique_post', ['uses' => 'CheckController@check_unique_post'])->name('check_unique_post');
    Route::post('ckeditor_image_upload', ['uses' => 'HomeController@ckeditor_image_upload'])->name('ckeditor_image_upload');
});
