@extends('layouts.app',['title' => 'Inscription-boutique'])

@section('main-content')
  <section class="py-0" style="margin-bottom: 3rem;">
    <div class="bg-holder" style="background-image:url(../assets/img/bg/bg-24.png);background-position:center;background-size:auto;"></div>
    <!--/.bg-holder-->
    <div class="container-lg position-relative">
        <div class="row flex-center">
            <div class="col-sm-10 col-md-8 col-lg-5 col-xl-5 col-xxl-3">
                <a class="d-flex flex-center text-decoration-none mb-4" href="/">
                <div class="d-flex align-items-center fw-bolder fs-3 d-inline-block"><img src="{{asset('assets/img/icons/logo.png')}}" alt="phoenix" width="58" /></div>
                </a>
                <div class="text-center mb-7">
                <h3 class="text-body-highlight">S'inscrire</h3>
                <p class="text-body-tertiary">Créer votre compte commerçant aujourd'hui</p>
                </div>
                <form method="POST" action="{{ route('magasin.register') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3 text-start">
                        <label class="form-label" for="name">Le nom de votre boutique</label>
                        <input id="shop_name" type="text" placeholder="Le nom de votre boutique" class="form-control @error('shop_name') is-invalid @enderror" name="shop_name" value="{{ old('shop_name') }}" required autocomplete="shop_name" autofocus>

                        @error('shop_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3 text-start">
                        <label class="form-label" for="admin_name">Votre Prenom et nom</label>
                        <input id="admin_name" type="text" placeholder="Votre Prenom et nom" class="form-control @error('admin_name') is-invalid @enderror" name="admin_name" value="{{ old('admin_name') }}" required autocomplete="admin_name" autofocus>

                        @error('admin_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3 text-start">
                        <label class="form-label" for="email">Votre adresse email</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="email@gmail.com" required autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3 text-start">
                        <label class="form-label" for="adresse">Votre adresse de localisation</label>
                        <input id="adresse" type="adresse" class="form-control @error('adresse') is-invalid @enderror" name="adresse" value="{{ old('adresse') }}" placeholder="Votre adresse de localisation" required autocomplete="adresse">

                        @error('adresse')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-sm-6 text-start">
                            <label class="form-label" for="phone">Votre numero de telephone</label>
                            <input id="phone" type="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" placeholder="Votre numero de telephone" required autocomplete="phone">

                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-sm-6 text-start">
                            <label class="form-label" for="logo">Le logo de votre boutique</label>
                            <input id="logo" type="file" class="form-control @error('logo') is-invalid @enderror" name="logo" value="{{ old('logo') }}" required autocomplete="logo">

                            @error('logo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-sm-6">
                            <label class="form-label" for="password">Votre mot de passe</label>
                            <input id="password" type="password" placeholder="Votre mot de passe" class="form-icon-input form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label" for="confirmPassword">Confirmer votre mot de passe</label>
                            <input id="password-confirm" type="password" class="form-icon-input form-control" placeholder="Confirmer votre mot de passe" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input @error('termsService') is-invalid @enderror" id="termsService" name="termsService" value="{{ old('termsService') ?? 1 }}" type="checkbox" required autocomplete="termsService"/>
                        <label class="form-label fs-9 text-transform-none mt-1" for="termsService">
                            J'accepte les <a target="_blank" href="{{route('utilisateur.conditions')}}">conditions d'utilisation </a> et <a target="_blank" href="{{route('utilisateur.privacy')}}">politique de confidentialités</a>
                        </label>
                        @error('termsService')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button class="btn btn-primary w-100 mb-3" type="submit">S'inscrire</button>
                    <div class="text-center"><a class="fs-9 fw-bold" href="{{ route('magasin.login') }}">Se connecter à un compte commerçant existant</a></div>
                </form>
            </div>
        </div>
    </div>
  </section>
@endsection