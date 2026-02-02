@extends('layouts.app',['title' => 'Mes  fournisseurs'])
@section('main-content')
  <div class="content">
    <div class="mb-9">
      <div class="row g-2 mb-4">
        <div class="col-auto">
          <h2 class="mb-0">Mes fournisseurs</h2>
        </div>
      </div>
      <div id="products" data-list='{"valueNames":["customer","email","total-orders","total-spent","city","last-seen","last-order"],"page":10,"pagination":true}'>
        <div class="mb-4">
          <div class="row g-3">
            <div class="col-auto">
              <div class="search-box">
                <form class="position-relative">
                  <input class="form-control search-input search" type="search" placeholder="Rechercher un fournisseur" aria-label="Search" />
                  <span class="fas fa-search search-box-icon"></span>
                </form>
              </div>
            </div>
            <div class="col-auto ms-auto">
              <button class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><span class="me-1" data-feather="plus"></span>Ajouter un fournisseur</button>
            </div>
          </div>
        </div>
        <div class="mx-n4 px-4 mx-lg-n6 px-lg-6 bg-body-emphasis border-top border-bottom border-translucent position-relative top-1">
          <div class="table-responsive scrollbar-overlay mx-n1 px-1">
            <table class="table table-sm fs-9 mb-0">
              <thead>
                <tr>
                  <th class="sort align-middle pe-5" scope="col" data-sort="customer" style="width:10%;">FOURNISSEURS</th>
                  <th class="sort align-middle pe-5" scope="col" data-sort="email" style="width:20%;">EMAIL</th>
                  <th class="sort align-middle text-end" scope="col" data-sort="total-orders" style="width:10%">TELEPHONES</th>
                  <th class="sort align-middle text-end ps-3" scope="col" data-sort="total-spent" style="width:10%">COMMANDES</th>
                  <th class="sort align-middle ps-7" scope="col" data-sort="city" style="width:25%;">ADRESSE</th>
                  <th class="sort align-middle text-end" scope="col" data-sort="last-seen" style="width:15%;">RCCM</th>
                  <th class="sort align-middle text-end pe-0" scope="col" data-sort="last-order" style="width:10%;min-width: 150px;">INFOS</th>
                  <th class="sort align-middle text-end pe-0" scope="col" data-sort="last-order" style="width:10%;min-width: 150px;">ACTIONS</th>
                </tr>
              </thead>
              <tbody class="list" id="customers-table-body">
                @foreach ($supplies as $supplie)
                <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                  <td class="customer align-middle white-space-nowrap pe-5">
                    <a class="d-flex align-items-center text-body-emphasis" href="{{ route('magasin.devis.show',$supplie->slug) }}">
                      <div class="avatar avatar-m">
                        <img class="rounded-circle" src="
                        @if($supplie->magasin_id != null))
                          @if($supplie->magasin->logo == '') 
                            https://ui-avatars.com/api/?name={{ $supplie->magasin->name }} 
                          @else 
                            {{(Storage::url($supplie->magasin->logo))}} 
                          @endif
                        @else
                          @if($supplie->image == '') 
                            https://ui-avatars.com/api/?name={{ $supplie->name }} 
                          @else 
                            {{(Storage::url($supplie->image))}} 
                          @endif
                        @endif
                          "
                        />
                      </div>
                      <p class="mb-0 ms-3 text-body-emphasis fw-bold">@if($supplie->magasin_id != null){{ $supplie->magasin->name }}@else {{ $supplie->name }} @endif</p>
                    </a>
                  </td>
                  <td class="email align-middle white-space-nowrap pe-5"><a class="fw-semibold" href="!#">@if($supplie->magasin_id != null){{ $supplie->magasin->email }}@else {{ $supplie->email }} @endif</a></td>
                  <td class="total-orders align-middle white-space-nowrap fw-semibold text-center text-body-highlight">@if($supplie->magasin_id != null){{ $supplie->magasin->phone }}@else {{ $supplie->phone }} @endif</td>
                  <td class="total-spent align-middle white-space-nowrap fw-bold text-center ps-3 text-body-emphasis">{{ $supplie->supply_orders->count() }}</td>
                  <td class="city align-middle white-space-nowrap text-body-highlight ps-7">@if($supplie->magasin_id != null){{ $supplie->magasin->adresse }}@else {{ $supplie->adresse }} @endif</td>
                  <td class="last-seen align-middle white-space-nowrap text-body-tertiary text-end">@if($supplie->magasin_id != null){{ $supplie->magasin->registre_com }}@else {{ $supplie->registre_com }} @endif</td>
                  <td class="last-order align-middle white-space-nowrap text-body-tertiary text-end">
                    @if($supplie->magasin_id != null)
                      <a href="{{ route('magasin.fournisseurs.about',$supplie->slug) }}"><span class="badge text-bg-info">A propos</span></a>
                    @else
                      Non Abonne
                    @endif
                  </td>
                  <td class="last-order align-middle white-space-nowrap text-body-tertiary text-end">
                    @if ($supplie->magasin_id == null)
                      <span class="me-3 text-success fs-7" data-feather="edit-3" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRightUpdate-{{ $supplie->id }}" aria-controls="offcanvasRightUpdate-{{ $supplie->id }}" data-fa-transform="shrink-3"></span>
                    @endif
                    <span class="me-2 text-danger fs-7" data-feather="trash-2" data-bs-toggle="modal" data-bs-target="#DeleteSupply-{{ $supplie->id }}" data-fa-transform="shrink-3"></span>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <div class="row align-items-center justify-content-between py-2 pe-0 fs-9">
            <div class="col-auto d-flex">
              <p class="mb-0 d-none d-sm-block me-3 fw-semibold text-body" data-list-info="data-list-info"></p><a class="fw-semibold" href="#!" data-list-view="*">View all<span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a><a class="fw-semibold d-none" href="#!" data-list-view="less">View Less<span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a>
            </div>
            <div class="col-auto d-flex"><button class="page-link" data-list-pagination="prev"><span class="fas fa-chevron-left"></span></button>
              <ul class="mb-0 pagination"></ul><button class="page-link pe-0" data-list-pagination="next"><span class="fas fa-chevron-right"></span></button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="card-body p-0">
      <div class="p-4 code-to-copy">
        <!-- Right Offcanvas-->
        <div class="offcanvas offcanvas-end" id="offcanvasRight" tabindex="-1" aria-labelledby="offcanvasRightLabel">
          <div class="offcanvas-header">
            <h5 id="offcanvasRightLabel">Ajouter un fournisseur</h5><button class="btn-close text-reset" type="button" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">
            <form method="POST" action="{{ route('magasin.autres-magasins.store') }}" enctype="multipart/form-data">
              @csrf
              <div class="mb-3 text-start">
                <label class="form-label" for="name">Nom du fournisseur</label>
                <input id="name" type="text" placeholder="Nom du fournisseur" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>

              <div class="mb-3 text-start">
                <label class="form-label" for="email">email du fournisseur</label>
                <input id="email" type="text" placeholder="email du fournisseur" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>

              <div class="mb-3 text-start">
                <label class="form-label" for="phone">Telephone du fournisseur</label>
                <input id="phone" type="numeric" placeholder="Telephone du fournisseur" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>

                @error('phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>

              <div class="mb-3 text-start">
                <label class="form-label" for="adresse">Adresse du fournisseur</label>
                <input id="adresse" type="text" placeholder="Adresse du fournisseur" class="form-control @error('adresse') is-invalid @enderror" name="adresse" value="{{ old('adresse') }}" required autocomplete="adresse" autofocus>

                @error('adresse')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>

              <div class="mb-3 text-start">
                <label class="form-label" for="ninea">Ninea du fournisseur</label>
                <input id="ninea" type="text" placeholder="Ninea du fournisseur" class="form-control @error('ninea') is-invalid @enderror" name="ninea" value="{{ old('ninea') }}" required autocomplete="ninea" autofocus>

                @error('ninea')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>

              <div class="mb-3 text-start">
                <label class="form-label" for="registre_com">Registre de commerce du fournisseur</label>
                <input id="registre_com" type="text" placeholder="Registre de commerce du fournisseur" class="form-control @error('registre_com') is-invalid @enderror" name="registre_com" value="{{ old('registre_com') }}" required autocomplete="registre_com" autofocus>

                @error('registre_com')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>

              <div class="mb-3 text-start">
                <label class="form-label" for="image">Logo du fournisseur (facultatif)</label>
                <input class="form-control @error('image') is-invalid @enderror" id="image" name="image" type="file" value="{{ old('image') }}" autocomplete="image"/>
                @error('image')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              
              <div class="mb-3 text-start">
                <label class="form-label" for="email">Status</label> <br>
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
              <button class="btn btn-primary w-100 mb-3" type="submit">Enreistrer le fournisseur</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    @foreach ($supplies as $supplieUpdate)
      <div class="card-body p-0">
        <div class="p-4 code-to-copy">
          <!-- Right Offcanvas-->
          <div class="offcanvas offcanvas-end" id="offcanvasRightUpdate-{{ $supplieUpdate->id }}" tabindex="-1" aria-labelledby="offcanvasRightLabel">
            <div class="offcanvas-header">
              <h5 id="offcanvasRightLabel">Modifier ce fournisseur</h5><button class="btn-close text-reset" type="button" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
              <form method="POST" action="{{ route('magasin.autres-magasins.update',$supplieUpdate->id) }}" enctype="multipart/form-data">
                @csrf
                {{ method_field('PUT') }}
                <div class="mb-3 text-start">
                  <label class="form-label" for="name">Nom du fournisseur</label>
                  <input id="name" type="text" placeholder="Nom du fournisseur" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $supplieUpdate->name }}" required autocomplete="name" autofocus>

                  @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>

                <div class="mb-3 text-start">
                  <label class="form-label" for="email">email du fournisseur</label>
                  <input id="email" type="text" placeholder="email du fournisseur" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') ?? $supplieUpdate->email }}" required autocomplete="email" autofocus>

                  @error('email')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>

                <div class="mb-3 text-start">
                  <label class="form-label" for="phone">Telephone du fournisseur</label>
                  <input id="phone" type="numeric" placeholder="Telephone du fournisseur" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') ?? $supplieUpdate->phone }}" required autocomplete="phone" autofocus>

                  @error('phone')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>

                <div class="mb-3 text-start">
                  <label class="form-label" for="adresse">Adresse du fournisseur</label>
                  <input id="adresse" type="text" placeholder="Adresse du fournisseur" class="form-control @error('adresse') is-invalid @enderror" name="adresse" value="{{ old('adresse') ?? $supplieUpdate->adresse }}" required autocomplete="adresse" autofocus>

                  @error('adresse')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>

                <div class="mb-3 text-start">
                  <label class="form-label" for="ninea">Ninea du fournisseur</label>
                  <input id="ninea" type="text" placeholder="Ninea du fournisseur" class="form-control @error('ninea') is-invalid @enderror" name="ninea" value="{{ old('ninea') ?? $supplieUpdate->ninea }}" required autocomplete="ninea" autofocus>

                  @error('ninea')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>

                <div class="mb-3 text-start">
                  <label class="form-label" for="registre_com">Registre de commerce du fournisseur</label>
                  <input id="registre_com" type="text" placeholder="Registre de commerce du fournisseur" class="form-control @error('registre_com') is-invalid @enderror" name="registre_com" value="{{ old('registre_com') ?? $supplieUpdate->registre_com }}" required autocomplete="registre_com" autofocus>

                  @error('registre_com')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>

                <div class="mb-3 text-start">
                  <label class="form-label" for="image">Logo du fournisseur (facultatif)</label>
                  <input class="form-control @error('image') is-invalid @enderror" id="image" name="image" type="file" value="{{ old('image') ?? $supplieUpdate->image }}" autocomplete="image"/>
                  @error('image')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
                
                <div class="mb-3 text-start">
                  <label class="form-label" for="email">Status</label> <br>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input text-success @error('visible') is-invalid @enderror" @if($supplieUpdate->status == 1) checked="" @endif id="inlineRadioA-{{ $supplieUpdate->id }}" type="radio" name="visible" value=" 1 ">
                    <label class="form-check-label text-success" for="inlineRadioA-{{ $supplieUpdate->id }}">Visible</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input text-warning @error('visible') is-invalid @enderror" @if($supplieUpdate->status == 0) checked="" @endif id="inlineRadioB-{{ $supplieUpdate->id }}" type="radio" name="visible" value=" 0 ">
                    <label class="form-check-label text-warning" for="inlineRadioB-{{ $supplieUpdate->id }}">Cacher</label>
                  </div>
                  @error('visible')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
                <button class="btn btn-primary w-100 mb-3" type="submit">Enreistrer les modification</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    @endforeach


    @foreach($supplies as $deleteSupply)
      <div class="modal fade" id="DeleteSupply-{{ $deleteSupply->id }}" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title text-danger" id="exampleModalLabel">Suppresion comme fournisseur</h5><button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close"><svg class="svg-inline--fa fa-xmark fs-9" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="xmark" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path fill="currentColor" d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z"></path></svg><!-- <span class="fas fa-times fs-9"></span> Font Awesome fontawesome.com --></button>
            </div>
            <form action="{{ route('magasin.autres-magasins.destroy',$deleteSupply->id) }}" method="post">
              @csrf
              {{ method_field('DELETE') }}
              <div class="modal-body">
                <p class="text-body-tertiary lh-lg mb-3"> 
                  Etes vous sure de bien vouloire supprimer ce fornisseur de @if($deleteSupply->magasin_id != null) {{$deleteSupply->magasin->name}} @else {{ $deleteSupply->name }} @endif
                </p>
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
