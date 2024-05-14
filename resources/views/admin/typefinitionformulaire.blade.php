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

              <form  class="mb-3" action="{{ route('typeFinitionUpdate') }}" method="get">
                @csrf
                <div class="mb-3">
                  <label for="email" class="form-label">Nom</label>
                  <h5>{{$finition->nom}}</h5>
                </div>

                <div class="mb-3">
                    <h5>Pourcentage</h5>
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label">Pourcentage</label>
                  <input
                    type="number"
                    class="form-control"
                    name="pourcentage"
                    placeholder="Entré un prix"
                    value="{{$finition->pourcentage}}"
                    autofocus
                  />
                </div>


                <div class="mb-3">
                  <button class="btn btn-primary d-grid w-100" type="submit">Modifier</button>
                </div>
                <input type="hidden" name="idfinition" value="{{$finition->id}}">
              </form>
            </div>
          </div>
          <!-- /Register -->
        </div>
      </div>
    </div>
@endsection
