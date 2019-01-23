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

//Frontend Routes Start

Route::get('/', 'HomeController@index');

Route::get('/at-a-glance', 'HomeController@atAglance');

Route::get('/why-study-ipsc', 'HomeController@whyStudyIpsc');

Route::get('/history', 'HomeController@history');

Route::get('/infrastructure', 'HomeController@infrastructure');

Route::get('/achievement', 'HomeController@achievement');

Route::get('/news-events', 'HomeController@newsEvents');

Route::get('/details/{id}', 'HomeController@details');

Route::get('/governing-body', 'HomeController@governingBody');

Route::get('/message-chairman', 'HomeController@messageChairman');

Route::get('/message-principle', 'HomeController@messagePrinciple');

Route::get('/teacher', 'HomeController@teacher');

Route::get('/staff', 'HomeController@staff');

Route::get('/academic-calendar', 'HomeController@academicCalendar');

Route::get('/holiday-calendar', 'HomeController@holidayCalendar');

Route::get('/class-routine', 'HomeController@classRoutine');

Route::get('/syllabus', 'HomeController@syllabus');

Route::get('/exam-routine', 'HomeController@examRoutine');

Route::get('/public-exam-result','HomeController@publicExamresult');

Route::get('/internal-exam-result','HomeController@internalExamresult');

Route::get('/notice', 'HomeController@notice');

Route::get('/notice-details/{id}', 'HomeController@noticeDetails');

Route::get('/admission-circular', 'HomeController@admissionCircular');

Route::get('/prospectus', 'HomeController@prospectus');

Route::get('/admission-result', 'HomeController@admissionResult');

Route::get('/waiting-list', 'HomeController@waitingList');

Route::get('/file-details/{id}', 'HomeController@fileDetails');

Route::get('/student-hostel', 'HomeController@studentHostel');

Route::get('/transport', 'HomeController@transport');

Route::get('/staff-quarter', 'HomeController@staffQuarter');

Route::get('/sports', 'HomeController@sports');

Route::get('/tours', 'HomeController@tours');

Route::get('/physial-activities', 'HomeController@physicalActivities');

Route::get('/international-achievements', 'HomeController@intAchievement');

Route::get('/debating-club', 'HomeController@debatingClub');

Route::get('/science-club', 'HomeController@scienceClub');

Route::get('/ict-club', 'HomeController@ictClub');

Route::get('/art-club', 'HomeController@artClub');

Route::get('/photo-gallery', 'HomeController@albumCategory');

Route::get('/photo-album/{id}', 'HomeController@albumGroup');

Route::get('/gallery-details/{id}', 'HomeController@photoDetails');

Route::get('/video-gallery', 'HomeController@videoGallery');

Route::get('/video-details/{id}/{sVideoID}', 'HomeController@videoDetails');


//Frontend Routes End
