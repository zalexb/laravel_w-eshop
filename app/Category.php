<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $table = 'categories';

    protected $fillable = [
        'name'
    ];

    public function goods(){
        return $this->belongsToMany('App\Good','good_category','category_id','good_id');
    }
}
