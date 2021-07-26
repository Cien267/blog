<?php

namespace App\Http\Controllers;

use App\User;
use App\Message;
use App\Events\NewMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index(){

        $users = DB::select("select users.id, users.name, users.image, count(is_read) as unread
        from users LEFT  JOIN  messages ON users.id = messages.sender_id and is_read = 0 and messages.receiver_id = " . Auth::id() . "
        where users.id != " . Auth::id() . "
        group by users.id, users.name, users.image");

        return view('messenger')->with('users', $users);
    }

    public function getMessage($user_id){
        $my_id = Auth::id();

        Message::where(['sender_id' => $user_id, 'receiver_id' => $my_id])->update(['is_read' => 1]);

        //get all msg for selected user
        $messages = Message::where(function($query) use ($user_id, $my_id){
            $query->where('sender_id',$my_id)->where('receiver_id', $user_id);
        })->orWhere(function($query2) use ($user_id, $my_id){
            $query2->where('receiver_id',$my_id)->where('sender_id', $user_id);
        })->get();

        return view('messages.index')->with('messages', $messages);
    }

    public function sendMessage(Request $request){
        $sender_id = Auth::id();
        $receiver_id = $request->receiver_id;
        $content = $request->message;

        $data = new Message();
        $data->sender_id = $sender_id;
        $data->receiver_id = $receiver_id;
        $data->content = $content;
        $data->is_read = 0;
        $data->save();

        $msg = ['sender_id' => $sender_id, 'receiver_id' => $receiver_id];
        event(new NewMessage($msg));
    }
}
