<?php

namespace App\Http\Controllers\admin;

use App\Notification;
use App\Order;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Good;
use App\Category;
use App\Review;
use Intervention\Image\ImageManagerStatic as Image_link;
use App\Image;
use Illuminate\Support\Facades\Input;

class AdminGoodsController extends Controller
{
    //
    public function get(Request $request)
    {
        try {
            $pag = 9;//pagination


            if ($request->input("per_page"))
                $pag = $request->input("per_page");


            $goods = Good::with('image')
                ->withCount('orders')
                ->where(function ($query) {

                    $data = $_REQUEST;

                    $keys = array_keys($data);

                    foreach ($keys as $select) {
                        if ($select == "discount")
                            $query->where('discount_percent', ">=", $data[$select]);

                        elseif ($select == 'search')
                            $query->where('name', 'like', '%' . $data[$select] . '%');


                        elseif ($select != "category" && $select != "page" && $select != "per_page" && $select != "sort_by" && $select != 'price')
                            $query->whereIn($select, $data[$select]);
                    }

                })
                ->when($request->input('sort_by'), function ($query) use ($request) {

                    if ($request->input('sort_by') == 'rating')
                        $query->orderBy('rating', 'desc');
                    if ($request->input('sort_by') == 'new_to_old')
                        $query->orderBy('id', 'desc');
                    if ($request->input('sort_by') == 'popularity')
                        $query->orderBy('orders_count', 'desc');
                })
                ->when($request->input('price'), function ($q) use ($request) {
                    $q->whereBetween('price', $request->input('price'));
                })
                ->whereHas('categories', function ($q) {

                    $data = $_REQUEST;

                    $keys = array_keys($data);

                    foreach ($keys as $select) {
                        if ($select == "category")
                            $q->whereIn('name', $data[$select]);
                    }
                })
                ->paginate($pag);


            $data['goods'] = Good::all();
            $data['goods_paginated'] = $goods;
            $data['categories'] = Category::all();

            if ($request->ajax()){
                return view('.admin/catalog', $data)->render();
            }

            return view('admin/goods', $data);

        } catch (\Exception $e) {
            abort(404);
        }

    }

    public function single(Request $request, $id)
    {

        try {

            $good = Good::where('id', '=', $id)->with('images')->with('categories')
                ->with('orders')->get();

            $reviews = Review::where('good_id','=',$id)->where('content','!=',null)
                ->with('user')->paginate(5);

            $orders = Order::whereHas('goods', function ($query) use ($id) {
                $query->where('good_id', '=', $id);
            })->with('user')->paginate(5);


            $data['good'] = $good;
            $data['reviews'] = $reviews;
            $data['orders'] = $orders;

            $data['order_statuses'] =  config('order_statuses');


            return view('admin/single', $data);

        } catch (\Exception $e) {
            abort(404);
        }
    }

    public function edit(Request $request,$id){
        try {
            $user = User::find(unserialize(request()->cookie('prof'))['id']);

            foreach ($user->roles as $role) {
                if ($role->name == 'Admin'||$role->name=="Manager") {
                    $data = $_REQUEST;

                    $name = $request->input('name');

                    $value = $request->input('value');

                    $good = Good::find($id);

                    $good->update([$name => $value]);

                    if($name=='name') {
                        $alias = str_replace(' ', '_', $value);
                        $al = $alias . '_' . $good->id;
                        $good->update(['alias' => $al]);
                    }
                    return $value;
                }
            }

            return "no_access";
        } catch (\Exception $e) {
            return 'no_access';
        }

    }

    public function category_delete(Request $request,$id){
        try {
            $user = User::find(unserialize(request()->cookie('prof'))['id']);

            foreach ($user->roles as $role) {
                if ($role->name == 'Admin'||$role->name=="Manager") {
                    $data = $_REQUEST;


                    $category_id = $request->input('id');

                    $good = Good::find($id);

                    $good->categories()->detach($category_id);

                    return 'ok';
                }
            }

            return "no_access";
        }
        catch (\Exception $e){
            return 'no_access';
        }

    }

    public function category_check(Request $request,$id){
        try {
            $user = User::find(unserialize(request()->cookie('prof'))['id']);

            foreach ($user->roles as $role) {
                if ($role->name == 'Admin'||$role->name=="Manager") {
                    $data = $_REQUEST;

                    $good = Good::find($id);

                    $categories = Category::whereDoesntHave('goods', function($q) use ($id){
                        $q->where('good_id', $id);
                    })->get();;

                    return $categories;
                }
            }

            abort(404);
        }
        catch (\Exception $e){
            abort(404);
        }
    }

    public function category_add(Request $request,$id){
        try {
            $user = User::find(unserialize(request()->cookie('prof'))['id']);

            foreach ($user->roles as $role) {
                if ($role->name == 'Admin'||$role->name=="Manager") {
                    $data = $_REQUEST;

                    $good = Good::find($id);

                    $category_id = $request->input('id');

                    $category = Category::find($category_id);

                    $good->categories()->attach($category_id);

                    return $category;
                }
            }

            return "no_access";
        }
        catch (\Exception $e){
            return 'no_access';
        }

    }



    public function image_add(Request $request,$id){
        try {
            $user = User::find(unserialize(request()->cookie('prof'))['id']);

            foreach ($user->roles as $role) {
                if ($role->name == 'Admin'||$role->name=="Manager") {

                    $good = Good::find($id);

                    $image = Input::file('avatar');

                    $filename = time().''.random_int(0,10000).'.'.$image->getClientOriginalExtension();

                    $path = public_path('images/goods/'.$filename);

                    $image_added = Image_link::make($image->getRealPath())->resize(300, 300)->save($path);

                  $image_created = Image::create([
                      'name'=>$image_added->filename,
                      'link'=>$image_added->basename,
                  ]);
                  $good->images()->attach($image_created->id);

                  return redirect()->back();
                }
            }

            return "no_access";
        }
        catch (\Exception $e){

            return 'no_access';
        }
    }


    public function image_delete(Request $request,$id){
        try {
            $user = User::find(unserialize(request()->cookie('prof'))['id']);

            foreach ($user->roles as $role) {
                if ($role->name == 'Admin'||$role->name=="Manager") {

                    $good = Good::find($id);

                    $image = Image::find($request->input('image_id'));

                    $good->images()->detach($image->id);

                    $path = public_path('images/goods/'.$image->link);

                    $image->delete();

                    unlink($path);

                    return 'ok';
                }
            }

            return "no_access";
        }
        catch (\Exception $e){
            return 'no_access';
        }
    }

    public function image_main_change(Request $request,$id){
        try {
            $user = User::find(unserialize(request()->cookie('prof'))['id']);

            foreach ($user->roles as $role) {
                if ($role->name == 'Admin'||$role->name=="Manager") {

                    $good = Good::find($id);

                    $image = Image::find($request->input('image_id'));

                    $good->main_id_img = $image->id;
                    $good->save();

                    return 'ok';
                }
            }

            return "no_access";
        }
        catch (\Exception $e){
            return 'no_access';
        }
    }
    public function order_single(Request $request,$id){
        try {
            $user = User::find(unserialize(request()->cookie('prof'))['id']);

            foreach ($user->roles as $role) {
                if ($role->name == 'Admin'||$role->name=="Manager") {


                    $orders = Order::whereHas('goods', function ($query) use ($id) {
                        $query->where('good_id', '=', $id);
                    })->with('user')->paginate(5);


                    $data['orders'] = $orders;
                    $data['order_statuses'] = config('order_statuses');

                    return view('admin/order_single', $data)->render();
                }
            }

            return "no_access";
        }
        catch (\Exception $e){

            return 'no_access';
        }
    }



    public function order_status(Request $request,$id){
        try {
            $user = User::find(unserialize(request()->cookie('prof'))['id']);

            foreach ($user->roles as $role) {
                if ($role->name == 'Admin' || $role->name == "Manager") {

                    $order_id = $id;


                    $order = Order::Find($id);
                    $order->order_status = $request->input('status');
                    $order->save();


                    return 'ok';
                }
            }

            return "no_access";
        }
        catch (\Exception $e){
            return 'no_access';
        }
    }

    public function create(Request $request){
        try {
            if($request->isMethod('get')){

                $data['categories'] = Category::all();

                return view('admin/create_good',$data);
            }
            else {
                $user = User::find(unserialize(request()->cookie('prof'))['id']);

                foreach ($user->roles as $role) {
                    if ($role->name == 'Admin' || $role->name == "Manager") {

                        $good_create = $request->except('token','categories');

                        $images = $request->allFiles();

                        $good = Good::create($good_create);

                        $categories_id = $request->input('categories');

                        foreach ($images['images'] as $image){

                            $filename = time().''.random_int(0,10000).'.'.$image->getClientOriginalExtension();

                            $path = public_path('images/goods/'.$filename);

                            $image_added = Image_link::make($image->getRealPath())->resize(300, 300)->save($path);

                            $image_created = Image::create([
                                'name'=>$image_added->filename,
                                'link'=>$image_added->basename,
                            ]);

                            $good->images()->attach($image_created->id);

                        }

                        $text = 'New item added <a href="'.route('admin_single_good',['id'=>$good->id]).'">'.$good->name.'</a>';

                        $note = Notification::create([
                            'text'=>$text
                        ]);

                        $all_users = User::whereHas('activations',function ($q) {
                            $q->where('completed','1');
                        })->get();

                        foreach ($all_users as $user){
                            $user->notifications()->attach($note);
                        }

                        $good->main_id_img = $image_created->id;
                        $alias = str_replace(' ', '_',$good->name);
                        $good->alias = $alias.'_'.$good->id;
                        $good->categories()->attach($categories_id);
                        $good->save();

                        return redirect()->back();

                    }
                }

                return redirect()->back()->with('status', 'No access');
            }
        }
        catch (\Exception $e) {
            return redirect()->back()->with('status', 'No access');
        }
    }

}
