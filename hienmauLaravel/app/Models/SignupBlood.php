<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SignupBlood extends Model
{
    use HasFactory;
     public $timestamps = false; //set time to false
    //có thể insert vào
    protected $fillable = 
    [
    	'blood_donation_id',
    	'users_id', 
        'signup_blood_weight',
        'signup_blood_height',
    	'signup_blood_landau',
    	'signup_blood_macbenh',
    	'signup_blood_sutcan',
    	'signup_blood_noihach',
    	'signup_blood_phauthuat',
    	'signup_blood_xamminh',
    	'signup_blood_duoctruyenmau',
    	'signup_blood_matuy',
    	'signup_blood_quanhe',
    	'signup_blood_cunggioi',
    	'signup_blood_vacxin',
    	'signup_blood_vungdich',
    	'signup_blood_bicum',
    	'signup_blood_khangsinh',
    	'signup_blood_chuarang',
    	'signup_blood_tantat',
    	'signup_blood_kinhnguyet',
    	'signup_blood_sinhcon',
        'signup_blood_note',
        'signup_blood_status'
    ];
    protected $primaryKey = 'signup_blood_id';
 	protected $table = 'tbl_signup_blood';
}
