<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Models\Hospital;
use App\Models\Employee;
session_start();
class EmployeeController extends Controller
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
    public function list_employee()
    {
    	$list_employee=DB::table('tbl_employee')
    	->join('tbl_hospital','tbl_employee.hospital_id','=','tbl_hospital.hospital_id')
    	->select('tbl_employee.*','tbl_hospital.hospital_name')
    	->orderBy('tbl_employee.employee_title')
    	->get();
    	$list_hospital=Hospital::orderBy('hospital_id','desc')->get();
    	return view('admin.employee.index')->with('result_employee',$list_employee)->with('result_hospital',$list_hospital);
    }
    public function save_employee(Request $request)
    {
    	
    	$data=$request->all();

        $employee=new Employee();//new cho phép insert dữu liệu
        $employee->hospital_id=$data['hospital_id'];
        $employee->employee_name=$data['employee_name'];
        $employee->employee_title=$data['employee_title'];
        $employee->employee_department=$data['employee_department'];
        $employee->employee_phone=$data['employee_phone'];
        $employee->employee_email=$data['employee_email'];
        $employee->employee_status=$data['employee_status'];
        $employee->save();

    	Session::put('message','Thêm nhân viên thành công');
    	return Redirect::to('/list-employee');//đường dẫn
    }
     public function update_employee($employeeid)
    {
        $update_employee=Employee::where('employee_id',$employeeid)->get();
        $list_hospital=Hospital::orderBy('hospital_id','desc')->get();
        return view('admin.employee.edit')->with('result_emp',$update_employee)->with('result_hospital',$list_hospital);;
    }
    public function edit_employee(Request $request,$employeeid)
    {
        $this->check_login();

        $data=$request->all();
        $employee=Employee::find($employeeid);//tìm ra 1 thương hiệu để update
        $employee->hospital_id=$data['hospital_id'];
        $employee->employee_name=$data['employee_name'];
        $employee->employee_title=$data['employee_title'];
        $employee->employee_department=$data['employee_department'];
        $employee->employee_phone=$data['employee_phone'];
        $employee->employee_email=$data['employee_email'];
        $employee->save();

    	Session::put('message','Đã cập nhật nhân viên thành công');
    	return Redirect::to('/list-employee');
    }
    public function delete_employee(Request $request)
    {
        $employee_id=$request->employee_id;
        $employee=Employee::find($employee_id);
        $employee->delete();
        Session::put('message','Đã xóa nhân viên thành công');
    }
    public function unactive_status_employee($employeeid)
    {
        $employee=Employee::find($employeeid);
        $employee->employee_status=0;
        $employee->save();
        Session::put('message','Đã chuyển sang Ẩn thành công');
        return Redirect::to('/list-employee');
    }
    public function active_status_employee($employeeid)
    {
        $employee=Employee::find($employeeid);
        $employee->employee_status=1;
        $employee->save();
        Session::put('message','Đã chuyển sang Hiển Thị thành công');
        return Redirect::to('/list-employee');
    }
}
