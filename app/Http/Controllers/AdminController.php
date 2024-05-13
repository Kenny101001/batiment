<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
class AdminController extends Controller
{
    public function index()
    {
        if(Session::has('idAdmin')){
            $user = Session::get('idAdmin');
            $utilisateur = DB::table('utilisateur')->where('id', $user)->first();

            if($utilisateur->type == 1){
                return view('admin.index');
            }
            else{
                Session::flush();
                return redirect()->route('login');
            }
        }
        else{
            Session::flush();
            return redirect()->route('login');
        }
    }
}
