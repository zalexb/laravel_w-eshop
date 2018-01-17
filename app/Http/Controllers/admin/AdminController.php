<?php

namespace App\Http\Controllers\admin;

use App\Good;
use App\Notification;
use App\Order;
use App\Review;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    //
    public function index(){

        $data['users'] = User::count();
        $data['goods'] = Good::count();
        $data['orders'] = Order::count();
        $data['reviews'] = Review::where('content','!=',null)->count();
        $data['notifications'] = Notification::with(['users'=> function ($q) {
            $q->select('checked');
        }])
            ->select('id','text','created_at')
            ->orderBy('id','desk')
            ->paginate(5);

        $now = \Carbon\Carbon::now();

        $data['month_report'] = Order::
        whereMonth('created_at',$now->month)
        ->whereYear('created_at',$now->year)
        ->paginate(5);

        $all_orders =Order::
        whereMonth('created_at',$now->month)
            ->whereYear('created_at',$now->year)
            ->get();

        $total_cost = 0 ;

        foreach ($all_orders as $order){
           $total_cost += $order->order_cost;
        }

        $data['now'] = $now;
        $data['total_cost'] = $total_cost;
        $data['admin'] = User::find(1);
        
        return view('admin/index',$data);
    }
    public function index_activities(){
        $data['notifications'] = Notification::with(['users'=> function ($q) {
            $q->select('checked');
        }])
            ->select('id','text','created_at')
            ->orderBy('id','desk')
            ->paginate(5);

        return view('admin/index_activities',$data);
    }
    public function monthly_orders(){

        $now = \Carbon\Carbon::now();

        $data['month_report'] = Order::
        whereMonth('created_at',$now->month)
            ->whereYear('created_at',$now->year)
            ->paginate(5);

        return view('admin/monthly_orders',$data);
    }
    public function search(Request $request,$value){
        $data['goods'] = Good::where('name','like','%'.$value.'%')
           ->with('image')
            ->get();
        $data['users'] = User::where('first_name','like','%'.$value.'%')
            ->orWhere('last_name','like','%'.$value.'%')
            ->get();

        return view('admin/search',$data);


    }
}
