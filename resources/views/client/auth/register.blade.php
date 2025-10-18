@extends('layouts.app',['title' => 'Inscription-client'])

@section('main-content')
  <section class="py-0" style="margin-bottom: 2rem;">
    <div class="bg-holder" style="background-image:url(assets/img/bg/bg-24.png);background-position:center;background-size:auto;"></div>
    <!--/.bg-holder-->
    <div class="container-lg position-relative">
        <div class="row flex-center">
            <div class="col-sm-10 col-md-8 col-lg-5 col-xl-5 col-xxl-3">
                <a class="d-flex flex-center text-decoration-none mb-4" href="/">
                <div class="d-flex align-items-center fw-bolder fs-3 d-inline-block"><img src="{{asset('assets/img/icons/logo.png')}}" alt="phoenix" width="58" /></div>
                </a>
                <div class="text-center mb-7">
                <h3 class="text-body-highlight">S'inscrire</h3>
                <p class="text-body-tertiary">Créez votre compte client aujourd'hui</p>
                </div>
                
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="mb-3 text-start">
                        <label class="form-label" for="name">Prenom et nom</label>
                        <input id="name" type="text" placeholder="Prenom et nom" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3 text-start">
                        <label class="form-label" for="email">Address email</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="email@gmail.com" required autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3 text-start">
                        <label class="form-label" for="phone">Numero de  telephone</label>
                        <input id="phone" type="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" placeholder="telephone" required autocomplete="phone">

                        @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3 text-start">
                        <label class="form-label" for="adresse">Adresse de localisation</label>
                        <input id="adresse" type="adresse" class="form-control @error('adresse') is-invalid @enderror" name="adresse" value="{{ old('adresse') }}" placeholder="Votre adresse de localisation" required autocomplete="adresse">

                        @error('adresse')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-sm-6">
                            <label class="form-label" for="password">Mot de passe</label>
                            <input id="password" type="password" placeholder="Password" class="form-icon-input form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label" for="confirmPassword">Confirmation mot de passe</label>
                            <input id="password-confirm" type="password" class="form-icon-input form-control" placeholder="Confirm Password" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input @error('termsService') is-invalid @enderror" id="termsService" name="termsService" value="{{ old('termsService') ?? 1 }}" type="checkbox" required autocomplete="termsService"/>
                        <label class="form-label fs-9 text-transform-none mt-1" for="termsService">
                            J'accepte les <a href="#!">termes </a> et <a href="#!">politique de confidentialité</a>
                        </label>
                        @error('termsService')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button class="btn btn-primary w-100 mb-3" type="submit">S'inscrire</button>
                    <div class="text-center"><a class="fs-9 fw-bold" href="{{ route('login') }}">Se connecter à un compte client existant</a></div>
                </form>
            </div>
        </div>
    </div>
  </section>
@endsection
