

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
				<div class="avatar avatar-4xl mb-4"><img class="rounded-circle" src="{{asset('assets/img/icons/logo.png')}}" alt="" /></div>
				<h4 class="text-body-highlight mb-3"> <span class="">Reinitialisation de compte de type client</span>  </h4>
				<p class="text-body-tertiary">
					Bonjour <b> cher client  </b>, Vous recevez cet e-mail parce que nous avons reçu une demande de réinitialisation du mot de passe de votre compte.
				</p>
				<a href="{{ $actionUrl }}" class="btn btn-success text-white">Je modifie mon mot de passe</a>
			</div>
			
			</div>
		</div>
		</div>
	</main><!-- ===============================================-->
	<!--    End of Main Content-->
	<!-- ===============================================-->

	@include('layouts.js')
</body>
