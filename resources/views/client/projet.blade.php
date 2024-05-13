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
                        <div class="mt-3">
                            <h4>{{ $projet->maison}}</h4>
                            <h5>Finition {{ $projet->finition}}</h5>
                            <br>
                            <span>{{ $projet->nbchambre}} chambres / {{ $projet->nbtoilette}} toilettes</span>
                            <br>
                            <span>duré : {{ $projet->dure /24}} jours </span>
                            <br>
                            <span>Début : {{ $projet->debut}} -> Fin : {{ $projet->fin}}</span>
                            <br>
                            <span>Total : {{ $projet->totalpourcentage}}</span>
                            <br>
                            <span>Payer : {{ $projet->payer }}</span>
                            <br>
                            <a href="{{ route('detailprojet',['iddevis' => $projet->id]) }}" class="btn btn-primary py-3 px-5">Voir plus</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection
