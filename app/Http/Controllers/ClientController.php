<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\maison;
class ClientController extends Controller
{
    public function index()
    {
        return view('client.index');
    }

    public function loginclient()
    {
        return view('client.loginClient');
    }
    public function logoutclient()
    {
        Session::flush();
        return view('choix');
    }

    public function connexion()
    {
        $numero = request()->input('numero');
        $action = request()->input('action');

        $rule = ['numero' => ['required', 'min:8', 'numeric']];

        $validator = Validator::make(['numero' => $numero], $rule);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($action == 'connexion') {
            $client = DB::table('client')->where('numero', $numero)->first();
            if ($client) {
                Session::put('numero', $numero);
            } else {
                return redirect()->back()->withErrors(['client' => ' numéro invalide']);
            }
            return redirect('indexClient');

        } else if ($action == 'inscription') {
            $client = DB::table('client')->where('numero', $numero)->first();
            if ($client) {
                return redirect()->back()->withErrors(['client' => ' ce numero existe déjà'])->withInput();
            } else {
                DB::table('client')->insert(
                    ['numero' => $numero]
                );
                Session::put('numero', $numero);

        }
        return redirect('index');

        }
    }
    public function offre()
    {
        if (!Session::has('numero')) {
            return redirect()->route('loginclient');
        } else {

            $maisons = DB::table('maison')
                ->join('type', 'maison.type', '=', 'type.id')
                ->select('maison.*','type.id','type.nom','type.dure')
                ->get();

            return view('client.offre', compact('maisons'));

        }
    }
}
