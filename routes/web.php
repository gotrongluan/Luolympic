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
use Illuminate\Http\Request;

// Route::get('home-page', function() {

// });
// Route::get('/', function() {
// 	return view('welcome');
// });
Route::get('/home-page', function () {
	return view('user.home-page');
});
Route::get('login', 'DSTARController@accessLoginPage');
Route::get('common/process-login', ['as'=>'process-login', 'uses'=>'DSTARController@processLogin']);
Route::get('admin/dashboard', 'DSTARController@accessAdminDashboardPage');
Route::get('admin/user-management/{page?}', 'BachKhoaController@accessAdminUserManagementPage');
Route::get('admin/statistic/province/{prov_id?}/{dist_id?}/{school_id?}', 'DSTARController@accessAdminStatisticProvincePage')->where(['prov_id' => '[0-9]+', 'dist_id' => '[0-9]+', 'school_id' => '[0-9]+']);
Route::get('admin/statistic/time/{year}', 'BachKhoaController@accessAdminStatisticTimePage')->where(['year' => '[0-9]+']);
Route::get('admin/statistic/grade', 'BachKhoaController@accessAdminStatisticGradePage');
Route::get('admin/account-management', 'DSTARController@accessAdminAccountManagementPage');
Route::get('admin/competition-management/{class?}', 'BachKhoaController@accessAdminCompetitionManagementPage');
Route::get('admin/comment-management', 'DSTARController@accessAdminCommentManagementPage');
Route::get('admin/student-information/{stu_id}', 'BachKhoaController@accessStudentInformationPage')->where(['stu_id' => '[0-9]+']);
Route::get('admin/round-management/{class}/{round_val}', 'BachKhoaController@adminRoundManagement');
Route::get('admin/custom-current-new-round/{class}/{is_new?}', 'BachKhoaController@customCurrentNewRound');
Route::get('admin/detail-question/{ques_id}/{unie}', 'BachKhoaController@detailQuestion');
Route::get('admin/add-new-question/{unie}/{type}/{class}/{round_val}', 'BachKhoaController@addNewQuestion');
Route::get('admin/delete-question', 'BachKhoaController@deleteQuestion');
Route::post('admin/process-new-round', 'BachKhoaController@processNewRound');
Route::post('admin/process-new-essay', 'BachKhoaController@adminProcessNewEssay');
Route::post('admin/process-new-multi-choice', 'BachKhoaController@adminProcessNewMultiChoice');
Route::post('admin/process-new-multi-select', 'BachKhoaController@adminProcessNewMultiSelect');
Route::get('admin/delete-student-account', 'BachKhoaController@deleteStudentAccount');
Route::get('change-province', 'DSTARController@changeProvince');
Route::get('get-admin-password', 'DSTARController@getAdminPassword');
Route::get('admin/news-management', 'BachKhoaController@adminNewsManagement');
Route::post('update-admin-info', 'BachKhoaController@updateAdminInfo');
Route::post('change-admin-password', 'BachKhoaController@changeAdminPassword');
Route::get('admin/delete-news-subject', 'BachKhoaController@deleteNewsSubject' );
Route::post('admin/edit-news-subject', 'BachKhoaController@editNewsSubject');
Route::post('admin/add-news-subject', 'BachKhoaController@addNewsSubject');
Route::get('admin/detail-news-subject/{sub-id}', 'BachKhoaController@adminDetailNewsSubject');
Route::get('exo/{a?}/{b?}', function( $a = 1, $b = 1 ) {
	// $abc = $request->all();
	// echo "<pre>";
	// print_r( $abc );
	// echo "</pre>";
	print_r($a);
	echo "<br>";
	print_r($b);
});
Route::get('xyz', function () {
	echo "<pre>";
	print_r( $data );
	echo "</pre>";
});
