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
                        <span><div id="error-messages" style="display: none; color: red; font-weight: bold;"></div></span>

                        <form id="form-versement">
                            @csrf
                            <div class="mt-3">
                                <label  class="form-label">Versement</label>
                                <br>
                                <small>reste : {{$projets->restant}} Ar</small>
                                <input min="1"  type="number" name="versement" class="form-control text-right focus:ring-[#FF2D20] focus:border-[#FF2D20] rounded-sm border-[#FF2D20] border-b-2 p-1"  required style="caret-color: #FF2D20;-moz-appearance:textfield;">
                                </div>
                                <div class="mt-3">
                                <label  class="form-label">Date</label>
                                    <input type="date" class="form-control" name="dateVersement" required>
                                </div>
                                <div class="mt-3">

                                <input type="hidden" name="refdevis" value="{{$projets->refdevis}}">
                                
                                <button class="btn btn-primary py-3 px-5" type="submit" style="border:none">
                                    validez
                                </button>
                            </div>
                        </form>

                        <div class="mt-3">

                            <h5>debut : {{$projets->debut}} -> fin {{$projets->fin}}</h5>
                            <table id="dataTablePdf" class="table table-striped table-hover" style="font-size: 14px;">
                                <th>
                                    <td>nom</td>
                                    <td>unite</td>
                                    <td>quantite</td>
                                    <td>prixunitaire</td>
                                    <td>total</td>
                                </th>
                                @foreach ($projetsdetails as $projetsdetail)
                                <tr>
                                    <td></td>
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

                        <div class="mt-3">

                            <h5>Historique de payement</h5>
                            <table id="dataTablePdfVersement" class="table table-striped table-hover" style="font-size: 14px;">
                                <th>
                                    <td>référence devis</td>
                                    <td>versement</td>
                                    <td>date</td>
                                </th>
                                <?php $total = 0; ?>
                                @foreach ($histoversements as $histoversement)
                                <tr>
                                    <td></td>
                                    <td>{{$histoversement->refdevis}}</td>
                                    <td>{{$histoversement->versement}}</td>
                                    <td>{{$histoversement->date}}</td>

                                    <?php 
                                    
                                    $total += $histoversement->versement; 
                                    ?>
                                </tr>
                                @endforeach

                                <h5>Total : {{$total}} Ar</h5>
                            </table>
                            
                          
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

        doc.autoTable({html: '#dataTablePdf', startY: 100});
        
        doc.text('Historique de payement :', 10, 190);
        doc.setFontStyle('bold');

        // Ajout d'une nouvelle page
        // doc.addPage();

        // Deuxième table
        doc.autoTable({html: '#dataTablePdfVersement',startY: 200});
        doc.text('Total versement : {{$total}} Ar', 20, 260);

        doc.save('devis.pdf');
    });
});
</script>


<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelector('#form-versement').addEventListener('submit', function (e) {
            e.preventDefault();

            axios.post('/versement', new FormData(this))
                .then(function (response) {
                    if (response.data.status === 'success') {
                        alert(response.data.message);
                    }
                })
                .catch(function (error) {
                    if (error.response.status === 422) {
                        // Afficher les messages d'erreur
                        var errorHtml = '';
                        Object.values(error.response.data.errors).forEach(function (value) {
                            errorHtml += value ;
                        });
                        document.querySelector('#error-messages').innerHTML = errorHtml;
                        document.querySelector('#error-messages').style.display = 'block';
                    }
                });
        });
    });
</script>

@endsection
