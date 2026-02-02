@include('layouts.head',['title' => 'magasin-connexion'])
<body>
     <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
      <div class="container">
        <div class="row flex-center min-vh-100 py-5">
          <div class="col-sm-10 col-md-8 col-lg-5 col-xl-5 col-xxl-3">
            
            <div class="text-center mb-5">
              <div class="avatar avatar-4xl mb-4"><img class="rounded-circle" src="../../../assets/img/team/30.webp" alt="" /></div>
              <h2 class="text-body-highlight"> <span class="fw-normal">Bonjour </span>{{$notifiable->name}}</h2>
              <p class="text-body-tertiary">
                Votre compte {{ $type }} a bien ete creer et nous vous remercion de votre confiance. <br>
                Veillez entre ce code de validation pour activer votre compte {{$type}} <b>{{ $code }}</b>
              </p>
            </div>
            
          </div>
        </div>
      </div>
    </main><!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->
    @include('layouts.js')
</body>