<?php

namespace App\Http\Controllers\admin;

use App\Good;
use App\Order;
use App\Review;
use App\Role;
use App\User;
use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Cartalyst\Sentinel\Roles\EloquentRole;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Cartalyst\Sentinel\Activations\EloquentActivation as Activation;
use Intervention\Image\ImageManagerStatic as Image_link;
use Cartalyst\Sentinel\Users\UserInterface;


class AdminUsersController extends Controller
{
    //
    public function get(Request $request){
        $paginate = 9;

        $data['users'] = User::with('orders')
            ->with('reviews')->with('roles')->paginate($paginate);

        return view('admin/users',$data);
    }

    public function ajax_get(Request $request){
        $paginate = $request->input('paginate');

        $data['users'] = User::with('orders')
            ->when($request->input('sort_by'), function ($query) use ($request) {
                if ($request->input('sort_by') == 'new_to_old')
                    $query->orderBy('id', 'desc');
            })
            ->with('reviews')->with('roles')->paginate($paginate);

        return view('admin/users_table',$data);
    }

    public function single(Request $request,$id){

        $data['user'] = User::where('id','=',$id)->get();
        $data['orders'] = Order::where('user_id','=',$data['user'][0]->id)->paginate(5);
        $data['reviews'] = Review::where('user_id','=',$data['user'][0]->id)->where('content','!=',null)->paginate(5);
        $data['order_statuses'] = config('order_statuses');
        $data['activation'] = Activation::where('user_id',$data['user'][0]->id)->where('completed',1)->get();
        $data['favorites'] = User::find($id)->favorites_goods()->with('images')->paginate(5);

        return view('admin/single_user',$data);
    }

    public function order_single(Request $request,$id){

        $orders = Order::where('user_id','=',$id)->with('user')->paginate(5);

        $data['orders'] = $orders;
        $data['order_statuses'] = config('order_statuses');

    }


    public function favorite_single(Request $request,$id){

        $data['favorites'] = User::find($id)->favorites_goods()->with('images')->paginate(5);

        return view('admin/favorite_single', $data)->render();
    }

    public function edit(Request $request,$id){
        try {
            $user = User::find(unserialize(request()->cookie('prof'))['id']);

            foreach ($user->roles as $role) {

                if ($role->name == 'Admin'||$role->name=="Manager") {
                    $data = $_REQUEST;

                    $name = $request->input('name');

                    $value = $request->input('value');

                    $user = User::find($id);

                    $user->update([$name => $value]);

                    return $value;
                }
            }

            return "no_access";
        } catch (\Exception $e) {
            return 'no_access';
        }

    }
    public function avatar_change(Request $request,$id){
        try {
            $user = User::find(unserialize(request()->cookie('prof'))['id']);

            foreach ($user->roles as $role) {
                if ($role->name == 'Admin'||$role->name=="Manager") {

                    $user = User::find($id);

                    $image = Input::file('avatar');

                    $filename = time().''.random_int(0,10000).'.'.$image->getClientOriginalExtension();

                    $path = public_path('images/profile_ava/'.$filename);

                    $image_added = Image_link::make($image->getRealPath())->resize(300, 300)->save($path);

                    $user->avatar=$image_added->basename;
                    $user->save();

                    return redirect()->back();
                }
            }

            return redirect()->back();
        }
        catch (\Exception $e){

            return redirect()->back();
        }
    }

    public function role_delete(Request $request,$id){
        try {
            $user = User::find(unserialize(request()->cookie('prof'))['id']);

            foreach ($user->roles as $role) {
                if ($role->name == 'Admin'||$role->name=="Manager") {


                    $role_id = $request->input('id');

                    $user = User::find($id);

                    $user->roles()->detach($role_id);

                    return 'ok';
                }
            }

            return "no_access";
        }
        catch (\Exception $e){
            return 'no_access';
        }

    }

    public function role_check(Request $request,$id){
        try {
            $user = User::find(unserialize(request()->cookie('prof'))['id']);

            foreach ($user->roles as $role) {
                if ($role->name == 'Admin'||$role->name=="Manager") {

                    $roles = EloquentRole::whereDoesntHave('users', function($q) use ($id){
                        $q->where('user_id', $id);
                    })->get();;

                    return $roles;
                }
            }

            abort(404);
        }
        catch (\Exception $e){
            abort(404);
        }
    }

    public function role_add(Request $request,$id){
        try {
            $user = User::find(unserialize(request()->cookie('prof'))['id']);

            foreach ($user->roles as $role) {
                if ($role->name == 'Admin'||$role->name=="Manager") {


                    $user = User::find($id);

                    $role_id = $request->input('id');

                    $role = EloquentRole::find($role_id);

                    $user->roles()->attach($role_id);

                    return $role;
                }
            }

            return "no_access";
        }
        catch (\Exception $e){
            return 'no_access';
        }

    }

    public function favorite_delete(Request $request,$id){
        try {
            $user = User::find(unserialize(request()->cookie('prof'))['id']);

            foreach ($user->roles as $role) {
                if ($role->name == 'Admin'||$role->name=="Manager") {

                    $user = User::find($id);

                    $user->favorites_goods()->detach($request->input('id'));

                    return 'ok';
                }
            }

            return "no_access";
        }
        catch (\Exception $e){
            return 'no_access';
        }

    }


}
