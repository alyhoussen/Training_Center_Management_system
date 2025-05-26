<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    //
    public function index(){
        return view('notifications');
    }
    public function getNumber(){
        $notifications = Notification::where('destinateur','=',Auth::user()->id)->orderByDesc('id')->get();
        $message_number = Message::where('receiver','=',Auth::user()->id)->where('state','unchecked')->get()->count();
        $number = $notifications->where('state','=','unchecked')->count();
        return response()->json(['success'=>true,'number'=>$number,'id'=>Auth::user()->id,"message_number"=>$message_number]);
    }
    public function get(){
        $notifications = Notification::where('destinateur','=',Auth::user()->id)->orderByDesc('id')->get();
        $new_notifications = Notification::where('destinateur','=',Auth::user()->id)->update(['state'=>'checked']);
        if($notifications->count() > 0){
            return response()->json(['success'=>true,'notifications'=>$notifications,'update_status'=>$new_notifications]);
        }else{
            return response()->json(['success'=>false]);
        }
    }
    public function destroy($id){
        $success = Notification::find($id)->delete();
        return response()->json(['success'=>$success]);
    }
}
