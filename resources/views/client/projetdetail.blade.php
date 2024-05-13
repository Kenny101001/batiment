@extends('layouts.indexClient')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-6">
            <h1>detail du devis</h1>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>

    <div  class="row">
        <div class="col-12">
            <div class="col-12" style="margin-bottom: 15px">
                <div class="card border-0" style="border-radius: 10px; background-color: #F5F5F5;">
                    <div class="card-body p-4">
                        <div class="mt-3">

                            <h5>debut : {{$projets->debut}} -> fin {{$projets->fin}}</h5>
                            <table id="dataTablePdf" class="table table-striped table-hover" style="font-size: 14px;">
                                <th>
                                    <td>idtype</td>
                                    <td>type</td>
                                    <td>nom</td>
                                    <td>unite</td>
                                    <td>quantite</td>
                                    <td>prixunitaire</td>
                                    <td>total</td>
                                </th>
                                @foreach ($projetsdetails as $projetsdetail)
                                <tr>
                                    <td></td>
                                    <td>{{$projetsdetail->idtype}}</td>
                                    <td>{{$projetsdetail->type}}</td>
                                    <td>{{$projetsdetail->nom}}</td>
                                    <td>{{$projetsdetail->unite}}</td>
                                    <td>{{$projetsdetail->quantite}}</td>
                                    <td>{{$projetsdetail->prixunitaire}}</td>
                                    <td>{{$projetsdetail->total}}</td>
                                </tr>
                                @endforeach
                            </table>

                            <div style="text-align: center;">
                                <a id="export-pdf" class="btn btn-primary py-3 px-5" style="display: inline-block;">télécharger pdf</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.6/jspdf.plugin.autotable.min.js"></script>

<script>
$(document).ready(function() {
    $('#export-pdf').click(function() {
        var doc = new jsPDF();

        // Ajout d'un titre au document PDF
        doc.setFontSize(18); // Définit la taille de la police pour le titre

        doc.setTextColor(40);
        doc.setFontStyle('bold');
        doc.text('Détail du projet :', 10, 20);
        doc.setTextColor(100);
        doc.text('numéro client : {{$projets->numclient}}', 20, 30);
        doc.text('maison : {{$projets->maison}}', 20, 40);
        doc.text('date début : {{$projets->debut}}', 20, 50);
        doc.text('date fin : {{$projets->fin}}', 20, 60);
        doc.text('finition : {{$projets->finition}}', 20, 70);
        doc.text('nombre de chambre : {{$projets->nbchambre}}', 20, 80);
        doc.text('nombre de toilette : {{$projets->nbtoilette}}', 20, 90);

        doc.autoTable({html: '#dataTablePdf', startY: 100});

        // Ajout d'une nouvelle page
        // doc.addPage();

        // Deuxième table
        // doc.autoTable({html: '#dataTablePdf2'});

        doc.save('devis.pdf');
    });
});
</script>


@endsection
