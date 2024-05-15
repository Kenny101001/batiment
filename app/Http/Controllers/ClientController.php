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
        return redirect('indexClient');
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
        return redirect('indexClient');

        }
    }
    public function offre()
    {
        if (!Session::has('numero')) {
            return redirect()->route('loginclient');
        } else {

            $maisons = DB::table('v_maisontype') ->get();
            $finitions = DB::table('finition')->orderBy('id')->get();
            $lieux = DB::table('lieu') ->get();

            return view('client.offre', compact('maisons','finitions','lieux'));

        }
    }

    public function DeviAjouter()
    {
        $idmaison = request()->input('maisonid');
        $finition = request()->input('finitionid');
        $date = request()->input('date');
        $lieu = request()->input('lieu');

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

        $dure = (int)($maison->dure);

        $date = Carbon::createFromFormat('Y-m-d', $date);
        $fin = $date->copy()->addDays($dure);

        $pourcentageCalcul = $finition->pourcentage * $maison->total / 100;

        $pourcentage = $pourcentageCalcul + $maison->total;

        $devi_id = DB::table('devi')->insertGetId([
            'dure' => $maison->dure,
            'debut' => $date,
            'fin'=> $fin,
            'restant'=> $pourcentage,
            'total'=> $maison->total,
            'type'=> $maison->nom,
            'maison' => (string)$maison->nom,
            'finition' => $finition->nom,
            'pourcentage' => $finition->pourcentage,
            'totalpourcentage' => $pourcentage,
            'creation' => now(),
            'description'=> $maison->description,
            'lieu' => $lieu,
            'refdevis' => 'D' . rand(1, 99) . rand(1, 99),
            'numclient' => Session::get('numero'),
        ]);


        $travaux = DB::table('v_travauxmaisonprix')->where('idmaison', $maison->id)->get();


        foreach ($travaux as $travauxInfo) {
            $dataToInsert[] = [
                'iddevis' => $devi_id,
                'idtravaux' => $travauxInfo->idtravaux,
                'nom' =>$travauxInfo->travaux,
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

            $histoversements = DB::table('histoversement')->where('refdevis',$projets->refdevis )->get();

            return view('client.projetdetail', compact('projets','projetsdetails','histoversements'));

        }
    }

    public function versement(Request $request)
    {
        if (!Session::has('numero')) {
            return redirect()->route('loginclient');
        } else {
    
          
            $date = $request->input('dateVersement');
            $versement = $request->input('versement');
            $refdevis = $request->input('refdevis');
            $refpaiement = substr(str_shuffle("abcdefghijklmnopqrstuvwxyz".rand(0,999999)), 0, 6);

            $devi = DB::table('devi')->where('refdevis', $refdevis)->first();
    
            $reste = $devi->restant;
    
            $rules = [
                'refdevis' => 'required',
                'dateVersement' => 'required|after_or_equal:'.date('Y-m-d')
            ];
    
            $validator = Validator::make($request->all(), $rules);
    
            if ($validator->fails()) {
                return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
            }
            
            if ($versement <= $reste) {
    
                $newpayer = $devi->payer + $versement;
                $newreste = $devi->restant - $versement;
                
                DB::table('histoversement')->insert([
                    'versement' => $versement,
                    'reste' => $newreste,
                    'total' => $devi->totalpourcentage,
                    'date' => $date,
                    'refdevis' => $refdevis,
                    'refpaiement' => $refpaiement,
                ]);
    
                DB::table('devi')
                    ->where('refdevis', $refdevis)
                    ->update(['payer' => $newpayer, 'restant' => $newreste]);
    
                return response()->json(['status' => 'success', 'message' => 'Formulaire validé avec succès.']);
    
            } else {
                $message = 'Le montant du versement doit être inférieur ou égal au solde restant';
                return response()->json(['status' => 'error', 'errors' => $message], 422);
            }
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

            $histoversements = DB::table('histoversement')->where('refdevis',$projets->refdevis )->get();

            $totalversement = 0;
            foreach ($histoversements as $histoversement) {
                $totalversement += $histoversement->versement;
            }

            $options = new Options();
            $options->set('defaultFont', 'Helvetica');

            $dompdf = new Dompdf($options);

            // HTML pour le contenu du PDF
            $html = '<style>
                        table {
                            border-collapse: collapse;
                            width: 100%;
                        }

                        table, th, td {
                            border: 1px solid black;
                        }

                        th, td {
                            padding: 5px;
                        }
                    </style>';
            $html .= '<h4>Informations du projet</h4>';
            $html .= '<div style="border:1px solid black; padding:5px;">
                        numclient : '. $projets->numclient .'<br>
                        Nom du projet : '. $projets->maison .'<br>
                        Date de début : '. $projets->debut .'<br>
                        Date de fin : '. $projets->fin .'<br>
                        finition : '. $projets->finition .'<br>
                        '. $projets->description .'<br>
                    </div>';
            $html .= '<h4>Liste des travaux</h4>';
            $html .= '<table style="border:1px solid black; border-collapse:collapse; width:100%;">';
            $html .= '<thead style="border:1px solid black;">
                        <tr>
                         
                            <th style="border:1px solid black; padding:5px;">Nom</th>
                            <th style="border:1px solid black; padding:5px;">Unite</th>
                            <th style="border:1px solid black; padding:5px;">quantite</th>
                            <th style="border:1px solid black; padding:5px;">prixunitaire</th>
                            <th style="border:1px solid black; padding:5px;">total</th>
                        </tr>
                    </thead>';
            $html .= '<tbody>';
            foreach ($projetsdetails as $travaux){
                $html .= '<tr style="border:1px solid black;">
                           
                            <td style="border:1px solid black; padding:5px;">'. $travaux->nom .'</td>
                            <td style="border:1px solid black; padding:5px;">'. $travaux->unite .'</td>
                            <td style="border:1px solid black; padding:5px;">'. $travaux->quantite .'</td>
                            <td style="border:1px solid black; padding:5px;">'. $travaux->prixunitaire .'</td>
                            <td style="border:1px solid black; padding:5px;">'. $travaux->total .'</td>
                        </tr>';
            }
            $html .= '</tbody></table>';


            //table versment

            $html .= '<h4>Versement</h4>';
            
            $html .= '<table style="border:1px solid black; border-collapse:collapse; width:100%;">';
            $html .= '<thead style="border:1px solid black;">
                        <tr>
                            <th style="border:1px solid black; padding:5px;">référence devis</th>
                            <th style="border:1px solid black; padding:5px;">versement</th>
                            <th style="border:1px solid black; padding:5px;">date</th>
                        </tr>
                    </thead>';
            $html .= '<tbody>';
            foreach ($histoversements as $histoversement){
                $html .= '<tr style="border:1px solid black;">    
                            <td style="border:1px solid black; padding:5px;">'. $histoversement->refdevis .'</td>
                            <td style="border:1px solid black; padding:5px;">'. $histoversement->versement .'</td>
                            <td style="border:1px solid black; padding:5px;">'. $histoversement->date .'</td>
                        </tr>';
            }

            $html .= '</tbody></table>';
            $html .= '<h4>TOTAL : '.$totalversement.'Ar</h4>';

            $dompdf->loadHtml($html);

            // Rendu du document PDF
            $dompdf->render();

            // Téléchargement du document PDF
            $dompdf->stream('devis.pdf');

            return redirect('detailprojet');

        }
    }
}
