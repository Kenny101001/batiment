<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use Dompdf\Dompdf;
use Dompdf\Options;
class AdminController extends Controller
{
    public function index()
    {
        if(Session::has('idAdmin')){
            $user = Session::get('idAdmin');
            $utilisateur = DB::table('utilisateur')->where('id', $user)->first();

            if($utilisateur->type == 1){


                // $projets = DB::table('devi')->whereRaw('payer != totalpourcentage')->get()::paginate(2);
                $projets = \App\Models\Devi::whereRaw('payer != totalpourcentage')->paginate(2);

                $projetsFinis = \App\Models\Devi::all();

                $annee =DB::table('devi')
                    ->selectRaw('EXTRACT(YEAR FROM creation) as annee')
                    ->groupBy(DB::raw('EXTRACT(YEAR FROM creation)'))
                    ->get();

                if(request()->input('date')){
                    $projetshistogrammes =DB::table('devi')
                    ->selectRaw('EXTRACT(MONTH FROM creation) as mois, SUM(totalpourcentage) as totalpourcentage')
                    ->whereRaw("EXTRACT(YEAR FROM creation) = ?", request()->input('date'))
                    ->groupBy(DB::raw('EXTRACT(MONTH FROM creation)'))
                    ->get();
                }else{
                $projetshistogrammes = DB::table('devi')
                    ->selectRaw('EXTRACT(MONTH FROM creation) as mois, SUM(totalpourcentage) as totalpourcentage')
                    ->whereRaw("EXTRACT(YEAR FROM creation) = ?", [date('Y')])
                    ->groupBy(DB::raw('EXTRACT(MONTH FROM creation)'))
                    ->get();
                }

                return view('admin.index', compact('projets','projetsFinis','projetshistogrammes','annee'));

            }else{
                Session::flush();
                return redirect()->route('login');
            }
        }
        else{
            Session::flush();
            return redirect()->route('login');
        }
    }

    public function detailprojetAdmin()
    {
        if (!Session::has('idAdmin')) {
            return redirect()->route('loginclient');
        } else {

            $iddevis = request()->input('iddevis');

            $projetsFinis = \App\Models\Devi::all();

            $projetsdetails = DB::table('travauxdevis')->where('iddevis',$iddevis )->get();
            $projets = DB::table('devi')->where('id',request()->input('iddevis') )->first();

            return view('admin.projetdetail', compact('projets','projetsdetails','projetsFinis'));

        }
    }

    public function telechargerpdfAdmin()
    {
        if (!Session::has('idAdmin')) {
            return redirect()->route('login');
        } else {

            $iddevis = request()->input('iddevis');

            $projetsdetails = DB::table('travauxdevis')->where('iddevis',$iddevis )->get();
            $projets = DB::table('devi')->where('id',request()->input('iddevis') )->first();


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
                        nombre de chambre : '. $projets->nbchambre .'<br>
                        nombre de toilette : '. $projets->nbtoilette .'<br>
                    </div>';
            $html .= '<h4>Liste des travaux</h4>';
            $html .= '<table style="border:1px solid black; border-collapse:collapse; width:100%;">';
            $html .= '<thead style="border:1px solid black;">
                        <tr>
                            <th style="border:1px solid black; padding:5px;">Idtype</th>
                            <th style="border:1px solid black; padding:5px;">Type</th>
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
                            <td style="border:1px solid black; padding:5px;">'. $travaux->idtype .'</td>
                            <td style="border:1px solid black; padding:5px;">'. $travaux->type .'</td>
                            <td style="border:1px solid black; padding:5px;">'. $travaux->nom .'</td>
                            <td style="border:1px solid black; padding:5px;">'. $travaux->unite .'</td>
                            <td style="border:1px solid black; padding:5px;">'. $travaux->quantite .'</td>
                            <td style="border:1px solid black; padding:5px;">'. $travaux->prixunitaire .'</td>
                            <td style="border:1px solid black; padding:5px;">'. $travaux->total .'</td>
                        </tr>';
            }
            $html .= '</tbody></table>';

            $dompdf->loadHtml($html);

            // Rendu du document PDF
            $dompdf->render();

            // Téléchargement du document PDF
            $dompdf->stream('devis.pdf');

            return redirect('indexAdmin');

        }
    }

    public function reinitialiserBase()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        foreach (DB::select('SHOW TABLES') as $table) {
            if (isset($table->Tables_in_projet) && $table->Tables_in_projet != 'users' && $table->Tables_in_projet != 'clients') {
                DB::table($table->Tables_in_projet)->truncate();
            }
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        return redirect('indexAdmin');
    }
}
