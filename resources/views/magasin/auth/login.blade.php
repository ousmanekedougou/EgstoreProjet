
@extends('layouts.app',['title' => 'Connexion commerçant'])

@section('main-content')
  <section class="py-0" style="margin-bottom: -6rem;">
    <div class="bg-holder" style="background-image:url(../assets/img/bg/bg-24.png);background-position:center;background-size:auto;"></div>
    <!--/.bg-holder-->
    <div class="container-lg position-relative mt-9">
      <div class="row flex-center">
        <div class="col-sm-10 col-md-8 col-lg-5 col-xl-5 px-xxl-3 text-center">
          <a class="d-flex flex-center text-decoration-none mb-4" href="/">
            <div class="d-flex align-items-center fw-bolder fs-3 d-inline-block">
              <img src="{{asset('assets/img/icons/logo.png')}}" alt="phoenix" width="58" />
            </div>
          </a>
          <div class="text-center mb-4">
            <h3 class="text-body-highlight">Se connecter</h3>
            <p class="text-body-tertiary">Accéder à votre compte commerçant</p>
          </div>
          <form method="POST" action="{{ route('magasin.login') }}">
            @csrf
            <div class="mb-3 text-start"><label class="form-label" for="email">Adresse email</label>
              <div class="form-icon-container">
                <input id="email" class="form-icon-input form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus type="email" placeholder="name@example.com" />
                <span class="fas fa-user text-body fs-9 form-icon"></span>
                  @error('email')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>
            </div>
            <div class="mb-3 text-start"><label class="form-label" for="password">Mot de passe</label>
              <div class="form-icon-container">
                <input  id="password" type="password" class="form-icon-input form-control @error('password') is-invalid @enderror" placeholder="votre mot de passe" name="password" required autocomplete="current-password" />
                <span class="fas fa-key text-body fs-9 form-icon"></span>
                  @error('password')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>
            </div>
            <div class="row flex-between-center mb-3">
              <div class="col-auto">
                <div class="form-check mb-0">
                  <input class="form-check-input" id="basic-checkbox" type="checkbox" />
                  <label class="form-check-label mb-0" for="basic-checkbox">Souvenez-vous de moi</label>
                </div>
              </div>
              <div class="col-auto"><a class="fs-9 fw-semibold" href="{{ route('magasin.reset') }}">Mot de passe oublié ?</a></div>
            </div>
            <button class="btn btn-primary w-100 mb-3">Se connecter</button>
          </form>
          <div class="text-center"><a class="fs-9 fw-bold" href="{{ route('magasin.register') }}">Créer votre compte commerçant</a></div>
        </div>
      </div>
    </div>
  </section>
@endsection

