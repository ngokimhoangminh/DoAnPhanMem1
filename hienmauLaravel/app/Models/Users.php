<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    use HasFactory;
    public $timestamps = false; //set time to false
    //có thể insert vào
    protected $fillable = 
    [
    	'users_id',
    	'users_fullname', 
    	'users_name',
    	'users_blood',
    	'users_email',
    	'users_phone',
    	'users_cmnd',
    	'users_password',
    	'users_gender',
    	'users_date',
    	'users_scholl',
    	'users_job',
    	'users_workplace',
    	'users_address'];
    protected $primaryKey = 'users_id';
 	protected $table = 'tbl_users';
}
