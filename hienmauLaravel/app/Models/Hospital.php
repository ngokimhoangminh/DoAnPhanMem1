<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;
    public $timestamps = false; //set time to false
    //có thể insert vào
    protected $fillable = ['hospital_id','hospital_name', 'hospital_address','hospital_email','hospital_phone','hospital_status'];
    protected $primaryKey = 'hospital_id';
 	protected $table = 'tbl_hospital';
}
