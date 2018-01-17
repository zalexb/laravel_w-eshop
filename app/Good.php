<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Good extends Model
{
    protected $table = 'goods';
//    protected $primaryKey = 'id';
//    public $incrementing = 'id';
//    public $timestamps = true;

    protected $fillable = [
        'name',
        'price',
        'description',
        'rating',
        'brand',
        'stock',
        'public',
        'discount_percent',
        'case_width_approx_mm',
        'case_depth_approx_mm',
        'color',
        'water_resistancy_m',
        'case_material',
        'alias',
        'MPN',
        'guarantee'
    ];

    public function image(){
        return $this->hasOne('App\Image','id','main_id_img');
    }
    public function images(){
        return $this->belongsToMany('App\Image','good_image','good_id','image_id');
    }


    public function categories(){
        return $this->belongsToMany('App\Category','good_category','good_id','category_id');
    }

    public function orders(){
        return $this->belongsToMany('App\Good','good_order','good_id','order_id')
            ->withPivot('goods_num');
    }
    public function reviews(){
        return $this->hasMany('App\Review','good_id','id');
    }

    public function favorites_users(){
       return $this->belongsToMany('App\User','favorites','good_id','user_id');
    }

}
