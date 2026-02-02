@include('layouts.head')
<body>
     <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
      <div class="container">
        <div class="row flex-center min-vh-100 py-5">
          <div class="col-sm-10 col-md-8 col-lg-5 col-xxl-4"><a class="d-flex flex-center text-decoration-none mb-4" href="../../../index.html">
              <div class="d-flex align-items-center fw-bolder fs-3 d-inline-block"><img src="../../../assets/img/icons/logo.png" alt="phoenix" width="58" /></div>
            </a>
            <div class="px-xxl-5">
              <div class="text-center mb-6">
                <h4 class="text-body-highlight">Saisir le code de vérification</h4>
                <p class="text-body-tertiary mb-0">Un courriel contenant un code de vérification à 6 chiffres a été envoyé à l'adresse électronique - {{$user->email}} </p>
                
                <form class="verification-form" data-2FA-varification="data-2FA-varification" method="post" action="{{ route('client.confirme',[$user->id,$user->confirmation_token]) }}">
                  @csrf
                  {{@method_field('PUT') }}
                  <div class="d-flex align-items-center gap-2 mb-3">
                    <input class="form-control px-2 text-center @error('code') is-invalid @enderror" type="number" name="code_1" value="{{ old('code')}}" required autocomplete="code" />
                    <input class="form-control px-2 text-center @error('code') is-invalid @enderror" type="number" name="code_2" value="{{ old('code')}}" required autocomplete="code" disabled="disabled" />
                    <input class="form-control px-2 text-center @error('code') is-invalid @enderror" type="number" name="code_3" value="{{ old('code')}}" required autocomplete="code" disabled="disabled" />
                    <span>-</span>
                    <input class="form-control px-2 text-center @error('code') is-invalid @enderror" type="number" name="code_4" value="{{ old('code')}}" required autocomplete="code" disabled="disabled" />
                    <input class="form-control px-2 text-center @error('code') is-invalid @enderror" type="number" name="code_5" value="{{ old('code')}}" required autocomplete="code" disabled="disabled" />
                    <input class="form-control px-2 text-center @error('code') is-invalid @enderror" type="number" name="code_6" value="{{ old('code')}}" required autocomplete="code" disabled="disabled" />
                  </div>
                  @error('code')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                  <Button class="btn btn-primary w-100 mb-5" type="submit">Enregistre le code</Button><a class="fs-9" href="#!">Didn’t receive the code? </a>
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