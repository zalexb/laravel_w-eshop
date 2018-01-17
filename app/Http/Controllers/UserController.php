<?php

namespace App\Http\Controllers;


use App\Notification;
use App\User;
use App\Mail as Mail_model;
use Illuminate\Support\Facades\Input;
use Mail;
use Activation;
use function MongoDB\BSON\toJSON;
use Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException ;
use Intervention\Image\ImageManagerStatic as Image;


class UserController extends Controller
{
    //
    public function show(){
        return view('register');
    }

    public function register(Request $request){

        try{
            $data = $request->except('_token');

            $user = Sentinel::register($data);

            $role = Sentinel::findRoleByName('User');

            $role->users()->attach($user);

            $activation = Activation::create($user);

            $to_user = User::find($user->id);

            $data_mail = ['user'=>$to_user,'activation'=>$activation];

            Mail::send('emails.activation',$data_mail,function ($m) use ($to_user){
                $m->from('zwhoiam17@gmail.com', 'Thank you for registration!');

                $m->to($to_user->email, $to_user->name)->subject('Activation!');
            });

            $text = 'New user registrated <a href="'.route('single_user',['id'=>$user->id]).'">'.$user->first_name.' '.$user->last_name.'</a>';

            $note = Notification::create([
                'text'=>$text
            ]);

            $all_users = User::whereHas('activations',function ($q) {
                $q->where('completed','1');
            })->get();

            foreach ($all_users as $one_user){
                $one_user->notifications()->attach($note);
            }

                return $request->email;
        }
        catch (\Exception $e){
            return 'Limit emails is reached!';
        }
    }

    public function activation(Request $request,$id,$code){

        $user = Sentinel::findById($id);

        $activation = ['activation'=>'ok'];



        if($user==null)
            return redirect()->route('index');


        if(Activation::complete($user,$code))
            return redirect('account')->with('status', 'Activated');
        else
            return redirect()->route('index');
    }

    public function check(Request $request){

        $email = $request->except('_token');

        $user_email = Sentinel::findByCredentials($email);

        if($user_email!==null)
            return 'This email is already in use!';

        return "Ok";
    }

    public function login(Request $request){

        try
        {
            $data = $request->except('_token');

            if(Sentinel::authenticateAndRemember($data))
            {
                    $session = Sentinel::check();

                    $notifications = Notification::whereHas('users', function($q) use ($session){
                        $q->where('user_id','=',$session->id);
                    })->with(['users'=> function ($q) use ($session){
                        $q->where('user_id','=',$session->id);
                        $q->select('checked');
                    }])
                        ->select('id','text','created_at')
                        ->orderBy('id','desk')
                        ->limit(3)
                        ->get();

                    $groped_notes = $notifications->sortBy(function ($item, $key) {
                        return substr($item['users'][0]['checked'], -3);
                    });

                    $notifs_num = Notification::whereHas('users', function($q) use ($session){
                        $q->where('user_id','=',$session->id);
                        $q->where('checked','=',null);
                    })->count();

                    $mails = Mail_model::whereHas('users',function ($q) use($session){
                        $q->where('user_id','=',$session->id);
                        $q->where('checked','=',null);
                    })->count();

                    $data = [
                        'id'=>$session->id,
                        'first_name'=>$session->first_name,
                        'last_name'=>$session->last_name,
                        'phone'=>$session->phone,
                        'avatar'=>$session->avatar,
                        'notifications'=>$groped_notes->toArray(),
                        'new_notifs_num' => $notifs_num
                    ];
                    $data['new_mails'] = $mails;
                    $cookie = cookie('prof',serialize($data), 10080);

                    return response('true')->withCookie($cookie);
            }
            else
            {
                return 'false';
            }
        }
       /*
        catch (ThrottlingException $e)
        {
            return "Throttle";
        }*/
        catch (NotActivatedException $e)
        {
            return 'Not activated';
        }


    }

    public function logout(Request $request){

        Sentinel::logout(null, true);

        $cookie = Cookie::forget('prof');

        return redirect()->back()->withCookie($cookie);
    }

    public function profile(Request $request,$id)
    {
            $user = User::find($id);

            if($user&&Activation::completed($user)) {
                $data['user'] = $user;

                return view('profile', $data);
            }
            else
                abort(404);
    }

    public function profile_edit(Request $request,$id){

        try {
            $user = Sentinel::findById($id);

            $data = unserialize(request()->cookie('prof'));

            if ($data['id']==$id && $user && Sentinel::validForUpdate($user,$request->except('_token'))) {

                if($request->file('avatar')) {

                    $image = Input::file('avatar');

                    $filename = time().''.random_int(0,10000).'.'.$image->getClientOriginalExtension();

                    $path = public_path('images/profile_ava/'.$filename);

                    $old_image = public_path().'/images/profile_ava/'.$user->avatar;

                    Image::make($image->getRealPath())->resize(300, 300)->save($path);

                    $data['avatar'] = $filename;

                    $user->avatar=$filename;

                    $user->save();

                    $cookie = cookie('prof', serialize($data), 10080);
                    
                    if($user->avatar!='default_ava.jpg')
                        unlink($old_image);

                    return redirect()->back()->withCookie($cookie);

                }else{
                    Sentinel::update($user, $request->except('_token'));

                    if ($request->input('first_name'))
                        $data['first_name'] = $request->input('first_name');

                    $cookie = cookie('prof', serialize($data), 10080);

                    return response('Ok')->withCookie($cookie);
                }

            }
            else
                abort(404);

        }catch (\Exception $e){
            abort(404);
        }
    }


}
