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

    <div class="row">
        <div class="col-12">
            <div class="col-12" style="margin-bottom: 15px">
                <div class="card border-0" style="border-radius: 10px; background-color: #F5F5F5;">
                    <div class="card-body p-4">
                        <div class="mt-3">
                            <table class="table table-striped table-hover" style="font-size: 14px;">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
