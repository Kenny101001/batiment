@extends('layouts.indexAdmin')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
    <div class="col-lg-8 mb-4 order-0">
        <div class="card" style="height:1090px">
            <div class="d-flex align-items-end row">
                <div class="col-sm-7">
                    <div class="card-body" height="auto">

                        <div class="mt-3">
                            <h5>debut : {{$projets->debut}} -> fin {{$projets->fin}}</h5>
                            <table id="dataTablePdf" class="table table-striped table-hover" style="font-size: 14px;">
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
                            <br>
                            <div style="text-align: center;">
                                <a  style="color:white" id="export-pdf" class="btn btn-primary py-3 px-5" style="display: inline-block;">télécharger pdf</a>
                            </div>

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
        
        </div>
    </div>
    <!-- Total Revenue -->
    <!-- <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
        <div class="card">
        <div class="row row-bordered g-0">
            <div class="col-md-8">
            <h5 class="card-header m-0 me-2 pb-3">Total Revenue</h5>
            <div id="totalRevenueChart" class="px-2"></div>
            </div>
            <div class="col-md-4">
            <div class="card-body">
                <div class="text-center">
                <div class="dropdown">
                    <button
                    class="btn btn-sm btn-outline-primary dropdown-toggle"
                    type="button"
                    id="growthReportId"
                    data-bs-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                    >
                    2022
                    </button>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="growthReportId">
                    <a class="dropdown-item" href="javascript:void(0);">2021</a>
                    <a class="dropdown-item" href="javascript:void(0);">2020</a>
                    <a class="dropdown-item" href="javascript:void(0);">2019</a>
                    </div>
                </div>
                </div>
            </div>
            <div id="growthChart"></div>
            <div class="text-center fw-semibold pt-3 mb-2">62% Company Growth</div>

            <div class="d-flex px-xxl-4 px-lg-2 p-4 gap-xxl-3 gap-lg-1 gap-3 justify-content-between">
                <div class="d-flex">
                <div class="me-2">
                    <span class="badge bg-label-primary p-2"><i class="bx bx-dollar text-primary"></i></span>
                </div>
                <div class="d-flex flex-column">
                    <small>2022</small>
                    <h6 class="mb-0">$32.5k</h6>
                </div>
                </div>
                <div class="d-flex">
                <div class="me-2">
                    <span class="badge bg-label-info p-2"><i class="bx bx-wallet text-info"></i></span>
                </div>
                <div class="d-flex flex-column">
                    <small>2021</small>
                    <h6 class="mb-0">$41.2k</h6>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div> -->
    <!--/ Total Revenue -->
    <!-- <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
        <div class="row">
        <div class="col-6 mb-4">
            <div class="card">
            <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                <div class="avatar flex-shrink-0">
                    <img src="admin/assets/img/icons/unicons/paypal.png" alt="Credit Card" class="rounded" />
                </div>
                <div class="dropdown">
                    <button
                    class="btn p-0"
                    type="button"
                    id="cardOpt4"
                    data-bs-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                    >
                    <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                    <a class="dropdown-item" href="javascript:void(0);">View More</a>
                    <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                    </div>
                </div>
                </div>
                <span class="d-block mb-1">Payments</span>
                <h3 class="card-title text-nowrap mb-2">$2,456</h3>
                <small class="text-danger fw-semibold"><i class="bx bx-down-arrow-alt"></i> -14.82%</small>
            </div>
            </div>
        </div>
        <div class="col-6 mb-4">
            <div class="card">
            <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                <div class="avatar flex-shrink-0">
                    <img src="admin/assets/img/icons/unicons/cc-primary.png" alt="Credit Card" class="rounded" />
                </div>
                <div class="dropdown">
                    <button
                    class="btn p-0"
                    type="button"
                    id="cardOpt1"
                    data-bs-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                    >
                    <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="cardOpt1">
                    <a class="dropdown-item" href="javascript:void(0);">View More</a>
                    <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                    </div>
                </div>
                </div>
                <span class="fw-semibold d-block mb-1">Transactions</span>
                <h3 class="card-title mb-2">$14,857</h3>
                <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.14%</small>
            </div>
            </div>
        </div>
        </div>
<div class="row">

        </div>
    </div>
    </div>
    <div class="row"> -->
    <!-- Order Statistics -->

    <!--/ Order Statistics -->

    <!-- Expense Overview -->
    <!-- <div class="col-md-6 col-lg-4 order-1 mb-4">
        <div class="card h-100">
        <div class="card-header">
            <ul class="nav nav-pills" role="tablist">
            <li class="nav-item">
                <button
                type="button"
                class="nav-link active"
                role="tab"
                data-bs-toggle="tab"
                data-bs-target="#navs-tabs-line-card-income"
                aria-controls="navs-tabs-line-card-income"
                aria-selected="true"
                >
                Income
                </button>
            </li>
            <li class="nav-item">
                <button type="button" class="nav-link" role="tab">Expenses</button>
            </li>
            <li class="nav-item">
                <button type="button" class="nav-link" role="tab">Profit</button>
            </li>
            </ul>
        </div>
        <div class="card-body px-0">
            <div class="tab-content p-0">
            <div class="tab-pane fade show active" id="navs-tabs-line-card-income" role="tabpanel">
                <div class="d-flex p-4 pt-3">
                <div class="avatar flex-shrink-0 me-3">
                    <img src="admin/assets/img/icons/unicons/wallet.png" alt="User" />
                </div>
                <div>
                    <small class="text-muted d-block">Total Balance</small>
                    <div class="d-flex align-items-center">
                    <h6 class="mb-0 me-1">$459.10</h6>
                    <small class="text-success fw-semibold">
                        <i class="bx bx-chevron-up"></i>
                        42.9%
                    </small>
                    </div>
                </div>
                </div>
                <div id="incomeChart"></div>
                <div class="d-flex justify-content-center pt-4 gap-2">
                <div class="flex-shrink-0">
                    <div id="expensesOfWeek"></div>
                </div>
                <div>
                    <p class="mb-n1 mt-1">Expenses This Week</p>
                    <small class="text-muted">$39 less than last week</small>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div> -->

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.6/jspdf.plugin.autotable.min.js"></script>

<script>
$(document).ready(function() {
    $('#export-pdf').click(function() {
        var doc = new jsPDF();

        // Ajout d'un titre au document PDF
        doc.setFontSize(18); // Définit la taille de la police pour le titre

        doc.setTextColor(40);
        doc.setFontStyle('bold');
        doc.text('Détail du projet :', 10, 20);
        doc.setTextColor(100);
        doc.text('numéro client : {{$projets->numclient}}', 20, 30);
        doc.text('maison : {{$projets->maison}}', 20, 40);
        doc.text('date début : {{$projets->debut}}', 20, 50);
        doc.text('date fin : {{$projets->fin}}', 20, 60);
        doc.text('finition : {{$projets->finition}}', 20, 70);
        doc.text('nombre de chambre : {{$projets->nbchambre}}', 20, 80);
        doc.text('nombre de toilette : {{$projets->nbtoilette}}', 20, 90);

        doc.autoTable({html: '#dataTablePdf', startY: 100});

        // Ajout d'une nouvelle page
        // doc.addPage();

        // Deuxième table
        // doc.autoTable({html: '#dataTablePdf2'});

        doc.save('devis.pdf');
    });
});
</script>

@endsection
