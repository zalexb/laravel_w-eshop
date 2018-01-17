<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Good;

class Image extends Model
{
    //
    protected $table = 'images';

    protected $fillable = [
        'name','alt','title','link'
    ];

    public function goods(){
        return $this->belongsToMany('App\Good','good_image','image_id','good_id');
    }
    public function good(){
        return $this->belongsTo('App\Good');
    }

}
