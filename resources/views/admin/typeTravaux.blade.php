@extends('layouts.indexAdmin')

@section('content')

<div class="container-l flex-grow-2 container-p-y" style="height:auto; width:auto>

    <div class="col-lg-12 mb-4 order-0" style="height:auto; width:auto>

            <div class="d-flex align-items-end row">
                <div class="col-sm-12">
                    <div class="card-body" style="height:auto">
                        <div class="mt-3">

                            <h5>les différents travaux</h5>
                                <table id="dataTablePdf" class="table table-striped table-hover" style="font-size: 14px;">
                                    <th>
                                        <td>id</td>
                                        <td>nom</td>
                                        <td>unite</td>
                                        <td>prixunitaire</td>
                                        <td>action</td>
                                    </th>
                                    @foreach ($typeTravaux as $typeTrav)
                                    <tr>
                                        <td></td>
                                        <td>{{$typeTrav->id}}</td>
                                        <td>{{$typeTrav->nom}}</td>
                                        <td>{{$typeTrav->unite}}</td>
                                        <td>{{$typeTrav->prixunitaire}}</td>
                                        <td><a href="{{route('typeTravauxformulaire', ['id' => $typeTrav->id])}}">modifier</a></td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    </div>

    <!-- Total Revenue -->

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

@endsection
