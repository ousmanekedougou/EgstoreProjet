@extends('layouts.app',['title' => 'affichage des commandes sous reserve'])

@section('main-content')
<div class="content">
    <div class="mb-9">
      <div class="row g-3 mb-4">
        <div class="col-auto">
          <h2 class="mb-3">Produits sous reservation pro-format</h2>
          <div class="d-sm-flex flex-between-center mb-3">
            <p class="text-body-secondary lh-sm mb-0 mt-2 mt-sm-0">
              Client : <a class="fw-bold" href="#!" style="margin-right: 15px;">  @if($reserve->user_id == '') {{ $reserve->name }} @else {{ $reserve->user->name }} @endif</a>
              Téléphone : <a class="fw-bold" href="#!"> @if($reserve->user_id == '') {{ $reserve->phone }} @else {{ $reserve->user->phone }} @endif</a>
            </p>
          </div>
        </div>
      </div>
      <div id="products" data-list='{"valueNames":["product","price","category","tags","vendor","time"],"page":10,"pagination":true}'>
        <div class="mb-4">
          <div class="d-flex flex-wrap gap-3">
            <div class="search-box" style="width: 70%;">
              <form class="position-relative"><input class="form-control search-input search" type="search" placeholder="Rechercher un produit" aria-label="Search" />
                <span class="fas fa-search search-box-icon"></span>
              </form>
            </div>
            <div class="ms-xxl-auto ms-auto">
              @if($reserve->status == 1)
                <a href="{{ route('magasin.reserve.delete',$reserve->id) }}" class="btn btn-warning">
                  <span data-feather="trash-2" data-fa-transform="shrink-3" class="me-2"></span>Vider ce stock
                </a>
              @elseif($reserve->status == 2)
                <button type="button" class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop" aria-controls="offcanvasTop">
                  <span class="me-2" data-feather="plus"></span>Ajouter des produits
                </button>
              @else
                <h4 class="mb-0">Cette commande de sous résérvation a été anuller</h4>
              @endif
            </div>
          </div>
        </div>
        <div class="mx-n4 px-4 mx-lg-n6 px-lg-6 bg-body-emphasis border-top border-bottom border-translucent position-relative top-1">
          <div class="table-responsive scrollbar mx-n1 px-1">
            <table class="table fs-9 mb-0">
              <thead>
                <tr>
                  <th class="sort white-space-nowrap align-middle ps-4" scope="col" style="width:350px;" data-sort="product">PRODUITS</th>
                  <th class="sort align-middle text-end ps-4" scope="col" data-sort="price" style="width:150px;">REFERENCES</th>
                  <th class="sort align-middle text-end ps-4" scope="col" data-sort="price" style="width:150px;">QUANTITES</th>
                  <th class="sort align-middle text-end ps-4" scope="col" data-sort="price" style="width:150px;">PRIX UNITAIRE</th>
                  <th class="sort align-middle text-end ps-4" scope="col" data-sort="price" style="width:150px;">PRIX TOTAL</th>
                  <th class="sort align-middle ps-4" scope="col" data-sort="time" style="width:50px;">DATE</th>
                  <th class="sort text-end align-middle pe-0 ps-4" scope="col">ACTIONS</th>
                </tr>
              </thead>
              <tbody class="list" id="products-table-body">
                @foreach($reserve->bagages as $product)
                  <tr class="position-static">
                    
                    <td class="product align-middle ps-4"><span class="fw-semibold line-clamp-3 mb-0" target="_blank" href="">{{ $product->name }}</span></td>
                    <td class="price align-middle white-space-nowrap text-center fw-bold text-body-tertiary ps-4">@if ($product->reference != '') {{ $product->reference }} @else null @endif</td>
                    <td class="price align-middle white-space-nowrap text-center fw-bold text-body-tertiary ps-4">{{ $product->quantity }}</td>
                    <td class="price align-middle white-space-nowrap text-center fw-bold text-body-tertiary ps-4">{{ $product->getPrice() }}</td>
                    <td class="price align-middle white-space-nowrap text-center fw-bold text-body-tertiary ps-4">{{ number_format($product->amount,2, ',','.') }} CFA</td>
                    <td class="time align-middle white-space-nowrap text-body-tertiary text-opacity-85 ps-4">{{date('d-m-Y', strtotime( $product->created_at ))}}</td>
                    <td class="align-middle white-space-nowrap text-end pe-0 ps-4 btn-reveal-trigger">
                      <span class="me-3 text-success fs-7" data-feather="edit-3" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight-{{ $product->id }}" aria-controls="offcanvasRight-{{ $product->id }}" data-fa-transform="shrink-3"></span>
                      <span class="me-2 text-danger fs-7" data-feather="trash-2" data-bs-toggle="modal" data-bs-target="#DeleteCompte-{{ $product->id }}" data-fa-transform="shrink-3"></span>
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
            <h5 id="offcanvasRightLabel">Ajouter un produit</h5><button class="btn-close text-reset" type="button" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">
            <form method="POST" action="" enctype="multipart/form-data">
              @csrf
              <input type="hidden" name="reserve_id" value="{{ $reserve->id }}">
              <input type="hidden" name="type" value="1">
              <div class="mb-3 text-start">
                  <label class="form-label" for="name">Titre du produit</label>
                  <input id="name" type="text" placeholder="Titre du produit" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                  @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>

              <div class="mb-3 text-start">
                  <label class="form-label" for="reference">Reference du produit</label>
                  <input id="reference" type="text" placeholder="Reference du produit" class="form-control @error('reference') is-invalid @enderror" name="reference" value="{{ old('reference') }}" required autocomplete="reference" autofocus>

                  @error('reference')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>

              <div class="mb-3 text-start">
                  <label class="form-label" for="price">Prix du produit</label>
                  <input id="price" type="numeric" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" placeholder="Prix du produit" required autocomplete="price">

                  @error('price')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>
              <div class="mb-3 text-start">
                  <label class="form-label" for="quantity">Quantite du produit</label>
                  <input id="quantity" type="quantity" class="form-control @error('quantity') is-invalid @enderror" name="quantity" value="{{ old('quantity') }}" placeholder="Quantite du produit" required autocomplete="quantity">

                  @error('quantity')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>

              <div class="mb-3 text-start">
                <label class="form-label" for="image">Image du produit</label>
                <input class="form-control @error('image') is-invalid @enderror" id="image" name="image" type="file" value="{{ old('image') }}" autocomplete="image"/>
                @error('image')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>

              <button class="btn btn-primary w-100 mb-3" type="submit">Enreistrer ce produit</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="offcanvas offcanvas-top h-auto w-auto" id="offcanvasTop" tabindex="-1" aria-labelledby="offcanvasTopLabel">
      <div class="offcanvas-header">
        <h5 id="offcanvasTopLabel"></h5><button class="btn-close text-reset" type="button" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <div class="mb-9">
          <div class="row g-2 mb-4">
            <div class="col-auto">
              <h2 class="mb-0">Ajouter des produits</h2>
            </div>
          </div>
          <div id="products" data-list='{"valueNames":["customer","email","total-orders","total-spent","city","last-seen","last-order"],"page":10,"pagination":true}'>
            <form action="{{ route('magasin.bagage.post') }}" method="post"> 
              @csrf
              <input type="hidden" name="reserve_id" value="{{ $reserve->id }}">
              <input type="hidden" name="type" value="1">
              <div class="mx-n4 px-4 mx-lg-n6 px-lg-6 bg-body-emphasis border-top border-bottom border-translucent position-relative top-1">
               
                <div class="table-responsive scrollbar-overlay mx-n1 px-1">
                  <table class="table table-sm fs-9 mb-0" id="table">
                    <thead>
                      <tr>
                        <th class="sort align-middle pe-5 text-center" scope="col" data-sort="customer" style="width:35%;">DESIGNATION</th>
                        <th class="sort align-middle ps-7 text-center" scope="col" data-sort="city" style="width:20%;">REFERENCE</th>
                        <th class="sort align-middle pe-5 text-center" scope="col" data-sort="email" style="width:13%;">QUANTITE</th>
                        <th class="sort align-middle text-center ps-3" scope="col" data-sort="total-spent" style="width:15%">PRIX UNITAIRE</th>
                        <th class="sort align-middle text-center pe-0" scope="col" data-sort="last-order" style="width:10%;">ACTIONS</th>
                      </tr>
                    </thead>
                    <tbody class="list" id="customers-table-body">
                      <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                        <td class="customer align-middle white-space-nowrap pe-5 text-center">
                          <input type="text" placeholder="Designation" class="form-control @error('name') is-invalid @enderror" name="inputs[0][name]" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        </td>
                        <td class="city align-middle white-space-nowrap text-body-highlight ps-7 text-center">
                          <input type="text" placeholder="Reference" class="form-control @error('reference') is-invalid @enderror" name="inputs[0][reference]" value="{{ old('reference') }}" autocomplete="reference" autofocus>
                        </td>
                        <td class="email align-middle white-space-nowrap pe-5 text-center">
                          <input type="number" placeholder="Quantite" class="form-control @error('quantite') is-invalid @enderror" name="inputs[0][qty]" value="{{ old('quantite') }}" required autocomplete="quantite" autofocus>
                        </td>
                        <td class="total-spent align-middle white-space-nowrap fw-bold ps-3 text-body-emphasis text-center">
                          <input type="number" placeholder="Prix unitaire" class="form-control @error('price') is-invalid @enderror" name="inputs[0][price]" value="{{ old('price') }}" required autocomplete="price" autofocus>
                        </td>
                        <td class="last-order align-middle white-space-nowrap text-body-tertiary text-center">
                          <button type="button" class="btn btn-primary" id="add">
                            <span class="fas fa-plus me-2"></span>Ajouter
                          </button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="row align-items-center justify-content-between mt-3 py-2 pe-0 fs-9">
                    <button type="submit" class="btn btn-success">
                      <span class="fas fa-check me-2"></span>Enregistre les produits
                    </button>
                </div>
              </div>
            </form>
          </div>

        </div>
      </div>
    </div>

    @foreach($reserve->bagages as $product)
      <div class="card-body p-0">
        <div class="p-4 code-to-copy">
          <!-- Right Offcanvas-->
          <div class="offcanvas offcanvas-end" id="offcanvasRight-{{ $product->id }}" tabindex="-1" aria-labelledby="offcanvasRightLabel">
            <div class="offcanvas-header">
              <h5 id="offcanvasRightLabel">Modification de produit</h5><button class="btn-close text-reset" type="button" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
              <form method="POST" action="{{ route('magasin.bagage.update',$product->id) }}">
                @csrf
                {{ method_field('PUT') }}
                <input type="hidden" name="reserve_id" value="{{ $reserve->id }}">
                <input type="hidden" name="type" value="1">
                <div class="mb-3 text-start">
                    <label class="form-label" for="name">Titre du produit</label>
                    <input id="name" type="text" placeholder="Titre du produit" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $product->name }}" required autocomplete="name" autofocus>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3 text-start">
                    <label class="form-label" for="reference">Reference du produit</label>
                    <input id="reference" type="text" placeholder="Reference du produit" class="form-control @error('reference') is-invalid @enderror" name="reference" value="{{ old('reference') ?? $product->reference }}" required autocomplete="reference" autofocus>

                    @error('reference')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3 text-start">
                    <label class="form-label" for="price">Prix du produit</label>
                    <input id="price" type="numeric" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') ?? $product->price }}" placeholder="Prix du produit" required autocomplete="price">

                    @error('price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3 text-start">
                    <label class="form-label" for="quantity">Quantite du produit</label>
                    <input id="quantity" type="quantity" class="form-control @error('quantity') is-invalid @enderror" name="quantity" value="{{ old('quantity') ?? $product->quantity }}" placeholder="Quantite du produit" required autocomplete="quantity">

                    @error('quantity')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <button class="btn btn-primary w-100 mb-3" type="submit">Enreistrer ce produit</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    @endforeach


    @foreach($reserve->bagages  as $product)
      <div class="modal fade" id="DeleteCompte-{{ $product->id }}" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title text-danger" id="exampleModalLabel">Suppresion de produit</h5><button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close"><svg class="svg-inline--fa fa-xmark fs-9" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="xmark" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path fill="currentColor" d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z"></path></svg><!-- <span class="fas fa-times fs-9"></span> Font Awesome fontawesome.com --></button>
            </div>
            <form action="{{ route('magasin.bagage.destroy',$product->id) }}" method="post">
              @csrf
              {{ method_field('DELETE') }}
              <div class="modal-body">
                <p class="text-body-tertiary lh-lg mb-3"> Etes vous sure de bien vouloire supprimer le produit {{$product->name}} </p>
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

<script src="{{ asset('assets/js/jquery/jquery.min.js') }}"></script>
<script>
  $(document).ready(function(){
    var i = 0;
    $('#add').click(function(){
      i++;
      $('#table').append(
        `
        <tbody class="list" id="customers-table-body">
          <tr class="hover-actions-trigger btn-reveal-trigger position-static">

            <td class="customer align-middle white-space-nowrap pe-5 text-center">
              <input type="text" placeholder="Designation" class="form-control @error('name') is-invalid @enderror" name="inputs[`+i+`][name]" value="{{ old('name') }}" required autocomplete="name" autofocus>
            </td>
            <td class="city align-middle white-space-nowrap text-body-highlight ps-7 text-center">
              <input type="text" placeholder="Reference" class="form-control @error('reference') is-invalid @enderror" name="inputs[`+i+`][reference]" value="{{ old('reference') }}"  autocomplete="reference" autofocus>
            </td>
            <td class="email align-middle white-space-nowrap pe-5 text-center">
              <input type="number" placeholder="Quantite" class="form-control @error('quantite') is-invalid @enderror" name="inputs[`+i+`][qty]" value="{{ old('quantite') }}" required autocomplete="quantite" autofocus>
            </td>
            <td class="total-spent align-middle white-space-nowrap fw-bold ps-3 text-body-emphasis text-center">
              <input type="number" placeholder="Prix unitaire" class="form-control @error('price') is-invalid @enderror" name="inputs[`+i+`][price]" value="{{ old('price') }}" required autocomplete="price" autofocus>
            </td>

            <td class="last-order align-middle white-space-nowrap text-body-tertiary text-center">
              <button type="button" class="btn btn-danger remove-table-row">
                <span class="fas fa-trash me-2"></span>Supprimer
              </button>
            </td>
          </tr>
          </tbody>
        `
      )
    });

    $(document).on('click','.remove-table-row', function(){
      $(this).parents('tr').remove();
    });

  });
</script>