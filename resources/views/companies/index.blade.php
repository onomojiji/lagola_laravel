@extends('layouts.master')
@section('title')
    {{__("Liste des Agences")}} @endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1') {{__("Agences")}} @endslot
        @slot('title') {{__("Liste des Agences")}} @endslot
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
                <th scope="col">{{__("Nom de l'agence")}}</th>
                <th scope="col">{{__("Adresse")}}</th>
                <th scope="col">{{__("Actions")}}</th>
                </thead>
                <tbody>
                @for($i=0; $i<count($companies); $i++)
                    <tr>

                        <td class="fw-medium">{{$i+1}}</td>
                        <td>
                            <a href="#" class="btn btn-link fw-medium">
                                {{$companies[$i]->name}}
                            </a>
                        </td>
                        <td>{{$companies[$i]->address}}</td>

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
