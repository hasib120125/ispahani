<?php
Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();
// DUPL User Registration
Route::resource('user-registration', 'HomeController');
//Academic Information
Route::resource('academic-information', 'AcademicController');
//Administration
Route::resource('messages', 'AdministrationController');
//Page Contents Information
Route::resource('contents-category', 'ContentCategoryController');
Route::resource('contents-information', 'ContentsMasterController');
//Notice information
Route::resource('notice-category', 'NoticeCategoryController');
Route::resource('notice-information', 'NoticeController');
//Teacher and Staff Information
Route::resource('staff-department', 'StaffDepartmentController');
Route::resource('teacher-staff', 'TeacherStaffController');
// Photo Gallery
Route::resource('album-category', 'AlbumCategoryController');
Route::resource('album-group', 'AlbumGroupController');
Route::resource('album-image', 'AlbumImageController');
Route::resource('others-image', 'OtherImageController');
Route::post('select-image-group', ['as'=>'select-image-group','uses'=>'AlbumGroupController@selectGroup']);
//Video Gallery
Route::resource('video-gallery', 'VideoController');
//Generate HTML
Route::get('generate/{iContentsID}/{iCategoryID}', 'GenerateHTMLController@index');
