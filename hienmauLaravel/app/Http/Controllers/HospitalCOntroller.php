<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Models\Hospital;
session_start();
class HospitalCOntroller extends Controller
{
    //
    public function list_hospital()
    {
        $list_hospital=Hospital::orderBy('hospital_id','desc')->get();
         return view('admin.hospital.index')->with(compact('list_hospital'));
    }
    public function add_hospital()
    {
    	return view('admin.hospital.add');
    }
    public function save_hospital(Request $request)
    {
    	$hospital_name=$request->hospital_name;
    	$hospital_address=$request->hospital_address;
    	$hospital_email=$request->hospital_email;
    	$hospital_phone=$request->hospital_phone;
    	$hospital_status=$request->hospital_status;

    	$hospital=new Hospital();
    	$hospital->hospital_name=$hospital_name;
    	$hospital->hospital_address=$hospital_address;
    	$hospital->hospital_email=$hospital_email;
    	$hospital->hospital_phone=$hospital_phone;
    	$hospital->hospital_status=$hospital_status;
    	$hospital->save();
        Session::put('message','Thêm bệnh viện thành công');
    }
    public function update_hospital($hospitalid)
    {
        $update_hospital=Hospital::where('hospital_id',$hospitalid)->get();
        return view('admin.hospital.edit')->with('update_hospital',$update_hospital);
    }
    public function edit_hospital(Request $request)
    {
        $hospital_id=$request->hospital_id;
        $hospital_name=$request->hospital_name;
        $hospital_address=$request->hospital_address;
        $hospital_email=$request->hospital_email;
        $hospital_phone=$request->hospital_phone;

        $hospital=Hospital::find($hospital_id);
        $hospital->hospital_name=$hospital_name;
        $hospital->hospital_address=$hospital_address;
        $hospital->hospital_email=$hospital_email;
        $hospital->hospital_phone=$hospital_phone;
        $hospital->save();
        Session::put('message','Cập nhật bệnh viện thành công');
    }
    public function delete_hospital(Request $request)
    {
        $hospital_id=$request->hospital_id;
        $hospital=Hospital::find($hospital_id);
        $hospital->delete();
        Session::put('message','Đã xóa bệnh viện thành công');
    }
    public function unactive_status_hospital($hospital_id)
    {
        $hospital=Hospital::find($hospital_id);
        $hospital->hospital_status=0;
        $hospital->save();
        Session::put('message','Đã chuyển sang Ẩn thành công');
        return Redirect::to('/list-hospital');
    }
    public function active_status_hospital($hospital_id)
    {
        $hospital=Hospital::find($hospital_id);
        $hospital->hospital_status=1;
        $hospital->save();
        Session::put('message','Đã chuyển sang Hiển Thị thành công');
        return Redirect::to('/list-hospital');
    }
}
