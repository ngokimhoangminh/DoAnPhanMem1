<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use App\Models\BloodActual;
use App\Models\BloodDonation;
use App\Models\SignupBlood;
use App\Models\Users;
use App\Models\CategoryNews;
use App\Models\News;
session_start();;
class HomeController extends Controller
{
    //
    public function index()
    {
    	$news=News::orderBy('news_id','desc')->where('news_meta_status',1)->paginate(6);
    	$category_news=CategoryNews::orderBy('category_news_id','desc')->where('category_news_status',1)->get();
    	return view('client.home')->with(compact('news','category_news'));
    }
    public function search_news(Request $request)
    {
        $keywords=$request->keywords;
       
        $category_news=CategoryNews::orderBy('category_news_id','desc')->where('category_news_status',1)->get();
       
        $news=News::where('news_title','like','%'.$keywords.'%')->where('news_meta_status','1')->get();       
        return view('client.news.search')->with(compact('news','category_news'));
    }
}
