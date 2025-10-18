@extends('layouts.app',['title' => 'Unités de gestion'])

@section('main-content')
  <div class="content">

    <div class="mb-9">
      <div class="row g-2 mb-4">
        <div class="col-auto">
          <h2 class="mb-0">Vos unités de gestion </h2>
        </div>
      </div>
      <div id="products" data-list='{"valueNames":["customer","email","total-orders","total-spent","city","last-seen","last-order"]}'>
        <div class="mb-4">
          <div class="row g-3">
            <div class="search-box" style="width: 70%;">
              <form class="position-relative"><input class="form-control search-input search" type="search" placeholder="Rechercher une unité" aria-label="Search" />
                <span class="fas fa-search search-box-icon"></span>
              </form>
            </div>
            <div class="col-auto ms-auto">
                <button type="button" class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                  <span class="me-2" data-feather="plus"></span>Ajouter une unité
              </button>
            </div>
          </div>
        </div>
        <div class="mx-n4 px-4 mx-lg-n6 px-lg-6 bg-body-emphasis border-top border-bottom border-translucent position-relative top-1">
          <div class="table-responsive scrollbar-overlay mx-n1 px-1">
            <table class="table table-sm fs-9 mb-0">
              <thead>
                <tr>
                  <th class="sort align-middle pe-5" scope="col" data-sort="customer" style="width:10%;">Unités</th>
                  <th class="sort align-middle text-center" scope="col" data-sort="total-orders" style="width:10%">Code</th>
                  <th class="sort align-middle text-end" scope="col" data-sort="total-orders" style="width:10%">Visibilite</th>
                  <th class="sort align-middle text-end ps-3" scope="col" data-sort="total-spent" style="width:10%">ACTIONS</th>
                </tr>
              </thead>
              <tbody class="list" id="customers-table-body">
                @foreach($unites as $unite)
                <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                  <td class="customer align-middle white-space-nowrap pe-5">
                    <a class="d-flex align-items-center text-body-emphasis" href="#">
                      <p class="mb-0 ms-3 text-body-emphasis fw-bold">{{ $unite->name }}</p>
                    </a>
                  </td>
                  <td class="total-spent align-middle white-space-nowrap fw-bold text-center ps-3 text-body-emphasis">
                    <span class="badge badge-phoenix badge-phoenix-success">{{ $unite->code }}</span>
                  </td>
                  <td class="total-spent align-middle white-space-nowrap fw-bold text-end ps-3 text-body-emphasis">
                    @if($unite->visible == 1) <span class="badge badge-phoenix badge-phoenix-success">Visible</span> @else <span class="badge badge-phoenix badge-phoenix-warning">Cacher</span> @endif
                  </td>
                  <td class="last-order align-middle white-space-nowrap text-body-tertiary text-end">
                    <span class="me-3 text-success fs-7" data-feather="edit-3" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight-{{ $unite->id }}" aria-controls="offcanvasRight-{{ $unite->id }}" data-fa-transform="shrink-3"></span>
                    <span class="me-2 text-danger fs-7" data-feather="trash-2" data-bs-toggle="modal" data-bs-target="#DeleteCompte-{{ $unite->id }}" data-fa-transform="shrink-3"></span>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>


    <div class="card-body p-0">
      <div class="p-4 code-to-copy">
        <!-- Right Offcanvas-->
        <div class="offcanvas offcanvas-end" id="offcanvasRight" tabindex="-1" aria-labelledby="offcanvasRightLabel">
          <div class="offcanvas-header">
            <h5 id="offcanvasRightLabel">Ajouter une unité</h5><button class="btn-close text-reset" type="button" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">
            <form method="POST" action="{{ route('magasin.unite.store') }}">
              @csrf
              <div class="mb-3 text-start">
                  <label class="form-label" for="name">Nom de la unité</label>
                  <input id="name" type="text" placeholder="Nom de la unité" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                  @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>

              <div class="mb-3 text-start">
                  <label class="form-label" for="code">Code de l'unité</label>
                  <input id="code" type="text" placeholder="Code de l'unité (Kg,Cm,L)" class="form-control @error('code') is-invalid @enderror" name="code" value="{{ old('code') }}" required autocomplete="code" autofocus>

                  @error('code')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>
              
              <div class="mb-3 text-start">
                <label class="form-label" for="email">Status de l'unité</label> <br>
                <div class="form-check form-check-inline">
                  <input class="form-check-input text-success @error('visible') is-invalid @enderror"  id="inlineRadio1" type="radio" name="visible" value=" 1 ">
                  <label class="form-check-label text-success" for="inlineRadio1">Visible</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input text-warning @error('visible') is-invalid @enderror"  id="inlineRadio2" type="radio" name="visible" value=" 0 ">
                  <label class="form-check-label text-warning" for="inlineRadio2">Cacher</label>
                </div>
                @error('visible')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              <button class="btn btn-primary w-100 mb-3" type="submit">Enreistrer cette unité</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    @foreach($unites as $unite)
    <div class="card-body p-0">
      <div class="p-4 code-to-copy">
        <!-- Right Offcanvas-->
        <div class="offcanvas offcanvas-end" id="offcanvasRight-{{ $unite->id }}" tabindex="-1" aria-labelledby="offcanvasRightLabel">
          <div class="offcanvas-header">
            <h5 id="offcanvasRightLabel">Modifier cette unité {{ $unite->name }}</h5><button class="btn-close text-reset" type="button" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">
            <form method="POST" action="{{ route('magasin.unite.update',$unite->id) }}">
            @csrf
            {{ method_field('PUT') }}
              <div class="mb-3 text-start">
                  <label class="form-label" for="name">Nom de votre unité</label>
                  <input id="name" type="text"  class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $unite->name }}" required autocomplete="name" autofocus>

                  @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>

               <div class="mb-3 text-start">
                  <label class="form-label" for="code">Code de votre unité</label>
                  <input id="code" type="text"  class="form-control @error('code') is-invalid @enderror" name="code" value="{{ old('code') ?? $unite->code }}" required autocomplete="code" autofocus>

                  @error('code')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>


              <div class="mb-3 text-start">
                <label class="form-label" for="email">Status de votre unité</label> <br>
                <div class="form-check form-check-inline">
                  <input class="form-check-input text-success @error('visible') is-invalid @enderror" @if($unite->visible == 1) checked="" @endif id="inlineRadioA-{{ $unite->id }}" type="radio" name="visible" value=" 1 ">
                  <label class="form-check-label text-success" for="inlineRadioA-{{ $unite->id }}">Visible</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input text-warning @error('visible') is-invalid @enderror" @if($unite->visible == 0) checked="" @endif id="inlineRadioB-{{ $unite->id }}" type="radio" name="visible" value=" 0 ">
                  <label class="form-check-label text-warning" for="inlineRadioB-{{ $unite->id }}">Cacher</label>
                </div>
                @error('visible')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              <button class="btn btn-primary w-100 mb-3" type="submit">Enreistrer cette unité</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    @endforeach

    @foreach($unites as $unite)
      <div class="modal fade" id="DeleteCompte-{{ $unite->id }}" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title text-danger" id="exampleModalLabel">Suppresion de cette unité</h5><button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close"><svg class="svg-inline--fa fa-xmark fs-9" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="xmark" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path fill="currentColor" d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z"></path></svg><!-- <span class="fas fa-times fs-9"></span> Font Awesome fontawesome.com --></button>
            </div>
            <form action="{{ route('magasin.unite.destroy',$unite->id) }}" method="post">
              @csrf
              {{ method_field('DELETE') }}
              <div class="modal-body">
                <p class="text-body-tertiary lh-lg mb-3"> Etes vous sure de bien vouloire supprimer l'unité {{$unite->name}} </p>
              </div>
              <div class="modal-footer">
                <button class="btn btn-danger" type="submit">Oui je veux bien</button>
                <button class="btn btn-outline-primary" type="button" data-bs-dismiss="modal">Anuller</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    @endforeach


    @include('layouts.footer_admin')

  </div>
@endsection