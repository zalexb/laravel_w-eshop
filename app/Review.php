<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cartalyst\Sentinel\Persistences\EloquentUser;


class Review extends Model
{
    //
    protected $table = 'reviews';
    protected $fillable = [
        'content',
        'user_id',
        'good_id',
        'rating'
    ];

    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }

    public function good(){
        return $this->belongsTo('App\Good','good_id','id');
    }
}
