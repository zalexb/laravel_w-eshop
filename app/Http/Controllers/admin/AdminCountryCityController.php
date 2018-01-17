<?php

namespace App\Http\Controllers\admin;

use App\City;
use App\Country;
use App\Good;
use App\Order;
use App\User;
use function foo\func;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminCountryCityController extends Controller
{
    //
    public function country_list(){
        $data['countries'] = Country::all();

        return view('admin/country_list',$data);
    }

    public function single_country(Request $request,$id){
        $country = Country::where('id',$id)->with('cities')->get();
        $data['country'] = $country[0];
        $data['orders'] = Order::whereHas('city',function ($q) use ($id){
            $q->where('country_id',$id);
        })->paginate(5);
        $data['order_statuses'] = config('order_statuses');

        return view('admin/single_country',$data);

     }
    public function single_city(Request $request,$id){
        $city =  City::where('id',$id)->with('country')->get();
        $data['city'] = $city[0];
        $data['orders'] = Order::whereHas('city',function ($q) use ($id){
            $q->where('id',$id);
        })->paginate(5);
        $data['order_statuses'] = config('order_statuses');

        return view('admin/single_city',$data);

    }
    public function get_orders(Request $request,$id){
        if($request->input('tag')=='country'){
            $data['orders']= Order::whereHas('city',function ($q) use ($id){
                $q->where('country_id',$id);
            })->paginate(5);
        }
        else{
            $data['orders']= Order::whereHas('city',function ($q) use ($id){
                $q->where('id',$id);
            })->paginate(5);
        }

        $data['order_statuses'] = config('order_statuses');

        return view('admin/order_single',$data)->render();
    }

    public function get_add_city(){
        $data['countries'] = Country::all();

        return view('admin/add_city',$data);
    }
    public function get_add_country(){
        return view('admin/add_country');
    }

    public function add_city(Request $request){
        try {
            $user = User::find(unserialize(request()->cookie('prof'))['id']);

            foreach ($user->roles as $role) {
                if ($role->name == 'Admin'||$role->name=="Manager") {

                    City::create([
                        'name'=>$request->input('name'),
                        'country_id'=>$request->input('country')
                    ]);

                    return redirect()->back()->with('status','success');
                }
            }

            return redirect()->back()->with('status', 'No access');
        }
        catch (\Exception $e){
            return redirect()->back()->with('status', 'No access');
        }
    }
    public function add_country(Request $request){
        try {
            $user = User::find(unserialize(request()->cookie('prof'))['id']);

            foreach ($user->roles as $role) {
                if ($role->name == 'Admin'||$role->name=="Manager") {


                    Country::create([
                        'name'=>$request->input('name')
                    ]);


                  return redirect()->back()->with('status','success');
                }
            }

            return redirect()->back()->with('status', 'No access');
        }
        catch (\Exception $e){
            return redirect()->back()->with('status', 'No access');
        }
    }
    public function delete_country(Request $request,$id){
        try {
            $user = User::find(unserialize(request()->cookie('prof'))['id']);

            foreach ($user->roles as $role) {
                if ($role->name == 'Admin'||$role->name=="Manager") {

                    $country = Country::whereHas('cities',function ($q) use ($id){
                        $q->where('country_id',$id);
                    })->get();

                    if(!$country->isEmpty())
                        return redirect()->back()->with('status','city');

                    $country = Country::find($id);
                    $country->delete();


                    return redirect()->route('country_list');
                }
            }

            return redirect()->back()->with('status', 'No access');
        }
        catch (\Exception $e){

            return redirect()->back()->with('status', 'No access');
        }
    }
    public function delete_city(Request $request,$id){
        try {
            $user = User::find(unserialize(request()->cookie('prof'))['id']);

            foreach ($user->roles as $role) {
                if ($role->name == 'Admin'||$role->name=="Manager") {

                    $city = City::whereHas('orders',function ($q) use ($id){
                        $q->where('city_id',$id);
                    })->get();

                    if(!$city->isEmpty())
                        return redirect()->back()->with('status','orders');

                    $city = City::find($id);
                    $city->delete();

                    return redirect()->route('country_list');
                }
            }

            return redirect()->back()->with('status', 'No access');
        }
        catch (\Exception $e){

            return redirect()->back()->with('status', 'No access');
        }
    }

    public function active_change(Request $request,$id){
        try {
            $user = User::find(unserialize(request()->cookie('prof'))['id']);

            foreach ($user->roles as $role) {
                if ($role->name == 'Admin'||$role->name=="Manager") {

                    $city = City::find($id);

                    $city->active = $request->input('active');

                    $city->save();

                    return redirect()->back();
                }
            }

            return redirect()->back()->with('status', 'No access');
        }
        catch (\Exception $e){

            return redirect()->back()->with('status', 'No access');
        }
    }
}
