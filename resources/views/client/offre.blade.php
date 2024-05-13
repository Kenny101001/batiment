@extends('layouts.indexClient')

@section('content')

<div class="container">
<form method="post" action="{{route('DeviAjouter')}}">
@csrf
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
                <div class="col-3" style="margin-bottom: 15px">
                    <div class="card border-0" style="border-radius: 10px; background-color: #F5F5F5;">
                        <div class="card-body p-4">
                            <h3 class="card-title text-center mb-0">{{ $maison->nom }}</h3>
                            <br>
                            <h6 style="color:orange" class="card-title text-center mb-0">{{ $maison->total }} Ar</h6>
                            <hr style="background-color: #1A1A1A; height: 2px">
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="card-text mb-0">type {{ $maison->type }}</p>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="radio-{{ $maison->id }}" name="maisonid" value="{{ $maison->id }}" style="margin-right: 10px">
                                    <label class="form-check-label" for="radio-{{ $maison->id }}">
                                    </label>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="card-text mb-0">{{ $maison->nbchambre }} <i class="fa fa-bed"></i></p>
                                <p class="card-text mb-0">{{ $maison->nbtoilette }} <i class="fa fa-toilet"></i></p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    </div>
    <br>
    <br>
    <div class="row">
        <div class="col-12">
            <h1>Choissir la finition</h1>
            <div class="row">
            @foreach ($finitions as $finition)
                <div class="col-3" style="margin-bottom: 15px">
                    <div class="card border-0" style="border-radius: 10px; background-color: #F5F5F5;">
                        <div class="card-body p-4">
                            <h3 class="card-title text-center mb-0">{{ $finition->nom }}</h3>
                            <hr style="background-color: #1A1A1A; height: 2px">
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="card-text mb-0">pourcentage supplémentaire : <strong style="color:orange">{{ $finition->pourcentage }}% </strong></p>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="radio-{{ $finition->id }}" name="finitionid" value="{{ $finition->id }}" style="margin-right: 10px">
                                    <label class="form-check-label" for="radio-{{ $finition->id }}">
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="col-12" style="margin-bottom: 15px">
                <div class="card border-0" style="border-radius: 10px; background-color: #F5F5F5;">
                    <div class="card-body p-4">
                        <div class="mt-3">
                            <label class="form-label">Date de début des travaux</label>
                            <input type="date" class="form-control" name="date" required>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-center mt-4">
                <button type="submit" class="btn btn-primary" style="border-radius: 10px; font-weight: bold; padding: 10px 20px; width: 100%;">Valider</button>
            </div>
        </div>
    </div>
<form>
</div>

@endsection
