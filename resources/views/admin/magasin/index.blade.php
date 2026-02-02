@extends('layouts.app',['title' => 'admin-magasin'])

@section('main-content')
  <div class="content">
    <nav class="mb-2" aria-label="breadcrumb">
      <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="#!">Page 1</a></li>
        <li class="breadcrumb-item"><a href="#!">Page 2</a></li>
        <li class="breadcrumb-item active">Default</li>
      </ol>
    </nav>

    <div class="mb-9">
      <div class="row g-2 mb-4">
        <div class="col-auto">
          <h2 class="mb-0">Les boutiques  </h2>
        </div>
      </div>
      <ul class="nav nav-links mb-3 mb-lg-2 mx-n3">
        <li class="nav-item"><a class="nav-link active" aria-current="page" href="#"><span>All </span><span class="text-body-tertiary fw-semibold">(68817)</span></a></li>
        <li class="nav-item"><a class="nav-link" href="#"><span>New </span><span class="text-body-tertiary fw-semibold">(6)</span></a></li>
        <li class="nav-item"><a class="nav-link" href="#"><span>Abandoned checkouts </span><span class="text-body-tertiary fw-semibold">(17)</span></a></li>
        <li class="nav-item"><a class="nav-link" href="#"><span>Locals </span><span class="text-body-tertiary fw-semibold">(6,810)</span></a></li>
        <li class="nav-item"><a class="nav-link" href="#"><span>Email subscribers </span><span class="text-body-tertiary fw-semibold">(8)</span></a></li>
        <li class="nav-item"><a class="nav-link" href="#"><span>Top reviews </span><span class="text-body-tertiary fw-semibold">(2)</span></a></li>
      </ul>
      <div id="products" data-list='{"valueNames":["customer","email","total-orders","total-spent","city","last-seen","last-order"],"page":10,"pagination":true}'>
        <div class="mb-4">
          <div class="row g-3">
            <div class="col-auto">
              <div class="search-box">
                <form class="position-relative"><input class="form-control search-input search" type="search" placeholder="Search customers" aria-label="Search" />
                  <span class="fas fa-search search-box-icon"></span>
                </form>
              </div>
            </div>
            <div class="col-auto scrollbar overflow-hidden-y flex-grow-1">
              <div class="btn-group position-static" role="group">
                <div class="btn-group position-static text-nowrap"><button class="btn btn-phoenix-secondary px-7 flex-shrink-0" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"> Country<span class="fas fa-angle-down ms-2"></span></button>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">US</a></li>
                    <li><a class="dropdown-item" href="#">Uk</a></li>
                    <li><a class="dropdown-item" href="#">Australia</a></li>
                  </ul>
                </div>
                <div class="btn-group position-static text-nowrap"><button class="btn btn-sm btn-phoenix-secondary px-7 flex-shrink-0" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"> VIP<span class="fas fa-angle-down ms-2"></span></button>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">VIP 1</a></li>
                    <li><a class="dropdown-item" href="#">VIP 2</a></li>
                    <li><a class="dropdown-item" href="#">VIP 3</a></li>
                    <li></li>
                  </ul>
                </div><button class="btn btn-phoenix-secondary px-7 flex-shrink-0">More filters</button>
              </div>
            </div>
            <div class="col-auto">
                <button class="btn btn-link text-body me-4 px-0">
                  <span class="fa-solid fa-file-export fs-9 me-2"></span>Export
                </button>
                
                <button type="button" class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                  <span data-feather="plus" class="me-2"></span>Ajouter une boutique
              </button>
            </div>
          </div>
        </div>
        <div class="mx-n4 px-4 mx-lg-n6 px-lg-6 bg-body-emphasis border-top border-bottom border-translucent position-relative top-1">
          <div class="table-responsive scrollbar-overlay mx-n1 px-1">
            <table class="table table-sm fs-9 mb-0">
              <thead>
                <tr>
                  <th class="sort align-middle pe-5" scope="col" data-sort="customer" style="width:10%;">MAGASIN</th>
                  <th class="sort align-middle pe-5" scope="col" data-sort="email" style="width:20%;">MAGASINIERS</th>
                  <th class="sort align-middle pe-5" scope="col" data-sort="email" style="width:20%;">EMAIL</th>
                  <th class="sort align-middle pe-5" scope="col" data-sort="email" style="width:20%;">TELEPHONES</th>
                  <th class="sort align-middle text-end" scope="col" data-sort="total-orders" style="width:10%">COMPTES</th>
                  <th class="sort align-middle text-end pe-0" scope="col" data-sort="last-order" style="width:10%;min-width: 150px;">ACTIONS</th>
                </tr>
              </thead>
              <tbody class="list" id="customers-table-body">
                @foreach($magasins as $magasin)
                <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                  <td class="customer align-middle white-space-nowrap pe-5"><a class="d-flex align-items-center text-body-emphasis" href="customer-details.html">
                      <div class="avatar avatar-m">
                        <img class="rounded-circle" src="@if($magasin->logo == '') https://ui-avatars.com/api/?name={{$magasin->name}} @else {{(Storage::url($magasin->logo))}} @endif" alt="" />
                      </div>
                      <p class="mb-0 ms-3 text-body-emphasis fw-bold">{{ $magasin->name }}</p>
                    </a>
                  </td>
                  <td class="email align-middle white-space-nowrap pe-5">{{ $magasin->admin_name }}</td>
                  <td class="email align-middle white-space-nowrap pe-5"><a class="fw-semibold" href="mailto:{{ $magasin->email }}">{{ $magasin->email }}</a></td>
                  <td class="total-spent align-middle white-space-nowrap fw-bold  ps-3 text-body-emphasis"> {{ $magasin->phone }} </td>
                  <td class="total-spent align-middle white-space-nowrap fw-bold ps-3 text-center text-body-emphasis"> @if($magasin->is_active == 1) <span class="badge badge-phoenix badge-phoenix-success">Actif</span> @else <span class="badge badge-phoenix badge-phoenix-warning">Desactive</span> @endif  </td>
                  <td class="last-order align-middle white-space-nowrap text-body-tertiary text-end">
                    <span class="me-2 text-success" data-bs-toggle="modal" data-bs-target="#StatusCompte-{{ $magasin->id }}" data-feather="edit-3" data-fa-transform="shrink-3"></span>
                    <span class="me-2 text-danger" data-bs-toggle="modal" data-bs-target="#DeleteCompte-{{ $magasin->id }}" data-feather="trash-2" data-fa-transform="shrink-3"></span>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          {{ $magasins->links('vendor.pagination.bootstrap-5') }}
        </div>
      </div>
    </div>


    <div class="card-body p-0">
      <div class="p-4 code-to-copy">
        <!-- Right Offcanvas-->
        <div class="offcanvas offcanvas-end" id="offcanvasRight" tabindex="-1" aria-labelledby="offcanvasRightLabel">
          <div class="offcanvas-header">
            <h5 id="offcanvasRightLabel">Ajouter une boutique</h5><button class="btn-close text-reset" type="button" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">
            <p>
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda expedita minima et voluptatibus veritatis magni labore quis consectetur perferendis non, odio illum quo obcaecati. Earum modi praesentium consectetur maxime iure.
            </p>
          </div>
        </div>
      </div>
    </div>

    @foreach($magasins as $magasin)
    <div class="modal fade" id="StatusCompte-{{ $magasin->id }}" tabindex="-1" style="display: none;" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Activation & desactivation de compte magasin</h5><button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close"><svg class="svg-inline--fa fa-xmark fs-9" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="xmark" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path fill="currentColor" d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z"></path></svg><!-- <span class="fas fa-times fs-9"></span> Font Awesome fontawesome.com --></button>
          </div>
          <form action="{{ route('admin.magasin.update',$magasin->id) }}" method="post">
            @csrf
            {{ method_field('PUT') }}
            <div class="modal-body">
              <p class="text-body-tertiary lh-lg mb-3"> Etes vous sure de bien vouloire bodifier le status du compte de {{$magasin->admin_name}} </p>
              <div class="form-check form-check-inline">
                <input class="form-check-input text-success @error('is_active') is-invalid @enderror" @if($magasin->is_active == 1) checked="" @endif id="inlineRadioA-{{ $magasin->id }}" type="radio" name="is_active" value=" 1 ">
                <label class="form-check-label text-success" for="inlineRadioA-{{ $magasin->id }}">Actif</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input text-warning @error('is_active') is-invalid @enderror" @if($magasin->is_active == 0) checked="" @endif id="inlineRadioB-{{ $magasin->id }}" type="radio" name="is_active" value=" 0 ">
                <label class="form-check-label text-warning" for="inlineRadioB-{{ $magasin->id }}">Desactiver</label>
              </div>
              @error('is_active')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
            <div class="modal-footer">
              <button class="btn btn-primary" type="submit">Oui je veux bien</button>
              <button class="btn btn-outline-primary" type="button" data-bs-dismiss="modal">Anuller</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    @endforeach

    @foreach($magasins as $magasin)
    <div class="modal fade" id="DeleteCompte-{{ $magasin->id }}" tabindex="-1" style="display: none;" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title text-danger" id="exampleModalLabel">Suppresion de compte magasin</h5><button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close"><svg class="svg-inline--fa fa-xmark fs-9" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="xmark" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path fill="currentColor" d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z"></path></svg><!-- <span class="fas fa-times fs-9"></span> Font Awesome fontawesome.com --></button>
          </div>
          <form action="{{ route('admin.magasin.destroy',$magasin->id) }}" method="post">
            @csrf
            {{ method_field('DELETE') }}
            <div class="modal-body">
              <p class="text-body-tertiary lh-lg mb-3"> Etes vous sure de bien vouloire supprimer le compte de {{$magasin->admin_name}} </p>
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