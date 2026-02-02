
<li class="nav-item dropdown"><a class="nav-link px-2 btn btn-outline-success me-1 mb-1" id="navbarDropdownUser" href="#" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false"><span data-feather="user-plus" class="me-2" data-fa-transform="shrink-3"></span>Creer votre compte</a>
    <div class="dropdown-menu dropdown-menu-end navbar-dropdown-caret py-0 dropdown-profile shadow border mt-2" aria-labelledby="navbarDropdownUser">
        <div class="card position-relative border-0">
            <div class="card-body p-0">
                <div class="text-center pt-4 pb-3">
                    <div class="d-flex mx-8">
                        <img class="text-center" src="{{asset('assets/img/icons/logo.png')}}" alt="phoenix" width="27" />
                        <p class="logo-text ms-2">phoenix</p>
                    </div>
                </div>
            <div class="card-footer p-0 border-top border-translucent">
                <ul class="nav d-flex flex-column my-3">
                    <li class="nav-item"><a class="nav-link px-3" href="#!"> <span class="me-2 text-body" data-feather="user-plus"></span>Creer un compte commerçant</a></li>
                </ul>
                <hr />
                <ul class="nav d-flex flex-column my-3">
                    <li class="nav-item"><a class="nav-link px-3" href="{{ route('register') }}"> <span class="me-2 text-body" data-feather="user-plus"></span>Creer un compte client</a></li>
                </ul>
                <hr />
                <div class="px-3"> <a class="btn btn-phoenix-secondary d-flex flex-center w-100" href="{{ route('login') }}"> <span class="me-2" data-feather="log-in"> </span>Se connecter</a></div>
                <div class="my-2 text-center fw-bold fs-10 text-body-quaternary"><a class="text-body-quaternary me-1" href="#!">Privacy policy</a>&bull;<a class="text-body-quaternary mx-1" href="#!">Terms</a>&bull;<a class="text-body-quaternary ms-1" href="#!">Cookies</a></div>
            </div>
        </div>
    </div>
</li>