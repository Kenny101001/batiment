@extends('layouts.indexAdmin')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
    <div class="col-lg-8 mb-4 order-0">
        <div class="card" style="height:1150px">
        <div class="d-flex align-items-end row">
            <div class="col-sm-7">
            <div class="card-body" height="auto">
                <div class="row">
                    <div class="col-6">
                        <h1>les projets</h1>
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
                <div class="col-sm-5 text-center text-sm-left">
                    <div class="card-body pb-0 px-0 px-md-4">
                        <img
                        src="admin/assets/img/illustrations/man-with-laptop-light.png"
                        height="140"
                        alt="View Badge User"
                        data-app-dark-img="illustrations/man-with-laptop-dark.png"
                        data-app-light-img="illustrations/man-with-laptop-light.png"
                        />
                    </div>
                </div>

                @foreach ($projets as $projet)
                <div class="row">
                    <div class="col-12">
                        <div class="col-12" style="margin-bottom: 15px">
                            <div class="card border-0" style="border-radius: 10px; background-color: #F5F5F5;">
                                <div class="card-body p-4">
                                    <div class="mt-3" >
                                        <h4>{{ $projet->maison}}</h4>
                                        <h5>Finition {{ $projet->finition}}</h5>
                                        <br>
                                        <span>{{ $projet->description}}</span>
                                        <br>
                                        <span>duré : {{ $projet->dure}} jours </span>
                                        <br>
                                        <span>Début : {{ $projet->debut}} -> Fin : {{ $projet->fin}}</span>
                                        <br>
                                        <span>Total : {{ $projet->totalpourcentage}}</span>
                                        <br>
                                        <span>Payer : {{ $projet->payer }}</span>
                                        <br>
                                        <?php $pourcentage = number_format(($projet->payer * 100) / $projet->totalpourcentage, 2); ?>

                                        @if($pourcentage < 50)
                                            <span style="color:red">pourcentage payer : {{ number_format($pourcentage, 2) }} %</span>
                                        @elseif($pourcentage > 50)
                                            <span style="color:green">pourcentage payer : {{ number_format($pourcentage, 2) }} %</span>
                                        @elseif($pourcentage == 50)
                                            <span>pourcentage payer : {{ number_format($pourcentage, 2) }} %</span>
                                        @endif
                                        <br>
                                        <span>Numéro du client : {{ $projet->numclient }}</span>
                                        <br>
                                        <br>
                                        <a href="{{ route('detailprojetAdmin',['iddevis' => $projet->id]) }}" class="btn btn-primary py-3 px-5">Voir plus</a>

                                        <a href="{{ route('telechargerpdfAdmin', ['iddevis' => $projet->id]) }}" class="btn btn-secondary py-3 px-5">telecharger pdf</a>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                @endforeach
                <div>
                    {{ $projets->links('vendor.pagination.bootstrap-4') }}
                </div>

            </div>
            </div>
        </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 order-1">
        <div class="row">
        <div class="col-lg-6 col-md-12 col-6 mb-4">
            <div class="card">
            <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                <div class="avatar flex-shrink-0">
                    <img
                    src="admin/assets/img/icons/unicons/chart-success.png"
                    alt="chart success"
                    class="rounded"
                    />
                </div>
                <div class="dropdown">
                    <button
                    class="btn p-0"
                    type="button"
                    id="cardOpt3"
                    data-bs-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                    >
                    <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                    <a class="dropdown-item" href="javascript:void(0);">View More</a>
                    <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                    </div>
                </div>
                </div>
                <span class="fw-semibold d-block mb-1">Profit</span>

                <h3 class="card-title mb-2">
                <?php $total =  0; ?>

                @foreach ($projetsFinis as $projetsFini)
                    <?php $total +=  $projetsFini->totalpourcentage; ?>
                @endforeach
                <p>
                    <span>{{ $total}} Ar </span>
                </p>

                </h3>
            </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12 col-6 mb-4">
            <div class="card">
            <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                <div class="avatar flex-shrink-0">
                    <img
                    src="admin/assets/img/icons/unicons/wallet-info.png"
                    alt="Credit Card"
                    class="rounded"
                    />
                </div>
                <div class="dropdown">
                    <button
                    class="btn p-0"
                    type="button"
                    id="cardOpt6"
                    data-bs-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                    >
                    <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                    <a class="dropdown-item" href="javascript:void(0);">View More</a>
                    <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                    </div>
                </div>
                </div>
                <span>Paiement effectué</span>
                <h3 class="card-title mb-2">
                <?php $totalpayer =  0; ?>

                @foreach ($projetsFinis as $projetspayer)
                    <?php $totalpayer +=  $projetspayer->payer; ?>
                @endforeach
                <p>
                    <span>{{ $totalpayer}} Ar </span>
                </p>

                </h3>
                <!-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.42%</small> -->
            </div>
            </div>
        </div>
        </div>
    </div>
    <!-- Total Revenue -->
    <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
        <div class="card">
        <div class="row row-bordered g-0">
            <div class="col-md-8">
            <h5 class="card-header m-0 me-2 pb-3">Total Revenue</h5>
            <div class="px-2">
                <form action="{{route('indexAdmin')}}" method="get">
                    @csrf
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="date">Choisir une date</label>
                        <select class="form-select" id="date" name="date">
                            <option value="">Choisir une année</option>
                            @foreach ($annee as $item)
                                <option value="{{$item->annee}}">{{$item->annee}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Rechercher</button>
                </form>
                <canvas id="histogramme" height="200"></canvas>
            </div>
            </div>
            <div class="col-md-4">
            </div>
        </div>
        </div>
    </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    var ctx = document.getElementById('histogramme').getContext('2d');
    var histogramme = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
                <?php foreach($projetshistogrammes as $projetshistogramme){ ?>
                    '<?php echo \Carbon\Carbon::createFromFormat('m', $projetshistogramme->mois)->format('M'); ?>',
                <?php } ?>
            ],
            datasets: [{
                label: 'Revenu',
                data: [
                    <?php foreach($projetshistogrammes as $projetshistogramme){ ?>
                        '<?php echo $projetshistogramme->totalpourcentage;  ?>',
                    <?php } ?>
                ],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>


@endsection
