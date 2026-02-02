@extends('layouts.app',['title' => 'agent-prifile'])

@section('main-content')
  <div class="content">
    <div class="row align-items-center justify-content-between g-3 mb-4">
      <div class="col-auto">
        <h2 class="mb-0">Profile</h2>
      </div>
      {{--
      <div class="col-auto">
        <div class="row g-2 g-sm-3">
          <div class="col-auto"><button class="btn btn-phoenix-danger"><span class="fas fa-trash-alt me-2"></span>Delete customer</button></div>
          <div class="col-auto"><button class="btn btn-phoenix-secondary"><span class="fas fa-key me-2"></span>Reset password</button></div>
        </div>
      </div>
      --}}
    </div>
    <div class="row g-3 mb-6">
      <div class="col-12 col-lg-8">
        <div class="card h-100">
          <div class="card-body">
            <div class="border-bottom border-dashed pb-4">
              <div class="row align-items-center g-3 g-sm-5 text-center text-sm-start">

                <div class="col-12 col-sm-auto">
                  <input id="image" type="file" class="form-control d-none @error('image') is-invalid @enderror" name="image" value="{{ old('image') }}" required autocomplete="image">
                    @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  <label class="cursor-pointer avatar avatar-5xl" for="image">
                    <img class="rounded-circle" src="@if(Auth::guard('agent')->user()->image == '') https://ui-avatars.com/api/?name={{Auth::guard('agent')->user()->name}} @else {{(Storage::url(Auth::guard('agent')->user()->image))}} @endif" alt="" />
                  </label>
                </div>
                <div class="col-12 col-sm-auto flex-1">
                  <h3>{{Auth::guard('agent')->user()->name}}</h3>
                  <p class="text-body-secondary">Joined 3 months ago</p>
                  <div><a class="me-2" href="#!"><span class="fab fa-linkedin-in text-body-quaternary text-opacity-75 text-primary-hover"></span></a><a class="me-2" href="#!"><span class="fab fa-facebook text-body-quaternary text-opacity-75 text-primary-hover"></span></a><a href="#!"><span class="fab fa-twitter text-body-quaternary text-opacity-75 text-primary-hover"></span></a></div>
                </div>
                <div class="col-12 col-sm-auto">
                  <input id="logo" type="file" class="form-control d-none @error('logo') is-invalid @enderror" name="logo" value="{{ old('logo') }}" required autocomplete="logo">
                    @error('logo')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  <label class="cursor-pointer avatar avatar-4xl" for="logo">
                    <img class="rounded-circle" src="@if(Auth::guard('agent')->user()->magasin->logo == '') https://ui-avatars.com/api/?name={{Auth::guard('agent')->user()->magasin->name}} @else {{(Storage::url(Auth::guard('agent')->user()->magasin->logo))}} @endif" alt="" />
                    <h6 class="text-center text-bold mt-2">Votre logo</h6>
                  </label>
                </div>
              </div>
            </div>
            <div class="d-flex flex-between-center pt-4">
              <div>
                <h6 class="mb-2 text-body-secondary">Total agents</h6>
                <h4 class="fs-7 text-body-highlight mb-0 text-center">{{Auth::guard('agent')->user()->magasin->agents->count()}}</h4>
              </div>
              <div class="text-end">
                <h6 class="mb-2 text-body-secondary">Total clients abonnés</h6>
                <h4 class="fs-7 text-body-highlight mb-0 text-center">{{Auth::guard('agent')->user()->magasin->users->count()}}</h4>
              </div>
              <div class="text-end">
                <h6 class="mb-2 text-body-secondary">Total clients enrégistrés</h6>
                <h4 class="fs-7 text-body-highlight mb-0 text-center">{{Auth::guard('agent')->user()->magasin->clients->count()}}</h4>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-lg-4">
        <div class="card h-100">
          <div class="card-body">
            <div class="border-bottom border-dashed">
              <h4 class="mb-3">Adresse par défaut<button class="btn btn-link p-0" type="button"> <span class="fas fa-edit fs-9 ms-3 text-body-quaternary"></span></button></h4>
            </div>
            <div class="pt-4 mb-7 mb-lg-4 mb-xl-7">
              <div class="row justify-content-between">
                <div class="col-auto">
                  <h5 class="text-body-highlight">Address</h5>
                </div>
                <div class="col-auto">
                  <p class="text-body-secondary">{{Auth::guard('agent')->user()->magasin->adresse}}</p>
                </div>
              </div>
            </div>
            <div class="border-top border-dashed pt-4">
              <div class="row flex-between-center mb-2">
                <div class="col-auto">
                  <h5 class="text-body-highlight mb-0">Email</h5>
                </div>
                <div class="col-auto"><a class="lh-1" href="mailto:{{Auth::guard('agent')->user()->email}}">{{Auth::guard('agent')->user()->email}}</a></div>
              </div>
              <div class="row flex-between-center">
                <div class="col-auto">
                  <h5 class="text-body-highlight mb-0">Telephone</h5>
                </div>
                <div class="col-auto"><a href="tel:{{Auth::guard('agent')->user()->phone}}">{{Auth::guard('agent')->user()->phone}}</a></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div>
      <div class="scrollbar">
        <ul class="nav nav-underline fs-9 flex-nowrap mb-3 pb-1" id="myTab" role="tablist">
           <li class="nav-item"><a class="nav-link text-nowrap active" id="personal-info-tab" data-bs-toggle="tab" href="#tab-personal-info" role="tab" aria-controls="tab-personal-info" aria-selected="true"><span data-father="user" class="me-2"></span>Informations Personnelles</a></li>
        </ul>
      </div>
      <div class="tab-content" id="profileTabContent">
        <div class="tab-pane fade show active" id="tab-personal-info" role="tabpanel" aria-labelledby="personal-info-tab">
          <form method="POST" action="{{ route('agent.profile.update',0) }}">
            @csrf
            @method('PUT')
            <div class="row g-3 mb-5">
              <div class="col-12 col-lg-6">
                <label class="form-label text-body-highlight fs-8 ps-0 text-lowercase lh-sm" for="admin_name">Votre Prenom et nom</label>
                <input id="name" type="text" placeholder="Votre Prenom et nom" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? Auth::guard('agent')->user()->name }}" required autocomplete="name" autofocus>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              <div class="col-12 col-lg-6">
                <label class="form-label text-body-highlight fs-8 ps-0 text-lowercase lh-sm" for="email">adresse Email</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') ?? Auth::guard('agent')->user()->email }}" placeholder="email@gmail.com" required autocomplete="email">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              <div class="col-12 col-lg-4">
                <label class="form-label text-body-highlight fw-bold fs-8 ps-0 text-lowercase lh-sm" for="phone">telePhone</label>
                <input id="phone" type="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') ?? Auth::guard('agent')->user()->phone }}" placeholder="Votre numero de telephone" required autocomplete="phone">

                @error('phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              
              <div class="col-12 col-lg-4">
                <label class="form-label text-body-highlight fw-bold fs-8 ps-0 text-lowercase lh-sm" for="password">modifier votre Mot de passe</label>
                <input id="password" type="password" placeholder="Votre mot de passe" class="form-icon-input form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">   
                @error('password')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              <div class="col-12 col-lg-4">
                <label class="form-label text-body-highlight fw-bold fs-8 ps-0 text-lowercase lh-sm" for="confirmPassword">Confirmer le mot de passe</label>
                <input id="password-confirm" type="password" class="form-icon-input form-control" placeholder="Confirmer votre mot de passe" name="password_confirmation" required autocomplete="new-password">
              </div>
            </div>
            <div class="text-end">
              <button type="submit" class="btn btn-primary px-7">Enregistre les modifications</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection