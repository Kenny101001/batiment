@extends('layouts.indexAdmin')

@section('content')

    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">

          <div class="card">
            <div class="card-body">
              <div class="app-brand justify-content-center">

                    <img alt="Image" src="Home-Renovation-Logo.png" style="width:150px">

              </div>

              <h4 class="mb-2">Modifier le traveaux </h4>
              <!-- <p class="mb-4">Connectez vous pour commencer l'aventure</p> -->

              @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <ul>
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              @endif

              <form  class="mb-3" action="{{ route('typeTravauxUpdate') }}" method="get">
                @csrf
                <div class="mb-3">
                  <label for="email" class="form-label">Type</label>
                  <h5>{{$travaux->type}}</h5>
                </div>

                <div class="mb-3">
                  <label for="email" class="form-label">Nom</label>
                  <h5>{{$travaux->travaux}}</h5>
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label">Unite</label>
                  <h5>{{$travaux->unite}}</h5>
                  <!-- <select name="unite" id="unite" class="form-control" value="{{$travaux->unite}}">
                    @foreach ($unites as $unite)
                      <option value="{{ $unite->unite }}">{{ $unite->unite }}</option>
                    @endforeach
                  </select> -->
                </div>

                <!-- <div class="mb-3">
                    <h5>Quantité</h5>
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label">Quantité</label>
                  <input
                    type="number"
                    class="form-control"
                    name="quantite"
                    placeholder="Entré une quantité"
                    value="{{$travaux->quantite}}"
                    autofocus
                  />
                </div> -->

                <div class="mb-3">
                    <h5>Prix Unitaire</h5>
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label">prix Unitaire</label>
                  <input
                    type="number"
                    class="form-control"
                    name="prix"
                    placeholder="Entré un prix"
                    value="{{$travaux->prixunitaire}}"
                    autofocus
                  />
                </div>

                <div class="mb-3">
                  <div class="form-check">
                    <h5>Total : {{$travaux->total}}</h5>
                    <!-- <input class="form-check-input" type="checkbox" id="remember-me" />
                    <label class="form-check-label" for="remember-me"> Remember Me </label> -->
                  </div>
                </div>
                <div class="mb-3">
                  <button class="btn btn-primary d-grid w-100" type="submit">Modifier</button>
                </div>
                <input type="hidden" name="idtravaux" value="{{$travaux->idtravaux}}">
              </form>
            </div>
          </div>
          <!-- /Register -->
        </div>
      </div>
    </div>
@endsection
