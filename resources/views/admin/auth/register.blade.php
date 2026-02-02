
@include('layouts.head')
<body>
   <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
      <div class="container">
        <div class="row flex-center min-vh-100 py-5">
          <div class="col-sm-10 col-md-8 col-lg-5 col-xl-5 col-xxl-3"><a class="d-flex flex-center text-decoration-none mb-4" href="/">
              <div class="d-flex align-items-center fw-bolder fs-3 d-inline-block"><img src="{{asset('assets/img/icons/logo.png')}}" alt="phoenix" width="58" /></div>
            </a>
            <div class="text-center mb-7">
              <h3 class="text-body-highlight">S'inscrire</h3>
              <p class="text-body-tertiary">Créez votre compte aujourd'hui</p>
            </div><button class="btn btn-phoenix-secondary w-100 mb-3"><span class="fab fa-google text-danger me-2 fs-9"></span>Sign up with google</button><button class="btn btn-phoenix-secondary w-100"><span class="fab fa-facebook text-primary me-2 fs-9"></span>Sign up with facebook</button>
            <div class="position-relative mt-4">
              <hr class="bg-body-secondary" />
              <div class="divider-content-center">ou utiliser l'email</div>
            </div>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="mb-3 text-start">
                    <label class="form-label" for="name">Name</label>
                    <input id="name" type="text" placeholder="Name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3 text-start">
                    <label class="form-label" for="email">Email address</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="email@gmail.com" required autocomplete="email">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3 text-start">
                    <label class="form-label" for="phone">Phone number</label>
                    <input id="phone" type="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" placeholder="telephone" required autocomplete="phone">

                    @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="row g-3 mb-3">
                    <div class="col-sm-6">
                        <label class="form-label" for="password">Password</label>
                        <input id="password" type="password" placeholder="Password" class="form-icon-input form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label" for="confirmPassword">Confirm Password</label>
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
                <div class="text-center"><a class="fs-9 fw-bold" href="{{ route('login') }}">Se connecter à un compte existant</a></div>
            </form>
          </div>
        </div>
      </div>
    </main><!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->
    @include('layouts.js')
</body>
