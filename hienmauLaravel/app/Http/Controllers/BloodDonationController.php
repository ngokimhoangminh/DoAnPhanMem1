<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Models\Hospital;
use App\Models\Employee;
use App\Models\BloodDonation;
session_start();
class BloodDonationController extends Controller
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
    public function list_blooddonation()
    {
    	$list_blooddonation=DB::table('tbl_blood_donation')
    	->join('tbl_hospital','tbl_blood_donation.hospital_id','=','tbl_hospital.hospital_id')
    	->select('tbl_blood_donation.*','tbl_hospital.hospital_name')
        ->orderBy('tbl_blood_donation.blood_donation_id','desc')
        ->get();
    	$list_hospital=Hospital::orderBy('hospital_id','desc')->get();
    	return view('admin.blooddonation.index')->with('result_blood',$list_blooddonation)->with('result_hospital',$list_hospital);
    }
    public function save_blooddonation(Request $request)
    {
    	
    	$data=$request->all();

        $blood_donation=new BloodDonation();//new cho phép insert dữu liệu
        $blood_donation->hospital_id=$data['hospital_id'];
        $blood_donation->blood_donation_name=$data['blood_donation_name'];
        $blood_donation->blood_donation_time=$data['blood_donation_time'];
        $blood_donation->blood_donation_place=$data['blood_donation_place'];
        $blood_donation->blood_object=$data['blood_object'];
        $blood_donation->blood_start_date=$data['blood_start_date'];
        $blood_donation->blood_finish_date=$data['blood_finish_date'];
        $blood_donation->blood_note=$data['blood_note'];
        $blood_donation->blood_status=$data['blood_status'];
        $blood_donation->save();

    	Session::put('message','Thêm đợt hiến máu thành công');
    	return Redirect::to('/list-blooddonation');//đường dẫn
    }
    public function update_blood_donation($bloodid)
    {
        $update_blood_donation=BloodDonation::where('blood_donation_id',$bloodid)->get();
        $list_hospital=Hospital::orderBy('hospital_id','desc')->get();
        return view('admin.blooddonation.edit')->with('result_blood',$update_blood_donation)->with('result_hospital',$list_hospital);;
    }
     public function edit_blood_donation(Request $request,$bloodid)
    {
        $this->check_login();

        $data=$request->all();
        $blood_donation=BloodDonation::find($bloodid);//tìm ra 1 thương hiệu để update
        $blood_donation->hospital_id=$data['hospital_id'];
        $blood_donation->blood_donation_name=$data['blood_donation_name'];
        $blood_donation->blood_donation_time=$data['blood_donation_time'];
        $blood_donation->blood_donation_place=$data['blood_donation_place'];
        $blood_donation->blood_object=$data['blood_object'];
        $blood_donation->blood_start_date=$data['blood_start_date'];
        $blood_donation->blood_finish_date=$data['blood_finish_date'];
        $blood_donation->blood_note=$data['blood_note'];

        $blood_donation->save();

    	Session::put('message','Đã cập nhật đợt hiến máu thành công');
    	return Redirect::to('/list-blooddonation');
    }
    public function delete_blood_donation(Request $request)
    {
        $blood_donation_id=$request->blood_donation_id;
        $blood_donation=BloodDonation::find($blood_donation_id);
        $blood_donation->delete();
        Session::put('message','Đã xóa đợt hiến máu thành công');
    }
    public function unactive_status_blood($bloodid)
    {
        $blood_donation=BloodDonation::find($blood_donation_id);
        $blood_donation->blood_status=0;
        $blood_donation->save();
        Session::put('message','Đã chuyển sang Ẩn thành công');
        return Redirect::to('/list-blooddonation');
    }
    public function active_status_employee($bloodid)
    {
        $blood_donation=BloodDonation::find($blood_donation_id);
        $blood_donation->blood_status=1;
        $blood_donation->save();
        Session::put('message','Đã chuyển sang Hiển Thị thành công');
        return Redirect::to('/list-blooddonation');
    }
}
