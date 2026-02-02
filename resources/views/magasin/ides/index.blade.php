@extends('layouts.app',['title' => 'idees et suggestions'])
@section('headSection')
<script src="{{ asset('assets/js/config.js') }}"></script>
@endsection
@section('main-content')
  
  <div class="content pt-0">
    <div class="email-container">
      <div class="row gx-lg-6 gx-3 py-4 z-2 position-sticky bg-body email-header">
        
        <div class="col-auto flex-1">
          <div class="search-box w-100">
            <h2 class="mb-2 lh-sm">Idées ou suggéstions</h2>
          </div>
        </div>
        <div class="col-auto">
          <a class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"> <span data-feather="plus"></span> Composer</a>
        </div>
      </div>
      <div class="row g-lg-6 mb-8">
        <div class="col-lg">
          <div class="px-lg-1">
            <div class="d-flex align-items-center flex-wrap position-sticky pb-2 bg-body z-2 email-toolbar inbox-toolbar">
              <div class="d-flex align-items-center flex-1 me-2"><button class="btn btn-sm p-0 me-2" type="button" onclick="location.reload()"><span class="text-primary fas fa-redo fs-10"></span></button>
                <p class="fw-semibold fs-10 text-body-tertiary text-opacity-85 mb-0 lh-sm text-nowrap">Last refreshed 1m ago</p>
              </div>
              <div class="d-flex">
                <p class="text-body-tertiary text-opacity-85 fs-9 fw-semibold mb-0 me-3">Showing : <span class="text-body">1-7 </span>of <span class="text-body">205</span></p><button class="btn p-0 me-3" type="button"><span class="text-body-quaternary fa-solid fa-angle-left fs-10"></span></button><button class="btn p-0" type="button"><span class="text-primary fa-solid fa-angle-right fs-10"></span></button>
              </div>
            </div>
            @foreach ($ides as $ide)
              <div class="border-top border-translucent hover-actions-trigger py-3 mt-3">
                <div class="row align-items-sm-center gx-2">
                
                  <div class="col-auto">
                    <span class="text-body-emphasis fw-bold inbox-link fs-9">{{ $ide->sujet }}</span>
                  </div>
                  <div class="col-auto ms-auto @if($ide->status == 1) text-primary @endif">
                    <span class="fs-10 fw-bold">{{ $ide->getDuration() }}</span>
                    <span class="fs-10 fw-bold fas fa-check-double"></span>
                  </div>
                </div>
                <div class="ms-4 mt-n3 mt-sm-0 ms-sm-0">
                  <p class="d-block inbox-link" >
                    <span class="fs-9 ps-0 text-body-tertiary mb-0 line-clamp-2">
                      {{ $ide->msg }}
                    </span>
                  </p>
                  @if ($ide->image != null)
                    <a class="d-inline-flex align-items-center border border-translucent rounded-pill px-3 py-1 me-2 mt-2 inbox-link" href="#!">
                      <span class="fas fa-file-image text-warning fs-9"></span>
                      <span class="ms-2 fw-bold fs-10 text-body">{{ $ide->image }}</span>
                    </a>
                  @endif
                </div>
                @if ($ide->reply != null)
                  <div class="align-items-center border border-translucent px-3 py-1 me-2 mt-3 bg-body-highlight">
                    <h6>Répondu par : {{ $ide->reply_by }}</h6>
                    <span class="fs-9 ps-0 text-body-tertiary mb-0 line-clamp-2">
                      {{ $ide->reply }}
                    </span>
                    </div>
                  </div>
                @endif
            @endforeach
          </div>
        </div>
      </div>
    </div>


     <div class="card-body p-0">
      <div class="p-4 code-to-copy">
        <!-- Right Offcanvas-->
        <div class="offcanvas offcanvas-end w-50" id="offcanvasRight" tabindex="-1" aria-labelledby="offcanvasRightLabel">
          <div class="offcanvas-header">
            <h5 id="offcanvasRightLabel">Idées ou suggéstions</h5><button class="btn-close text-reset" type="button" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">
            <div class="card email-content h-100">
              <div class="card-body h-100">
                <form method="POST" action="{{ route('magasin.ide.store') }}" enctype="multipart/form-data">
                  @csrf
                  <div class="mb-3 text-start">
                    <label class="form-label" for="sujet">Objet de votre soumission</label>
                    <input id="sujet" type="text" placeholder="Objet de votre soumission" class="form-control @error('name') is-invalid @enderror" name="sujet" value="{{ old('sujet') }}" required autocomplete="sujet" autofocus>

                    @error('sujet')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                  <div class="mb-3 text-start">
                    <label class="form-label" for="msg">Entre le message </label>
                    <textarea class="form-control @error('msg') is-invalid @enderror" name="msg" id="msg" rows="10" value="{{ old('msg') }}" required autocomplete="msg" autofocus> </textarea>
                    @error('msg')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>

                  <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex">
                      <label class="btn btn-link py-0 px-2 text-body fs-9" for="emailPhotos">
                        <span class="fa-solid fa-image"></span> ajouter une capture d'ecrant
                      </label>
                      <input class="d-none" name="image" id="emailPhotos" type="file" accept="image/*" />
                    </div>
                    <div class="d-flex">
                      <button class="btn btn-primary fs-10" type="submit">Envoyer
                        <span class="fa-solid fa-paper-plane ms-1"></span>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>




    @include('layouts.footer_admin')
  </div>
@endsection