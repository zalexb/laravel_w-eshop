<?php

namespace App\Http\Controllers;

use App\City;
use App\Country;
use App\Good;
use App\Notification;
use App\Order;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;
use Sentinel;

class OrdersController extends Controller
{
    //
    public function take_country(Request $request){
        $countries = Country::all();

        return $countries->toJson();
    }

    public function take_cities(Request $request){

        $country = $request->input('country_id');

        $cities = City::where('country_id','=',$country)->where('active','!=',null)->get();

        return $cities;
    }

    public function order_create(Request $request){
        try {
            $create_order = $request->except('goods','country_id');

            if (unserialize(request()->cookie('prof'))['id']) {
                $id = unserialize(request()->cookie('prof'))['id'];
                $create_order['user_id'] = $id;
            }

//            $basket = json_decode($request->input('goods'), true); //working only in postman
              $basket = $request->input('goods');//working with ajax


            $ids = array_keys($basket);

            //calc order_cost
            $goods = Good::findMany($ids);

            $order_cost = 0;

            $i = 0;
            foreach ($goods as $good) {
                $order_cost += $good->price * $basket[$ids[$i]][2];
                $i += 1;
            }

            $create_order['order_cost'] = $order_cost;

            if($create_order['delivery_type']==1)
                $create_order['delivery_type']='Express';
            else
                $create_order['delivery_type']='Self pick-up';
            //creating model

            $order = Order::create($create_order);

            //saving relationships
            $i = 0;
            foreach ($goods as $good) {
                DB::table('good_order')->insert(['good_id'=>$good->id,'order_id'=>$order->id,'goods_num'=>$basket[$ids[$i]][2]]);
                $i += 1;
            }

            if(unserialize(request()->cookie('prof'))['id']){
                $user = Sentinel::findById($id);
                $order->user()->save($user);
            }

            $text = 'New order registrated <a href="'.route('admin_order',['id'=>$order->id]).'">'.$order->id.'</a>';

            $note = Notification::create([
                'text'=>$text
            ]);

            $all_users = User::whereHas('activations',function ($q) {
                $q->where('completed','1');
            })->get();

            foreach ($all_users as $user){
                $user->notifications()->attach($note);
            }


            return 'true';
        }catch (\Exception $e){

            abort(404);
        }
    }

    public function user_orders(Request $request,$id){

        if (unserialize(request()->cookie('prof'))['id']==$id) {
            $user_id = unserialize(request()->cookie('prof'))['id'];

            $data['orders'] = Order::where('user_id', '=', $user_id)->paginate(9);

            return view('orders',$data);
        }
        else
            abort(404);
    }

    public  function single_order(Request $request,$user_id,$order_id){

        try {
            if($user_id==unserialize(request()->cookie('prof'))['id']) {
                $orders = Order::where('id', '=', $order_id)->with('goods:goods_num,good_id,discount_percent,name,price,main_id_img,public,alias')->get();

                $data['order'] = $orders[0];

                return view('single_order',$data);
            }
            else
                abort(404);
        }
        catch (Exception $e){
            abort(404);
        }
    }
}
