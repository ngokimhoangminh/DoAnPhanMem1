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
session_start();

class BloodActualController extends Controller
{
    //
    public function list_blood_actual()
    {
        //
    	$blood_donation=BloodDonation::where('blood_finish_date','<',Carbon::now())->get();
    	$bloodactual=BloodActual::orderBy('blood_actual_id','desc')->get();
    	$data=[];
    	$data_bl=[];
    	foreach ($blood_donation as $key => $value_bl) {
    		$data_bl[]=
    		[
    			'blood_donation_id'=>$value_bl['blood_donation_id'],
    			'blood_donation_name'=>$value_bl['blood_donation_name']
    		];
    	}
    	foreach ($bloodactual as $key => $value) {
    		$signup_blood=SignupBlood::where('signup_blood_id',$value['signup_blood_id'])->first();
    		$blood_donation=BloodDonation::where('blood_donation_id',$signup_blood->blood_donation_id)->first();
    		$users=Users::where('users_id',$signup_blood->users_id)->first();
    		$data[]=
    		[
    			'blood_actual_id'=>$value->blood_actual_id,
    			'blood_name'=>$blood_donation->blood_donation_name,
    			'users_fullname'=>$users->users_fullname,
                'blood_actual_group'=>$value->blood_actual_group,
    			'blood_actual_date'=>$value->blood_actual_date,
    			'blood_actual_unit'=>$value->blood_actual_unit,
    			'blood_actual_health'=>$value->blood_actual_health,
    			'blood_actual_situations'=>$value->blood_actual_situations
    		];
    	}

    	View::share('blood_actual',$data);
    	View::share('blood_donations',$data_bl);
    	return view('admin.bloodactual.index');
    }
    public function filter_user(Request $request)
    {
    	$blood_id=$request->blood_id;
    	$signblood=SignupBlood::where('blood_donation_id',$blood_id)->where('signup_blood_status',1)->get();
    	$data=[];
    	foreach ($signblood as $key => $value) {
    		$key=$value['signup_blood_id'];
    		$user=Users::where('users_id',$value['users_id'])->first();
    		$data[]=
    		[
    			'signup_blood_id'=>$value['signup_blood_id'],
    			'fullname'=>$user['users_fullname']
    		];
    	}
    	return response()->json([
            'error'    => false,
            'response'=>$data,
            'messages' => "Lưu thành công",
        ], 200);
    }
    public function save_blood_actual(Request $request)
    {

    	$request->validate([
            'signup_blood_id'=>'required',
            'blood_actual_unit'=>'required',
            'blood_actual_health'=>'required'
        ]);
    	$signup_blood_id=$request->signup_blood_id;
        $blood_actual_group=$request->blood_actual_group;
    	$blood_actual_unit=$request->blood_actual_unit;
    	$blood_actual_health=$request->blood_actual_health;
    	$blood_actual_situations=$request->blood_actual_situations;
    	$blood_donation_id=$request->blood_donation_id;

        
        $signblood=SignupBlood::where('signup_blood_id',$signup_blood_id)->first();
        $users_id=$signblood->users_id;
        $users=Users::find($users_id);


    	$blood=BloodDonation::where('blood_donation_id',$blood_donation_id)->first();

    	$bloodactual=new BloodActual();
    	$bloodactual->signup_blood_id=$signup_blood_id;
        $bloodactual->blood_actual_group=$blood_actual_group;
    	$bloodactual->blood_actual_unit=$blood_actual_unit;
    	$bloodactual->blood_actual_health=$blood_actual_health;
    	$bloodactual->blood_actual_situations=$blood_actual_situations;
    	$bloodactual->blood_actual_date=$blood->blood_start_date;

        $users->users_blood=$bloodactual->blood_actual_group;
        $users->save();
    	$bloodactual->save();
    }
    public function update_blood_actual($bloodactualid)
    {
    	$data=[];
    	$bloodactual=BloodActual::where('blood_actual_id',$bloodactualid)->first();

    	$signup_blood=SignupBlood::where('signup_blood_id',$bloodactual['signup_blood_id'])->first();

    	$blood_donation=BloodDonation::where('blood_donation_id',$signup_blood->blood_donation_id)->first();
    	$users=Users::where('users_id',$signup_blood->users_id)->first();

    	$data[]=
    	[
    		'blood_actual_id'=>$bloodactual->blood_actual_id,
    		'blood_name'=>$blood_donation->blood_donation_name,
    		'users_fullname'=>$users->users_fullname,
            'blood_actual_group'=>$bloodactual->blood_actual_group,
    		'blood_actual_unit'=>$bloodactual->blood_actual_unit,
    		'blood_actual_health'=>$bloodactual->blood_actual_health,
    		'blood_actual_situations'=>$bloodactual->blood_actual_situations   
    	
  		];
        View::share('signup_blood_id',$signup_blood->signup_blood_id);
  		View::share('blood_actual',$data);
        return view('admin.bloodactual.edit');
    }
    public function edit_blood_actual(Request $request)
    {
        $signup_blood_id=$request->signup_blood_id;
    	$blood_actual_id=$request->blood_actual_id;
        $blood_actual_group=$request->blood_actual_group;
    	$blood_actual_unit=$request->blood_actual_unit;
    	$blood_actual_health=$request->blood_actual_health;
    	$blood_actual_situations=$request->blood_actual_situations;


        $signblood=SignupBlood::where('signup_blood_id',$signup_blood_id)->first();
        $users_id=$signblood->users_id;
        $users=Users::find($users_id);

    	$blood_actual=BloodActual::find($blood_actual_id);
        $blood_actual->blood_actual_group=$blood_actual_group;
        $blood_actual->blood_actual_unit=$blood_actual_unit;
        $blood_actual->blood_actual_health=$blood_actual_health;
        $blood_actual->blood_actual_situations=$blood_actual_situations;

        $users->users_blood=$blood_actual->blood_actual_group;
        $users->save();
        $blood_actual->save();
    }
    public function delete_blood_actual(Request $request)
    {
        $blood_actual_id=$request->blood_actual_id;
        $blood_actual=BloodActual::find($blood_actual_id);
        $blood_actual->delete();
    }
}
