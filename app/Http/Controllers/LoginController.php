<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{

    public function choix()
    {
        Session::flush();
        return view('choix');
    }
    public function loginclient()
    {
        return view('loginClient');
    }

    public function login()
    {
        Session::flush();
        return view('login');
    }
    public function logoutclient()
    {
        Session::flush();
        return view('choix');
    }

    public function logout()
    {
        Session::flush();
        return view('login');
    }

    public function loginVerif()
    {
        $email = request()->input('email');
        $mdp = request()->input("mdp");

        $verifEmail = DB::table('utilisateur')->where('email', $email)->first();
        if (!$verifEmail) {
            return back()->withErrors(['email' => 'Ce Email est incorrect'])->withInput();
        }

        $verifmdp = DB::table('utilisateur')->where('mdp', $mdp)->first();
        if (!$verifmdp) {
            return back()->withErrors(['email' => 'Ce mot de passe est incorrect'])->withInput();
        }

        $utilisateur = DB::table('utilisateur')->where('email', $email)->where('mdp', $mdp)->first();

        $type = $utilisateur->type;
        if($type == 1){

            Session::put('idAdmin', $utilisateur->id);
            return redirect()->route('indexAdmin');
        }
        else{
            return back()->withErrors(['email' => 'Ce compte n\'est pas encore validé par un administrateur'])->withInput();
        }

    }

    public function mdp()
    {
        return view('mdpOublier');
    }

    public function mdpUpdate()
    {
        $email = request()->input('email');
        $mdp = request()->input("mdp");


        $validator = Validator::make(request()->all(), [
            'email' => 'required|string|email|max:255',
            'mdp' => 'required|string|min:5',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $verifEmail = DB::table('utilisateur')->where('email', $email)->first();
        if (!$verifEmail) {
            return back()->withErrors(['email' => 'Ce Email est incorrect'])->withInput();
        }

        DB::table('utilisateur')->where('email', $email)->update([
            'mdp' => $mdp,
        ]);

        return redirect('mdp');
    }
    public function inscription()
    {
        return view('inscription');
    }
    //sans ajax
    public function ajoutUtilisateur()
    {
        $nom = request()->input('nom');
        $email = request()->input('email');
        $mdp = request()->input("mdp");

        $validator = Validator::make(request()->all(), [
            'nom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:utilisateur',
            'mdp' => 'required|string|min:5',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }


        $verif = DB::table('utilisateur')->where('nom', $nom)->where('email', $email)->first();
        if ($verif) {
            return back()->withErrors(['email' => 'Ce nom et cette addresse email existe déjà'])->withInput();
        }

        $verif2 = DB::table('utilisateur')->where('email', $email)->first();
        if ($verif2) {
            return back()->withErrors(['email' => 'cette addresse email existe déjà'])->withInput();
        }

        DB::table('utilisateur')->insert([
            'nom' => $nom,
            'email' => $email,
            'mdp' => $mdp,
        ]);

        return redirect('login');
    }

    //avec ajax
    // public function validerformulaire(Request $request)
    // {
    //     $nom = request()->input('nom');
    //     $email = request()->input('email');
    //     $mdp = request()->input("mdp");

    //     $validator = Validator::make(request()->all(), [
    //         'nom' => 'required|string|max:255',
    //         'email' => 'required|string|email|max:255|unique:utilisateur',
    //         'mdp' => 'required|string|min:8|confirmed',
    //     ]);

    //     if ($validator->fails()) {
    //         return back()->withErrors($validator)->withInput();
    //     }


    //     $verif = DB::table('utilisateur')->where('nom', $nom)->where('email', $email)->first();
    //     if ($verif) {
    //         return back()->withErrors(['email' => 'Ce nom et cette addresse email existe déjà'])->withInput();
    //     }

    //     $verif2 = DB::table('utilisateur')->where('email', $email)->first();
    //     if ($verif2) {
    //         return back()->withErrors(['email' => 'cette addresse email existe déjà'])->withInput();
    //     }

    //     DB::table('utilisateur')->insert([
    //         'nom' => $nom,
    //         'email' => $email,
    //         'mdp' => $mdp,
    //     ]);

    //     // Traitement du formulaire si la validation réussit

    //     return response()->json(['success' => 'Formulaire validé avec succès.']);
    // }



}
