<?php

namespace App\Http\Controllers;

use App\Models\Centre;
use App\Models\Eleve;
use App\Models\Formation;
use App\Models\Payement;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //
    public function index(){
        $Payement = Payement::all();
        $Eleve = Eleve::all();
        if(Auth::user()->privillege == 'teacher'){
            $centre = Centre::where('id_centre','=',Auth::user()->centre)->first()->ville;
            $Eleve = Eleve::where('id_centre','=',$centre)->get();
            $new_payment = array();
            foreach($Payement as $payement){
                foreach($Eleve as $eleve){
                    if($payement->id_eleve == $eleve->id){
                        $new_payment [] = $payement;
                        break; 
                    }
                }
            }
            $Payement = $new_payment;
        }
        return view("dashboard",compact("Payement","Eleve"));
    }
    public function get(){
        $Eleve = Eleve::all();
        $Formations = Formation::all();
        
        if(Auth::user()->privillege == 'teacher'){
            $centre = Centre::where('id_centre','=',Auth::user()->centre)->first()->ville;
            $Eleve = Eleve::where('id_centre','=',$centre)->get();
        }
        foreach($Formations as $formation){
            $formation->number = 0;
            foreach($Eleve as $eleve){
                if($eleve->id_formation == $formation->nom_formation){
                    $formation->number += 1;
                }
            }
        }
        return response()->json(['formations'=>$Formations,'success'=>true]);
    }
    public function search($item){
        $result = null;
        $Eleves = Eleve::where("name","like","%".$item."%")->orWhere("surname","like","%".$item."%")->get();
        $Payment = Payement::all();
        if($Eleves){
            foreach($Eleves as $eleve){
                foreach($Payment as $payment){
                    if($payment->id_eleve == $eleve->id && $payment->reste_pay > 0){
                        $payment->name = $eleve->name;
                        $result[] = $payment;
                    }
                }
            };
            if($result != null){
                return response()->json(['data'=>$result,'students'=>$Eleves, 'success'=>true]);
            }else{
                return response()->json([ 'success'=>false]);
            }
        }else{
            return response()->json([ 'success'=>false]);
        }
    }
}
