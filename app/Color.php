<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    //
    protected $table = 'colors';

    protected $fillable = [
        'name'
    ];

    public function goods(){
        return $this->belongsToMany('App\Good','good_color','color_id','good_id');
    }
}
