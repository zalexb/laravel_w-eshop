<?php

namespace App\Http\Controllers\admin;

use App\Category;
use App\Good;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryAdminController extends Controller
{
    //

    public function get_list(){
        $data['categories']= Category::all();

        return view('admin/categories',$data);
    }

    public function single(Request $request,$id){

        $data['category']= Category::find($id);
        $data['goods'] = Good::whereHas('categories', function($q) use ($id){
            $q->where('category_id','=',$id);
        })
            ->with('image')
            ->paginate(5);

        return view('admin/single_category',$data);
    }

    public function delete_category(Request $request,$id){

        try {
            $user = User::find(unserialize(request()->cookie('prof'))['id']);

            foreach ($user->roles as $role) {
                if ($role->name == 'Admin'||$role->name=="Manager") {
                    $category = Category::find($id);
                    $count_goods = $category->goods()->count();

                    if($count_goods!=0)
                        return redirect()->back()->with('status','goods');

                    $category->delete();

                    return redirect()->route('categories_list');
                }
            }

            return redirect()->back()->with('status', 'No access');
        }
        catch (\Exception $e){
            return redirect()->back()->with('status', 'No access');
        }


    }

    public function create_category(Request $request){
        try {
            $user = User::find(unserialize(request()->cookie('prof'))['id']);

            foreach ($user->roles as $role) {
                if ($role->name == 'Admin'||$role->name=="Manager") {

                    $category = Category::create([
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

    public function get_create(){
        return view('admin/create_category');
    }
}
