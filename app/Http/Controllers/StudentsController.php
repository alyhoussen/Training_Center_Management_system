<?php

namespace App\Http\Controllers;

use App\Models\Centre;
use App\Models\Eleve;
use App\Models\Formation;
use App\Models\Formationsession;
use App\Models\Notification;
use App\Models\Payement;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class StudentsController extends Controller
{
    //

    public function index()
    {
        $students = Eleve::all();
        $sessions = Formationsession::all();
        $formations = Formation::all();
        $centres = Centre::all();
        return view('students',compact('students','sessions','centres','formations'));
    }
    
    public function get()
    {
        $students = Eleve::all();
        $sessions = Formationsession::all();
        if(Auth::user()->privillege == 'teacher'){
            $centre = Centre::where('id_centre','=',Auth::user()->centre)->first()->ville;
            $students = Eleve::where('id_centre','=',$centre)->get();
        }
        if($sessions){
            if($students){
                foreach($students as $student){
                    foreach($sessions as $session){
                        if($session->id == $student->id_session){
                            $student->start = $session->start;
                            $student->end = $session->end;
                        }
                    }
                }
                return response()->json(['success'=>true,'students'=>$students]);
            }
        }
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'name'=>'required|string|max:255',
            'surname'=>'required|string|max:255',
            'datenaiss'=>'required|date',
            'phone'=>'required|string|max:12',
            'cin'=>'required|string|max:12',
            'email'=>'required|email|unique:eleves,email',
            'image'=>'image|file|mimes:jpeg,jpg,gif,svg,png|max:2048',
            'center'=>'required|string|max:20',
            'formation'=>'required|string|max:20',
            'level'=>'required|string|max:20',
            'id_session'=>'required|int|max:1000',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()],422);   
        }
        $eleve = Eleve::create([
            'name'=> $request->name,
            'surname'=> $request->surname,
            'datenaiss'=> $request->datenaiss,
            'telephone'=> $request->phone,
            'cin'=> $request->cin,
            'email'=> $request->email,
            'image'=> '/images/fav.jpg',
            'level'=> $request->level,
            'id_centre'=> $request->center,
            'id_formation'=> $request->formation,
            'id_session'=> $request->id_session,
            'enseignant'=>$request->user
        ]);
        $eleve = Eleve::all()->last();
        $admins = User::where('privillege','=','admin')->get();
        if(Auth::user()->privillege == "teacher"){
            $text = 'A new student <b>'.$eleve->name.' '.$eleve->surname.'</b> added by user <b>'.Auth::user()->name.'</b>';
            foreach($admins as $admin){
                Notification::create([
                    'text'=>$text,
                    'destinateur'=>$admin->id,
                    'state'=>'unchecked',
                ]);
            }
        }
        return response()->json(['success'=>true,'data'=>$eleve,/*'file'=>$path*/],200);
    }
    public function destroy($id){
        $eleve = Eleve::findOrFail($id);
        Payement::where("id_eleve",'=',$eleve->id)->delete();
        $eleve = Eleve::findOrFail($id)->delete();
        return response()->json(['Data'=>$eleve,'status'=>"no errors"]);
    }
    public function update($id,Request $request){
        $eleve = Eleve::findOrFail($id);
        $validator = Validator::make($request->all(),
        [
            'name'=>'required|string|max:255',
            'surname'=>'required|string|max:255',
            'datenaiss'=>'required|date',
            'phone'=>'required|string|max:12',
            'cin'=>'required|string|max:12',
            'email'=>'required|email',
            'center'=>'required|string|max:20',
            'formation'=>'required|string|max:20',
            'level'=>'required|string|max:20',
            'id_session'=>'required|int|max:1000',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()],422);   
        }
        try{
            $eleve->name = $request->name;
            $eleve->surname = $request->surname;
            $eleve->telephone = $request->phone;
            $eleve->cin = $request->cin;
            $eleve->email = $request->email;
            $eleve->level = $request->level;
            $eleve->id_centre = $request->center;
            $eleve->id_formation = $request->formation;
            $eleve->id_session = $request->id_session;
            $eleve->enseignant = $request->user;
            $eleve->save();
            return response()->json(['success'=>true,"data"=>$eleve],200);
        }catch(\Exception $e){
            return response()->json(['errors'=>$e->getMessage()]);
        }
 
    }
    public function search($item){    
        $students = Eleve::where("name","like","%".$item."%")->orWhere("surname","like","%".$item."%")->get();
        $sessions = Formationsession::all();
        if($sessions){
            if($students){
                foreach($students as $student){
                    foreach($sessions as $session){
                        if($session->id = $student->id_session){
                            $student->start = $session->start;
                            $student->end = $session->end;
                        }
                    }
                }
                return response()->json(['success'=>true,'students'=>$students]);
            }
        }
        return response()->json(['success'=>false],200);
    }
    public function payement(){
        return view('students.payement');
    }
    public function list(Request $request){
        $eleve = Eleve::all();
        return response()->json(['data'=>$eleve],200);
    }
}
