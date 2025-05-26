<?php

namespace App\Http\Controllers;

use App\Models\Centre;
use App\Models\Formation;
use App\Models\Formationsession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class formationSessionController extends Controller
{
    //
    public function index(){
        $centres = Centre::all();
        $formations = Formation::all();
        return view('session',compact('centres','formations'));
    }
    public function get(){
        $sessions = Formationsession::where('id','>','0')->orderBydesc('id')->get();
        if($sessions->count()>0){
            return response()->json(['sessions'=>$sessions,'success'=>true]);
        }else{
            return response()->json(['success'=>false]);
        }
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'start'=>'required|date',
            'end'=>'required|date',
            'echeance'=>'required|date',
            'formation'=>'required|string|max:12',
            'centre'=>'required|string|max:20',
            'niveau'=>'required|string|max:20',
            'frais'=>'required|int',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()],422);   
        }
        $success = Formationsession::create([
            'start'=>$request->start,
            'end'=>$request->end,
            'echeance'=>$request->echeance,
            'formation'=>$request->formation,
            'niveau'=>$request->niveau,
            'frais'=>$request->frais,
            'centre'=>$request->centre,
        ]);
        return response()->json(['success'=>$success]);
    }
    public function update($id,Request $request){
        $validator = Validator::make($request->all(),[
            'start'=>'required|date',
            'end'=>'required|date',
            'echeance'=>'required|date',
            'formation'=>'required|string|max:12',
            'centre'=>'required|string|max:20',
            'niveau'=>'required|string|max:20',
            'frais'=>'required|int',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()],422);   
        }
        $session = Formationsession::find($id);
        $session->start = $request->start;
        $session->end = $request->end;
        $session->echeance = $request->echeance;
        $session->formation = $request->formation;
        $session->niveau = $request->niveau;
        $session->frais = $request->frais;
        $session->centre = $request->centre;
        $session->save();
        return response()->json(['success'=>true]);
    }
    public function destroy($id){
        $session = Formationsession::find($id);
        if($session){
            $session->delete();
            return response()->json(['success'=>true]);
        }
        else{
            return response()->json(['success'=>false]);
        }
    }
}
