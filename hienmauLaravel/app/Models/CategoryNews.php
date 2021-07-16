<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryNews extends Model
{
    use HasFactory;
       public $timestamps = false; //set time to false
    //có thể insert vào
    protected $fillable = ['category_news_name','category_news_slug','category_news_des', 'category_news_status'];
    protected $primaryKey = 'category_news_id';
 	protected $table = 'tbl_category_news';

 	public function News()
 	{
 		return $this->hasMany('App\Models\News');
 	}
}
