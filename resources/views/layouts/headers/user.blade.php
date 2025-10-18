
<nav class="navbar navbar-expand-lg sticky-top py-3 loginPageNaveBar" data-navbar-soft-on-scroll="data-navbar-soft-on-scroll">
   <div class="container-small px-0 px-sm-3"><a class="navbar-brand" href="/">
       <div class="d-flex align-items-center">
       {{--<img src="{{asset('assets/img/icons/logo.png')}}" alt="phoenix" width="27" />--}}
        <span class="logo-text" data-feather="shopping-bag" style="height: 25px; width: 25px;"></span>
         <p class="logo-text ms-2">E-Gstore</p>
       </div>
     </a><button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
     <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item border-bottom border-translucent border-bottom-lg-0"><a class="nav-link fs-9 fw-bold pe-3 {{ set_active_roote('utilisateur.document') }}" aria-current="page" href="{{route('utilisateur.document')}}">Comment ça marche</a></li>
          <li class="nav-item border-bottom border-translucent border-bottom-lg-0"><a class="nav-link fs-9 fw-bold pe-3 {{ set_active_roote('utilisateur.conditions') }}" href="{{route('utilisateur.conditions')}}">Conditions</a></li>
          <li class="nav-item border-bottom border-translucent border-bottom-lg-0"><a class="nav-link fs-9 fw-bold pe-3 {{ set_active_roote('utilisateur.privacy') }}" href="{{route('utilisateur.privacy')}}">Confidentialités</a></li>
          {{-- <li class="nav-item"><a class="nav-link fs-9 fw-bold pe-1" href="#">Hirese us </a></li> --}}
          <li class="nav-item d-flex align-items-center">
            <div class="theme-control-toggle fa-icon-wait px-3">
              <input class="form-check-input ms-0 theme-control-toggle-input" type="checkbox" data-theme-control="phoenixTheme" value="dark" id="themeControlToggle" />
              <label class="mb-0 theme-control-toggle-label theme-control-toggle-light" for="themeControlToggle" data-bs-toggle="tooltip" data-bs-placement="left">
                <span class="icon" data-feather="moon"></span>
              </label>
              <label class="mb-0 theme-control-toggle-label theme-control-toggle-dark" for="themeControlToggle" data-bs-toggle="tooltip" data-bs-placement="left">
                <span class="icon" data-feather="sun"></span>
              </label>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="d-grid d-lg-flex align-items-center btn btn-primary" id="navbarDropdownUser" href="#" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false">
            Connexion <span data-feather="chevron-down" class="ml-3"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-end navbar-dropdown-caret py-0 dropdown-profile shadow border mt-2" aria-labelledby="navbarDropdownUser">
              <div class="card position-relative border-0">
                <div class="card-footer p-0 border-top border-translucent">
                  <ul class="nav d-flex flex-column my-3">
                    <li class="nav-item"><a class="nav-link px-3" href="{{ route('magasin.login') }}"> <span class="me-2 text-body" data-feather="user-plus"></span>Compte commerçant</a></li>
                  </ul>
                  <hr />
                  <ul class="nav d-flex flex-column my-3">
                    <li class="nav-item"><a class="nav-link px-3" href="{{ route('agent.login') }}"> <span class="me-2 text-body" data-feather="user-plus"></span>Compte employé </a></li>
                  </ul>
                  <hr>
                  <div class="my-2 text-center fw-bold fs-10 text-body-quaternary"><a class="text-body-quaternary me-1" href="{{route('utilisateur.privacy')}}">Confidentialité</a>&bull;<a class="text-body-quaternary mx-1" href="{{route('utilisateur.conditions')}}">Conditions</a>&bull;<a class="text-body-quaternary ms-1" href="#!">Cookies</a></div>
                </div>
              </div>
            </div>
          </li>
       </ul>
       
     </div>
   </div>
</nav>
               
             