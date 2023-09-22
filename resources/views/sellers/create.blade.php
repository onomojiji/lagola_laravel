@extends('layouts.master')
@section('title')
    {{__("Nouvel Utilisateur")}} @endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1') {{__("Utilisateurs")}} @endslot
        @slot('title') {{__("Nouvel utilisateurs")}} @endslot
    @endcomponent

    <div class="card p-3">

        <form action="{{route("sellers.store")}}" method="post">
            @csrf
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
                <div class="row mb-3">
                    <div class="col-md-8 form-group">
                        <label for="name">{{__("Nom(s) et prénom(s)")}}</label>
                        <input id="name" type="text" name="name" class="form-control" placeholder="{{__("Tapez le nom de l'utilisateur")}}" required>
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="phone">{{__("Numéro de téléphone")}}</label>
                        <input id="phone" type="number" name="phone" class="form-control" placeholder="{{__("Tapez le numéro de téléphone")}}" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 form-group">
                        <label for="sexe">{{__("Sexe")}}</label>
                        <select id="sexe" name="sexe" class="form-select">
                            <option value="M">{{__("Masculin")}}</option>
                            <option value="F">{{__("Feminin")}}</option>
                        </select>
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="cni">{{__("Numéro de CNI")}}</label>
                        <input id="cni" type="text" name="cni" class="form-control" placeholder="{{__("Tapez le numéro de CNI")}}" required>
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="company_id">{{__("Agence d'affectation")}}</label>
                        <select id="company_id" name="company_id" class="form-select">
                            @foreach($companies as $company)
                                <option value="{{$company->id}}">{{$company->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6 form-group">
                        <label for="password">{{__("Mot de passe")}}</label>
                        <input id="password" type="password" name="password" class="form-control" placeholder="{{__("Mot de passe")}}" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="confirm">{{__("Confirmation")}}</label>
                        <input id="confirm" type="password" name="confirm" class="form-control" placeholder="{{__("Confirmer le mot de passe")}}" required>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <div class="row justify-content-end">
                    <button type="submit" class="btn btn-primary w-25">Enregistrer</button>
                </div>
            </div>

        </form>

    </div>

@endsection

@section('script')
    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
@endsection
