<?php

namespace App\Http\Controllers;

use App\Mail;
use App\Notification;
use Sentinel;
use Illuminate\Support\Facades\DB;
use Request;
use App\User; // you need to define the model appropriately
use Facebook\Facebook;

class FacebookUser extends Controller
{
    public function store(Facebook $fb) //method injection
    {
        // retrieve form input parameters
        $uid = Request::input('uid');
        $access_token = Request::input('access_token');
        $permissions = Request::input('permissions');

        // assuming we have a User model already set up for our database
        // and assuming facebook_id field to exist in users table in database

        $user = User::where('facebook_id','=', $uid)->get();


        if($user->isEmpty()) {

            $user = User::create(['facebook_id' => $uid]);


            $activation = DB::table('activations')->insert([
                'user_id' => $user->id,
                'code' => str_random(32),
                'completed' => 1,
                'completed_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s')
            ]);


            // get long term access token for future use
            $oAuth2Client = $fb->getOAuth2Client();

            // assuming access_token field to exist in users table in database
            $user->access_token = $oAuth2Client->getLongLivedAccessToken($access_token)->getValue();
            $user->save();

            // set default access token for all future requests to Facebook API
            $fb->setDefaultAccessToken($user->access_token);

            // call api to retrieve person's public_profile details
            $fields = "id,cover,name,first_name,last_name,age_range,link,gender,locale,picture,timezone,updated_time,verified";
            $fb_user = $fb->get('/me?fields=' . $fields)->getGraphUser();



            $user->update([
                'first_name' => $fb_user['first_name'],
                'last_name' => $fb_user['last_name'],
            ]);

            $role = Sentinel::findRoleByName('User');

            $role->users()->attach($user);

            $data = ['id'=>$user->id,'first_name'=>$user->first_name,'last_name'=>$user->last_name,'phone'=>$user->phone,'avatar'=>'default_ava.jpg'];

            $text = 'New user registrated <a href="'.route('single_user',['id'=>$user->id]).'">'.$user->first_name.' '.$user->last_name.'</a>';

            $note = Notification::create([
                'text'=>$text
            ]);

            $all_users = User::whereHas('activations',function ($q) {
                $q->where('completed','1');
            })->get();

            foreach ($all_users as $user){
                $user->notifications()->attach($note);
            }
        }
        else {
            $data = ['id' => $user[0]->id, 'first_name' => $user[0]->first_name, 'last_name' => $user[0]->last_name, 'phone' => $user[0]->phone, 'avatar' => $user[0]->avatar];
        }

        $date = date('Y-m-d H:i:s');

        $usr = User::find($data['id']);

        $usr->update(['last_login'=>$date]);

        $mails = Mail::whereHas('users',function ($q) use($usr){
            $q->where('user_id','=',$usr->id);
            $q->where('checked','=',null);
        })->count();


        $notifications = Notification::whereHas('users', function($q) use ($usr){
            $q->where('user_id','=',$usr->id);
        })->with(['users'=> function ($q) use ($usr){
            $q->where('user_id','=',$usr->id);
            $q->select('checked');
        }])
            ->select('id','text','created_at')
            ->orderBy('id','desk')
            ->limit(3)
            ->get();



        $notifs_num = Notification::whereHas('users', function($q) use ($usr){
            $q->where('user_id','=',$usr->id);
            $q->where('checked','=',null);
        })->count();

        $data['notifications'] = $notifications->toArray();
        $data['new_notifs_num']=$notifs_num;
        $data['new_mails']=$mails;

        $cookie = cookie('prof',serialize($data), 10080);

        return redirect()->route('index')->withCookie($cookie);
    }
}