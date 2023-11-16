@extends('layouts.master')
@section('title')
    {{__("Nouvelle kiosque")}} @endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1') {{__("Kiosques")}} @endslot
        @slot('title') {{__("Nouveau kiosque")}} @endslot
    @endcomponent

    <div class="card p-3">

        <form action="{{route("companies.store")}}" method="post">
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
                    <div class="col-md-12 form-group">
                        <label for="name">{{__("Nom")}}</label>
                        <input id="name" type="text" name="name" class="form-control" placeholder="{{__("Tapez le nom du kiosque")}}" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12 form-group">
                        <label for="address">{{__("Adresse du kiosque")}}</label>
                        <textarea id="address" class="form-control" name="address" cols="2"></textarea>
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
