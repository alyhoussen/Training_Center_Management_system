<?php

namespace App\Http\Controllers;

use App\Models\Formation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FormationController extends Controller
{
    //
    public function index(){
        return view('formation');
    }
    public function get(){
        $formations = Formation::all();
        return response()->json(['success'=>true,'formations'=>$formations]);
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'code_formation'=>'required|string|max:255',
            'nom_formation'=>'required|string|max:255',
            'duree'=>'int|max:10000'
        ]);
        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()],422);   
        }
        $success = Formation::create([
            'code_formation'=>$request->code_formation,
            'nom_formation'=>$request->nom_formation,
            'duree'=>$request->duree,
        ]);
        return response()->json(['success'=>$success]);
    }
    public function update($id,Request $request){
        $validator = Validator::make($request->all(),[
            'code_formation'=>'required|string|max:255',
            'nom_formation'=>'required|string|max:255|',
            'duree'=>'required|int|max:10000'
        ]);
        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()],422);   
        }
        $formation = Formation::where('id_formation','=',$id)->get()->first();
        $formation->code_formation = $request->code_formation;
        $formation->nom_formation = $request->nom_formation;
        $formation->duree = $request->duree;
        $formation->save();
        return response()->json(['success'=>true]);
    }
    public function destroy($id){
        Formation::where('id_formation','=',$id)->delete();
        return response()->json(['success'=>true]);
    }
}
