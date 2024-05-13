@extends('layouts.indexClient')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-6">
            <form action="{{route('client.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">numéro</label>
                    <input type="text" class="form-control" name="numero" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">image</label>
                    <input class="form-control" type="file" name="image" id="formFile">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div class="col-6">
            <img src="{{asset('client/images/default.jpg')}}" alt="" class="img-fluid">
        </div>
    </div>
</div>

@endsection
