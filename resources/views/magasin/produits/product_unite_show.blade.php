@extends('layouts.app',['title' => 'Unités de gestion'])

@section('main-content')
  <div class="content">

    <div class="mb-9">
      <div class="row g-2 mb-4">
        <div class="col-auto">
          <h2 class="mb-0">Les unités de vente pour ce produit</h2>
        </div>
      </div>
      <div id="products" data-list='{"valueNames":["customer","email","total-orders","total-spent","city","last-seen","last-order"]}'>
        <div class="mb-4">
          <div class="row g-3">
            <div class="col-auto">
              <div class="search-box" style="width: 70%;">
                <form class="position-relative"><input class="form-control search-input search" type="search" placeholder="Rechercher une unite" aria-label="Search" />
                  <span class="fas fa-search search-box-icon"></span>
                </form>
              </div>
            </div>
            <div class="col-auto ms-auto">
                <button type="button" class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                  <span class="me-2" data-feather="plus"></span>Ajouter une unité pour ce produit
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
                  <th class="sort align-middle text-center" scope="col" data-sort="total-orders" style="width:10%">Quantites</th>
                  <th class="sort align-middle text-center" scope="col" data-sort="total-orders" style="width:10%">Prix d'achats</th>
                  <th class="sort align-middle text-center" scope="col" data-sort="total-orders" style="width:10%">Prix de vente</th>
                  <th class="sort align-middle text-center" scope="col" data-sort="total-orders" style="width:10%">Prix de revenu</th>
                  <th class="sort align-middle text-end" scope="col" data-sort="total-orders" style="width:10%">status</th>
                  <th class="sort align-middle text-end ps-3" scope="col" data-sort="total-spent" style="width:10%">ACTIONS</th>
                </tr>
              </thead>
              <tbody class="list" id="customers-table-body">
                @foreach($product->vendor_systems as $vendor_system)
                <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                  <td class="customer align-middle white-space-nowrap pe-5">
                    <a class="d-flex align-items-center text-body-emphasis" href="#">
                      <p class="mb-0 ms-3 text-body-emphasis fw-bold">{{ $vendor_system->unite->name }}</p>
                    </a>
                  </td>
                  <td class="total-spent align-middle white-space-nowrap fw-bold text-center ps-3 text-body-emphasis">
                    <span class="badge badge-phoenix badge-phoenix-primary">{{ $vendor_system->unite->code }}</span>
                  </td>
                  <td class="total-spent align-middle white-space-nowrap fw-bold text-center ps-3 text-body-emphasis">
                    <span class="badge badge-phoenix badge-phoenix-success">{{ $vendor_system->quantity }}</span>
                  </td>
                  <td class="total-spent align-middle white-space-nowrap fw-bold text-center ps-3 text-body-emphasis">
                    <span class="badge badge-phoenix badge-phoenix-success">{{ $vendor_system->getPriceAchat() }}</span>
                  </td>
                  <td class="total-spent align-middle white-space-nowrap fw-bold text-center ps-3 text-body-emphasis">
                    <span class="badge badge-phoenix badge-phoenix-success">{{ $vendor_system->getPriceVente() }}</span>
                  </td>
                   <td class="total-spent align-middle white-space-nowrap fw-bold text-center ps-3 text-body-emphasis">
                    <span class="badge badge-phoenix badge-phoenix-success">{{ $vendor_system->getPriceRevenu() }}</span>
                  </td>
                  <td class="total-spent align-middle white-space-nowrap fw-bold text-end ps-3 text-body-emphasis">
                    @if($vendor_system->status == 1) <span class="badge badge-phoenix badge-phoenix-success">Unité de base</span> @else <span class="badge badge-phoenix badge-phoenix-warning">Unité simple</span> @endif
                  </td>
                  <td class="last-order align-middle white-space-nowrap text-body-tertiary text-end">
                    <span class="me-3 text-success fs-7" data-feather="edit-3" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight-{{ $vendor_system->id }}" aria-controls="offcanvasRight-{{ $vendor_system->id }}" data-fa-transform="shrink-3"></span>
                    <span class="me-2 text-danger fs-7" data-feather="trash-2" data-bs-toggle="modal" data-bs-target="#DeleteVendorSystem-{{ $vendor_system->id }}" data-fa-transform="shrink-3"></span>
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
            <form method="POST" action="{{ route('magasin.produit.addVendorSystem') }}">
              @csrf
              <input type="hidden" name="product_id" value="{{ $product->id }}">

              <input type="hidden" name="unite_status" value="{{ $unite_status->id }}">

              <div class="mb-3 text-start">
                <label for="organizerSingle">Sélectionner une unité</label>
                <select class="form-select @error('unite_id') is-invalid @enderror" name="unite_id" id="organizerSingle" data-choices="data-choices" data-options='{"removeItemButton":true,"placeholder":true}'>
                  <option value="">Sélectionner un...</option>
                  @foreach ($unites as $unite)
                    <option value="{{ old('unite_id') ?? $unite->id }}"> {{ $unite->name }}</option>
                  @endforeach
                </select>
                @error('unite_id')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              <div class="mb-3 text-start">
                <label class="form-label" for="quantity">Quantité de l'unité</label>
                <input id="quantity" type="quantity" class="form-control @error('quantity') is-invalid @enderror" name="quantity" value="{{ old('quantity') }}" placeholder="Quantité de l'unité" required autocomplete="quantity">

                @error('quantity')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              {{-- 
              @if($unite_status->status != 1)
                <div class="mb-3 text-start">
                  <label class="form-label" for="price_achat">Prix d'achat de l'unité</label>
                  <input id="price_achat" type="numeric" class="form-control @error('price_achat') is-invalid @enderror" name="price_achat" value="{{ old('price_achat') }}" placeholder="Prix d'achat de l'unité" required autocomplete="price_achat">

                  @error('price_achat')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>

                  <div class="mb-3 text-start">
                  <label class="form-label" for="price_vente">Prix de vente de l'unité</label>
                  <input id="price_vente" type="numeric" class="form-control @error('price_vente') is-invalid @enderror" name="price_vente" value="{{ old('price_vente') }}" placeholder="Prix de vente de l'unité" required autocomplete="price_vente">

                  @error('price_vente')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
              @endif
               --}}

              <button class="btn btn-primary w-100 mb-3" type="submit">Enregistrer cette unité</button>
              </form>
          </div>
        </div>
      </div>
    </div>

    @foreach($product->vendor_systems as $vendor_system_update)
    <div class="card-body p-0">
      <div class="p-4 code-to-copy">
        <!-- Right Offcanvas-->
        <div class="offcanvas offcanvas-end" id="offcanvasRight-{{ $vendor_system_update->id }}" tabindex="-1" aria-labelledby="offcanvasRightLabel">
          <div class="offcanvas-header">
            <h5 id="offcanvasRightLabel">Modifier cette unité {{ $vendor_system_update->unite->name }}</h5><button class="btn-close text-reset" type="button" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">
            <form method="POST" action="{{ route('magasin.produit.updateVendorSystem',$vendor_system_update->id) }}">
              @csrf
              {{ method_field('PUT') }}
              <input type="hidden" name="product_id" value="{{ $product->id }}">
              <input type="hidden" name="unite_status" value="{{ $unite_status->id }}">
              <div class="mb-3 text-start">
                <label for="organizerSingle">Séléctionner une unité pour ce produit</label>
                <select class="form-select @error('unite_id') is-invalid @enderror" name="unite_id" id="organizerSingle" data-choices="data-choices" data-options='{"removeItemButton":true,"placeholder":true}'>
                  <option value="">Séléctionner un...</option>
                  @foreach ($unites as $unite)
                    <option value="{{ old('unite_id') ?? $unite->id }}" @if($unite->id == $vendor_system_update->unite->id) selected @endif> {{ $unite->name }}</option>
                  @endforeach
                </select>
                @error('unite_id')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              <div class="mb-3 text-start">
                <label class="form-label" for="quantity">Quantité de l'unité</label>
                <input id="quantity" type="quantity" class="form-control @error('quantity') is-invalid @enderror" name="quantity" value="{{ old('quantity') ?? $vendor_system_update->quantity }}" placeholder="Quantité de l'unité" required autocomplete="quantity">

                @error('quantity')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              @if($unite_status->status != 1)
                <div class="mb-3 text-start">
                  <label class="form-label" for="price_achat">Prix d'achat de l'unité</label>
                  <input id="price_achat" type="numeric" class="form-control @error('price_achat') is-invalid @enderror" name="price_achat" value="{{ old('price_achat') ?? $vendor_system_update->price_achat }}" placeholder="Prix d'achat de l'unité" required autocomplete="price_achat">

                  @error('price_achat')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>

                <div class="mb-3 text-start">
                  <label class="form-label" for="price_vente">Prix de vente de l'unité</label>
                  <input id="price_vente" type="numeric" class="form-control @error('price_vente') is-invalid @enderror" name="price_vente" value="{{ old('price_vente') ?? $vendor_system_update->price_vente }}" placeholder="Prix de vente de l'unité" required autocomplete="price_vente">

                  @error('price_vente')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              @endif
              <div class="mb-3 text-start">
                <div class="form-check form-switch">
                  <input class="form-check-input mt-1 @error('status_unite') is-invalid @enderror" @if($vendor_system_update->status == 1) checked="" @endif id="status_unite-{{ $vendor_system_update->id }}" name="status_unite" type="checkbox" value="1" />
                  <label class="form-check-label" for="status_unite-{{ $vendor_system_update->id }}">@if($vendor_system_update->status == 1) Desactiver @else Activer @endif comme unité de base</label>
                </div>
                @error('status_unite')
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

    @foreach($product->vendor_systems as $vendor_system_delete)
      <div class="modal fade" id="DeleteVendorSystem-{{ $vendor_system_delete->id }}" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title text-danger" id="exampleModalLabel">Suppresion de cette unité @if ($vendor_system_delete->status == 1) de base @else simple @endif</h5><button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close"><svg class="svg-inline--fa fa-xmark fs-9" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="xmark" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path fill="currentColor" d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z"></path></svg><!-- <span class="fas fa-times fs-9"></span> Font Awesome fontawesome.com --></button>
            </div>
            <form action="{{ route('magasin.produit.deleteVendorSystem',$vendor_system_delete->id) }}" method="post">
              @csrf
              {{ method_field('DELETE') }}
              <input type="hidden" name="product_id" value="{{ $product->id }}">
              <div class="modal-body">
                <p class="text-body-tertiary lh-lg mb-3">
                  @if ($vendor_system_delete->status == 1)
                    Vous ne pouvez pas supprimer cette unite a moince de la desactiver comme unite de base
                  @else
                    Etes vous sure de bien vouloire supprimer l'unité {{$vendor_system_delete->unite->name}} 
                  @endif
                </p>
              </div>
              <div class="modal-footer">
                @if ($vendor_system_delete->status != 1)
                  <button class="btn btn-danger" type="submit">Oui je veux bien</button>
                  <button class="btn btn-outline-primary" type="button" data-bs-dismiss="modal">Anuller</button>
                @endif
              </div>
            </form>
          </div>
        </div>
      </div>
    @endforeach


    @include('layouts.footer_admin')

  </div>
@endsection