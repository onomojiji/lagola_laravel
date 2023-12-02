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


    <div class="row">
        <div class="card">
            <div class="card-header">
                <p class="h6">Tendance des ventes du mois en cours</p>
            </div>
            <div class="card-body my-0 py-0">
                <div class="w-100 h-auto" id="gains" style="height: 300%"></div>
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

    var gains = echarts.init(document.getElementById('gains'));

    var option = {
        tooltip: {},
        xAxis: {
            data: [1,2,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31]
        },
        yAxis: {},
        series: [
            {
                data: [10, 22, 28, 43, 49,10, 22, 28, 43, 49,10, 22, 28, 43, 49,10, 22, 28, 43, 49,10, 22, 28, 43, 49,],
                type: 'bar',
                stack: 'x',
                areaStyle: {
                    color: '#41ef31',
                }
            },
            {
                data: [10, 22, 28, 43, 49,10, 22, 28, 43, 49,10, 22, 28, 43, 49,10, 22, 28, 43, 49,10, 22, 28, 43, 49,],
                type: 'bar',
                stack: 'x',
            },
        ],
        dimensions: ['product', '2015', '2016', '2017']
    };

    gains.setOption(option);


</script>
@endsection
