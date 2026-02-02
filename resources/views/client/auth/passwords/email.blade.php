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
              <div class="text-center mb-6">
                <h4 class="text-body-highlight">Vous avez oublié votre mot de passe ?</h4>
                <p class="text-body-tertiary mb-5">Saisissez votre e-mail ci-dessous et nous vous enverrons <br class="d-sm-none" />un lien de réinitialisation</p>
                <form action="{{route('password.email')}}" method="POST" class="d-flex align-items-center mb-5">
                    @csrf
                    <input id="email" type="email" placeholder="Email" class="form-control flex-1 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <button class="btn btn-primary ms-2">Envoyer<span class="fas fa-chevron-right ms-2"></span></button>
                </form><a class="fs-9 fw-bold" href="#!">Toujours des problèmes ?</a>
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