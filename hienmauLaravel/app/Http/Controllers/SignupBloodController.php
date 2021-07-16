<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;
use App\Models\BloodDonation;
use App\Models\Hospital;
use App\Models\SignupBlood;
use App\Models\BloodActual;
use App\Models\CategoryNews;
use App\Models\News;
session_start();
class SignupBloodController extends Controller
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
    public function signup_blood()
   {
   		$customer_id=Session::get('customer_id');
    	if($customer_id)
    	{
        $category_news=CategoryNews::orderBy('category_news_id','desc')->where('category_news_status',1)->get();
    		$list_blood_donation=BloodDonation::orderBy('blood_donation_id','desc')->where('blood_finish_date','>',Carbon::now())->get();

    		return view('client.signupBlood.signup_blood')->with(compact('list_blood_donation','category_news'));
    	}else
    	{
    		return Redirect::to('/login')->send();
    	}
   		
   }
   public function sign_up_blood($bloodid)
   {
      $category_news=CategoryNews::orderBy('category_news_id','desc')->where('category_news_status',1)->get();
      $blood=BloodDonation::where('blood_donation_id',$bloodid)->first();
      $hospital=Hospital::where('hospital_id',$blood->hospital_id)->first();
      $data=[];
      
      $data[]=
      [
        'id'=>$blood->blood_donation_id,
        'name'=>$blood->blood_donation_name,
        'place'=>$blood->blood_donation_place,
        'object'=>$blood->blood_object,
        'hospital'=>$hospital->hospital_name,
        'time'=>date('h:i', strtotime($blood->blood_donation_time)).'--'.date('d-m-Y', strtotime($blood->blood_start_date))
      ];
      View::share('datas',$data);
      return view('client.signupBlood.sign_up_blood')->with(compact('category_news'));
   }
   public function filter_blood(Request $request)
   {
   		$blood_id=$request->blood_id;
   		$blood=BloodDonation::where('blood_donation_id',$blood_id)->first();
   		$hospital=Hospital::where('hospital_id',$blood->hospital_id)->first();
   		$data=[];
   		
		$data[]=
		[
			'place'=>$blood->blood_donation_place,
			'object'=>$blood->blood_object,
			'hospital'=>$hospital->hospital_name,
			'time'=>date('h:i', strtotime($blood->blood_donation_time)).'--'.date('d-m-Y', strtotime($blood->blood_start_date))
		];
   		return response()->json([
            'error'    => false,
            'response'=>$data,
            'messages' => "Lưu thành công",
        ], 200);
   }
   public function notification_sign_up_blood()
   {
      $category_news=CategoryNews::orderBy('category_news_id','desc')->where('category_news_status',1)->get();
   		return view('client.signupBlood.notification_blood')->with(compact('category_news'));
   }
   public function save_sign_up_blood(Request $request)
   {
   		$data=$request->all();
        $signup_blood=new SignupBlood();

        $customer_id=Session::get('customer_id');
        //new cho phép insert dữu liệu
        $signup_blood->blood_donation_id=$data['blood_donation_id'];
        $signup_blood->users_id=$customer_id;
        $signup_blood->signup_blood_weight=$data['signup_blood_weight'];
        $signup_blood->signup_blood_height=$data['signup_blood_height'];
        $signup_blood->signup_blood_landau=$data['landauhienmau'];
        $signup_blood->signup_blood_macbenh=$data['tungmaccacbenh'];
        $signup_blood->signup_blood_sutcan=$data['sutcan'];
        $signup_blood->signup_blood_noihach=$data['noihach'];
        $signup_blood->signup_blood_phauthuat=$data['phauthuat'];
        $signup_blood->signup_blood_xamminh=$data['xamminh'];
        $signup_blood->signup_blood_duoctruyenmau=$data['duoctruyenmau'];
        $signup_blood->signup_blood_matuy=$data['matuy'];
        $signup_blood->signup_blood_quanhe=$data['quanhe'];
        $signup_blood->signup_blood_cunggioi=$data['quanhecunggioi'];
        $signup_blood->signup_blood_vacxin=$data['vacxin'];
        $signup_blood->signup_blood_vungdich=$data['songtrongvungdich'];
        $signup_blood->signup_blood_bicum=$data['bicum'];
    		$signup_blood->signup_blood_khangsinh=$data['khangsinh'];
    		$signup_blood->signup_blood_chuarang=$data['chuarang'];  
    		$signup_blood->signup_blood_tantat=$data['tantat'];   


        $kinhnguyet='';
        $sinhcon='';
        if(isset($data['kinhnguyet']) && isset($data['sinhcon']))
        {
          $kinhnguyet=$data['kinhnguyet'];
          $sinhcon=$data['sinhcon'];
        } 

        
        $signup_blood->signup_blood_kinhnguyet=$kinhnguyet;   
        $signup_blood->signup_blood_sinhcon=$sinhcon;  
        
    		
    		$signup_blood->signup_blood_status=0;       
        
    		if($data['blood_donation_id']==null)
    		{
    			Session::put('error_blood','Bạn chưa chọn đợt hiến máu');
          return Redirect::to('/signup-blood');
    		}else
    		{
          $signup_blood_active=SignupBlood::where('users_id',$customer_id)->where('signup_blood_status',1)->get();
          $signup_blood_unactive=SignupBlood::where('users_id',$customer_id)->where('signup_blood_status',0)->get();
          if(count($signup_blood_active)>0 && count($signup_blood_unactive)==0)
          {
              foreach ($signup_blood_active as $key => $value) {
                  $blood_actual=BloodActual::where('signup_blood_id',$value['signup_blood_id'])->first();
                  if($blood_actual)
                  {
                      if($blood_actual->blood_actual_date < Carbon::now()->subDays(120))
                      {
                       $signup_blood->save();
                        return Redirect::to('/notification-sign-up-blood');
                      }else
                      {
                        Session::put('error_blood','Bạn đã hiến máu vào ngày '.date('d-m-Y', strtotime($blood_actual->blood_actual_date)).' và hiện tại bạn vẫn chưa thể thực hiện hiến máu tiếp tục. Thời gian tối thiểu của mỗi lẫn hiến máu là 4 Tháng. Xin cảm ơn !!!');
                        return Redirect::to('/signup-blood');
                      }
                  }else
                  {
                    Session::put('error_blood','Bạn đã được duyệt cho yêu cầu đăng ký hiến máu. Xin hãy kiểm tra thông tin diễn ra đợt hiến máu, và mong bạn đến đúng giờ. Xin cảm ơn !!!');
                        return Redirect::to('/signup-blood');
                  }
                  
              } 
              
          }else
          {
              $signup_blood_unactive=SignupBlood::where('users_id',$customer_id)->where('signup_blood_status',0)->get();
              if(count($signup_blood_unactive)>0)
              {
                Session::put('error_blood','Bạn đã thực hiện đăng ký một đợt hiến máu rồi. Nếu muốn đăng ký thêm đợt hiến máu, bạn hãy vui lòng hủy đăng ký đợt hiến máu trước đó. Xin cảm ơn !!!');
                return Redirect::to('/signup-blood');
              }else
              {
                $signup_blood->save();
                return Redirect::to('/notification-sign-up-blood');//đường dẫn
              }
              
          }
    			
    		}     
    }
    public function notification()
    {

   		$customer_id=Session::get('customer_id');
   		$customer_name=Session::get('customer_name');
      $category_news=CategoryNews::orderBy('category_news_id','desc')->where('category_news_status',1)->get();
    	if($customer_id)
    	{
    		$signup_blood=SignupBlood::where('users_id',$customer_id)->orderBy('signup_blood_id','desc')->get();
        $data=[];
    		foreach($signup_blood as $key => $value)
    		{
    			$blood=BloodDonation::where('blood_donation_id',$value['blood_donation_id'])->first();
    			$blood_name=$blood['blood_donation_name'];
    			$blood_time=date('h:i', strtotime($blood['blood_donation_time'])).'--'.date('d-m-Y', strtotime($blood['blood_start_date']));
    			$blood_status="";
    			if($value['signup_blood_status']==1)
    			{
    				$blood_status="Đã Duyệt";
    			}
    			else
    			{
    				$blood_status="Chưa Duyệt";
    			}
    			$key=$value['signup_blood_id'];
    			$data[$key]=
	    		[
	    			'name'=>$customer_name,
	    			'blood'=>$blood_name,
	    			'time'=>$blood_time,
	    			'status'=>$blood_status,
            'blood_status'=>$value['signup_blood_status'],
	    			'note'=>$value['signup_blood_note']
	    		];
    		}
    		return view('client.signupBlood.notification_status')->with(compact('data','category_news'));
    	}else
    	{
    		return Redirect::to('/login')->send();
    	}
    	
    }
    public function list_signup_blood()
    {
    	$this->check_login();
    	$list_signup_blood=DB::table('tbl_signup_blood')
    	->join('tbl_users','tbl_signup_blood.users_id','=','tbl_users.users_id')
    	->join('tbl_blood_donation','tbl_signup_blood.blood_donation_id','=','tbl_blood_donation.blood_donation_id')
    	->select('tbl_signup_blood.*','tbl_users.users_fullname','tbl_blood_donation.blood_donation_name')
    	->orderBy('tbl_signup_blood.signup_blood_id','desc')->get();
    	return view('admin.signupBlood.index')->with(compact('list_signup_blood'));
    }
    public function show_data(Request $request)
    {
        $signup_blood_id=$request->signup_blood_id;
        $list_signup_blood=DB::table('tbl_signup_blood')
        ->join('tbl_users','tbl_signup_blood.users_id','=','tbl_users.users_id')
        ->where('tbl_signup_blood.signup_blood_id',$signup_blood_id)
        ->select('tbl_signup_blood.*','tbl_users.users_fullname','tbl_users.users_blood')
        ->first();
        
        $landau="";
        $macbenh="";
        $sutcan="";
        $noihach="";
        $phauthuat="";
        $xamminh="";
        $duoctruyenmau=""; $matuy=""; $quanhe="";$quanhecunggioi="";
        $vacxin="";$vungdich="";$bicum="";$khangsinh="";$chuarang="";
        $tantat="";$kinhnguuet="";$sinhcon="";
        
        $fullname=$list_signup_blood->users_fullname;
        $blood_group=$list_signup_blood->users_blood;
        
        if($list_signup_blood->signup_blood_landau==0)
        {
          $landau="Không";
        }else
        {
          $landau="Có";
        }
        if($list_signup_blood->signup_blood_macbenh==0)
        {
          $macbenh="Không";
        }else
        {
          $macbenh="Có";
        }
        if($list_signup_blood->signup_blood_sutcan==0)
        {
          $sutcan="Không";
        }else
        {
          $sutcan="Có";
        }
        if($list_signup_blood->signup_blood_noihach==0)
        {
          $noihach="Không";
        }else
        {
          $noihach="Có";
        }
        if($list_signup_blood->signup_blood_phauthuat==0)
        {
          $phauthuat="Không";
        }else
        {
          $phauthuat="Có";
        }
        if($list_signup_blood->signup_blood_xamminh==0)
        {
          $xamminh="Không";
        }else
        {
          $xamminh="Có";
        }
        if($list_signup_blood->signup_blood_duoctruyenmau==0)
        {
          $duoctruyenmau="Không";
        }else
        {
          $duoctruyenmau="Có";
        }
        if($list_signup_blood->signup_blood_matuy==0)
        {
          $matuy="Không";
        }else
        {
          $matuy="Có";
        }
        if($list_signup_blood->signup_blood_quanhe==0)
        {
          $quanhe="Không";
        }else
        {
          $quanhe="Có";
        }
        if($list_signup_blood->signup_blood_cunggioi==0)
        {
          $quanhecunggioi="Không";
        }else
        {
          $quanhecunggioi="Có";
        }
        if($list_signup_blood->signup_blood_vacxin==0)
        {
          $vacxin="Không";
        }else
        {
          $vacxin="Có";
        }
        if($list_signup_blood->signup_blood_vungdich==0)
        {
          $vungdich="Không";
        }else
        {
          $vungdich="Có";
        }
        if($list_signup_blood->signup_blood_bicum==0)
        {
          $bicum="Không";
        }else
        {
          $bicum="Có";
        }
        if($list_signup_blood->signup_blood_khangsinh==0)
        {
          $khangsinh="Không";
        }else
        {
          $khangsinh="Có";
        }
        if($list_signup_blood->signup_blood_chuarang==0)
        {
          $chuarang="Không";
        }else
        {
          $chuarang="Có";
        }
        if($list_signup_blood->signup_blood_tantat==0)
        {
          $tantat="Không";
        }else
        {
          $tantat="Có";
        }

        if($list_signup_blood->signup_blood_kinhnguyet !=null)
        {
            if($list_signup_blood->signup_blood_kinhnguyet==0)
            {
              $kinhnguuet="Không";
            }else
            {
              $kinhnguuet="Có";
            }
        }else
        {
            $kinhnguuet="";
        }
        

        if($list_signup_blood->signup_blood_sinhcon != null)
        {
            if($list_signup_blood->signup_blood_sinhcon==0)
            {
              $sinhcon="Không";
            }else
            {
              $sinhcon="Có";
            }
        }else
        {
            $sinhcon="";
        }
        

        


        $key=$list_signup_blood->signup_blood_id;
        $data[$key]=
        [
          'landau'=>$landau,'macbenh'=>$macbenh,'sutcan'=>$sutcan,'noihach'=>$noihach,
          'phauthuat'=>$phauthuat,'xamminh'=>$xamminh,'duoctruyenmau'=>$duoctruyenmau,
          'matuy'=>$matuy,'quanhe'=>$quanhe,'cunggioi'=>$quanhecunggioi,'vacxin'=>$vacxin,
          'vungdich'=>$vungdich,'bicum'=>$bicum,'khangsinh'=>$khangsinh,'chuarang'=>$chuarang,
          'tantat'=>$tantat,'kinhnguyet'=>$kinhnguuet,'sinhcon'=>$sinhcon

        ];
        $dataname[]=
        [
          'fullname'=>$fullname,
          'users_blood'=>$blood_group
        ];
        return response()->json([
            'error'    => false,
            'response'=>$data,
            'responses'=>$dataname,
            'messages' => "Lưu thành công",
        ], 200);

    }
    public function active_signup_blood(Request $request)
    {
        $signup_blood_id=$request->signup_blood_id;
        $signup_blood=SignupBlood::find($signup_blood_id);
        $signup_blood->signup_blood_status=1;
        $signup_blood->save();
    }
    public function reply_note_signup_blood(Request $request)
    {
        $request->validate([
            'sign_note'=>'required',
        ]);

        $signup_blood_id=$request->signup_blood_id;
        $signup_blood_note=$request->sign_note;

        $signup_blood=SignupBlood::find($signup_blood_id);
        $signup_blood->signup_blood_note=$signup_blood_note;

        $signup_blood->save();
        
        
    }
    public function delete_signup_blood(Request $request)
    {
        $signup_blood_id=$request->signup_blood_id;
        $signup_blood=SignupBlood::find($signup_blood_id);
        $signup_blood->delete();
    }
    public function history_blood()
    {
      $customer_id=Session::get('customer_id');
      $customer_name=Session::get('customer_name');
      if($customer_id)
      {
          $sign_blood=SignupBlood::where('users_id', $customer_id)->where('signup_blood_status',1)->get();
          $data=[];
          foreach ($sign_blood as $key => $value) {
            $blood_actual=BloodActual::where('signup_blood_id',$value['signup_blood_id'])->first();
            $blood_donation=BloodDonation::where('blood_donation_id',$value['blood_donation_id'])->first();
              $data[]=
              [
                'blood_name'=>$blood_donation->blood_donation_name,
                'blood_group'=>$blood_actual->blood_actual_group,
                'blood_unit'=>$blood_actual->blood_actual_unit,
                'blood_actual_date'=>$blood_actual->blood_actual_date,
                'blood_donation_place'=>$blood_donation->blood_donation_place
              ];
          }
          $category_news=CategoryNews::orderBy('category_news_id','desc')->where('category_news_status',1)->get();
          View::share('history_blood',$data);
          return view('client.historyBlood.historyBlood')->with(compact('category_news'));
      }else
      {
          return Redirect::to('/login')->send();
      }
      
    }
    public function blood_donation_schedule()
    {
      $customer_id=Session::get('customer_id');
      if($customer_id)
      {
        $category_news=CategoryNews::orderBy('category_news_id','desc')->where('category_news_status',1)->get();
        $blood_donation=BloodDonation::orderBy('blood_donation_id','desc')->where('blood_status',1)->get();
        return view('client.signupBlood.blood_donation_schedule')->with(compact('category_news','blood_donation'));
      }else
      {
        return Redirect::to('/login')->send();
      }
    }
}
