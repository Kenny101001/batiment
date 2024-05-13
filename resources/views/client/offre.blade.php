@extends('layouts.indexClient')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>Choissir une offre</h1>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <div class="row">
            @foreach ($maisons as $maison)
                <div class="col-3">
                    <div class="card text-center" style="border :none ;width: 18rem; box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
                        <div class="card-body" style="background-color: #FFF;" >
                            <div class="d-flex flex-column">
                                <h3 class="card-text">{{ $maison->nom }}</h3>
                                <div class="d-flex">
                                    <p class="card-text">{{ $maison->type }}</p>
                                    <p class="card-text ms-auto">{{ $maison->nbchambre }} chambre</p>
                                </div>
                                <div class="d-flex">
                                    <p class="card-text">{{ $maison->nbtoilette }} toilettte</p>
                                </div>
                            </div>
                            <a href="" class="btn btn-primary">Réserver</a>
                        </div>
                    </div>
                </div>
            @endforeach

            </div>
        </div>
    </div>
</div>

@endsection
