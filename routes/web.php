<?php

use \Illuminate\Support\Facades\Route;

// to this work -> have to change all routes to 'admin2.' prefix in the v1 theme
if (env('THEME_VERSION') == 'v1'){
    $namespace = 'Admin';
}else{
    $namespace = 'Admin2';
}


// Login And Forget Password Routes
Route::group(['namespace' => 'Auth', 'prefix' => 'admin', 'middleware' => ['web']], function () {

    Route::get('login', ['as' => 'admin2.login', 'uses' => 'AdminLoginController@index']);
    Route::post('login', ['as' => 'admin2.login_check', 'uses' => 'AdminLoginController@ajaxLogin']);
    Route::get('logout', ['as' => 'admin2.logout', 'uses' => 'AdminLoginController@logout']);
});

// Admin Panel After Login
Route::group(['middleware' => ['auth.admin', 'web', 'admin.permission.check'],'namespace' => $namespace, 'prefix' => 'admin'], function () {

    // region Dashboard Routes
    Route::resource('dashboard', 'DashboardController', ['as' => 'admin2']);
    //endregion

    // region Staff Member
    Route::get('get-users', ['as' => 'admin2.get-users', 'uses' => 'UserController@getLists']);
    Route::resource('users', 'UserController', ['as' => 'admin2']);
    //endregion

    //region Sales Member
    Route::get('get-sales-users', ['as' => 'admin2.get-sales-users', 'uses' => 'SalesMemberController@getLists']);
    Route::resource('sales-users', 'SalesMemberController', ['as' => 'admin2']);
    //endregion

    // region Email Template
    Route::post('send-mail/{lead}', ['as' => 'admin2.email-templates.send-mail', 'uses' => 'EmailTemplateController@sendMail']);
    Route::get('write-edit-email/{lead}/{id?}', ['as' => 'admin2.email-templates.write-edit-email', 'uses' => 'EmailTemplateController@writeOrEditEmail']);
    Route::get('get-email-templates', ['as' => 'admin2.get-email-templates', 'uses' => 'EmailTemplateController@getLists']);
    Route::resource('email-templates', 'EmailTemplateController', ['as' => 'admin2']);

    Route::get('forms/add-new-field', ['as' => 'admin2.forms.add-new-field', 'uses' => 'FormController@addNewField']);
    Route::post('forms/upload-fields-from-csv', ['as' => 'admin2.forms.upload-fields-from-csv', 'uses' => 'FormController@uploadFieldsFromCSV']);
    Route::post('forms/select-form-data', ['as' => 'admin2.forms.select-form-data', 'uses' => 'FormController@selectFormData']);
    Route::get('get-forms', ['as' => 'admin2.get-forms', 'uses' => 'FormController@getLists']);
    Route::resource('forms', 'FormController', ['as' => 'admin2']);

    //endregion

    //region Campaign Manger
    Route::post('campaigns/save-lead/{campaign_id}', ['as' => 'admin2.campaigns.lead.store', 'uses' => 'CampaignController@storeLead']);
    Route::get('campaigns/create-lead/{campaign_id}', ['as' => 'admin2.campaigns.lead.create', 'uses' => 'CampaignController@createLead']);
    Route::post('campaigns/save-lead-data', ['as' => 'admin2.campaigns.save-lead-data', 'uses' => 'CampaignController@saveLeadData']);
    Route::post('campaigns/import-lead-data', ['as' => 'admin2.campaigns.import-lead-data', 'uses' => 'CampaignController@importLeadData']);
    Route::get('campaigns/import-leads', ['as' => 'admin2.campaigns.import-leads', 'uses' => 'CampaignController@importLeads']);
    Route::get('campaigns/download-export-leads', ['as' => 'admin2.campaigns.download-export-leads', 'uses' => 'CampaignController@downloadExportLead']);
    Route::get('campaigns/get-export-leads', ['as' => 'admin2.campaigns.get-export-leads', 'uses' => 'CampaignController@getExportLeadLists']);
    Route::get('campaigns/export-leads', ['as' => 'admin2.campaigns.export-leads', 'uses' => 'CampaignController@exportLeadData']);
    Route::get('get-campaigns', ['as' => 'admin2.get-campaigns', 'uses' => 'CampaignController@getLists']);
    Route::resource('campaigns', 'CampaignController', ['as' => 'admin2']);
    //endregion

    //region Call Manager
    Route::get('callmanager/view-lead/{id}', ['as' => 'admin2.callmanager.view-lead', 'uses' => 'CallManagerController@viewLead']);
    Route::post('callmanager/save-lead-time/{id}', ['as' => 'admin2.callmanager.save-lead-time', 'uses' => 'CallManagerController@saveLeadTime']);
    Route::post('callmanager/cancel-callback/{id}', ['as' => 'admin2.callmanager.cancel-callback', 'uses' => 'CallManagerController@cancelCallback']);
    Route::post('callmanager/skip-delete/{id}', ['as' => 'admin2.callmanager.skip-delete', 'uses' => 'CallManagerController@skipAndDelete']);
    Route::post('callmanager/come-back/{id}', ['as' => 'admin2.callmanager.come-back', 'uses' => 'CallManagerController@comeBack']);
    Route::post('callmanager/lead-action/{id}/{action}', ['as' => 'admin2.callmanager.lead-action', 'uses' => 'CallManagerController@takeLeadAction']);
    Route::post('callmanager/save-lead/{id}', ['as' => 'admin2.callmanager.save-lead', 'uses' => 'CallManagerController@saveLeadData']);
    Route::post('callmanager/stop/{id}', ['as' => 'admin2.callmanager.stop', 'uses' => 'CallManagerController@stopCampaign']);
    Route::post('callmanager/take-action/{campaign}', ['as' => 'admin2.callmanager.take-action', 'uses' => 'CallManagerController@takeAction']);
    Route::get('callmanager/{lead}', ['as' => 'admin2.callmanager.lead', 'uses' => 'CallManagerController@startLead']);
    Route::get('get-call-manager', ['as' => 'admin2.get-call-manager', 'uses' => 'CallManagerController@getLists']);
    Route::get('callmanager', ['as' => 'admin2.callmanager.index', 'uses' => 'CallManagerController@index']);
    //endregion

    //region Call Enquiry
    Route::post('call-enquiry/campaign-form-field/{id}', ['as' => 'admin2.call-enquiry.campaign-form-field', 'uses' => 'CallEnquiryController@getFormFieldsByCampaign']);
    Route::get('get-call-enquiry', ['as' => 'admin2.get-call-enquiry', 'uses' => 'CallEnquiryController@getLists']);
    Route::resource('call-enquiry', 'CallEnquiryController', ['as' => 'admin2', 'only' => ['index']]);
    //endregion

    //region Call History
    Route::post('call-history/campaign-team-members/{id}', ['as' => 'admin2.call-history.campaign-team-member', 'uses' => 'CallHistoryController@getCampaignTeamMember']);
    Route::get('get-call-history', ['as' => 'admin2.get-call-history', 'uses' => 'CallHistoryController@getLists']);
    Route::resource('call-history', 'CallHistoryController', ['as' => 'admin2', 'only' => ['index']]);
    //endregion

    //region Appointment

    // Pending Callbacks
    Route::get('add-edit-callback/{id}', ['as' => 'admin2.add-edit-callback', 'uses' => 'PendingCallbackController@addEditByLead']);
    Route::get('get-callbacks', ['as' => 'admin2.get-callbacks', 'uses' => 'PendingCallbackController@getLists']);
    Route::resource('pending-callback', 'PendingCallbackController', ['as' => 'admin2']);

    // Appointment Calendar
    Route::get('add-edit-appointments/{id}', ['as' => 'admin2.add-edit-appointments', 'uses' => 'AppointmentCalendarController@addEditByLead']);
    Route::post('get-appointments', ['as' => 'admin2.get-appointments', 'uses' => 'AppointmentCalendarController@getAppointments']);
    Route::resource('appointments', 'AppointmentCalendarController', ['as' => 'admin2']);

    //endregion

    //region Settings Routes
    Route::resource('settings/profile', 'ProfileSettingController', ['as' => 'admin2.settings', 'only' => ['index','store']]);
    Route::group(
        ['prefix' => 'settings', 'middleware' => ['auth.admin.check']], function () {

        Route::resource('company', 'CompanySettingController', ['as' => 'admin2.settings', 'only' => ['index','store']]);
        Route::post('send-test-email', ['as' => 'admin2.settings.send-test-email', 'uses' => 'EmailSettingController@sendTestEmail']);
        Route::get('get-send-mail-modal', ['as' => 'admin2.settings.get-send-mail-modal', 'uses' => 'EmailSettingController@getSendMailModal']);
        Route::resource('email', 'EmailSettingController', ['as' => 'admin2.settings', 'only' => ['index','store']]);

        Route::get('translations/view/{groupKey?}', ['as' => 'admin2.settings.translations.get-view', 'uses' => 'TranslationController@getView'])->where('groupKey', '.*');
        Route::get('translations/{groupKey?}', ['as' => 'admin2.settings.translations', 'uses' => 'TranslationController@getIndex'])->where('groupKey', '.*');

        Route::post('calls/save-twilio-number', ['as' => 'admin2.settings.calls.save-twilio-number', 'uses' => 'CallSettingController@saveTwilioNumber']);
        Route::resource('calls', 'CallSettingController', ['as' => 'admin2.settings', 'only' => ['index','store']]);

        Route::resource('form-field-name', 'FormFieldNameSettingController', ['as' => 'admin2.settings', 'only' => ['index','store']]);

        //region Role Routes
        Route::get('get-roles', ['as' => 'admin2.get-roles', 'uses' => 'RoleSettingController@getList']);
        Route::resource('roles', 'RoleSettingController', ['as' => 'admin2.settings']);
        //endregion

        //region Update App Routes
        Route::post('install-by-file', ['as' => 'admin2.settings.update-app.install-by-file', 'uses' => 'UpdateAppSettingController@installByFile']);
        Route::post('delete-file', ['as' => 'admin2.settings.update-app.delete-file', 'uses' => 'UpdateAppSettingController@deleteFile']);
        Route::resource('update-app', 'UpdateAppSettingController', ['as' => 'admin2.settings']);
        //endregion

    });
    // endregion

});


Route::post('/twilio/inbound-webhook/{number}', ['as' => 'front.twilio.inbound-webhook', 'uses' => 'Front\TwilioCallController@inboundWebhookHandler']);
Route::post('/twilio/token', ['as' => 'front.twilio.token', 'uses' => 'Front\TwilioCallController@newToken']);
Route::post('/twilio/support/call', ['as' => 'front.twilio.support-call', 'uses' => 'Front\TwilioCallController@newCall']);

Route::get('/', ['as' => 'admin.app', 'uses' => 'Auth\AdminLoginController@index']);
