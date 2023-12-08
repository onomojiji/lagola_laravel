@extends('layouts.master')
@section('title')
    {{__("Accueil")}} @endsection
@section('css')
<link href="{{ URL::asset('assets/libs/jsvectormap/jsvectormap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/libs/swiper/swiper.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') Dashboards @endslot
@slot('title') {{ \Carbon\Carbon::now()->monthName. " - ". \Carbon\Carbon::now()->year }} @endslot
@endcomponent

    <div class="row">
        <div class="col-12">
            <h5 class="text-decoration-underline mb-3 pb-1">Les ventes</h5>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div class="card crm-widget">
                <div class="card-body p-0">
                    <div class="row row-cols-md-3 row-cols-1">
                        <div class="col col-lg border-end">
                            <div class="py-4 px-3">
                                <h5 class="text-muted text-uppercase fs-13">Produits vendus ce mois <i
                                        class="ri-arrow-up-circle-line text-success fs-18 float-end align-middle"></i>
                                </h5>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <i class="ri-store-line display-6 text-muted"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h3 class="mb-0">
                                            {{ $thisMonthSellProducts }}
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end col -->
                        <div class="col col-lg border-end">
                            <div class="mt-3 mt-md-0 py-4 px-3">
                                <h5 class="text-muted text-uppercase fs-13">Montant du mois <i
                                        class="ri-arrow-up-circle-line text-success fs-18 float-end align-middle"></i>
                                </h5>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <i class="ri-exchange-dollar-line display-6 text-muted"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h4 class="mb-0">
                                            {{ $thisMonthMoney }}
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end col -->
                        <div class="col col-lg border-end">
                            <div class="mt-3 mt-md-0 py-4 px-3">
                                <h5 class="text-muted text-uppercase fs-13">Produits vendus aujourd'hui <i
                                        class="ri-arrow-up-circle-line text-success fs-18 float-end align-middle"></i>
                                </h5>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <i class="ri-store-line display-6 text-muted"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h3 class="mb-0">
                                            {{ $thisTodaySellProducts }}
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end col -->
                        <div class="col col-lg border-end">
                            <div class="mt-3 mt-lg-0 py-4 px-3">
                                <h5 class="text-muted text-uppercase fs-13">Montant d'aujourd'hui <i
                                        class="ri-arrow-up-circle-line text-success fs-18 float-end align-middle"></i>
                                </h5>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <i class="ri-exchange-dollar-line display-6 text-muted"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h4 class="mb-0">
                                            {{ $thisTodayMoney }}
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end col -->
                    </div><!-- end row -->
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->
    </div><!-- end row -->

    <div class="row">
        <div class="col-12">
            <h5 class="text-decoration-underline mb-3 pb-1">Les pertes financières</h5>
        </div>
    </div>

    <div class="row">

        <div class="col-xl-3 col-md-6">
            <!-- card -->
            <div class="card card-animate bg-danger">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <p class="text-uppercase fw-medium text-white-50 mb-0">TOTALES</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-end justify-content-between mt-4">
                        <div>
                            <h4 class="fs-22 fw-semibold ff-secondary mb-4 text-white">{{ $totalFinancePertes }}</h4>

                        </div>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->

        <div class="col-xl-3 col-md-6">
            <!-- card -->
            <div class="card card-animate">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <p class="text-uppercase fw-medium text-muted mb-0">ANNUELLES</p>
                        </div>
                        <div class="flex-shrink-0">
                            <h5 class="text-success fs-14 mb-0">
                                <i class="ri-arrow-right-up-line fs-13 align-middle"></i> +100 %
                            </h5>
                        </div>
                    </div>
                    <div class="d-flex align-items-end justify-content-between mt-4">
                        <div>
                            <h4 class="fs-22 fw-semibold ff-secondary mb-4"> {{ $yearFinancePertes }} </h4>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->

        <div class="col-xl-3 col-md-6">
            <!-- card -->
            <div class="card card-animate">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <p class="text-uppercase fw-medium text-muted mb-0">MENSUELLES</p>
                        </div>
                        <div class="flex-shrink-0">
                            <h5 class="text-success fs-14 mb-0">
                                <i class="ri-arrow-right-up-line fs-13 align-middle"></i> +100 %
                            </h5>
                        </div>
                    </div>
                    <div class="d-flex align-items-end justify-content-between mt-4">
                        <div>
                            <h4 class="fs-22 fw-semibold ff-secondary mb-4"> {{ $monthFinancePertes }} </h4>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->

        <div class="col-xl-3 col-md-6">
            <!-- card -->
            <div class="card card-animate">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <p class="text-uppercase fw-medium text-muted mb-0">Journalière</p>
                        </div>
                        <div class="flex-shrink-0">
                            <h5 class="text-muted fs-14 mb-0">
                                +2.35 %
                            </h5>
                        </div>
                    </div>
                    <div class="d-flex align-items-end justify-content-between mt-4">
                        <div>
                            <h4 class="fs-22 fw-semibold ff-secondary mb-4"> {{ $dayFinancePertes }} </h4>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->
    </div> <!-- end row-->

    <div class="row">
        <div class="col-12">
            <h5 class="text-decoration-underline mb-3 pb-1">Les pertes de produits</h5>
        </div>
    </div>

    <div class="row">

        <div class="col-xl-3 col-md-6">
            <!-- card -->
            <div class="card card-animate bg-danger">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <p class="text-uppercase fw-medium text-white-50 mb-0">TOTALES</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-end justify-content-between mt-4">
                        <div>
                            <h4 class="fs-22 fw-semibold ff-secondary mb-4 text-white">{{ $totalProductPertes }}</h4>

                        </div>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->

        <div class="col-xl-3 col-md-6">
            <!-- card -->
            <div class="card card-animate">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <p class="text-uppercase fw-medium text-muted mb-0">ANNUELLES</p>
                        </div>
                        <div class="flex-shrink-0">
                            <h5 class="text-success fs-14 mb-0">
                                <i class="ri-arrow-right-up-line fs-13 align-middle"></i> +100 %
                            </h5>
                        </div>
                    </div>
                    <div class="d-flex align-items-end justify-content-between mt-4">
                        <div>
                            <h4 class="fs-22 fw-semibold ff-secondary mb-4"> {{ $yearProductPertes }} </h4>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->

        <div class="col-xl-3 col-md-6">
            <!-- card -->
            <div class="card card-animate">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <p class="text-uppercase fw-medium text-muted mb-0">MENSUELLES</p>
                        </div>
                        <div class="flex-shrink-0">
                            <h5 class="text-success fs-14 mb-0">
                                <i class="ri-arrow-right-up-line fs-13 align-middle"></i> +100 %
                            </h5>
                        </div>
                    </div>
                    <div class="d-flex align-items-end justify-content-between mt-4">
                        <div>
                            <h4 class="fs-22 fw-semibold ff-secondary mb-4"> {{ $monthProductPertes }} </h4>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->

        <div class="col-xl-3 col-md-6">
            <!-- card -->
            <div class="card card-animate">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <p class="text-uppercase fw-medium text-muted mb-0">Journalière</p>
                        </div>
                        <div class="flex-shrink-0">
                            <h5 class="text-muted fs-14 mb-0">
                                +2.35 %
                            </h5>
                        </div>
                    </div>
                    <div class="d-flex align-items-end justify-content-between mt-4">
                        <div>
                            <h4 class="fs-22 fw-semibold ff-secondary mb-4"> {{ $dayProductPertes }} </h4>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->
    </div> <!-- end row-->

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <p class="h6">Benefices vs pertes totales</p>
                    <table class="table table-striped-columns">
                        <thead>
                            <tr>
                                <th>Benefices</th>
                                <th>Pertes</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="fw-bold text-success">{{ number_format($totalBenefics, 0, ",", " ")." Fcfa" }}</td>
                                <td class="fw-bold text-danger">{{ number_format($totalLosses, 0, ",", " ")." Fcfa" }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-body my-0 py-0">
                    <div class="w-100 h-auto" id="all_benefics_losses" style="height: 300%; width: 100%"></div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <p class="h6">Benefices vs pertes annuelles</p>
                    <table class="table table-striped-columns">
                        <thead>
                        <tr>
                            <th>Benefices</th>
                            <th>Pertes</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="fw-bold text-success">{{ number_format($annualBenefics, 0, ",", " ")." Fcfa" }}</td>
                            <td class="fw-bold text-danger">{{ number_format($annualLosses, 0, ",", " ")." Fcfa" }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-body my-0 py-0">
                    <div class="w-100 h-auto" id="annual_benefics_losses" style="height: 300%; width: 100%"></div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <p class="h6">Benefices vs pertes des 3 derniers mois</p>
                    <table class="table table-striped-columns">
                        <thead>
                        <tr>
                            <th>Benefices</th>
                            <th>Pertes</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="fw-bold text-success">{{ number_format($lastThreeMonthBenefics, 0, ",", " ")." Fcfa" }}</td>
                            <td class="fw-bold text-danger">{{ number_format($lastThreeMonthLosses, 0, ",", " ")." Fcfa" }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-body my-0 py-0">
                    <div class="w-100 h-auto" id="last3months_benefics_losses" style="height: 300%; width: 100%"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="card">
            <div class="card-header">
                <p class="h6">Produits les plus vendus</p>
            </div>
            <div class="card-body my-0 py-0">
                <div class="w-100 h-auto" id="produits_plus_vendus" style="height: 300%; width: 100%"></div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="card">
            <div class="card-header">
                <p class="h6">Produits les moins vendus</p>
            </div>
            <div class="card-body my-0 py-0">
                <div class="w-100 h-auto" id="produits_moins_vendus" style="height: 300%; width: 100%"></div>
            </div>
        </div>
    </div>


@endsection
@section('script')
<!-- apexcharts -->
<script src="{{ URL::asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/jsvectormap/jsvectormap.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/swiper/swiper.min.js')}}"></script>
<!-- dashboard init -->
<script src="{{ URL::asset('/assets/js/pages/dashboard-ecommerce.init.js') }}"></script>
<script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/echarts@5.4.3/dist/echarts.min.js"></script>
<script type="text/javascript">

    var productsNames = @json($productsNames);
    var productsQte = @json($productsQte);
    var productsNames2 = @json($productsNames2);
    var productsQte2 = @json($productsQte2);
    var totalBenefics = @json($totalBenefics);
    var totalLosses = @json($totalLosses);
    var annualBenefics = @json($annualBenefics);
    var annualLosses = @json($annualLosses);
    var lastThreeMonthBenefics = @json($lastThreeMonthBenefics);
    var lastThreeMonthLosses = @json($lastThreeMonthLosses);

    // Produits les plus vendus
    var produits_plus_vendus = echarts.init(document.getElementById('produits_plus_vendus'));

    var option = {
        tooltip: {},
        xAxis: {
            data: productsNames
        },
        yAxis: {},
        series: [
            {
                name: 'Quantité vendue',
                type: 'bar',
                data: productsQte
            }
        ],
    };

    // Display the chart using the configuration items and data just specified.
    produits_plus_vendus.setOption(option);

    ///////////////////////////////////////////////////////////////////////////////////

    // Produits les plus vendus
    var produits_moins_vendus = echarts.init(document.getElementById('produits_moins_vendus'));

    var option = {
        tooltip: {},
        xAxis: {
            data: productsNames2
        },
        yAxis: {},
        color: [
            '#c23531',
        ],
        series: [
            {
                name: 'Quantité vendue',
                type: 'bar',
                data: productsQte2
            }
        ],
    };

    // Display the chart using the configuration items and data just specified.
    produits_moins_vendus.setOption(option);

    ///////////////////////////////////////////////////////////////////////////////////

    var all_benefics_losses = echarts.init(document.getElementById('all_benefics_losses'));

    var option = {
        series: [
            {
                type: 'pie',
                color: [
                    '#FF0000',
                    '#00FF00',
                ],
                data: [
                    {
                        value: totalLosses,
                        name: 'Pertes'
                    },
                    {
                        value: totalBenefics,
                        name: 'Benefices',
                    },
                ],
            }
        ]
    }

    all_benefics_losses.setOption(option)

    var annual_benefics_losses = echarts.init(document.getElementById('annual_benefics_losses'));

    var option = {
        series: [
            {
                type: 'pie',
                color: [
                    '#FF0000',
                    '#00FF00',
                ],
                data: [
                    {
                        value: annualLosses,
                        name: 'Pertes'
                    },
                    {
                        value: annualBenefics,
                        name: 'Benefices',
                    },
                ],
            }
        ]
    }

    annual_benefics_losses.setOption(option)

    var last3months_benefics_losses = echarts.init(document.getElementById('last3months_benefics_losses'));

    var option = {
        series: [
            {
                type: 'pie',
                color: [
                    '#FF0000',
                    '#00FF00',
                ],
                data: [
                    {
                        value: lastThreeMonthLosses,
                        name: 'Pertes'
                    },
                    {
                        value: lastThreeMonthBenefics,
                        name: 'Benefices',
                    },
                ],
            }
        ]
    }

    last3months_benefics_losses.setOption(option)

</script>
@endsection
