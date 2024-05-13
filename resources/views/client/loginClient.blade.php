@extends('layouts.indexClient')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-6">
            <h1>Se connecter</h1>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{route('connexion')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">numéro</label>
                    <input type="texte" class="form-control" name="numero" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Entré votre numéro de téléphone" value="{{ old('numero') }}">
                </div>
                <div class="mb-3">

                </div>
                <button name="action" value="connexion" type="submit" class="btn btn-primary">se connecter</button>
                <br>
                <br>
                pas encore de compte ?
                <br>
                <button name="action" value="inscription" type="submit" class="btn btn-primary">s'inscription</button>
            </form>
        </div>
        <div class="col-6">
            <img src="client/img/carousel-2.jpg" alt="" class="img-fluid">
        </div>
    </div>
</div>

@endsection
