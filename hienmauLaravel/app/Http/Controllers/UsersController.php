<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Models\Users;
use App\Models\CategoryNews;
use App\Models\News;
session_start();
class UsersController extends Controller
{
    //
    
    public function sign_up()
    {
        $category_news=CategoryNews::orderBy('category_news_id','desc')->where('category_news_status',1)->get();
    	return view('client.signUp.signup')->with(compact('category_news'));
    }
    public function notification_sign_up()
    {
        $category_news=CategoryNews::orderBy('category_news_id','desc')->where('category_news_status',1)->get();
    	return view('client.signUp.notification')->with(compact('category_news'));
    }
    public function checkUserName($user_name)
    {
    	$user=Users::where('users_name',$user_name)->get();
    	return $user;
    }
    public function checkUserPhone($user_phone)
    {
    	$phone=Users::where('users_phone',$user_phone)->get();
    	return $phone;
    }
    public function save_sign_up(Request $request)
    {
    	$data=$request->all();
        $users=new Users();
        //new cho phép insert dữu liệu
        $users->users_fullname=$data['users_fullname'];
        $users->users_name=$data['users_name'];
        $users->users_blood=$data['users_blood'];
        $users->users_email=$data['users_email'];
        $users->users_phone=$data['users_phone'];
        $users->users_cmnd=$data['users_cmnd'];
        $users->users_password=md5($data['users_password']);
        $users->users_gender=$data['users_gender'];
        $users->users_date=$data['users_date'];
        $users->users_school=$data['users_scholl'];
        $users->users_job=$data['users_jog'];
        $users->users_workplace=$data['users_workplace'];
        $users->users_address=$data['users_address'];

        $check_name=$this->checkUserName($data['users_name']);
        $check_phone=$this->checkUserPhone($data['users_phone']);
        if(count($check_name) > 0  && count($check_phone) >0)
        {
        	Secheck_phonession::put('error_name','Tên đăng nhập đã được sử dụng');
        	Session::put('error_phone','Số điện thoại đã được sử dụng');
        	return Redirect::to('/sign-up');
        }else if(count($check_name) > 0)
        {
        	Session::put('error_name','Tên đăng nhập đã được sử dụng');
        	return Redirect::to('/sign-up');
        }else if(count($check_phone)>0)
        {
        	Session::put('error_phone','Số điện thoại đã được sử dụng');
        	return Redirect::to('/sign-up');
        }
        else
        {
        	$users->save();
        	return Redirect::to('/notification-sign-up');//đường dẫn
        }
    }
    public function login()
    {
        $category_news=CategoryNews::orderBy('category_news_id','desc')->where('category_news_status',1)->get();
    	return view('client.login.login')->with(compact('category_news'));
    }
    public function login_system(Request $request)
    {
    	$users_name=$request->users_name;
    	$users_password=md5($request->users_password);
    	$result=Users::where('users_name',$users_name)->where('users_password',$users_password)->first();
    	if($result)
    	{
    		Session::put('customer_name',$result->users_fullname);
    		Session::put('customer_id',$result->users_id);
    		return Redirect::to('/trang-chu');
    	}else
    	{
    		Session::put('error_login','Tên đăng nhập hoặc mật khẩu bị sai');
            return Redirect::to('/login');
    	}
    }
    public function logout()
    {
    	Session::put('customer_name',null);
    	Session::put('customer_id',null);
    	return Redirect::to('/trang-chu');
    }
}
