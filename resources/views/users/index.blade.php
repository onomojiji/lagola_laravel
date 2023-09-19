@extends('layouts.master')
@section('title')
    {{__("Liste des utilisateurs")}} @endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1') {{__("Utilisateurs")}} @endslot
        @slot('title') {{__("Liste des utilisateurs")}} @endslot
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
                    <th scope="col">{{__("Qualité")}}</th>
                    <th scope="col">{{__("Statut")}}</th>
                    <th scope="col">{{__("Actions")}}</th>
                </thead>
                <tbody>
                @for($i=0; $i<count($users); $i++)
                    <tr>

                        <td class="fw-medium">{{$i+1}}</td>
                        <td>
                            <a href="#" class="btn btn-link fw-medium">
                                {{$users[$i]->name}}
                            </a>
                        </td>
                        <td>{{$users[$i]->phone}}</td>
                        <td>
                            @if($users[$i]->admin)
                                @if($users[$i]->id == 1)
                                    <span class="text-primary fw-bold">
                                        {{__("Super Admin")}}
                                    </span>
                                @else
                                    <span class="text-primary fw-bold">
                                        {{__("Administrateur")}}
                                    </span>
                                @endif
                            @else
                                {{__("Commercial")}}
                            @endif
                        </td>

                        <td>
                            @if($users[$i]->active)
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
                                            @if($users[$i]->active)
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
