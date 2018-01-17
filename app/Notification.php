<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    //
    protected $table = 'notifications';

    protected $fillable = [
        'text'
    ];
    protected $hidden = ['pivot'];

    public function users(){
        return $this->belongsToMany('App\User','notification_user','notification_id','user_id');
    }

}
