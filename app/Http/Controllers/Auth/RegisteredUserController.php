<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Centre;
use App\Models\Eleve;
use App\Models\Enseignant;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        $teachers = Enseignant::where('email','=',$request->email)->first();
        $students = Eleve::where('email','=',$request->email)->first();
        $privillege = false;
        $centre = 0;
        if($teachers){
            $privillege = 'teacher';
            $centre = $teachers->id_centre;
        }elseif($students){
            $privillege = 'student';
            $centre = Centre::where('ville','=',$students->id_centre)->first()->id_centre;
        }
        if($privillege){
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'centre' => $centre,
                'privillege' => $privillege,
            ]);

            event(new Registered($user));

            Auth::login($user);

            return redirect(route('dashboard', absolute: false));
        }else{
            die('<h1 style="text-align:center;padding:5rem">Oups! Seems like your not allowed to create account. Please, contact your administrator.</h1> ');
        }
    }
}
