@extends('layouts.master-without-nav')
@section('title')
    {{__("Connexion")}}
@endsection
@section('content')

    <!-- auth-page wrapper -->
    <div class="auth-page-wrapper py-5 d-flex justify-content-center align-items-center min-vh-100"
         style="
      background-image: url({{asset("assets/images/cover-pattern.png")}});
      background-position: top;
      background-repeat: no-repeat;
      background-size: cover;
      ">
        <div class="bg-overlay"></div>
        <!-- auth-page content -->
        <div class="auth-page-content overflow-hidden pt-lg-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card overflow-hidden">
                            <div class="row g-0">
                                <div class="col-lg-6">
                                    <div class="p-lg-5 p-4 h-100"
                                         style="background-image: url('images/logo_lagola.png');
                                            background-position: center;
                                            background-repeat: no-repeat;
                                            background-size: contain;">
                                        <div class="position-relative h-100 d-flex flex-column">

                                        </div>
                                    </div>
                                </div>
                                <!-- end col -->

                                <div class="col-lg-6">
                                    <div class="p-lg-5 p-4">
                                        <div>
                                            <h5 class="text-primary">{{__("Bienvenue !")}}</h5>
                                            <p class="text-muted">{{__("Connectez vous pour continuer.")}}</p>
                                        </div>

                                        <div class="mt-4">

                                            @if ($errors->any())

                                                @foreach ($errors->all() as $error)
                                                    <div class="alert alert-danger mb-2" role="alert">
                                                        {{$error}}
                                                    </div>
                                                @endforeach

                                            @endif

                                            <form action="{{route("login.store")}}" method="post">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="username" class="form-label">{{__("Numéro de téléphone")}}</label>
                                                    <input type="number" class="form-control" id="phone" name="phone"
                                                           placeholder="{{__("Entrez votre numéro de téléphone")}}"  @error('phone') is-invalid @enderror required autofocus>
                                                    @error('phone')
                                                    <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <div class="float-end">
                                                        <a href="#" class="text-muted">{{__("Mot de passe oublié ?")}}</a>
                                                    </div>
                                                    <label class="form-label" for="password-input">{{__("Mot de passe")}}</label>
                                                    <div class="position-relative auth-pass-inputgroup mb-3">
                                                        <input type="password" class="form-control pe-5 password-input"
                                                               placeholder="{{__("Entrez votre mot de passe")}}" id="password-input" name="password" @error('password') is-invalid @enderror required>
                                                        <button
                                                            class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                                                            type="button" id="password-addon"><i
                                                                class="ri-eye-fill align-middle"></i></button>

                                                        @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                    </div>
                                                </div>

                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                           id="auth-remember-check" name="remember">
                                                    <label class="form-check-label" for="auth-remember-check">{{__("Se souvenir de moi")}}</label>
                                                </div>

                                                <div class="mt-4">
                                                    <button class="btn btn-success w-100" type="submit">{{__("Se connecter")}}</button>
                                                </div>

                                            </form>
                                        </div>

                                    </div>
                                </div>
                                <!-- end col -->
                            </div>
                            <!-- end row -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->

                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->

    </div>
    <!-- end auth-page-wrapper -->

@endsection
@section('script')
    <script src="{{ URL::asset('assets/js/pages/password-addon.init.js') }}"></script>
@endsection
