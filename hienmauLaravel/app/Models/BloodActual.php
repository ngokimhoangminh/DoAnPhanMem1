<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BloodActual extends Model
{
    use HasFactory;
       public $timestamps = false; //set time to false
    //có thể insert vào
    protected $fillable = ['signup_blood_id','blood_actual_group','blood_actual_unit', 'blood_actual_health','blood_actual_situations','blood_actual_date'];
    protected $primaryKey = 'blood_actual_id';
 	protected $table = 'tbl_blood_actual';
}
