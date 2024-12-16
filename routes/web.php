<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});


Route::get('/', 'App\\Http\\Controllers\\HomeController@index'); 
Route::get('extended_warranty', 'App\\Http\\Controllers\\HomeController@extendedWarranty'); 
Route::post('registration', 'App\\Http\\Controllers\\HomeController@registration');
Route::get('enquire_us', 'App\\Http\\Controllers\\HomeController@EnquireUs'); 
Route::post('/enquiry', 'App\\Http\\Controllers\\HomeController@enquiry')->name('enquiry');

Route::get('/check-order-id', 'App\Http\Controllers\HomeController@checkOrderId'); 

Route::get('detail/{slug}', 'App\Http\Controllers\HomeController@detailPage')->name('detail');


Route::get('no_access', 'App\\Http\\Controllers\\SettingsController@no_access')->middleware('checkRole:client');

Route::group(array('prefix' => 'admin', 'middleware' => ['guest-admin']), function () {
  Route::get('login', 'App\Http\Controllers\AdminController@login')->name('admin-login');
  Route::post('login', 'App\Http\Controllers\AdminController@login');
  Route::get('forgot-password', 'App\Http\Controllers\Admin\ForgotPasswordController@userForgotPassword');
  Route::post('forgot-password', 'App\Http\Controllers\Admin\ForgotPasswordController@forgotPassword');
  Route::get('password-reset/{token}', 'App\Http\Controllers\Admin\ForgotPasswordController@renderResetPassword');
  Route::post('password-reset/{token}', 'App\Http\Controllers\Admin\ForgotPasswordController@resetPassword');
});
//reset password
Route::get('reset-password/{token}', ' PasswordResetLinkController@resetPassword');
Route::post('update-password', ' PasswordResetLinkController@updatePassword')->name('update-password');
Route::post('admin-update-reset-password', ' PasswordResetLinkController@updateResetPassword')->name('admin-update-reset-password');





Route::group(array('prefix' => 'admin', 'middleware' => ['auth.admin']), function () {

  Route::get('dashboard', 'App\\Http\\Controllers\\AdminController@dashboard')->name('admin-dashboard');
  Route::get('logout', 'App\\Http\\Controllers\\AdminController@logout');
  Route::get('change_password', 'App\\Http\\Controllers\\ProfileController@changePassword');
  Route::post('new_password', 'App\\Http\\Controllers\\ProfileController@newPassword')->name('newpassword');
  Route::get('profile', 'App\\Http\\Controllers\\ProfileController@profile');
  Route::post('update_profile', 'App\\Http\\Controllers\\ProfileController@updateProfile')->name('update_profile');

  //extended warranty
  Route::resource('extended_warranty', 'App\Http\Controllers\Admin\ExtendedWarrantyController', ['names' => [
    'create' => 'Admin.extended_warranty.create',
    'index' => 'Admin.extended_warranty.index',
    'store' => 'Admin.extended_warranty.store',
    'edit' => 'Admin.extended_warranty.edit',
    'update' => 'Admin.extended_warranty.update',
    'destroy' => 'Admin.extended_warranty.destroy'
  ]]);
  Route::group(['prefix' => 'extended_warranty'], function () {
    Route::post('extended_warranty_list', 'App\Http\Controllers\Admin\ExtendedWarrantyController@extendedWarrantyList');
  });


  Route::get('extended_warranty_pdf', 'App\Http\Controllers\Admin\ExtendedWarrantyController@extendedWarrantyPdf');
  Route::post('extended_warranty_pdf', 'App\Http\Controllers\Admin\ExtendedWarrantyController@extendedWarrantyPdf');
  Route::get('extended_warranty_delete', 'App\Http\Controllers\Admin\ExtendedWarrantyController@extendedWarrantyDelete');
 
  Route::get('extended_warranty_export', 'App\Http\Controllers\Admin\ExtendedWarrantyController@extendedWarrantyExport');
  Route::post('extended_warranty_export', 'App\Http\Controllers\Admin\ExtendedWarrantyController@extendedWarrantyExport');

  Route::get('/check-order-id', 'App\Http\Controllers\Admin\ExtendedWarrantyController@checkOrderId');

  Route::post('/remove-file', 'App\Http\Controllers\Admin\ExtendedWarrantyController@removeFile')->name('remove-file');


  //Settings
  Route::get('settings', 'App\Http\Controllers\Admin\SettingsController@index')->name('settings');
  Route::get('settings/{value}/edit', 'App\Http\Controllers\Admin\SettingsController@edit')->name('settings-edit');
  Route::put('settings/{data}/update', 'App\Http\Controllers\Admin\SettingsController@update')->name('settings-update');
  Route::post('data_list', 'App\Http\Controllers\Admin\SettingsController@dataList');



  Route::resource('users', 'App\Http\Controllers\Admin\UsersController', ['names' => [
    'create' => 'Admin.users.create',
    'index' => 'Admin.users.index',
    'store' => 'Admin.users.store',
    'edit' => 'Admin.users.edit',
    'update' => 'Admin.users.update',
    'destroy' => 'Admin.users.destroy'
  ]]);
  Route::group(['prefix' => 'users'], function () {
    Route::post('users_list', 'App\Http\Controllers\Admin\UsersController@userList');
  });
  Route::get('user_delete', 'App\Http\Controllers\Admin\UsersController@userDelete');
  Route::get('users_export', 'App\Http\Controllers\Admin\UsersController@usersExport');
  Route::post('users_export', 'App\Http\Controllers\Admin\UsersController@usersExport');


  //Enquiry
  Route::resource('enquiries', 'App\Http\Controllers\Admin\EnquiryController', ['names' => [
    'create' => 'Admin.enquiries.create',
    'index' => 'Admin.enquiries.index',
    'store' => 'Admin.enquiries.store',
    'edit' => 'Admin.enquiries.edit',
    'update' => 'Admin.enquiries.update',
    'destroy' => 'Admin.enquiries.destroy'
  ]]);
  Route::group(['prefix' => 'enquiries'], function () {
    Route::post('enquiry_list', 'App\Http\Controllers\Admin\EnquiryController@enquiryList');
  });
  Route::get('enquiry_delete', 'App\Http\Controllers\Admin\EnquiryController@tradeEnquiryDelete');

//Model Management
  Route::resource('model_management', 'App\Http\Controllers\Admin\ModelManagementController', ['names' => [
    'create' => 'Admin.model_management.create',
    'index' => 'Admin.model_management.index',
    'store' => 'Admin.model_management.store',
    'edit' => 'Admin.model_management.edit',
    'update' => 'Admin.model_management.update',
    'destroy' => 'Admin.model_management.destroy'
  ]]);
  Route::group(['prefix' => 'model_management'], function () {
    Route::post('model_list', 'App\Http\Controllers\Admin\ModelManagementController@modelIdList');
    Route::get('{id}/upload', 'App\Http\Controllers\Admin\ModelManagementController@upload');
    Route::get('{id}/variants', 'App\Http\Controllers\Admin\ModelManagementController@variants');

    //Route::get('model_management/{id}/upload', [App\Http\Controllers\Admin\ModelManagementController::class, 'upload'])->name('Admin.model_management.upload');

    Route::post('upload_images', 'App\Http\Controllers\Admin\ModelManagementController@upload_images')->name('admin.model_management.upload_images');
    Route::post('/upload-files', [ModelManagementController::class, 'uploadFiles'])->name('upload.files');

    Route::post('/file-upload', [ModelManagementController::class, 'upload'])->name('file.upload');
Route::get('/file-list', [ModelManagementController::class, 'list'])->name('file.list');
Route::post('/file-delete', [ModelManagementController::class, 'delete'])->name('file.delete');

Route::post('/upload/store', 'App\Http\Controllers\Admin\ModelManagementController@storeCarImages');
Route::post('/variants_store', 'App\Http\Controllers\Admin\ModelManagementController@variantsStore');

  });


  //Service Requests
  Route::resource('service_request', 'App\Http\Controllers\Admin\ServiceRequestController', ['names' => [
    'create' => 'Admin.service_request.create',
    'index' => 'Admin.service_request.index',
    'store' => 'Admin.service_request.store',
    'edit' => 'Admin.service_request.edit',
    'update' => 'Admin.service_request.update',
    'destroy' => 'Admin.service_request'
  ]]);
  Route::group(['prefix' => 'service_request'], function () {
    Route::post('service_request_list', 'App\Http\Controllers\Admin\ServiceRequestController@serviceRequestList');
  });
  Route::get('service_request_delete', 'App\Http\Controllers\Admin\ServiceRequestController@serviceRequestDelete');

//New settings
  Route::resource('new_settings', 'App\Http\Controllers\Admin\NewSettingsController', ['names' => [
    'create' => 'Admin.new_settings.create',
    'index' => 'Admin.new_settings.index',
    'store' => 'Admin.new_settings.store',
    'edit' => 'Admin.new_settings.edit',
    'update' => 'Admin.new_settings.update',
    'destroy' => 'Admin.new_settings.destroy'
  ]]);
  Route::group(['prefix' => 'new_settings'], function () {
    Route::post('users_list', 'App\Http\Controllers\Admin\NewSettingsController@userList');
  });
  Route::get('user_delete', 'App\Http\Controllers\Admin\NewSettingsController@userDelete');
  Route::get('users_export', 'App\Http\Controllers\Admin\NewSettingsController@usersExport');
  Route::post('users_export', 'App\Http\Controllers\Admin\NewSettingsController@usersExport');




//Assign user
Route::resource('assign_users', 'App\Http\Controllers\Admin\AssignUserController', ['names' => [
  'create' => 'Admin.assign_users.create',
  'index' => 'Admin.assign_users.index',
  'store' => 'Admin.assign_users.store',
  'edit' => 'Admin.assign_users.edit',
  'update' => 'Admin.assign_users.update',
  'destroy' => 'Admin.assign_users.destroy'
]]);
Route::group(['prefix' => 'assign_users'], function () {
  Route::post('extended_warranty_list', 'App\Http\Controllers\Admin\AssignUserController@extendedWarrantyList');
});

//Staff Report
Route::resource('staff_report', 'App\Http\Controllers\Admin\StaffReportController', ['names' => [
  'create' => 'Admin.staff_report.create',
  'index' => 'Admin.staff_report.index',
  'store' => 'Admin.staff_report.store',
  'edit' => 'Admin.staff_report.edit',
  'update' => 'Admin.staff_report.update',
  'destroy' => 'Admin.staff_report.destroy'
]]);

Route::group(['prefix' => 'staff_report'], function () {
Route::post('staff_report_list', 'App\Http\Controllers\Admin\StaffReportController@extendedWarrantyList');
});
Route::get('staff_report_export', 'App\Http\Controllers\Admin\StaffReportController@extendedWarrantyExport');
Route::post('staff_report_export', 'App\Http\Controllers\Admin\StaffReportController@extendedWarrantyExport');

});
