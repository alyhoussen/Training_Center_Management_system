<?php

namespace App\Http\Controllers;

use App\Models\Eleve;
use App\Models\Formation;
use App\Models\Notification;
use App\Models\Payement;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BudgetController extends Controller
{
    //
    public function index(){
        $transactions = Transaction::where('id','>', '0')->orderByDesc('id')->get();
        $depense = 0;
        foreach($transactions as $transaction){
            if($transaction->type == 'Outgoing'){
                $depense += $transaction->somme;
            }
        }
        $payments = Payement::all(); 
        $formations= Formation::all();   
        $eleves = Eleve::all();
        foreach($eleves as $eleve){
            foreach($formations as $formation){
                if($formation->nom_formation == $eleve->id_formation){
                    $eleve->frais = $formation->frais;
                }
            }
        }
        $rest = 0;
        $counter = 0;
        $paid_fee = 0;
        $unpaid_fee = 0;
        $paid_cotisation = 0;
        $unpaid_cotisation = 0;
        
        $total_budget = $transactions->last()->somme;
        
        foreach($eleves as $eleve){
            foreach($payments as $payment){
                //echo($eleve->id);
                //echo("->".$payment->id_eleve);
                //echo("<br>");
                if($eleve->id == $payment->id_eleve){
                    $counter += 1;
                }
            }
            //echo("compteur = ".$counter);
            //echo("--------------- <br>");
            if($counter == 0){
                $rest += $eleve->frais;
            }
            $counter = 0;
        }
        foreach($payments as $payment){
            if($payment->reste_pay > 0){
                $rest += $payment->reste_pay;
                if($payment->description == 'school fee'){
                    $unpaid_fee += $payment->reste_pay;
                }
                else{
                    $unpaid_cotisation += $payment->reste_pay;
                }
            }
            
            if($payment->description == 'school fee'){
                $paid_fee += $payment->montant_pay;
            }
            else{
                $paid_cotisation += $payment->montant_pay;
            }
        }
        return view('budget',compact("transactions","depense","rest","total_budget","paid_fee","unpaid_fee","paid_cotisation","unpaid_cotisation"));

    }
    public function get(){
        $transactions = Transaction::where('id','>', '0')->orderByDesc('id')->get();
        $depense = 0;
        $users = User::all();
        foreach($transactions as $transaction){
            if($transaction->type == 'Outgoing'){
                $depense += $transaction->somme;
            }
            foreach($users as $user){
                if($transaction->by == $user->id){
                    $transaction->user = $user->name;
                }
            }
        }
        $payments = Payement::all(); 
        $formations= Formation::all();   
        $eleves = Eleve::all();
        foreach($eleves as $eleve){
            foreach($formations as $formation){
                if($formation->nom_formation == $eleve->id_formation){
                    $eleve->frais = $formation->frais;
                }
            }
        }
        $rest = 0;
        $counter = 0;
        $paid_fee = 0;
        $unpaid_fee = 0;
        $paid_cotisation = 0;
        $unpaid_cotisation = 0;
        
        $total_budget = $transactions->last()->somme;
        
        foreach($eleves as $eleve){
            foreach($payments as $payment){
                //echo($eleve->id);
                //echo("->".$payment->id_eleve);
                //echo("<br>");
                if($eleve->id == $payment->id_eleve){
                    $counter += 1;
                }
            }
            //echo("compteur = ".$counter);
            //echo("--------------- <br>");
            if($counter == 0){
                $rest += $eleve->frais;
            }
            $counter = 0;
        }
        foreach($payments as $payment){
            if($payment->reste_pay > 0){
                $rest += $payment->reste_pay;
                if($payment->description == 'school fee'){
                    $unpaid_fee += $payment->reste_pay;
                }
                else{
                    $unpaid_cotisation += $payment->reste_pay;
                }
            }
            
            if($payment->description == 'school fee'){
                $paid_fee += $payment->montant_pay;
            }
            else{
                $paid_cotisation += $payment->montant_pay;
            }
        }
        return response()->json([
            'success'=>true,
            'data'=>$transactions,
            'total_budget'=>$total_budget,
            'rest'=>$rest,
            'depense'=>$depense,
            'paid_fee'=>$paid_fee,
            'unpaid_fee'=>$unpaid_fee,
            'paid_cotisation'=>$paid_cotisation,
            'unpaid_cotisation'=>$unpaid_cotisation,
        ]);
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'somme'=>'required|int',
            'type'=>'required|string',
            'description'=>'required|string',
            'date'=>'required|date',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()],422);   
        }
        $state = 'Pending';
        if(Auth::user()->privillege == "admin"){
            $state = "verified";
        }
        Transaction::create([
            'somme'=>$request->somme,
            'type'=>$request->type,
            'description'=>$request->description,
            'date'=>$request->date,
            'state'=>$state,
            'by'=>Auth::user()->id,
        ]);
        $transaction = Transaction::all()->last();
        $admins = User::where('privillege','=','admin')->get();
        if(Auth::user()->privillege == "teacher"){
            $text = 'User <b>'.Auth::user()->name.'</b> made a <b>'.$transaction->type.'</b> transaction. <br> Description : <b>'.$transaction->description.'</b>';
            foreach($admins as $admin){
                Notification::create([
                    'text'=>$text,
                    'destinateur'=>$admin->id,
                    'state'=>'unchecked',
                ]);
            }
        }elseif(Auth::user()->privillege == "admin"){
            $text = 'Admin <b>'.Auth::user()->name.'</b> made a <b>'.$transaction->type.'</b> transaction. <br> Description : <b>'.$transaction->description.'</b>';
            foreach($admins as $admin){
                if(Auth::user()->id != $admin->id){
                    Notification::create([
                        'text'=>$text,
                        'destinateur'=>$admin->id,
                        'state'=>'unchecked',
                    ]);
                }
            }
        }
        return response()->json(['success'=>true,'data'=>$transaction],200);
    }
    public function verify($id,$value){
        $transaction = Transaction::find($id);
        $initial = Transaction::find(1);
        $transaction->state = $value;
        $transaction->save();
        $total = 0;
        $notification = '';
        if($value == 'verified'){
            if($transaction->type == 'Ingoing'){
                $initial->somme += $transaction->somme;
            }
            elseif($transaction->type == 'Outgoing'){
                $initial->somme -= $transaction->somme;
            }
            $initial->save();
            $notification = 'Your '.$transaction->type.' transaction of '.$transaction->somme.' has been <b class="green">aprooved</b> by admin '.Auth::user()->name;
        }
        else{
            $notification = 'Your '.$transaction->type.' transaction of '.$transaction->somme.' has been <b class="red">rejected</b> by admin '.Auth::user()->name;
        }
        if(Auth::user()->privillege == "admin"){
            Notification::create([
                'text'=>$notification,
                'destinateur'=>$transaction->by,
                'state'=>'unchecked',
            ]);
        }
        return response()->json(['success'=>true,]);
    }
}
