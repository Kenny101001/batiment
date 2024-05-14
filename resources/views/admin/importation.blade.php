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

              <h4 class="mb-2">Inportation CSV </h4>
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

              <form  class="mb-3" action="{{ route('ImportationCsvMaisonDevis') }}" method="post" enctype="multipart/form-data">
                @csrf
                    <div class="mb-3">
                        <h5>Importation de données</h5>
                    </div>
                    <div class="mb-3">
                    <label for="" class="form-label">Maison et travaux</label>
                    <input
                        type="file"
                        class="form-control"
                        name="maisonTravaux"
                        placeholder="Maison et travaux"
                        autofocus
                        accept=".csv, text/csv"
                    />
                    </div>

                    <div class="mb-3">
                    <label for="" class="form-label">Devis</label>
                    <input
                        type="file"
                        class="form-control"
                        name="Devis"
                        placeholder="Devis"
                        autofocus
                        accept=".csv, text/csv"
                    />
                    </div>

                    <div class="mb-3">
                        <button class="btn btn-primary d-grid w-100" type="submit">Importer</button>
                    </div>
                </form>

                <form class="mb-3" action="{{ route('ImportationCsvPaiement') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <h5>Importation de paiement</h5>
                </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Paiement</label>
                        <input
                            type="file"
                            class="form-control"
                            name="Paiement"
                            placeholder="Paiement"
                            autofocus
                            accept=".csv, text/csv"
                        />
                    </div>
                <div class="mb-3">
                  <button class="btn btn-primary d-grid w-100" type="submit">Importer</button>
                </div>
                </form>
            </div>
          </div>
          <!-- /Register -->
        </div>
      </div>
    </div>
@endsection
