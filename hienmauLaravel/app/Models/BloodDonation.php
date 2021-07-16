<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BloodDonation extends Model
{
    use HasFactory;
    public $timestamps = false; //set time to false
    //có thể insert vào
    protected $fillable = ['hospital_id','blood_donation_name', 'blood_donation_time','blood_donation_place','blood_object','blood_start_date','blood_finish_date','blood_note','blood_status'];
    protected $primaryKey = 'blood_donation_id';
 	protected $table = 'tbl_blood_donation';
}
