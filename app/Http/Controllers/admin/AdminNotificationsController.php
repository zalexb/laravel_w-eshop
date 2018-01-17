<?php

namespace App\Http\Controllers\admin;

use App\Mail;
use App\Notification;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AdminNotificationsController extends Controller
{
    //
    public function checked(Request $request){
        $data = unserialize(request()->cookie('prof'));

        $user = User::find(unserialize(request()->cookie('prof'))['id']);

        $notifications = Notification::find($request->input('ids'));

        foreach ($notifications as $notification) {
            DB::table('notification_user')
                ->where('notification_id', $notification->id)
                ->where('user_id', $user->id)
                ->update([
                    'checked' => 1,
                ]);
        }

        $notifications = Notification::whereHas('users', function($q) use ($user){
            $q->where('user_id','=',$user->id);
        })->with(['users'=> function ($q) use ($user){
            $q->where('user_id','=',$user->id);
            $q->select('checked');
        }])
            ->select('id','text','created_at')
            ->orderBy('id','desk')
            ->limit(3)
            ->get();

        $groped_notes = $notifications->sortBy(function ($item, $key) {
            return substr($item['users'][0]['pivot']['checked'], -3);
        });

        $notifs_num = Notification::whereHas('users', function($q) use ($user){
            $q->where('user_id','=',$user->id);
            $q->where('checked','=',null);
        })->count();

        $data['notifications'] = $groped_notes->toArray();
        $data['new_notifs_num'] = $notifs_num;

        $cookie = cookie('prof',serialize($data), 10080);

        return response('true')->withCookie($cookie);
    }

    public function check_notifications(){

        $data = unserialize(request()->cookie('prof'));
        $user = User::find(unserialize(request()->cookie('prof'))['id']);

        $notifications = Notification::whereHas('users', function($q) use ($user){
            $q->where('user_id','=',$user->id);
        })->with(['users'=> function ($q) use ($user){
            $q->where('user_id','=',$user->id);
            $q->select('checked');
        }])
            ->select('id','text','created_at')
            ->orderBy('id','desc')
            ->limit(3)
            ->get();

      /*  $groped_notes = $notifications->sortBy(function ($item, $key) {
            return substr($item['users'][0]['checked'], -3);
        });*/

        $notifs_num = Notification::whereHas('users', function($q) use ($user){
            $q->where('user_id','=',$user->id);
            $q->where('checked','=',null);
        })->count();

        $data['notifications'] = $notifications->toArray();
        $data['new_notifs_num'] = $notifs_num;
        $mails = Mail::whereHas('users',function ($q) use($user){
            $q->where('user_id','=',$user->id);
            $q->where('checked','=',null);
        })->count();
        $data['new_mails'] = $mails;

        $cookie = cookie('prof',serialize($data), 10080);

        return response($data)->withCookie($cookie);

    }
    public function all_notifications(){
        $user = User::find(unserialize(request()->cookie('prof'))['id']);



        $data['notifications'] = Notification::whereHas('users', function($q) use ($user){
            $q->where('user_id','=',$user->id);
        })->with(['users'=> function ($q) use ($user){
            $q->where('user_id','=',$user->id);
            $q->select('checked');
        }])
            ->select('id','text','created_at')
            ->orderBy('id','desk')
            ->paginate(10);

        $notifs = Notification::whereHas('users', function($q) use ($user){
            $q->where('user_id','=',$user->id);
        })->with(['users'=> function ($q) use ($user){
            $q->where('user_id','=',$user->id);
            $q->select('checked');
        }])
            ->select('id','text','created_at')
            ->orderBy('id','desk')
            ->get();

        foreach ($notifs as $notification){
            $notification->users->checked=1;
            $notification->save();
        }

        return view('admin/all_notifications',$data);
    }
}
