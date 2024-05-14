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
        if (empty(request()->file('maisonTravaux'))) {
            // Retourne une erreur ou arrête le processus
            return redirect()->back()->withErrors(['maison' => 'il ny a pas de fichier csv dans la maison et travaux']);
        }

        if (empty(request()->file('Devis'))) {
            // Retourne une erreur ou arrête le processus
            return redirect()->back()->withErrors(['devis' => 'il ny a pas de fichier csv dans le devis']);
        }

        $maisonTravaux = request()->file('maisonTravaux');
        $Devis = request()->file('Devis');

        $extensionA = $maisonTravaux->getClientOriginalExtension();
            if($extensionA != 'csv'){
                return redirect()->back()->withErrors(['maison' => 'le fichier csv n\'est pas au bon format']);
            }

        $extensionB = $Devis->getClientOriginalExtension();
            if($extensionB != 'csv'){
                return redirect()->back()->withErrors(['maison' => 'le fichier csv n\'est pas au bon format']);
            }

        $maisonTravauxContents = file($maisonTravaux->getPathname());

        $rowA = 0;
        foreach ($maisonTravauxContents as $lineA) {

            $rowA++;

            if ($rowA == 1) {
                continue;
            }
            $dataA = str_getcsv($lineA, ",");

            // $dateDevis = Carbon::createFromFormat('d/m/Y', $data[6])->format('Y-m-d');
            // $dateDebut = Carbon::createFromFormat('d/m/Y', $data[7])->format('Y-m-d');


            // if (!is_numeric($dataA[2])) {
            //     return redirect()->back()->withErrors(['surface' => "La ligne $rowA, le champs surface n'est pas un nombre"]);
            // }
            // if (!is_numeric($dataA[6])) {
            //     return redirect()->back()->withErrors(['prix' => "La ligne $rowA, le champs prix n'est pas un nombre"]);
            // }
            // if (!is_numeric($dataA[7])) {
            //     return redirect()->back()->withErrors(['quantite' => "La ligne $rowA, le champs quantité n'est pas un nombre"]);
            // }

            $dataA[2] = str_replace(',', '.', $dataA[2]); // surface
            $dataA[5] = str_replace(',', '.', $dataA[5]); // prix_unitaire
            $dataA[6] = str_replace(',', '.', $dataA[6]); // quantite
            $dataA[7] = str_replace(',', '.', $dataA[7]); // duree_travaux

            $dataToInsertA[] =[
                'type_maison' =>$dataA[0],
                'description' => $dataA[1],
                'surface' => $dataA[2],
                'code_travaux' => $dataA[3],
                'unite' => $dataA[5],
                'prix_unitaire' => $dataA[6],
                'quantite' => $dataA[7],
                'duree_travaux' => $dataA[8],
                'type_travaux' => $dataA[4],
            ];
        }

        $DevisContents = file($Devis->getPathname());
        $rowB = 0;
        foreach ($DevisContents as $lineB) {

            $rowB++;

            if ($rowB == 1) {
                continue;
            }
            $dataB = str_getcsv($lineB);

            $dateDevis = Carbon::createFromFormat('d/m/Y', $dataB[5])->format('Y-m-d');
            $dateDebut = Carbon::createFromFormat('d/m/Y', $dataB[6])->format('Y-m-d');

            $dataToInsertB[] =[
                'client' =>$dataB[0],
                'ref_devis' => $dataB[1],
                'finition' => $dataB[3],
                'taux_finition' => $dataB[4],
                'date_devis' => $dateDevis,
                'date_debut' => $dateDebut,
                'lieu' => $dataB[7],
                'type_maison' => $dataB[2],
            ];
        }

        DB::table('maisonimportationcsv')->insert($dataToInsertA);

        DB::table('devisimportationcsv')->insert($dataToInsertB);

         //maison Import
        $idmaison = DB::select("INSERT INTO maison(nom, description, dure, surface)
        SELECT type_maison, description, duree_travaux, surface
        FROM maisonimportationcsv
        WHERE type_maison NOT IN (SELECT nom FROM maison)
        GROUP BY type_maison, type_maison, description, duree_travaux, surface
        RETURNING id");

         //travaux Import
        $idtravaux = DB::select("INSERT INTO travaux(nom, unite, prixunitaire, codetravaux)
        SELECT type_travaux, unite, prix_unitaire, code_travaux
        FROM maisonimportationcsv
        WHERE type_travaux NOT IN (SELECT type_travaux FROM travaux)
        GROUP BY type_travaux, unite, prix_unitaire, code_travaux
        RETURNING id");

        //devis Import
        $iddevis = DB::select("INSERT INTO devi(numclient, debut, maison, finition, pourcentage, creation, lieu, refdevis)
        SELECT client, date_debut, type_maison, finition,
            CAST(REPLACE(SUBSTRING(taux_finition, 0, LENGTH(taux_finition)-1), ',', '.') AS numeric(5,2)) AS pourcentage_creation,
            date_devis, lieu, ref_devis
        FROM devisimportationcsv
        WHERE ref_devis NOT IN (SELECT refdevis FROM devi)
        GROUP BY ref_devis, client, date_debut, type_maison, finition, date_devis, taux_finition, lieu
        RETURNING id");

        for($i = 0; $i < count($iddevis); $i++){

            $iddeviss = $iddevis[$i]->id;

            //  dd($iddeviss);
            $id = DB::table('devi')->where('id', $iddeviss)->first(); // Use first() instead of get()
            $iddevisref = $id->refdevis;

            $devisimportationcsv = DB::table('devisimportationcsv')->where('ref_devis', $iddevisref)->first();

            $maisonimportationcsv = DB::table('maisonimportationcsv')->where('type_maison', $devisimportationcsv->type_maison)->get();

            $paiementimportationcsv = DB::table('paiementimportationcsv')->where('ref_devis', $iddevisref)->get();

            $dure = (int)($maisonimportationcsv[0]->duree_travaux);

            $date = Carbon::createFromFormat('Y-m-d', $devisimportationcsv->date_debut);
            $fin = $date->copy()->addDays($dure);

            $payement = 0;
            foreach ($paiementimportationcsv as $paiementimportationcsvs) {
                $payement += $paiementimportationcsvs->montant;
            }

            $total = 0;
            foreach ($maisonimportationcsv as $maisonimportationcsvs) {
                $total += ($maisonimportationcsvs->prix_unitaire * $maisonimportationcsvs->quantite);
            }

            $reste = $total - $payement;

            $type = $devisimportationcsv->type_maison;

            $pourcentageCalcul = $id->pourcentage * $total / 100;

            $totalpourcentage = $pourcentageCalcul + $total;

            $description = $maisonimportationcsv[0]->description;

            // dd($iddevisref);
            DB::table('devi')->where('refdevis', $iddevisref)->update([ 'dure' => $dure,'fin' => $fin,'payer' => $payement, 'total' => $total, 'restant' => $reste, 'description' => $description, 'type' => $type , 'totalpourcentage' => $totalpourcentage]);
    

        }
        
        // $idtravauxMaison= DB::select("INSERT INTO travauxmaison(idmaison, idtravaux, quantite)
        //     SELECT type_travaux, unite, prixunitaire, code_travaux
        //     FROM maisonimportationcsv
        //     join devisimportationcsv on maisonimportationcsv.type_maison = devisimportationcsv.type_maison
        //     join travaux on maisonimportationcsv.code_travaux = travaux.codetravaux
        //     WHERE type_travaux NOT IN (SELECT type_travaux FROM travaux)
        //     GROUP BY type_travaux, unite, prixunitaire, code_travaux
        //     RETURNING id");
                

        return redirect('pageCsv');
    }

    public function ImportationCsvPaiement()
    {
        if (!Session::has('idAdmin')) {
            return redirect()->route('loginclient');
        } else {
            if (empty(request()->file('Paiement'))) {
                // Retourne une erreur ou arrête le processus
                return redirect()->back()->withErrors(['maison' => 'il ny a pas de fichier csv dans le paiement']);
            }

            $paiment = request()->file('Paiement');

            $extension = $paiment->getClientOriginalExtension();
            if($extension != 'csv'){
                return redirect()->back()->withErrors(['maison' => 'le fichier csv n\'est pas au bon format']);
            }

            $paimentContents = file($paiment->getPathname());

            $row = 0;
            foreach ($paimentContents as $line) {

                $row++;

                if ($row == 1) {
                    continue;
                }
                $data = str_getcsv($line, ",");

                // $dateDevis = Carbon::createFromFormat('d/m/Y', $data[6])->format('Y-m-d');
                $datePaiement = Carbon::createFromFormat('d/m/Y', $data[2])->format('Y-m-d');


                // if (!is_numeric($dataA[2])) {
                //     return redirect()->back()->withErrors(['surface' => "La ligne $rowA, le champs surface n'est pas un nombre"]);
                // }
                // if (!is_numeric($dataA[6])) {
                //     return redirect()->back()->withErrors(['prix' => "La ligne $rowA, le champs prix n'est pas un nombre"]);
                // }
                // if (!is_numeric($dataA[7])) {
                //     return redirect()->back()->withErrors(['quantite' => "La ligne $rowA, le champs quantité n'est pas un nombre"]);
                // }

                $data[3] = str_replace(',', '.', $data[3]); // surface
                // $dataA[5] = str_replace(',', '.', $dataA[5]); // prix_unitaire
                // $dataA[6] = str_replace(',', '.', $dataA[6]); // quantite
                // $dataA[7] = str_replace(',', '.', $dataA[7]); // duree_travaux

                $dataToInsert[] =[
                    'ref_devis' =>$data[0],
                    'ref_paiement' => $data[1],
                    'date_paiement' => $datePaiement,
                    'montant' => $data[3],
                ];
            }

            DB::table('paiementimportationcsv')->insert($dataToInsert);

            return view('admin.importation');

        }
    }
}
