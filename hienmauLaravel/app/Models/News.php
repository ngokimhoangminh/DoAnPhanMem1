<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    public $timestamps = false; //set time to false
    //có thể insert vào
    protected $fillable = ['category_news_id','news_title', 'news_slug','news_desc','news_content','news_meta_des','news_meta_keyswword','news_meta_status','news_image','news_date'];
    protected $primaryKey = 'news_id';
 	protected $table = 'tbl_news';

 	public function category_news()
 	{
 		return $this->belongsTo('App\Models\CategoryNews','category_news_id');
 	}
}
