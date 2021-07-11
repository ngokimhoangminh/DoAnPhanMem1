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
//client

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
Route::post('/filter-blood','App\Http\Controllers\SignupBloodController@filter_blood');
Route::post('/save-sign-up-blood','App\Http\Controllers\SignupBloodController@save_sign_up_blood');
Route::get('/notification-sign-up-blood','App\Http\Controllers\SignupBloodController@notification_sign_up_blood');

//nitfication
Route::get('/notification','App\Http\Controllers\SignupBloodController@notification');