<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mail extends Model
{
    //
    protected $table = 'mails';

    protected $fillable = [
        'message',
        'phone',
        'email',
        'name'
    ];

    public function users(){
        return $this->belongsToMany('App\User','mail_user','mail_id','user_id');
    }
}
