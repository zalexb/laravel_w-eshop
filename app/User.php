<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends \Cartalyst\Sentinel\Users\EloquentUser

{
    protected $hidden = ['pivot'];

    protected $fillable = ['email','password','first_name','last_name','permission','phone','facebook_id'];

    public function orders()
    {
        return $this->hasMany('App\Order', 'user_id', 'id');

    }

    public function reviews()
    {
        return $this->hasMany('App\Review', 'user_id', 'id');

    }

    public function favorites_goods(){
        return $this->belongsToMany('App\Good','favorites','user_id','good_id');
    }

    public function notifications(){
        return $this->belongsToMany('App\Notification','notification_user','user_id','notification_id');
    }

    public function mails(){
        return $this->belongsToMany('App\Mail','mail_user','user_id','mail_id');
    }

}
