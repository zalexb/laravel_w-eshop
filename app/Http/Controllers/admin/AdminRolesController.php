<?php

namespace App\Http\Controllers\admin;

use App\Good;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Role;
use App\User;
use Cartalyst\Sentinel\Native\Facades\Sentinel;



class AdminRolesController extends Controller
{
    //
    public function add_role_get(){
        return view('admin/add_role');
    }

    public function add_role(Request $request){
        try {
            $user = User::find(unserialize(request()->cookie('prof'))['id']);

            foreach ($user->roles as $role) {
                if ($role->name == 'Admin'||$role->name=="Manager") {


                    Sentinel::getRoleRepository()->createModel()->create([
                        'name' => $request->input('name'),
                        'slug' => $request->input('slug'),
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

    public function roles_list(){

        $data['roles'] = Role::all();

        return view('admin/roles',$data);
    }

    public function single_role(Request $request,$id){

        $data['role'] = Role::find($id);
        $data['users'] = $data['role']->users()->paginate(5);

        if($request->ajax())
            return view('admin/users_tab',$data);

        return view('admin/single_role',$data);
    }

    public function detach_user(Request $request){
        try {
            $user = User::find(unserialize(request()->cookie('prof'))['id']);

            foreach ($user->roles as $role) {
                if ($role->name == 'Admin'||$role->name=="Manager") {

                    $role = Role::find($request->input('role_id'));

                    $role->users()->detach($request->input('user_id'));

                    return 'ok';
                }
            }

            return 'no_access';
        }
        catch (\Exception $e){
            return 'no_access';
        }
    }

    public function delete_role(Request $request,$id){
        try {
            $user = User::find(unserialize(request()->cookie('prof'))['id']);

            foreach ($user->roles as $role) {
                if ($role->name == 'Admin'||$role->name=="Manager") {

                    $role = Role::find($id);

                    $user_count = $role->users()->count();

                    if($user_count!=0)
                        return redirect()->back()->with('status','users');

                    $role->delete();

                    return redirect()->route('roles_list');
                }
            }

            return redirect()->back()->with('status', 'No access');
        }
        catch (\Exception $e){
            return redirect()->back()->with('status', 'No access');
        }
    }
}
