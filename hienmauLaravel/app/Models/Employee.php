<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    public $timestamps = false; //set time to false
    //có thể insert vào
    protected $fillable = ['employee_id','hospital_id', 'employee_name','employee_title','employee_department','employee_phone','employee_email','employee_status'];
    protected $primaryKey = 'employee_id';
 	protected $table = 'tbl_employee';
}
