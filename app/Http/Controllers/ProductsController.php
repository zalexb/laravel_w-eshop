<?php

namespace App\Http\Controllers;

use App\Category;
use App\Review;
use function foo\func;
use Illuminate\Http\Request;
use App\Good;
use Illuminate\Http\Response;

class ProductsController extends Controller
{
    //
    public function show(Request $request)
    {
        try {
            $pag = 9;//pagination


               if($request->input("per_page"))
                   $pag = $request->input("per_page");


               $goods = Good::where('public', '=', 1)->with('image')
                   ->withCount('orders')
                   ->where(function($query){

                        $data = $_REQUEST;

                        $keys = array_keys($data);

                       foreach($keys as $select){
                           if($select=="discount")
                               $query->where('discount_percent',">=",$data[$select]);

                           elseif($select=='search')
                               $query->where('name','like','%'.$data[$select].'%');


                           elseif($select!="category"&&$select!="page"&&$select!="per_page"&&$select!="sort_by"&&$select!='price')
                               $query->whereIn($select,$data[$select]);
                       }

                   })
                   ->when($request->input('sort_by'),function ($query) use ($request) {

                       if($request->input('sort_by')=='rating')
                            $query->orderBy('rating','desc');
                       if($request->input('sort_by')=='new_to_old')
                           $query->orderBy('id','desc');
                       if($request->input('sort_by')=='popularity')
                           $query->orderBy('orders_count', 'desc');
                   })
                   ->when($request->input('price'),function ($q) use ($request){
                       $q->whereBetween('price',$request->input('price'));
                   })
                   ->whereHas('categories',function($q){

                       $data = $_REQUEST;

                       $keys = array_keys($data);

                       foreach($keys as $select){
                           if($select=="category")
                               $q->whereIn('name',$data[$select]);
                       }
                   })
                   ->paginate($pag);

            $data['goods']= Good::all();
            $data['goods_paginated'] = $goods;
            $data['categories'] = Category::all();

            if($request->ajax())
               return view('catalog', $data)->render();

            return view('products', $data);

        }catch (\Exception $e) {

            abort(404);
        }

    }

    public function single(Request $request, $alias)
    {

        try {

            $good = Good::where('alias', '=', $alias)->where('public','=',1)
                ->with('images')->with('categories')->with('reviews')->get();

            $recs = Good::where('brand', $good[0]->brand)->where('alias', '!=', $alias)
                ->limit(3)->with('image')->get();

            $reviews = Review::where('good_id','=',$good[0]->id)->where('content','!=',null)
                ->with('user')->paginate(9);

            $data['good'] = $good;
            $data['recs'] = $recs;
            $data['reviews'] = $reviews;


            return view('single', $data);

        } catch (\Exception $e) {
            abort(404);
        }
    }

}
