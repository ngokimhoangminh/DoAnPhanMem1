<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;
use App\Models\BloodActual;
use App\Models\BloodDonation;
use App\Models\SignupBlood;
use App\Models\Users;
use App\Models\CategoryNews;
session_start();

class CategoryNewsController extends Controller
{
    //
    public function check_login()
    {
    	$admin_id=Session::get('admin_id');
    	if($admin_id)
    	{
    		return Redirect::to('/dashboard');
    	}else
    	{
    		return Redirect::to('/admin')->send();
    	}
    }
    public function list_category_news()
    {
    	$this->check_login();
        $categorynews=CategoryNews::orderby('category_news_id','desc')->get();
    	return view('admin.categorynews.index')->with(compact('categorynews'));
    }
    
    public function save_category_news(Request $request)
    {
        $this->check_login();
    	$request->validate([
            'category_news_name'=>'required',
            'category_news_slug'=>'required',
            'category_news_des'=>'required',
            'category_news_status'=>'required'
        ]);
    	$category_news_name=$request->category_news_name;
        $category_news_slug=$request->category_news_slug;
    	$category_news_des=$request->category_news_des;
    	$category_news_status=$request->category_news_status;


    	$categorynews=new CategoryNews();
    	$categorynews->category_news_name=$category_news_name;
        $categorynews->category_news_slug=$category_news_slug;
    	$categorynews->category_news_des=$category_news_des;
    	$categorynews->category_news_status=$category_news_status;
    	
    	$categorynews->save();
    }
    public function update_category_news($categorynewsid)
    {
    	$data=[];
    	$category_news=CategoryNews::where('category_news_id',$categorynewsid)->get();
        return view('admin.categorynews.edit')->with('value_news',$category_news);
    }
    public function edit_category_news(Request $request)
    {
        $category_news_id=$request->category_news_id;
    	$category_news_name=$request->category_news_name;
        $category_news_slug=$request->category_news_slug;
        $category_news_des=$request->category_news_des;
        $category_news_status=$request->category_news_status;

    	$category_news=CategoryNews::find($category_news_id);
        $category_news->category_news_name=$category_news_name;
        $category_news->category_news_slug=$category_news_slug;
        $category_news->category_news_des=$category_news_des;
        $category_news->category_news_status=$category_news_status;
        $category_news->save();
    }
    public function delete_category_news(Request $request)
    {
        $category_news_id=$request->category_news_id;
        $category_news=CategoryNews::find($category_news_id);
        $category_news->delete();
    }
}
