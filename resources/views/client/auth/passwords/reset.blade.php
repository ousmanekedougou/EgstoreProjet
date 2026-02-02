

@include('layouts.head')
<body>
     <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
      <div class="container">
        <div class="row flex-center min-vh-100 py-5">
          <div class="col-sm-10 col-md-8 col-lg-5 col-xxl-4"><a class="d-flex flex-center text-decoration-none mb-4" href="{{ route('login') }}">
              <div class="d-flex align-items-center fw-bolder fs-3 d-inline-block"><img src="../../../assets/img/icons/logo.png" alt="phoenix" width="58" /></div>
            </a>
            <div class="px-xxl-5">
              <div class=" mb-6">
                <h4 class="text-body-highlight text-center">Réinitialiser le nouveau mot de passe</h4>
                <p class="text-body-tertiary text-center">Tapez votre nouveau mot de passe pour l'email {{ $email }}</p>
                <form action="{{ route('password.update') }}" method="POST" class="d-block align-items-center mb-5">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <input type="hidden" name="email" value="{{ $email }}">
                    {{--
                    <input id="email" type="email" placeholder="Email" class="form-control mb-3 @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    --}}
                    <label class="form-label text-left" for="password">Mot de passe</label>
                    <input id="password" type="password" placeholder="Mot de passe" class="form-icon-input form-control mb-3 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <label class="form-label" for="confirmPassword">Confirmation mot de passe</label>
                    <input id="password-confirm" type="password" class="form-icon-input form-control mb-3" placeholder="Confirmation mot de passe" name="password_confirmation" required autocomplete="new-password">
                    
                    <div class="text-center">
                        <button class="btn btn-primary">Définir le mot de passe<span class="fas fa-chevron-right ms-2"></span></button>
                    </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main><!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->
    @include('layouts.js')
</body>