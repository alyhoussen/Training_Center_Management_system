<?php

namespace App\Http\Controllers;

use App\Models\Centre;
use App\Models\Enseignant;
use App\Models\Formation;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class TeachersController extends Controller
{
    //
    
    public function index(){
        $teachers = Enseignant::all();
        $formations = Formation::all();
        $centres = Centre::all();
        return view("teachers",compact("teachers","centres","formations"));
    }
    public function get(){
        $formations = Formation::all();
        $centres = Centre::all();
        $teachers = Enseignant::all();
        if($formations && $centres){
            if($teachers){
                foreach($teachers as $teacher){
                    foreach($formations as $formation){
                        if($formation->id_formation == $teacher->id_formation){
                            $teacher->formation = $formation->nom_formation;
                        }
                    }
                    foreach($centres as $centre){
                        if($centre->id_centre == $teacher->id_centre){
                            $teacher->centre = $centre->ville;
                        }
                    }
                }
                return response()->json(['success'=>true,'teachers'=>$teachers]);
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
            'email'=>'required|email|unique:enseignants,email',
            'center'=>'required|string|max:20',
            'formation'=>'required|string|max:20',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()],422);   
        }
        /*
        if($request->file("image")){
            $path = $request->file("image")->store('assets','public');
        }*/
        $formation = Formation::where('nom_formation','=', $request->formation)->first();
        $centre = Centre::where('ville','=', $request->center)->first();
        $teachers = Enseignant::create([
            'name'=> $request->name,
            'surname'=> $request->surname,
            'datenaiss'=> $request->datenaiss,
            'telephone'=> $request->phone,
            'CIN'=> $request->cin,
            'email'=> $request->email,
            'image'=> "/assets/avatar.jpg",
            'id_centre'=>$centre->id_centre,
            'id_formation'=>$formation->id_formation,
        ]);
        return response()->json(['success'=>true,/*'errors'=>"no errors",'file'=>$path*/],200);
    }
    public function destroy($id){
        $enseignant = Enseignant::where('id_enseignant','=',$id)->delete();
        return response()->json(['Data'=>$enseignant,'status'=>"no errors"]);
    }
    public function update($id,Request $request){
        $validator = Validator::make($request->all(),[
            'name'=>'required|string|max:255',
            'surname'=>'required|string|max:255',
            'datenaiss'=>'required|date',
            'phone'=>'required|string|max:12',
            'cin'=>'required|string|max:12',
            'center'=>'required|string|max:20',
            'formation'=>'required|string|max:20',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()],422);   
        }
        $teacher = Enseignant::where('id_enseignant','=',$id)->first();
        $formation = Formation::where('nom_formation','=', $request->formation)->first();
        $centre = Centre::where('ville','=', $request->center)->first();
        try{
            $teacher = Enseignant::where('id_enseignant','=',$id)->update([
                'name'=> $request->name,
                'surname'=> $request->surname,
                'telephone'=> $request->phone,
                'CIN'=>$request->cin,
                'email'=> $request->email,
                'id_centre'=> $centre->id_centre,
                'id_formation'=> $formation->id_formation,
            ]);
            return response()->json(['success'=>true,'errors'=>"no errors",'data'=>$teacher],200);
        }catch(\Exception $e){
            return response()->json(['errors'=>$e->getMessage(),'success'=>false]);
        }
 
    }
    public function search($value){
        $results = Enseignant::where('name','LIKE','%'.$value.'%')->orWhere('surname','LIKE','%'.$value.'%')->get();
        if($results->count()>0){
            return response()->json(['data'=>$results,'success'=>true],200);
        }else{
            return response()->json(['data'=>"no result",'success'=>false],200);
        }
    }
}



