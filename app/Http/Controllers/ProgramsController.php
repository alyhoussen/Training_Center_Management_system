<?php

namespace App\Http\Controllers;

use App\Models\Centre;
use App\Models\Edt;
use App\Models\Eleve;
use App\Models\Enseignant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProgramsController extends Controller
{
    //
    public function index(){
        $edts = Edt::orderBy("created_at","desc")->get();
        $centres = Centre::all();
        return view("programs",compact("edts","centres"));
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            "day"=> "required|string|max:255",
            "hour"=> "required|",
            "date"=> "required|date",
            "type"=> "required|string|max:255",
            "formation"=> "required|string",
            "level"=> "required|string|max:255",
            "teacher"=> "string|max:255",
        ]);
        if($validator->fails()){
            return response()->json(["errors"=>$validator->errors()],422);
        }
        Edt::create([
            "jour"=> $request->day,
            "heur"=> $request->hour,
            "date_edt"=> $request->date,
            "type"=> $request->type,
            "nom_formation"=> $request->formation,
            "niveau"=> $request->level,
            "centre"=> $request->centre,
            "nom_enseignant"=> $request->teacher ? $request->teacher: null,
        ]);
        $data = Edt::all()->last();
        return response()->json(["success"=>true,"data"=> $data],200);

    }
    public function update(Request $request){
        $edt = Edt::find($request->id);
        if($edt){
            $edt->jour = $request->jour;
            $edt->heur = $request->heur;
            $edt->date_edt = $request->date;
            $edt->type = $request->type;
            $edt->nom_formation = $request->formation;
            $edt->niveau = $request->niveau;
            $edt->nom_enseignant = $request->teacher;
            $edt->save();
            return response()->json(['data'=>$edt,'success'=>true]);
        }
    }
    public function search($id){
        $edt = Edt::find($id);
        if($edt){
            return response()->json(["success"=>true,"data"=> $edt],200);   
        }
    }

    public function destroy($id){
        $edt = Edt::find($id)->delete();
        if($edt){
            return response()->json(["success"=>true],200);
        }else{
            return response()->json(["success"=>false],0);
        }
    }

    public function getEdt($start,$end,$centreFilter){
        $user = Auth::user();
        $student = Eleve::where('email','=',$user->email)->first(); 
        $teacher = Enseignant::where('email','=',$user->email)->first();
        $centre = null;
        if($teacher){
            $centre = Centre::where('id_centre','=',$teacher->id_centre)->first()->ville;
        }elseif($student){
            $centre = $student->id_centre;
        }
        if($user->privillege == "admin"){
            $centre = $centreFilter;
        }
        $edt = Edt::where('date_edt','<',$end)->orderBy('heur')->get();
        if($edt && $centre){
            $new_edt = array();
            foreach($edt as $item){
                if($item->date_edt >= $start){
                    $new_edt[] = $item;
                }
            }
            $edt = null;
            foreach($new_edt as $item){
                if($item->centre == $centre){
                    $edt[] = $item;
                }
            }
            if($edt){
                return response()->json(['data'=>$edt,'success'=>true]);
            }
            else{
                return response()->json(['success'=>false]);
            }
        }
        /*
        $edt = Edt::where('centre','=',$student->id_centre)->get();*/
    }
}