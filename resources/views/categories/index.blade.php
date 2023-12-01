@extends('layouts.master')
@section('title')
    {{__("Liste des Catégories")}} @endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1') {{__("Catalogue > Catégories")}} @endslot
        @slot('title') {{__("Liste des Catégories")}} @endslot
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
                <th>{{__("Avatar")}}</th>
                <th scope="col">{{__("Nom de la catégorie")}}</th>
                <th scope="col">{{__("Description")}}</th>
                </thead>
                <tbody>
                @for($i=0; $i<count($categories); $i++)
                    <tr>

                        <td class="fw-medium">{{$i+1}}</td>

                        <td>
                            <img class="header-profile-user"
                                 @if($categories[$i]->avatar != null)
                                     src="{{asset($categories[$i]->avatar)}}"
                                @else
                                     src="{{asset("images/logo_lagola.png")}}"
                                @endif>
                        </td>

                        <td>
                            <a href="#" class="btn btn-link fw-medium">
                                {{$categories[$i]->name}}
                            </a>
                        </td>
                        <td>{{$categories[$i]->description}}</td>

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
