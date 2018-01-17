<?php

namespace App\Http\Controllers;


use App\Notification;
use App\Good;
use App\Review;
use App\User;
use Illuminate\Http\Request;

class ReviewsController extends Controller
{
    //
    public function review_create(Request $request){

        try {
            $data = $request->except('_token');


            $data['user_id'] = unserialize(request()->cookie('prof'))['id'];

            $good = Good::where('alias','=',$data['alias'])->first();

            $data['good_id'] = $good->id;

            Review::create($data);

            $text = 'New review created on item <a href="'.route('admin_single_good',['id'=>$good->id]).'">'.$good->name.'</a>';


            $note = Notification::create([
                'text'=>$text
            ]);

            $all_users = User::whereHas('activations',function ($q) {
                $q->where('completed','1');
            })->get();

            foreach ($all_users as $user){
                $user->notifications()->attach($note);
            }

            return "Ok";

        }catch (\Exception $e){
            abort(404);
        }
    }

    public function reviews(Request $request,$id){
        try{
                $data['reviews'] = Review::where('user_id','=',$id)
                    ->where('content','!=',null)->with('good')->with('user')->paginate(9);

                return view('reviews',$data);
        }
        catch (\Exception $e){
            abort(404);
        }
    }

    public function rating(Request $request,$good_id,$rating){
        try{
            if(unserialize(request()->cookie('prof'))['id']){

                if($rating>5)
                    $rating = 5;


                    $review = Review::create(["user_id"=>unserialize(request()->cookie('prof'))['id'],
                        "good_id"=>$good_id,
                        "rating"=>$rating,
                        'created_at'=>date("Y-m-d h:i:s a", time())
                    ]);


                $reviews = Review::where('good_id','=',$good_id)->where('rating','!=',null)->get();

                $good = Good::find($good_id);

                $rating = 0;

                foreach ($reviews as $review){
                    $rating += $review->rating;

                }
                $rating = round($rating / $reviews->count());

                $good->rating = $rating;

                $good->save();

                return redirect()->back();
            }
            else
                abort(404);
        }catch (\Exception $e){

            abort(404);
        }
    }

    public function favorite_add(Request $request,$good_id){
        try{
            if(unserialize(request()->cookie('prof'))['id']){
                $user = User::find(unserialize(request()->cookie('prof'))['id']);

                $user->favorites_goods()->attach($good_id);

                return redirect()->back();
            }
            else
                abort(404);

        }
        catch (\Exception $e) {
            abort(404);
        }

    }

    public function favorite_delete(Request $request,$good_id){
        try{
            if(unserialize(request()->cookie('prof'))['id']){
                $user = User::find(unserialize(request()->cookie('prof'))['id']);

                $user->favorites_goods()->detach($good_id);

                return redirect()->back();
            }
            else
                abort(404);

        }
        catch (\Exception $e) {
            abort(404);
        }

    }
    public function favorites(Request $request,$user_id){
        try{
            $user = User::find($user_id);

            if($user==null)
                abort(404);


                $data['favorites'] = $user->favorites_goods()->paginate(9);
                $data['user']=$user;


                return view('favorites',$data);

        }
        catch (\Exception $e) {
            abort(404);
        }

    }
}
