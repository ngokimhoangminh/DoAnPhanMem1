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
use App\Models\News;
session_start();
class NewsController extends Controller
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
    public function list_news()
    {
    	$this->check_login();
    	// $list_news=DB::table('tbl_news')
    	// ->join('tbl_category_news','tbl_news.category_news_id','=','tbl_category_news.category_news_id')
    	// ->select('tbl_news.*','tbl_category_news.category_news_name')
    	// ->orderBy('tbl_news.news_id','desc')
    	// ->get();
    	$list_news=News::with('category_news')->orderBy('news_id','desc')->get();
    	return view('admin.news.index')->with(compact('list_news'));
    }
    public function add_news()
    {
    	$this->check_login();
    	$categorynews=CategoryNews::orderBy('category_news_id','desc')->get();
    	return view('admin.news.add')->with(compact('categorynews'));
    }
    public function save_news(Request $request)
    {
        $this->check_login();
        
        $data=$request->all();
        $news=new News();

        $news->category_news_id=$data['category_news_id'];
        $news->news_title=$data['news_title'];
       	$news->news_slug=$data['news_slug'];
        $news->news_desc=$data['news_desc'];
        $news->news_content=$data['news_content'];
        $news->news_meta_des=$data['news_meta_des'];
        $news->news_meta_keysword=$data['news_meta_keysword'];
        $news->news_meta_status=$data['news_status'];
        $news->news_date=Carbon::now();

        $get_image=$request->file('news_image');
        if($get_image)
        {

            $get_name_image=$get_image->getClientOriginalName();
            $get_name_split=current(explode('.',$get_name_image));
            //current lấy chuỗi cắt đầu tiên
            $name_image=$get_name_split.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            //getClientOriginalExtension()lấy đuôi ảnh
            $get_image->move('assets/admin/uploads/news',$name_image);
            $news->news_image=$name_image;
            $news->save();
            Session::put('message','Thêm tin tức thành công');
            return Redirect::to('/list-news');//đường dẫn

        }else
        {
	        Session::put('message','Làm ơn thêm hình ảnh');
	        return redirect()->back();//đường dẫn
        }
        
    }
    public function delete_news(Request $request)
    {
        $news_id=$request->news_id;
        $news=News::find($news_id);
        $news_image=$news->news_image;
        if($news_image)
        {
        	$path='assets/admin/uploads/news/'.$news_image;
        	unlink($path);
        }
        $news->delete();
        
        
    }
    public function update_news($newsid)
    {
    	$news=News::where('news_id',$newsid)->get();
        $categorynews=CategoryNews::orderBy('category_news_id','desc')->get();
        return view('admin.news.edit')->with(compact('news','categorynews'));

    }
    public function edit_news(Request $request, $newsid)
    {
    	
    	 $this->check_login();
        
        $data=$request->all();
        $news=News::find($newsid);

        $news->category_news_id=$data['category_news_id'];
        $news->news_title=$data['news_title'];
       	$news->news_slug=$data['news_slug'];
        $news->news_desc=$data['news_desc'];
        $news->news_content=$data['news_content'];
        $news->news_meta_des=$data['news_meta_des'];
        $news->news_meta_keysword=$data['news_meta_keysword'];
        $news->news_meta_status=$data['news_status'];
        $news->news_date=Carbon::now();

        $get_image=$request->file('news_image');
        if($get_image)
        {

        	//xóa ảnh cữ
        	$news_image_old=$news->news_image;
       
        	$path='assets/admin/uploads/news/'.$news_image_old;
        	unlink($path);
        

            $get_name_image=$get_image->getClientOriginalName();
            $get_name_split=current(explode('.',$get_name_image));
            //current lấy chuỗi cắt đầu tiên
            $name_image=$get_name_split.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            //getClientOriginalExtension()lấy đuôi ảnh
            $get_image->move('assets/admin/uploads/news',$name_image);
            $news->news_image=$name_image;
            
        }
        $news->save();
        Session::put('message','Cập nhật tin tức thành công');
        return Redirect::to('/list-news');//đường dẫn

    }
    public function bai_viet($news_slug)
    {
        $news_detail=News::where('news_slug',$news_slug)->take(1)->get();
        $category_news=CategoryNews::orderBy('category_news_id','desc')->where('category_news_status',1)->get();

        foreach ($news_detail as $key => $value) {
            $category_news_id=$value->category_news_id;
        }
        $related=News::with('category_news')->where('news_meta_status',1)->where('category_news_id',$category_news_id)->whereNotIn('news_slug',[$news_slug])->get();
    	return view('client.news.detail')->with(compact('news_detail','category_news','related'));
    }
    public function danh_muc_bai_viet($category_news_slug)
    {
        $category_news=CategoryNews::orderBy('category_news_id','desc')->where('category_news_status',1)->get();

        $cat_news=CategoryNews::where('category_news_slug',$category_news_slug)->take(1)->get();

        foreach ($cat_news as $key => $value) {
            $cat_news_name=$value->category_news_name;
            $cat_news_id=$value->category_news_id;
        }
        $news=News::with('category_news')->where('news_meta_status',1)->where('category_news_id',$cat_news_id)->paginate(5);

        return view('client.news.categorynews')->with(compact('category_news','news','cat_news_name'));
    }
    
}
