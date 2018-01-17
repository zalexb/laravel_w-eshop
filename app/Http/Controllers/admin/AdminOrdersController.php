<?php

namespace App\Http\Controllers\admin;

use App\City;
use App\Country;
use App\Good;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
use App\User;
use Illuminate\Support\Facades\DB;

class AdminOrdersController extends Controller
{
    //
    public function get(Request $request){

        $paginate = 9;
        $data['orders'] = Order::
            with('goods:goods_num,good_id,discount_percent,name,price,main_id_img,public,alias')
            ->with('user')
            ->paginate($paginate);

        if($request->ajax()){
            $paginate = $request->input('paginate');

            $data['orders'] = Order::
            with('goods:goods_num,good_id,discount_percent,name,price,main_id_img,public,alias')
                ->with('user')
            ->when($request->input('sort_by'), function ($query) use ($request) {
                if ($request->input('sort_by') == 'new_to_old')
                    $query->orderBy('id', 'desc');
            })->paginate($paginate);

            return view('admin/orders_catalog',$data);
        }

        return view('admin/orders',$data);

    }

    public function single(Request $request,$id){

        $orders = Order::where('id', '=', $id)
            ->with('goods:goods_num,good_id,discount_percent,name,price,main_id_img,public,alias')->get();

        $data['order'] = $orders[0];
        $data['order_statuses'] = config('order_statuses');
        $data['countries'] = Country::all();
        $data['cities'] = City::all();
        $data['delivery_types'] = config('delivery_types');

        return view('admin/order',$data);

    }
    public function edit(Request $request,$id){

        try {
            $user = User::find(unserialize(request()->cookie('prof'))['id']);

            foreach ($user->roles as $role) {
                if ($role->name == 'Admin'||$role->name=="Manager") {

                    $order = Order::find($id);

                    $order->update([$request->input('name')=>$request->input('value')]);

                    if($request->input('name')=='city_id'){
                        $city = City::where('id','=',$request->input('value'))
                            ->with('country')->get();
                        return $city[0]->country->name;
                    }

                    return $request->input('value');

                }
            }

            return "no_access";
        } catch (\Exception $e) {
            return 'no_access';
        }

    }
    public function edit_good_num(Request $request,$id){

        try {
            $user = User::find(unserialize(request()->cookie('prof'))['id']);

            foreach ($user->roles as $role) {
                if ($role->name == 'Admin'||$role->name=="Manager") {

                    $order = Order::find($id);

                    DB::table('good_order')->where('good_id','=',$request->input('good_id'))
                        ->where('order_id','=',$id)->update(['goods_num'=>$request->input('good_num')]);

                    $goods = Good::with(['orders' => function($q) use ($id){
                        $q->where('order_id','=',$id);
                    }])
                    ->whereHas('orders', function($q) use ($id){
                        $q->where('order_id','=',$id);
                    })
                        ->get();

                    $order_cost = 0;

                    foreach ($goods as $good) {
                        $order_cost += $good->price * $good->orders[0]->pivot->goods_num;
                    }


                    $order->order_cost = $order_cost;
                    $order->save();

                    return $order_cost;

                }
            }

            return "no_access";
        } catch (\Exception $e) {
            return 'no_access';
        }
    }

    public function delete_good(Request $request,$id){

        try {
            $user = User::find(unserialize(request()->cookie('prof'))['id']);

            foreach ($user->roles as $role) {
                if ($role->name == 'Admin'||$role->name=="Manager") {


                    $order = Order::find($id);

                    $good = Good::find($request->input('good_id'));

                    $good_fav= DB::table('good_order')->where('good_id','=',$request->input('good_id'))
                        ->where('order_id','=',$id)->get();

                    $good_number = $good_fav[0]->goods_num;

                    $good_price = $good->price;

                    if($order->goods()->count()>1){
                        $order->goods()->detach($request->input('good_id'));

                        $order->order_cost -= $good_price * $good_number;
                        $order->save();
                    }
                    else
                        return 'no_access';


                    return 'ok';

                }
            }

            return "no_access";
        } catch (\Exception $e) {

            return 'no_access';
        }
    }
    public function good_check(Request $request,$id){
        try {
            $order = Order::find($id);

            $good_ids = $order->goods()->select('good_id as id')->get();

            $ids = [];

            foreach ($good_ids as $id){
                $ids[] = $id['id'];
            }

            $goods = Good::all()->except($ids);

            return $goods;

        } catch (\Exception $e) {
            return 'no_access';
        }

    }
    public function add_order_goods(Request $request,$id){
        try {
            $user = User::find(unserialize(request()->cookie('prof'))['id']);

            foreach ($user->roles as $role) {
                if ($role->name == 'Admin'||$role->name=="Manager") {

                   $order = Order::find($id);

                   DB::table('good_order')->insert([
                       'good_id'=>$request->input('good_id'),
                       'order_id'=>$id,
                       'goods_num'=>$request->input('goods_num')
                   ]);


                   $goods = Good::whereHas('orders', function($q) use ($id,$request){
                        $q->where('order_id','=',$id);
                        $q->where('good_id','=',$request->input('good_id'));
                    })->with('orders:goods_num')->get();

                    $order_cost = $order->order_cost;

                    foreach ($goods as $good) {
                        $order_cost += $good->price * $request->input('goods_num');
                    }

                    $order->order_cost = $order_cost;
                    $order->save();

                    return redirect()->back();

                }
            }

            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }
}
