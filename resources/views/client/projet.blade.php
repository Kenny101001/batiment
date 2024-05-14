@extends('layouts.indexClient')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-6">
            <h1>Mes projets</h1>
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
    @foreach ($projets as $projet)
    <div class="row">
        <div class="col-12">
            <div class="col-12" style="margin-bottom: 15px">
                <div class="card border-0" style="border-radius: 10px; background-color: #F5F5F5;">
                    <div class="card-body p-4">
                        <div class="mt-3" >
                            <h4>{{ $projet->maison}}</h4>
                            <h5>Finition {{ $projet->finition}}</h5>
                            <br>
                            <span>{{ $projet->description}}
                            <br>
                            <span>duré : {{ $projet->dure}} jours </span>
                            <br>
                            <span>Début : {{ $projet->debut}} -> Fin : {{ $projet->fin}}</span>
                            <br>
                            <span>Total : {{ $projet->totalpourcentage}}</span>
                            <br>
                            <span>Payer : {{ $projet->payer }}</span>
                            <br>
                            <a href="{{ route('detailprojet',['iddevis' => $projet->id]) }}" class="btn btn-primary py-3 px-5">Voir plus</a>

                            <a href="{{ route('telechargerpdf', ['iddevis' => $projet->id]) }}" class="btn btn-primary py-3 px-5">telecharger pdf</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
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
        doc.text('Devis', 10, 10); // Insère le titre à la position (10, 10)

        doc.autoTable({html: '#dataTablePdf', startY: 30});

        // Ajout d'une nouvelle page
        // doc.addPage();

        // Deuxième table
        // doc.autoTable({html: '#dataTablePdf2'});

        doc.save('Devis.pdf');
    });
});
</script>

@endsection
