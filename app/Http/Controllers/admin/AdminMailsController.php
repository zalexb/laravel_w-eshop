<?php

namespace App\Http\Controllers\admin;

use App\Mail;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AdminMailsController extends Controller
{
    //
    public function get_mails(){
        $user = User::find(unserialize(request()->cookie('prof'))['id']);

        $mails = Mail::whereHas('users',function ($q) use ($user){
            $q->where('user_id',$user->id);
        })->with(['users'=> function ($q) use ($user){
            $q->where('user_id','=',$user->id);
            $q->select('checked');
        }])->orderBy('id','desc')
            ->limit(3)
            ->get();

        foreach ($mails as $mail){

            $created_at = Carbon::parse($mail->created_at);

            $mail->setAttribute('diff_in_time',$created_at->diffForHumans());

        }

        return $mails;
    }
    public function mails_checked(Request $request){
        $data = unserialize(request()->cookie('prof'));

        $user = User::find(unserialize(request()->cookie('prof'))['id']);

        $mails = Mail::find($request->input('ids'));

        foreach ($mails as $mail) {
            DB::table('mail_user')
                ->where('mail_id', $mail->id)
                ->where('user_id', $user->id)
                ->update([
                    'checked' => 1,
                ]);
        }

        $mails_num = Mail::whereHas('users',function ($q) use($user){
            $q->where('user_id','=',$user->id);
            $q->where('checked','=',null);
        })->count();

        $data['new_mails'] = $mails_num;

        $cookie = cookie('prof',serialize($data), 10080);

        return response('true')->withCookie($cookie);
    }
    public function inbox(){

        $user = User::find(unserialize(request()->cookie('prof'))['id']);

        $data['mails'] = Mail::whereHas('users',function ($q) use ($user){
            $q->where('user_id',$user->id);
        })->with(['users'=> function ($q) use ($user){
            $q->where('user_id','=',$user->id);
            $q->select('checked');
        }])->orderBy('id','desc')
            ->paginate(10);

        foreach ($data['mails'] as $mail) {
            DB::table('mail_user')
                ->where('mail_id', $mail->id)
                ->where('user_id', $user->id)
                ->update([
                    'checked' => 1,
                ]);
            $created_at = Carbon::parse($mail->created_at);

            $mail->setAttribute('diff_in_time',$created_at->diffForHumans());
        }

        return view('admin/inbox',$data);
    }
}
