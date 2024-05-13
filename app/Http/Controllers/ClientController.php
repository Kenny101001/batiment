<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\maison;
use Carbon\Carbon;

use Dompdf\Dompdf;
use Dompdf\Options;
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

            $maisons = DB::table('v_maisontype') ->get();
            $finitions = DB::table('finition') ->get();

            return view('client.offre', compact('maisons','finitions'));

        }
    }

    public function DeviAjouter()
    {
        $idmaison = request()->input('maisonid');
        $finition = request()->input('finitionid');
        $date = request()->input('date');


        $rules = [
            'idmaison' => 'required',
            'finition' => 'required',
            'date' => 'required|date|after:yesterday',
        ];

        $validator = Validator::make(compact('idmaison', 'finition', 'date'), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $maison = DB::table('v_maisontype')
            ->where('id', $idmaison)
            ->first();
        $finition = DB::table('finition')
            ->where('id', $finition)
            ->first();

        $dure = (int)($maison->dure / 24);

        $date = Carbon::createFromFormat('Y-m-d', $date);
        $fin = $date->copy()->addDays($dure);

        $pourcentageCalcul = $finition->pourcentage * $maison->total / 100;

        $pourcentage = $pourcentageCalcul + $maison->total;

        $devi_id = DB::table('devi')->insertGetId([
            'numclient' => Session::get('numero'),
            'dure' => $maison->dure,
            'debut' => $date,
            'fin'=> $fin,
            'restant'=> $pourcentage,
            'total'=> $maison->total,
            'type'=> $maison->type,
            'maison' => (string)$maison->nom,
            'nbchambre'=> $maison->nbchambre,
            'nbtoilette'=>$maison->nbtoilette,
            'finition' => $finition->nom,
            'pourcentage' => $finition->pourcentage,
            'totalpourcentage' => $pourcentage,
        ]);


        $travaux = DB::table('v_travauxprix')->where('idtype', $maison->idtype)->get();


        foreach ($travaux as $travauxInfo) {
            $dataToInsert[] = [
                'iddevis' => $devi_id,
                'idtype' => $travauxInfo->idtype,
                'type' =>$travauxInfo->type,
                'nom' =>$travauxInfo->nom ,
                'unite' => $travauxInfo->unite,
                'quantite' =>$travauxInfo->quantite ,
                'prixunitaire' =>$travauxInfo->prixunitaire  ,
                'total' =>$travauxInfo->total ,
            ];
        }

        DB::table('travauxdevis')->insert($dataToInsert);

        return redirect('offre');
    }

    public function projet()
    {
        if (!Session::has('numero')) {
            return redirect()->route('loginclient');
        } else {

            $projets = DB::table('devi')->where('numclient', Session::get('numero'))->get();
            return view('client.projet', compact('projets'));

        }
    }

    public function detailprojet()
    {
        if (!Session::has('numero')) {
            return redirect()->route('loginclient');
        } else {

            $iddevis = request()->input('iddevis');

            $projetsdetails = DB::table('travauxdevis')->where('iddevis',$iddevis )->get();
            $projets = DB::table('devi')->where('id',request()->input('iddevis') )->first();

            return view('client.projetdetail', compact('projets','projetsdetails'));

        }
    }
    public function telechargerpdf()
    {
        if (!Session::has('numero')) {
            return redirect()->route('loginclient');
        } else {

            $iddevis = request()->input('iddevis');

            $projetsdetails = DB::table('travauxdevis')->where('iddevis',$iddevis )->get();
            $projets = DB::table('devi')->where('id',request()->input('iddevis') )->first();


            $options = new Options();
            $options->set('defaultFont', 'Helvetica');

            $dompdf = new Dompdf($options);

            // HTML pour le contenu du PDF
            $html = '<h4>Screen '. $idsalle.'</h4>';
            $html .= '<div>
                        Row : '. $letter .' seat : '. $number. ' time : '. $heure . ' date : '. $date .
                    '</div>';
            $html .= '<h4>prix'. $prix.'</h4>';

            $dompdf->loadHtml($html);

            // Rendu du document PDF
            $dompdf->render();

            // Téléchargement du document PDF
            $dompdf->stream('informations.pdf');

            return redirect('detailprojet');

        }
    }
}
