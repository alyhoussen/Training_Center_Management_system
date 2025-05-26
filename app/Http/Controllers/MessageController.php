<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    //
    public function index(){
        return view('messages');
    }
    public function store(Request $request){
        Message::create([
            'message'=>$request->message,
            'sender'=>Auth::user()->id,
            'receiver'=>$request->sender,
        ]);
        return response()->json(['success'=>true]);
    }
    public function get(){
        $online_users = User::where('status','=','online')->get();
        $new_messages = Message::where('receiver','=', Auth::user()->id)->orderByDesc('date')->get();
        $users = User::all();
        $success = true;
        if($new_messages->count() == 0){
            $success = false;
        }else{
            foreach($new_messages as $message){
                foreach($users as $user){
                    if($user->id == $message->sender){
                        $message->user_name = $user->name;
                    }
                }
            }
            return response()->json(["gens"=>$users,'users'=>$online_users,'new_messages'=>$new_messages,'success'=>$success]);
        }
        
    }
    public function mp($id){
        $messages = Message::where('receiver','=',Auth::user()->id)->where('sender','=',$id)->orWhere('receiver','=',$id)->where('sender','=',Auth::user()->id)->get();
        $sender = $id;
        $name = User::where("id",'=',$id)->first()->name;
        return view('messages.mp',compact('messages','sender','name'));
    }
}
