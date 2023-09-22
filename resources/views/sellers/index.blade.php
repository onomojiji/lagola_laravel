@extends('layouts.master')
@section('title')
    {{__("Liste des vendeur(ses)")}} @endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1') {{__("Vendeur(ses)")}} @endslot
        @slot('title') {{__("Liste des vendeur(ses)")}} @endslot
    @endcomponent

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
            <table class="table table-hover table-responsive table-striped align-middle mb-0">
                <thead>
                <th scope="col">#</th>
                <th scope="col">{{__("Nom(s) et prénom(s)")}}</th>
                <th scope="col">{{__("Numéro de téléphone")}}</th>
                <th scope="col">{{__("sexe")}}</th>
                <th scope="col">{{__("N° CNI")}}</th>
                <th scope="col">{{__("Agence")}}</th>
                <th scope="col">{{__("Statut")}}</th>
                <th scope="col">{{__("Actions")}}</th>
                </thead>
                <tbody>
                @for($i=0; $i<count($sellers); $i++)
                    <tr>

                        <td class="fw-medium">{{$i+1}}</td>
                        <td>
                            <a href="#" class="btn btn-link fw-medium">
                                {{$sellers[$i]['name']}}
                            </a>
                        </td>
                        <td>{{$sellers[$i]['phone']}}</td>
                        <td>{{$sellers[$i]['sexe']}}</td>
                        <td>{{$sellers[$i]['cni']}}</td>
                        <td>{{$sellers[$i]['company']}}</td>

                        <td>
                            @if($sellers[$i]['status'])
                                <span class="badge bg-success">{{__("Actif")}}</span>
                            @else
                                <span class="badge bg-danger">{{__("Désactivé")}}</span>
                            @endif

                        </td>

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
                                        <a class="dropdown-item" href="#">
                                            <i class="ri-edit-box-fill me-2 align-middle text-muted"></i>
                                            Editer
                                        </a>
                                    </li>
                                    <li class="dropdown-divider"></li>

                                    <li>
                                        <a class="dropdown-item" href="#">
                                            @if($sellers[$i]['status'])
                                                <i class="ri-delete-bin-fill text-danger me-2 align-middle"></i>
                                                <span class="text-danger">Désactiver</span>
                                            @else
                                                <i class="ri-check-fill me-2 align-middle text-primary"></i>
                                                <span class="text-primary">Activer</span>
                                            @endif

                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </td>

                    </tr>
                @endfor
                </tbody>
            </table>
        </div>
    </div>

@endsection

@section('script')
    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
@endsection
