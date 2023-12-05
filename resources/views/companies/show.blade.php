@extends('layouts.master')
@section('title')
    {{__("Liste des Kiosques")}} @endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1') {{__("Kiosques")}} @endslot
        @slot('title') {{ "Kiosque de ".$company->name }} @endslot
    @endcomponent

    <div class="row">

        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger mb-2" role="alert">
                                {{$error}}
                            </div>
                        @endforeach
                    @endif
                    @if(@session('success'))
                        <div class="alert alert-success">
                            {{session('success')}}
                        </div>
                    @endif
                    @if(@session('fail'))
                        <div class="alert alert-danger">
                            {{session('fail')}}
                        </div>
                    @endif

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs nav-tabs-custom nav-primary nav-justified mb-3" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#home1" role="tab">
                                Produits vendus
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#profile1" role="tab">
                                Produits en stock
                            </a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content text-muted">
                        <div class="tab-pane active" id="home1" role="tabpanel">
                            <table class="table table-striped table-hover table-striped-columns">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Qté</th>
                                    <th scope="col">Montant</th>
                                    <th scope="col">Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                @for($i = 0; $i < count($companyCommands); $i++)
                                    <tr>
                                        <th scope="row">{{$i +1}}</th>
                                        <td>{{$companyCommands[$i]["name"]}}</td>
                                        <td class="text-primary fw-bold">{{$companyCommands[$i]["quantity"]}}</td>
                                        <td class="fw-bold">{{$companyCommands[$i]["price"]." FCFA"}}</td>
                                        <td>{{$companyCommands[$i]["date"]}}</td>
                                    </tr>
                                @endfor
                            </table>
                        </div>
<!--------------------------------------------------------------------------------------------------------------------------------------->
                        <div class="tab-pane" id="profile1" role="tabpanel">
                            <table class="table table-striped table-hover table-striped-columns">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Prix</th>
                                    <th scope="col">Qté</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @for($i = 0; $i < count($companyProducts); $i++)
                                    <tr>
                                        <th scope="row">{{$i +1}}</th>
                                        <td>{{$companyProducts[$i]["name"]}}</td>
                                        <td class="fw-bold">{{$companyProducts[$i]["price"]." FCFA"}}</td>
                                        <td class="text-primary fw-bold">{{$companyProducts[$i]["quantity"]}}</td>
                                        <td>
                                            <div class="dropdown">
                                                <a href="#"
                                                   class="btn btn-light btn-icon" id="dropdownMenuLink15"
                                                   data-bs-toggle="dropdown" aria-expanded="true">
                                                    <i class="ri-equalizer-fill"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end"
                                                    aria-labelledby="dropdownMenuLink15">
                                                    <li>
                                                        <a class="dropdown-item text-danger"
                                                           href="{{ route("pertes.store", ["company_id" => $companyProducts[$i]["product_id"], "product_id" => $companyProducts[$i]["product_id"]]) }}">
                                                            <i class="ri-delete-bin-fill me-2 align-middle text-danger"></i>
                                                            Vider
                                                        </a>
                                                    </li>
                                                    <li class="dropdown-divider"></li>
                                                </ul>
                                            </div>
                                        </td>

                                    </tr>
                                @endfor
                            </table>
                        </div>
                    </div>
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div>
        <!--end col-->
    </div>
    <!--end row-->

@endsection

@section('script')
    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
@endsection

