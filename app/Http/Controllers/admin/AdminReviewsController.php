<?php

namespace App\Http\Controllers\admin;

use App\Good;
use App\Order;
use App\Review;
use App\User;
use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Cartalyst\Sentinel\Roles\EloquentRole;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Intervention\Image\ImageManagerStatic as Image_link;

class AdminReviewsController extends Controller
{
    //
    public function review_single_user(Request $request,$id){

        $reviews = Review::where('user_id','=',$id)->where('content', '!=', null)->with('user')->paginate(5);

        $data['reviews'] = $reviews;

        return view('admin/review_single', $data)->render();

    }

    public function review_single(Request $request,$id){
        try {
            $user = User::find(unserialize(request()->cookie('prof'))['id']);

            foreach ($user->roles as $role) {
                if ($role->name == 'Admin' || $role->name == "Manager") {

                    $reviews = Review::where('good_id', '=', $id)->where('content', '!=', null)
                        ->with('user')->paginate(5);


                    $data['reviews'] = $reviews;


                    return view('admin/review_single', $data)->render();
                }
            }

            return "no_access";
        }
        catch (\Exception $e){

            return 'no_access';
        }
    }

    public function review_delete(Request $request){
        try {
            $user = User::find(unserialize(request()->cookie('prof'))['id']);

            foreach ($user->roles as $role) {
                if ($role->name == 'Admin'||$role->name=="Manager") {
                    $data = $_REQUEST;

                    $review = Review::find($request->input('id'));

                    $review->delete();

                    return 'ok';
                }
            }

            return "no_access";
        }
        catch (\Exception $e){
            return 'no_access';
        }

    }
    public function reviews_ajax(Request $request){

        $paginate = $request->input('paginate');

        $data['reviews'] = Review::with('orders')
            ->when($request->input('sort_by'), function ($query) use ($request) {
                if ($request->input('sort_by') == 'new_to_old')
                    $query->orderBy('id', 'desc');
            })
            ->with('user')->with('good')->paginate($paginate);

        return view('admin/reviews_catalog',$data);
    }
    public function reviews_get(){

        $data['reviews'] = Review::where('content','!=',null)
            ->with('good')->with('user')->paginate(9);


        return view('admin/admin_reviews',$data);
    }
    public function review_edit(Request $request){
        try {
            $user = User::find(unserialize(request()->cookie('prof'))['id']);

            foreach ($user->roles as $role) {
                if ($role->name == 'Admin'||$role->name=="Manager") {

                    $review = Review::find($request->input('id'));

                    $review->update(['content'=>$request->input('value')]);

                    return $request->input('value');

                }
            }

            return "no_access";
        }
        catch (\Exception $e){
            return 'no_access';
        }

    }
}
