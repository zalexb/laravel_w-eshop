<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Order extends Model
{
    //
    protected $table = 'orders';

    protected $fillable = [
        'first_name',
        'last_name',
        'city_id',
        'country_id',
        'address',
        'phone',
        'payment',
        'order_cost',
        'order_status',
        'user_id',
        'delivery_type',
        'postal_zip'
    ];

    public function user(){
        return $this->hasOne('App\User','id','user_id');
    }

    public function goods(){
        return $this->belongsToMany('App\Good','good_order','order_id','good_id')
            ->withPivot('goods_num');
    }
    public function city(){
        return $this->hasOne('App\City','id','city_id');
    }

}
