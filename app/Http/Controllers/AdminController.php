<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

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
                       '. $projets->description .'<br>

                    </div>';
            $html .= '<h4>Liste des travaux</h4>';
            $html .= '<table style="border:1px solid black; border-collapse:collapse; width:100%;">';
            $html .= '<thead style="border:1px solid black;">
                        <tr>

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
        if(Session::has('idAdmin')){

        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        foreach (DB::select('SHOW TABLES') as $table) {
            if (isset($table->Tables_in_projet) && $table->Tables_in_projet != 'users' && $table->Tables_in_projet != 'clients') {
                DB::table($table->Tables_in_projet)->truncate();
            }
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        return redirect('indexAdmin');
        }else{
            Session::flush();
            return redirect()->route('login');
        }
    }

    public function typeTravaux()
    {
        if(Session::has('idAdmin')){
        $typeTravaux = DB::table('travaux')->orderBy('id')->get();

        return view('admin.typeTravaux', compact('typeTravaux'));
        }else{
            Session::flush();
            return redirect()->route('login');
        }
    }

    public function typeTravauxformulaire()
    {
        if(Session::has('idAdmin')){
        $idtravaux = request()->input('id');
        $travaux = DB::table('v_travauxmaisonprix')->where('idtravaux', $idtravaux)->first();

        $unites =DB::table('v_travauxmaisonprix')
                    ->selectRaw('unite')
                    ->groupBy(DB::raw('unite'))
                    ->get();

        return view('admin.typetravauxformulaire', compact('travaux','unites'));
        }else{
            Session::flush();
            return redirect()->route('login');
        }
    }

    public function typeTravauxUpdate()
    {
        if(Session::has('idAdmin')){
        $rules = [
            'idtravaux' => 'required|exists:travaux,id',
            'prix' => 'required|numeric|min:0',
        ];
        $validator = Validator::make(request()->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $idtravaux = request()->input('idtravaux');
        $prix = request()->input('prix');


        DB::table('travaux')->where('id', $idtravaux)->update(['prixunitaire' => $prix]);
        return redirect('typeTravaux');
        }else{
            Session::flush();
            return redirect()->route('login');
        }
    }

    public function typeFinition()
    {
        if(Session::has('idAdmin')){
        $typeFinitions = DB::table('finition')->orderBy('id', 'asc')->get();

        return view('admin.typeFinition', compact('typeFinitions'));
        }else{
            Session::flush();
            return redirect()->route('login');
        }
    }
    public function typeFinitionformulaire()
    {
        if(Session::has('idAdmin')){
        $idfinition = request()->input('id');

        $finition = DB::table('finition')->where('id', $idfinition)->first();

        return view('admin.typefinitionformulaire', compact('finition'));
        }else{
            Session::flush();
            return redirect()->route('login');
        }
    }

    public function typeFinitionUpdate()
    {
        if(Session::has('idAdmin')){
        $rules = [
            'idfinition' => 'required',
            'pourcentage' => 'required|between:0,100',
        ];

        $validator = Validator::make(request()->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $idfinition = request()->input('idfinition');
        $pourcentage = request()->input('pourcentage');


        DB::table('finition')->where('id', $idfinition)->update(['pourcentage' => $pourcentage]);

        return redirect('typeFinition');
        }else{
            Session::flush();
            return redirect()->route('login');
        }
    }

    public function pageCsv()
    {
        if (!Session::has('idAdmin')) {
            return redirect()->route('loginclient');
        } else {

            return view('admin.importation');

        }
    }

    public function ImportationCsvMaisonDevis()
    {
        if (empty(request()->file('file'))) {
            // Retourne une erreur ou arrête le processus
            return redirect()->back()->withErrors(['quantite' => 'il ny a pas de fichier csv']);
        }

        $maisonTravaux = request()->file('maisonTravaux');
        $Devis = request()->file('Devis');

        $maisonTravauxContents = file($maisonTravaux->getPathname());

        $rowA = 0;
        foreach ($maisonTravauxContents as $lineA) {

            $rowA++;

            if ($rowA == 1) {
                continue;
            }
            $data = str_getcsv($lineA);

            // $dateDevis = Carbon::createFromFormat('d/m/Y', $data[6])->format('Y-m-d');
            // $dateDebut = Carbon::createFromFormat('d/m/Y', $data[7])->format('Y-m-d');


            if (count($data) != 8) {
                return redirect()->back()->withErrors(['ligne' => "La ligne $rowA n'a pas 8 champs, vérifiez votre fichier csv"]);
            }
            if (!is_numeric($data[2])) {
                return redirect()->back()->withErrors(['surface' => "La ligne $rowA, le champs surface n'est pas un nombre"]);
            }
            if (!is_numeric($data[6])) {
                return redirect()->back()->withErrors(['prix' => "La ligne $rowA, le champs prix n'est pas un nombre"]);
            }
            if (!is_numeric($data[7])) {
                return redirect()->back()->withErrors(['quantite' => "La ligne $rowA, le champs quantité n'est pas un nombre"]);
            }

            $dataToInsertA[] =[
                'type_maison' =>$data[0],
                'description' => $data[1],
                'surface' => $data[2],
                'code_travaux' => $data[3],
                'type_travaux' => $data[4],
                'unite' => $data[5],
                'prix_unitaire' => $data[6],
                'quantite' => $data[7],
                'duree_travaux' => $data[8],
            ];
        }

        $DevisContents = file($Devis->getPathname());
        $rowB = 0;
        foreach ($maisonTravauxContents as $lineA) {

            $rowB++;

            if ($rowB == 1) {
                continue;
            }
            $data = str_getcsv($lineA);

            $dateDevis = Carbon::createFromFormat('d/m/Y', $data[6])->format('Y-m-d');
            $dateDebut = Carbon::createFromFormat('d/m/Y', $data[7])->format('Y-m-d');


            $dataToInsertA[] =[
                'client' =>$data[0],
                'ref_devis' => $data[1],
                'type_maison' => $data[2],
                'finition' => $data[3],
                'taux_finition' => $data[4],
                'date_devis' => $data[5],
                'date_debut' => $data[6],
                'lieux' => $data[7],
            ];
        }

        DB::table('seance')->insert($dataToInsertA);

        DB::statement("INSERT INTO categorie(nom) SELECT categorie FROM seance WHERE categorie NOT IN (SELECT nom FROM categorie) GROUP BY categorie");

        DB::statement("INSERT INTO salle(salle) SELECT salle FROM seance WHERE salle NOT IN (SELECT salle FROM salle) GROUP BY salle");

        DB::statement("INSERT INTO film(nom, idcategorie) SELECT film, categorie.id FROM seance INNER JOIN categorie ON categorie.nom = seance.categorie WHERE film NOT IN (SELECT nom FROM film) GROUP BY film , categorie.id ");

        DB::statement("INSERT INTO seancefilm(idfilm, idcategorie, idsalle, date, heure) SELECT film.id, categorie.id, salle.id, date, heure FROM seance INNER JOIN film ON film.nom = seance.film INNER JOIN categorie ON categorie.nom = seance.categorie INNER JOIN salle ON salle.salle = seance.salle");


        return redirect('typeFinition');
    }

    public function ImportationCsvPaiement()
    {
        if (!Session::has('idAdmin')) {
            return redirect()->route('loginclient');
        } else {

            return view('admin.importation');

        }
    }
}
