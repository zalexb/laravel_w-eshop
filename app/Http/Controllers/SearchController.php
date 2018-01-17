<?php

namespace App\Http\Controllers;

use App\Good;
use Illuminate\Http\Request;
use Mockery\Matcher\Closure;
use App\Category;

class SearchController extends Controller
{
    //
    public function liveSearch(Request $request){
        $name = $request->input('value');

        $goods = Good::where('public','1')->where('name','LIKE',"%".$name."%")
            ->limit(4)->with('image')->get();

        return $goods->toJson();
    }
    public function searching(Request $request, $value){

        $goods = Good::where('public','=',1)
            ->where('name','like','%'.$value.'%')
            ->with('image')->paginate(9); //connecting goods base with images

        $data['goods_paginated']=$goods;
        $data['goods']= Good::all();
        $data['categories'] = Category::all();

        return view('products',$data);
    }
}
