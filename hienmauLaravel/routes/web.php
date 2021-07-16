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
use App\Http\Controllers\HomeController;
Route::get('/', [HomeController::class, 'index']);

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/trang-chu','App\Http\Controllers\HomeController@index');
Route::post('/search-news','App\Http\Controllers\HomeController@search_news');
//BACKEND
Route::get('/admin','App\Http\Controllers\Admincontroller@index');
Route::get('/dashboard','App\Http\Controllers\Admincontroller@show_dashboard');
Route::post('/admin_login','App\Http\Controllers\Admincontroller@login');
Route::get('/admin_logout','App\Http\Controllers\Admincontroller@logout');


//Hospital
Route::get('/list-hospital','App\Http\Controllers\HospitalController@list_hospital');
Route::get('/add-hospital','App\Http\Controllers\HospitalController@add_hospital');
Route::post('/save-hospital','App\Http\Controllers\HospitalController@save_hospital');
Route::get('/update-hospital/{hospitalid}','App\Http\Controllers\HospitalController@update_hospital');
Route::post('/edit-hospital','App\Http\Controllers\HospitalController@edit_hospital');
Route::post('/delete-hospital','App\Http\Controllers\HospitalController@delete_hospital');
Route::get('/unactive_status_hospital/{hospital_id}','App\Http\Controllers\HospitalController@unactive_status_hospital');
Route::get('/active_status_hospital/{hospital_id}','App\Http\Controllers\HospitalController@active_status_hospital');

//Employee
Route::get('/list-employee','App\Http\Controllers\EmployeeController@list_employee');
Route::post('/save-employee','App\Http\Controllers\EmployeeController@save_employee');
Route::get('/update-employee/{employeeid}','App\Http\Controllers\EmployeeController@update_employee');
Route::post('/edit-employee/{employeeid}','App\Http\Controllers\EmployeeController@edit_employee');
Route::post('/delete-employee','App\Http\Controllers\EmployeeController@delete_employee');
Route::get('/unactive_status_employee/{employeeid}','App\Http\Controllers\EmployeeController@unactive_status_employee');
Route::get('/active_status_employee/{employeeid}','App\Http\Controllers\EmployeeController@active_status_employee');

//BloodDonation
Route::get('/list-blooddonation','App\Http\Controllers\BloodDonationController@list_blooddonation');
Route::post('/save-blooddonation','App\Http\Controllers\BloodDonationController@save_blooddonation');
Route::get('/update-blood-donation/{bloodid}','App\Http\Controllers\BloodDonationController@update_blood_donation');
Route::post('/edit-blood-donation/{bloodid}','App\Http\Controllers\BloodDonationController@edit_blood_donation');
Route::post('/delete-blood_donation','App\Http\Controllers\BloodDonationController@delete_blood_donation');
Route::get('/unactive_status_blood/{bloodid}','App\Http\Controllers\BloodDonationController@unactive_status_blood');
Route::get('/active_status_blood/{bloodid}','App\Http\Controllers\BloodDonationController@active_status_blood');
Route::get('/report-list-blood/{bloodid}','App\Http\Controllers\BloodDonationController@report_list_blood');
//signupBlood
Route::get('/list-signUpblood','App\Http\Controllers\SignupBloodController@list_signup_blood');
Route::post('/show-data','App\Http\Controllers\SignupBloodController@show_data');
Route::post('/active-signup-blood','App\Http\Controllers\SignupBloodController@active_signup_blood');
Route::post('/reply-note-signup-blood','App\Http\Controllers\SignupBloodController@reply_note_signup_blood');
Route::post('/delete-signup-blood','App\Http\Controllers\SignupBloodController@delete_signup_blood');
//blood_actual
Route::get('/list-blood-actual','App\Http\Controllers\BloodActualController@list_blood_actual');
Route::post('/filter-user','App\Http\Controllers\BloodActualController@filter_user');
Route::post('/save-blood-actual','App\Http\Controllers\BloodActualController@save_blood_actual');
Route::get('/update-blood-actual/{bloodactualid}','App\Http\Controllers\BloodActualController@update_blood_actual');
Route::post('/edit-blood-actual','App\Http\Controllers\BloodActualController@edit_blood_actual');
Route::post('/delete-blood-actual','App\Http\Controllers\BloodActualController@delete_blood_actual');


//category_news
Route::get('/list-category-news','App\Http\Controllers\CategoryNewsController@list_category_news');
Route::post('/save-category-news','App\Http\Controllers\CategoryNewsController@save_category_news');
Route::get('/update-category-news/{categorynewsid}','App\Http\Controllers\CategoryNewsController@update_category_news');
Route::post('/edit-category-news','App\Http\Controllers\CategoryNewsController@edit_category_news');
Route::post('/delete-category-news','App\Http\Controllers\CategoryNewsController@delete_category_news');

//news
Route::get('/list-news','App\Http\Controllers\NewsController@list_news');
Route::get('/add-news','App\Http\Controllers\NewsController@add_news');
Route::post('/save-news','App\Http\Controllers\NewsController@save_news');
Route::post('/delete-news','App\Http\Controllers\NewsController@delete_news');
Route::get('/update-news/{newsid}','App\Http\Controllers\NewsController@update_news');
Route::post('/edit-news/{newsid}','App\Http\Controllers\NewsController@edit_news');
//client

//news
Route::get('/bai-viet/{news_slug}','App\Http\Controllers\NewsController@bai_viet');
Route::get('/danh-muc-bai-viet/{category_news_slug}','App\Http\Controllers\NewsController@danh_muc_bai_viet');


//sign-up
Route::get('/sign-up','App\Http\Controllers\UsersController@sign_up');
Route::post('/save-sign-up','App\Http\Controllers\UsersController@save_sign_up');
Route::get('/notification-sign-up','App\Http\Controllers\UsersController@notification_sign_up');

//login
Route::get('/login','App\Http\Controllers\UsersController@login');
Route::post('/login-system','App\Http\Controllers\UsersController@login_system');
Route::get('/logout','App\Http\Controllers\UsersController@logout');


//sign-up blood
Route::get('/signup-blood','App\Http\Controllers\SignupBloodController@signup_blood');
Route::get('/sign-up-blood/{bloodid}','App\Http\Controllers\SignupBloodController@sign_up_blood');
Route::post('/filter-blood','App\Http\Controllers\SignupBloodController@filter_blood');
Route::post('/save-sign-up-blood','App\Http\Controllers\SignupBloodController@save_sign_up_blood');
Route::get('/notification-sign-up-blood','App\Http\Controllers\SignupBloodController@notification_sign_up_blood');

//nitfication
Route::get('/notification','App\Http\Controllers\SignupBloodController@notification');

//historyBlood
Route::get('/history-blood','App\Http\Controllers\SignupBloodController@history_blood');

//blood-donation-schedule
Route::get('blood-donation-schedule','App\Http\Controllers\SignupBloodController@blood_donation_schedule');