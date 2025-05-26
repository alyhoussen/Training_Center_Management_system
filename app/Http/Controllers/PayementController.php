<?php

namespace App\Http\Controllers;

use App\Models\Centre;
use App\Models\Eleve;
use App\Models\Notification;
use App\Models\Payement;
use App\Models\Transaction;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PayementController extends Controller
{
    //
    public function index(){
        $payments = Payement::all();
        $students = Eleve::all();
        return view("students.payement", compact(["payments","students"]));
    }
    public function get(){
        $payments = Payement::all();
        $students = Eleve::all();
        if(Auth::user()->privillege == 'teacher'){
            $centre = Centre::where('id_centre','=',Auth::user()->centre)->first()->ville;
            $students = Eleve::where('id_centre','=',$centre)->get();
            $new_payment = array();
            foreach($payments as $payement){
                foreach($students as $eleve){
                    if($payement->id_eleve == $eleve->id){
                        $new_payment [] = $payement;
                        break; 
                    }
                }
            }
            $payments = $new_payment;
        }
        $count = 0;
        foreach($payments as $payment){
            $count +=1;
        }
        if($count){
            if($students){
                foreach($payments as $payment){
                    foreach($students as $student){
                        if($student->id == $payment->id_eleve){
                            $payment->name = $student->name;
                            $payment->surname = $student->surname;
                            $payment->email = $student->email;
                        }
                    }
                }
                return response()->json(['payments'=> $payments,'success'=>true]);
            }
        }else{
            return response()->json(['success'=> false]);
        }
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            "name"=> "required|string|max:255",
            "surname"=> "required|string|max:255",
            "email"=> "required|email",
            "description"=> "required|string|max:255",
            "amountPay"=> "required|int|max:10000000",
            "amountPaid"=> "required|int|max:10000000",
            "amountRest"=> "required|int|max:10000000",
        ]);
        if ($validator->fails()) {
            return response()->json(['data'=> $validator->errors()],200);
        }
        $eleve = Eleve::where('name','=', $request->name)->where('surname','=',$request->surname)->first();
        if($eleve){
            $payement = Payement::create([
                'id_eleve'=> $eleve->id,
                "total_pay"=>$request->amountPay,
                "montant_pay"=>$request->amountPaid,
                "reste_pay"=>$request->amountRest,
                "description"=>$request->description,
            ]);
            $transaction = Transaction::find(1);
            $transaction->somme += $request->amountPaid;
            $transaction->save;
            $payement = Payement::all()->last();
            $admins = User::where('privillege','=','admin')->get();
            if(Auth::user()->privillege == "teacher"){
                $text = 'Student <b>'.$eleve->name.' '.$eleve->surname.'</b> '.$eleve->id_formation.' student at '.$eleve->id_centre.' made a payment of'.$request->description.'<b> to user '.Auth::user()->name.'</b>';
                foreach($admins as $admin){
                    Notification::create([
                        'text'=>$text,
                        'destinateur'=>$admin->id,
                        'state'=>'unchecked',
                    ]);
                }
            }elseif(Auth::user()->privillege == "admin"){
                $text = 'Student <b>'.$eleve->name.' '.$eleve->surname.'</b> '.$eleve->id_formation.' student at '.$eleve->id_centre.' made a payment of'.$request->description.'<b> to admin '.Auth::user()->name.'</b>';
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
            return response()->json(['data'=>$payement,'success'=>true],200);
        }else{
            return response()->json(['data'=>false,'success'=>false],200);
        }
    }
    public function update($id,$paid){
        $payment = Payement::find($id);
        if($payment){
            $transaction = Transaction::all()->first();
            $transaction->somme += $paid;
            $transaction->save;
            $payment->montant_pay = $payment->montant_pay+$paid;
            $payment->reste_pay = ($payment->total_pay - $payment->montant_pay) > 0 ? ($payment->total_pay - $payment->montant_pay): 0;
            $payment->save();
            $eleve = Eleve::find($payment->id_eleve);
            $admins = User::where('privillege','=','admin')->get();
            if($eleve){
                if(Auth::user()->privillege == "teacher"){
                    $text = 'Student <b>'.$eleve->name.' '.$eleve->surname.'</b> '.$eleve->id_formation.' student at TLC '.$eleve->id_centre.' settled his payment of'.$payment->description.' <b> to user '.Auth::user()->name.'</b><br>amount : <span class="gree">'.$paid.'</span>';
                    foreach($admins as $admin){
                        Notification::create([
                            'text'=>$text,
                            'destinateur'=>$admin->id,
                            'state'=>'unchecked',
                        ]);
                    }
                }elseif(Auth::user()->privillege == "admin"){
                    $text = 'Student <b>'.$eleve->name.' '.$eleve->surname.'</b> '.$eleve->id_formation.' student at TLC '.$eleve->id_centre.' settled his payment of'.$payment->description.' <b> to admin '.Auth::user()->name.'</b><br>amount : <span class="gree">'.$paid.'</span>';
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
            }
            return response()->json(['data'=>$payment,'success'=>true],200);
        }else{
            return response()->json(['success'=>false],200);
        }
    }
    public function destroy($id){
        $payment = Payement::find($id);
        if($payment){
            $payment->delete();
            return response()->json(['data'=>$payment,'success'=>true],200);
        }else{
            return response()->json(['success'=>false],200);
        }
    }
    public function search($name){
        $students = Eleve::where('name','LIKE','%'.$name.'%')->orWhere('surname','LIKE','%'.$name.'%')->get();
        $payments = Payement::all();
        $new_payments = array();
        if($payments->count()>0){
            if($students){
                foreach($payments as $payment){
                    foreach($students as $student){
                        if($student->id == $payment->id_eleve){
                            $payment->name = $student->name;
                            $payment->surname = $student->surname;
                            $payment->email = $student->email;
                            $new_payments[] = $payment;
                        }
                    }
                }
                return response()->json(['payments'=> $new_payments,'success'=>true]);
            }
        }else{
            return response()->json(['success'=> false]);
        }
    }
    
    public function filter($value){
        $payments = Payement::where("description",'like','%'.$value.'%')->get();
        $students = Eleve::all();
        if($payments->count()>0){
            if($students){
                foreach($payments as $payment){
                    foreach($students as $student){
                        if($student->id == $payment->id_eleve){
                            $payment->name = $student->name;
                            $payment->surname = $student->surname;
                            $payment->email = $student->email;
                        }
                    }
                }
                return response()->json(['payments'=> $payments,'success'=>true]);
            }
        }else{
            return response()->json(['success'=> false]);
        }
    }
}
