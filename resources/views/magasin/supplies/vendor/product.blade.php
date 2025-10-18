@extends('layouts.app',['title' => 'affichage des commandes de devis'])
@section('headSection')
<link href="{{asset('assets/css/bootstrap-tagsinput.css')}}" rel="stylesheet" />
@endsection
@section('main-content')
<div class="content">
    <div class="mb-9">
      <div class="row g-3 mb-4">
        <div class="col-auto">
          <h2 class="mb-3">Produits de la commande de devis Nº-{{ str_pad($supplyOrder->order, 5, '0', STR_PAD_LEFT) }}</h2>
          <div class="d-sm-flex flex-between-center mb-3">
            <p class="text-body-secondary lh-sm mb-0 mt-2 mt-sm-0">
              Magasin : <a class="fw-bold" href="#!" style="margin-right: 15px;">@if($supplyVendor->magasin_id != null) {{ $supplyVendor->magasin->name }} @else {{ $supplyVendor->name }} @endif</a>
              Email : <a class="fw-bold" href="#!" style="margin-right: 15px;">@if($supplyVendor->magasin_id != null) {{ $supplyVendor->magasin->email }} @else {{ $supplyVendor->email }} @endif</a>
              Téléphone : <a class="fw-bold" href="#!">@if($supplyVendor->magasin_id != null) {{ $supplyVendor->magasin->phone }} @else {{ $supplyVendor->phone }} @endif</a>
            </p>
          </div>
        </div>
      </div>
      <div id="products" data-list='{"valueNames":["product","price","category","tags","vendor","time"]}'>
        <div class="mb-4">
          <div class="d-flex flex-wrap gap-3">
            <div class="search-box" style="width: 100%;">
              <form class="position-relative"><input class="form-control search-input search" type="search" placeholder="Rechercher un produit" aria-label="Search" />
                <span class="fas fa-search search-box-icon"></span>
              </form>
            </div>
          </div>
        </div>
        <div class="mx-n4 px-4 mx-lg-n6 px-lg-6 bg-body-emphasis border-top border-bottom border-translucent position-relative top-1">
          <div class="table-responsive scrollbar mx-n1 px-1">
            <table class="table fs-9 mb-0">
              <thead>
                <tr>
                <th class="sort white-space-nowrap align-middle fs-10" scope="col" style="width:70px;"></th>
                  <th class="sort white-space-nowrap align-middle ps-4" scope="col" style="width:350px;" data-sort="product">DESIGNATIONS</th>
                  <th class="sort align-middle text-start ps-4" scope="col" data-sort="price" style="width:150px;">REFERENCES</th>
                  <th class="sort align-middle text-center ps-4" scope="col" data-sort="price" style="width:50px;">QTS</th>
                  <th class="sort align-middle ps-3" scope="col" data-sort="tags" style="width:250px;">COULEURS</th>
                  <th class="sort align-middle ps-3" scope="col" data-sort="tags" style="width:250px;">TAILLES</th>
                  <th class="sort align-middle text-end ps-4" scope="col" data-sort="price" style="width:150px;">VALIDATION</th>
                  <th class="sort align-middle text-end ps-4" scope="col" data-sort="price" style="width:150px;">PRIX UNITAIRE</th>
                  <th class="sort align-middle text-end ps-4" scope="col" data-sort="price" style="width:150px;">PRIX TOTAL</th>
                  <th class="sort text-end align-middle pe-0 ps-4" scope="col">ACTIONS</th>
                </tr>
              </thead>
              <tbody class="list" id="products-table-body">
                @foreach($supplyOrder->supply_order_products as $product)
                  <tr class="position-static">
                    
                    <td class="align-middle white-space-nowrap py-0"><a href="#!" class="d-block border border-translucent rounded-2"  data-bs-toggle="modal" data-bs-target="#scrollingLong-{{ $product->id }} "><img src="{{Storage::url($product->image)}}" alt="" width="53" /></a></td>
                    <td class="product align-middle ps-4"><a href="#!" class="fw-semibold line-clamp-3 mb-0"  data-bs-toggle="modal" data-bs-target="#scrollingLong-{{ $product->id }}">{{ $product->name }}</a></td>
                    <td class="price align-middle white-space-nowrap text-start fw-bold text-body-tertiary ps-4">@if ($product->reference != '') {{ $product->reference }} @else null @endif</td>
                    <td class="price align-middle white-space-nowrap text-center fw-bold text-body-tertiary ps-4">{{ $product->quantity }}</td>
                    <td class="tags align-middle review pb-2 ps-3" style="min-width:225px;">
                      @if($product->colors != '')
                        @foreach(unserialize($product->colors) as $colorGet)
                          <a class="text-decoration-none" href="#!"><span class="badge badge-tag me-2 mb-2">{{ $colorGet }}</span></a>
                        @endforeach
                      @endif
                    </td>
                    <td class="tags align-middle review pb-2 ps-3" style="min-width:225px;">
                      @if($product->sizes != '')
                        @foreach(unserialize($product->sizes) as $sizeGet)
                          <a class="text-decoration-none" href="#!"><span class="badge badge-tag me-2 mb-2">{{ $sizeGet }}</span></a>
                        @endforeach
                      @endif
                    </td>
                    <td class="price align-middle white-space-nowrap text-center fw-bold text-body-tertiary ps-4">@if ($product->status == 1) <span class="badge badge-tag me-2 mb-2 text-success">Valider</span> @else <span class="badge badge-tag me-2 mb-2 text-primary">En cours</span> @endif</td>
                    <td class="price align-middle white-space-nowrap text-center fw-bold text-body-tertiary ps-4">{{ $product->getPrice() }}</td>
                    <td class="price align-middle white-space-nowrap text-center fw-bold text-body-tertiary ps-4">{{ number_format($product->amount,2, ',','.') }} CFA</td>
                    <td class="align-middle white-space-nowrap text-end pe-0 ps-4 btn-reveal-trigger">
                      @if($product->supply_order->status == 1)
                        <span class="badge badge-phoenix badge-phoenix-success fs-10"> Payée </span>
                      @elseif($product->supply_order->status == 2)
                        @if ($product->status == 0)
                          <span class="me-3 text-success" data-feather="edit-3" data-bs-toggle="offcanvas" data-bs-target="#offcanvasUpdatePrice-{{ $product->id }}" aria-controls="offcanvasUpdatePrice-{{ $product->id }}" data-fa-transform="shrink-3"></span>
                        @else
                          <span class="badge badge-phoenix badge-phoenix-warning fs-10"> Non payée </span>
                        @endif
                      @endif
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>


    @foreach($supplyOrder->supply_order_products as $product)
      <div class="card-body p-0">
        <div class="p-4 code-to-copy">
          <!-- Right Offcanvas-->
          <div class="offcanvas offcanvas-end" id="offcanvasUpdatePrice-{{ $product->id }}" tabindex="-1" aria-labelledby="offcanvasRightLabel">
            <div class="offcanvas-header">
              <h5 id="offcanvasRightLabel">Entrer le prix du produit</h5><button class="btn-close text-reset" type="button" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
              <form method="POST" action="{{ route('magasin.devis-produits.updatePrice',$product->id) }}" enctype="multipart/form-data" >
                @csrf
                {{ method_field('PUT') }}
                <input type="hidden" name="supply_order_id" value="{{ $supplyOrder->id }}">

                <div class="mb-3 text-start">
                    <label class="form-label" for="price">Prix du produit</label>
                    <input id="price" type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') ?? $product->price }}" placeholder="Prix du produit" required autocomplete="price">
                    @error('price')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                </div>

                <button class="btn btn-primary w-100 mb-3" type="submit">Modifier le prix du produit</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    @endforeach


    @foreach($supplyOrder->supply_order_products  as $product)
      <div class="modal fade" id="DeleteCompte-{{ $product->id }}" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title text-danger" id="exampleModalLabel">Suppresion de produit</h5><button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close"><svg class="svg-inline--fa fa-xmark fs-9" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="xmark" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path fill="currentColor" d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z"></path></svg><!-- <span class="fas fa-times fs-9"></span> Font Awesome fontawesome.com --></button>
            </div>
            <form action="{{ route('magasin.devis-produits.destroy',$product->id) }}" method="post">
              @csrf
              {{ method_field('DELETE') }}
              <input type="hidden" name="supply_order_id" value="{{ $supplyOrder->id }}">
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


    
    @foreach($supplyOrder->supply_order_products  as $product)
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
              <input type="text" placeholder="Designation" class="form-control @error('name') is-invalid @enderror" name="inputs[`+i+`][name]" value="{{ old('name') }}" autocomplete="name" autofocus>
            </td>
            <td class="city align-middle white-space-nowrap text-body-highlight ps-7 text-center">
              <input type="text" placeholder="Reference" class="form-control @error('reference') is-invalid @enderror" name="inputs[`+i+`][reference]" value="{{ old('reference') }}"  autocomplete="reference" autofocus>
            </td>
            <td class="email align-middle white-space-nowrap pe-5 text-center">
              <input type="number" placeholder="Quantite" class="form-control @error('quantite') is-invalid @enderror" name="inputs[`+i+`][qty]" value="{{ old('quantite') }}" autocomplete="quantite" autofocus>
            </td>
            <td class="email align-middle white-space-nowrap pe-5 text-center">
              <input id="colors" type="text" placeholder="Couleurs" class="form-control colors @error('colors') is-invalid @enderror" name="inputs[`+i+`][colors]" value="{{ old('colors') }}" autocomplete="colors" autofocus>
            </td>
            <td class="email align-middle white-space-nowrap pe-5 text-center">
              <input id="sizes" type="text" placeholder="Tailles" class="form-control sizes @error('sizes') is-invalid @enderror" name="inputs[`+i+`][sizes]" value="{{ old('sizes') }}" autocomplete="sizes" autofocus>
            </td>
            <td class="email align-middle white-space-nowrap pe-5 ml-3 text-center">
              <input type="file" class="form-control @error('image') is-invalid @enderror" name="inputs[`+i+`][image]" value="{{ old('image') }}" autocomplete="image" autofocus>
            </td>
            <td class="last-order align-middle white-space-nowrap text-body-tertiary text-center">
              <button type="button" class="btn btn-danger remove-table-row">
                <span class="fas fa-trash me-2"></span>
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

<script type="text/javascript">
  $(".colorsUpdate").tagsinput();
  $(".sizesUpdate").tagsinput();
</script>

@endsection