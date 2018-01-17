<?php

namespace App\Http\Controllers;

use App\Mail;
use App\User;
use Illuminate\Http\Request;
use App\Good;
use App\Image;

class IndexController extends Controller
{
    //
    public function show(Request $request){

        $new_goods = Good::with('images')->where('public','=',1)->limit(8)->orderBy('id','desc')->get();
        $main_goods = Good::with('images')->where('public','=',1)->limit(3)->orderBy('rating')->get();
        $slider_imgs = Image::where('slider','=',1)->take(3)->get();

        $data['new_goods']= $new_goods;
        $data['main_goods']= $main_goods;
        $data['slider_imgs']= $slider_imgs;



        return view('index',$data);
    }

    public function mail(Request $request){

        $mail = Mail::create($request->except('_token'));

        $all_users = User::whereHas('activations',function ($q) {
            $q->where('completed','1');
        })->get();
        
        foreach ($all_users as $user){
            $user->mails()->attach($mail);
        }
        return redirect()->back()->with('status','ok');
    }
}
