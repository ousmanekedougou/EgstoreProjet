
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
				<h2 class="text-body-highlight"> <span class="fw-normal">Reinitialisation de compte de </span>{{ $type }} </h2>
				<p class="text-body-tertiary">
					Bonjour <b> @if($type == 'Boutique'){{$notifiable->admin_name}} @else {{$notifiable->name}} @endif </b>, Vous recevez cet e-mail parce que nous avons reçu une demande de réinitialisation du mot de passe de votre compte.
				</p>
				<a href="{{ $url }}" class="btn btn-success">Je modifie mon mot de passe de {{ $type }}</a>
			</div>
			
			</div>
		</div>
		</div>
	</main><!-- ===============================================-->
	<!--    End of Main Content-->
	<!-- ===============================================-->

	@include('layouts.js')
</body>