@extends('layouts.app',['title' => 'affichage des bon de commande'])
  @section('headSection')
  <link href="{{asset('vendors/choices/choices.min.css')}}" rel="stylesheet" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  @endsection
@section('main-content')
  <div class="content">

    <div class="mb-9">
      <div class="row g-3 mb-4">
        <div class="col-auto">
          <h2 class="mb-3">Produits sous bon mensuelle</h2>
          <div class="d-sm-flex flex-between-center mb-3">
            <p class="text-body-secondary lh-sm mb-0 mt-2 mt-sm-0">
              Client : <a class="fw-bold" href="#!" style="margin-right: 15px;">  @if($bon->user_id == '') {{ $bon->name }} @else {{ $bon->user->name }} @endif</a>
              Téléone : <a class="fw-bold" href="#!"> @if($bon->user_id == '') {{ $bon->phone }} @else {{ $bon->user->phone }} @endif</a>
            </p>
          </div>
        </div>
      </div>
      <div id="products" data-list='{"valueNames":["product","price","category","tags","vendor","time"],"page":10,"pagination":true}'>
        <div class="mb-4">
          <div class="d-flex flex-wrap gap-3">
            <div class="search-box" style="width: 75%;">
              <form class="position-relative"><input class="form-control search-input search" type="search" placeholder="Rechercher un produit" aria-label="Search" />
                <span class="fas fa-search search-box-icon"></span>
              </form>
            </div>
            <div class="ms-xxl-auto">
              @if($bon->status == 1)
                <a href="{{ route('magasin.bon.delete',$bon->id) }}" class="btn btn-warning">
                  <span data-feather="trash-2" data-fa-transform="shrink-3" class="me-2"></span>Vider ce stock
                </a>
              @elseif($bon->status == 2)
                <button type="button" class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                  <span class="me-2" data-feather="plus"></span>Ajouter des produits
                </button>
              @else
                <h4 class="mb-0">Cette commande de sous reservation a ete anuller</h4>
              @endif
            </div>
          </div>
        </div>
        <div class="mx-n4 px-4 mx-lg-n6 px-lg-6 bg-body-emphasis border-top border-bottom border-translucent position-relative top-1">
          <div class="table-responsive scrollbar mx-n1 px-1">
            <table class="table fs-9 mb-0">
              <thead>
                <tr>
                  <th class="sort white-space-nowrap align-middle fs-10" scope="col" style="width:70px;"></th>
                  <th class="sort white-space-nowrap align-middle ps-4" scope="col" style="width:350px;" data-sort="product">PRODUITS</th>
                  <th class="sort align-middle text-end ps-4" scope="col" data-sort="price" style="width:150px;">CODE-U</th>
                  <th class="sort align-middle ps-3 w-auto" scope="col" data-sort="tags">COULEURS</th>
                  <th class="sort align-middle ps-3 w-auto" scope="col" data-sort="vendor">TAILLES</th>
                  <th class="sort align-middle ps-3 w-auto" scope="col" data-sort="vendor">UNITES</th>
                  <th class="sort align-middle text-end ps-4" scope="col" data-sort="price" style="width:150px;">QUANTITES</th>
                  <th class="sort align-middle text-end ps-4" scope="col" data-sort="price" style="width:150px;">PRIX UNITAIRE</th>
                  <th class="sort align-middle text-end ps-4" scope="col" data-sort="price" style="width:150px;">PRIX TOTAL</th>
                  <th class="sort align-middle ps-4" scope="col" data-sort="time" style="width:50px;">DATE</th>
                  <th class="sort text-end align-middle pe-0 ps-4" scope="col">@if ($bon->validate == 1) PAIEMENTS @else ACTIONS @endif</th>
                </tr>
              </thead>
              <tbody class="list" id="products-table-body">
                @foreach($bon->bagages as $product)
                  <tr class="position-static">
                    <td class="align-middle white-space-nowrap py-0" data-bs-toggle="modal" data-bs-target="#scrollingLong-{{ $product->id }}"><a href="#" class="d-block border border-translucent rounded-2"><img src="{{Storage::url($product->image)}}" alt="" width="53" /></a></td>
                    <td class="product align-middle ps-4" data-bs-toggle="modal" data-bs-target="#scrollingLong-{{ $product->id }}"><a href="#" class="fw-semibold line-clamp-3 mb-0">{{ $product->name }}</a></td>
                    <td class="price align-middle white-space-nowrap text-center fw-bold text-body-tertiary ps-4">{{ $product->unique_code }}</td>
                    <td class="total-spent align-middle white-space-nowrap fw-bold text-end ps-3 text-body-emphasis">
                      <span class="badge badge-phoenix badge-phoenix-secondary">{{ $product->color }}</span> 
                    </td>
                    <td class="total-spent align-middle white-space-nowrap fw-bold text-end ps-3 text-body-emphasis">
                      <span class="badge badge-phoenix badge-phoenix-secondary">{{ $product->size }}</span> 
                    </td>
                    <td class="total-spent align-middle white-space-nowrap fw-bold text-end ps-3 text-body-emphasis">
                      <span class="badge badge-phoenix badge-phoenix-secondary">{{ $product->unite }}</span> 
                    </td>
                    <td class="price align-middle white-space-nowrap text-center fw-bold text-body-tertiary ps-4">{{ $product->quantity }}</td>
                    <td class="price align-middle white-space-nowrap text-center fw-bold text-body-tertiary ps-4">{{ $product->getPrice() }}</td>
                    <td class="price align-middle white-space-nowrap text-center fw-bold text-body-tertiary ps-4">{{ number_format($product->price * $product->quantity,2, ',','.') }} CFA</td>
                    <td class="time align-middle white-space-nowrap text-body-tertiary text-opacity-85 ps-4">{{date('d-m-Y', strtotime( $product->date ))}}</td>
                    <td class="align-middle white-space-nowrap text-end pe-0 ps-4 btn-reveal-trigger">
                    @if ($product->commande->status != 1)
                      @if ($product->commande->validate == 1)
                        <span class="me-3 text-center badge badge-phoenix badge badge-phoenix-warning">Non payée</span>
                      @else
                        <span class="me-2 text-danger" data-feather="trash-2" data-bs-toggle="modal" data-bs-target="#DeleteCompte-{{ $product->id }}" data-fa-transform="shrink-3"></span>
                      @endif
                    @else
                          <span class="me-2 text-center badge badge-phoenix badge badge-success">payée</span>
                    @endif
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
            <form method="POST" action="{{ route('magasin.bagage.store') }}">
              @csrf
              <input type="hidden" name="reserve_id" value="{{ $bon->id }}">
              <input type="hidden" name="type" value="0">

              <div class="mb-3 text-start">
                <label class="form-label" for="productId">Choisire votre produit</label>
                <select class="form-select @error('productId') is-invalid @enderror" name="productId" id="productId" data-choices="data-choices" data-options='{"removeItemButton":true,"placeholder":true}'>
                  <option value="">Sélectionner le produit</option>
                  @foreach ($products as $product)
                    <option value="{{ old('productId') ?? $product->id }}"> {{ $product->name }}</option>
                  @endforeach
                </select>
                @error('productId')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              <div class="mb-3 text-start">
                <label class="form-label" for="unity">Choisire l'unites</label>
                <select class="form-select @error('unity') is-invalid @enderror" name="unity" id="unity" data-options='{"removeItemButton":true,"placeholder":true}'>
                  <option >Sélectionner un...</option>
                </select>
                @error('unity')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              <div class="mb-3 text-start">
                <label class="form-label" for="color">Choisire la couleur</label>
                <select class="form-select @error('color') is-invalid @enderror" name="color" id="color" data-options='{"removeItemButton":true,"placeholder":true}'>
                  <option >Sélectionner une...</option>
                </select>
                @error('color')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              <div class="mb-3 text-start">
                <label class="form-label" for="size">Choisire la taille</label>
                <select class="form-select @error('size') is-invalid @enderror" name="size" id="size" data-options='{"removeItemButton":true,"placeholder":true}'>
                  <option >Sélectionner une...</option>
                </select>
                @error('size')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              <div class="mb-3 text-start">
                <label class="form-label" for="quantity">Quantite du produit</label>
                <input id="quantity" type="numeric" class="form-control @error('quantity') is-invalid @enderror" name="quantity" value="{{ old('quantity') }}" placeholder="Quantite du produit" required autocomplete="quantity">

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
            <form action="{{ route('magasin.bagage.store') }}" method="post"> 
              @csrf
              <input type="hidden" name="reserve_id" value="{{ $bon->id }}">
              <input type="hidden" name="type" value="0">
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



    @foreach($bon->bagages  as $product)
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


      
    @foreach($bon->bagages  as $product)
      <div class="modal fade" id="scrollingLong-{{ $product->id }}" tabindex="-1" aria-labelledby="scrollingLongModalLabel2" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="scrollingLongModalLabel2">Grand format de l'image</h5><button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close"><svg class="svg-inline--fa fa-xmark fs-9" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="xmark" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path fill="currentColor" d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z"></path></svg><!-- <span class="fas fa-times fs-9"></span> Font Awesome fontawesome.com --></button>
            </div>
            <div class="modal-body">
              <p class="text-body-tertiary lh-lg mb-0">
                <img src="{{Storage::url($product->image)}}" alt="" style="width: 100%;height:auto;" />
              </p>
            </div>
            <div class="modal-footer">
              <button class="btn btn-outline-primary" type="button" data-bs-dismiss="modal">Fermer</button>
            </div>
          </div>
        </div>
      </div>
    @endforeach



    @include('layouts.footer_admin')


  </div>
@endsection

@section('footerSection')
<script src="{{ asset('assets/js/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap-tagsinput.js') }}"></script> 
<script src="{{asset('vendors/choices/choices.min.js')}}"></script>
<script>
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
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

    $("#productId").change(function () {
      var productId = $(this).val();
      
      $.ajax({
        url:'{{ url("/magasin/getProductOption") }}/' + productId,
        type:"get",
        dataType:"json",
        success: function(response){
          $("#unity").find('option:not(:first)').remove();
          $("#color").find('option:not(:first)').remove();
          $("#size").find('option:not(:first)').remove();

          if (response['unites'].length > 0) {
            $.each(response['unites'], function (key, value) {
              $("#unity").append("<option value='" + value['id'] + "'>" + value['name'] + "</option>")
            });
          }

          if (response['colors'].length > 0) {
            $.each(response['colors'], function (key, value) {
              $("#color").append("<option value='" + value['name'] + "'>" + value['name'] + "</option>")
            });
          }

          if (response['sizes'].length > 0) {
            $.each(response['sizes'], function (key, value) {
              $("#size").append("<option value='" + value['name'] + "'>" + value['name'] + "</option>")
            });
          }
        }
      });


    });

  });
</script>
@endsection