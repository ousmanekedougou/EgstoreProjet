@extends('layouts.app',['title' => 'acceuil'])
{{ProductStockAlert()}}
{{ProductStockVide()}}
@section('main-content')
  <div class="content">

    <div class="pb-5">
      <div class="row g-4">
        <div class="col-12 col-xxl-6">
          <div class="mb-8">
            <h2 class="mb-2">Tableau de bord du commerce électronique</h2>
            <h5 class="text-body-tertiary fw-semibold">Voici ce qui se passe actuellement dans votre entreprise</h5>
            @if($paimentNotification)
              <div class="alert alert-warning alert-dismissible fade show" role="alert">
                  <i class="mdi mdi-alert-outline me-2"></i>
                      <b>Attention : </b>  {{$paimentNotification}}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif
          </div>
          <div class="row align-items-center g-4">
            <div class="col-12 col-md-auto">
              <div class="d-flex align-items-center"><span class="fa-stack" style="min-height: 46px;min-width: 46px;"><span class="fa-solid fa-square fa-stack-2x dark__text-opacity-50 text-primary-light" data-fa-transform="down-4 rotate--10 left-4"></span><span class="fa-solid fa-circle fa-stack-2x stack-circle text-stats-circle-primary" data-fa-transform="up-4 right-3 grow-2"></span><span class="fa-stack-1x fa-solid fa-user-circle text-primary " data-fa-transform="shrink-2 up-8 right-6"></span></span>
                <div class="ms-3">
                  <h4 class="mb-0">{{ $clients }} Clients</h4>
                  <p class="text-body-secondary fs-9 mb-0"></p>
                </div>
              </div>
            </div>
            <div class="col-12 col-md-auto">
              <div class="d-flex align-items-center"><span class="fa-stack" style="min-height: 46px;min-width: 46px;"><span class="fa-solid fa-square fa-stack-2x dark__text-opacity-50 text-success-light" data-fa-transform="down-4 rotate--10 left-4"></span><span class="fa-solid fa-circle fa-stack-2x stack-circle text-stats-circle-success" data-fa-transform="up-4 right-3 grow-2"></span><span class="fa-stack-1x fa-solid fa-shopping-bag text-success " data-fa-transform="shrink-2 up-8 right-6"></span></span>
                <div class="ms-3">
                  <h4 class="mb-0">{{ $commandes }} Commandes</h4>
                  <p class="text-body-secondary fs-9 mb-0"></p>
                </div>
              </div>
            </div>
            <div class="col-12 col-md-auto">
              <div class="d-flex align-items-center"><span class="fa-stack" style="min-height: 46px;min-width: 46px;"><span class="fa-solid fa-square fa-stack-2x dark__text-opacity-50 text-warning-light" data-fa-transform="down-4 rotate--10 left-4"></span><span class="fa-solid fa-circle fa-stack-2x stack-circle text-stats-circle-warning" data-fa-transform="up-4 right-3 grow-2"></span><span class="fa-stack-1x fa-solid fa-file-alt text-warning " data-fa-transform="shrink-2 up-8 right-6"></span></span>
                <div class="ms-3">
                  <h4 class="mb-0">{{ $bons }} Bons</h4>
                  <p class="text-body-secondary fs-9 mb-0"></p>
                </div>
              </div>
            </div>
            <div class="col-12 col-md-auto">
              <div class="d-flex align-items-center"><span class="fa-stack" style="min-height: 46px;min-width: 46px;"><span class="fa-solid fa-square fa-stack-2x dark__text-opacity-50 text-danger-light" data-fa-transform="down-4 rotate--10 left-4"></span><span class="fa-solid fa-circle fa-stack-2x stack-circle text-stats-circle-danger" data-fa-transform="up-4 right-3 grow-2"></span><span class="fa-stack-1x fa-solid fa-file text-danger " data-fa-transform="shrink-2 up-8 right-6"></span></span>
                <div class="ms-3">
                  <h4 class="mb-0">{{ $pro_format }} Résérvations</h4>
                  <p class="text-body-secondary fs-9 mb-0"></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div id="products" data-list='{"valueNames":["product","price","category","tags","vendor","time"]}'>
      <div class="mb-4">
        <div class="search-box" style="width: 100%;">
          <form class="position-relative">
            <input class="form-control search-input search" type="search" placeholder="Rechercher un produit" aria-label="Search" />
            <span class="fas fa-search search-box-icon"></span>
          </form>
        </div>
      </div>
      <div class="mx-n4 px-4 mx-lg-n6 px-lg-6 bg-body-emphasis border-top border-bottom border-translucent position-relative top-1">
        <div class="table-responsive scrollbar mx-n1 px-1">
          <table class="table fs-9 mb-0">
            <thead>
              <tr>
                <th class="sort white-space-nowrap align-middle fs-10" scope="col" style="width:70px;"></th>
                <th class="sort white-space-nowrap align-middle ps-4" scope="col" style="width:350px;" data-sort="product">PRODUITS</th>
                <th class="sort align-middle text-end ps-4" scope="col" data-sort="category" style="width:150px;">REFERENCES</th>
                <th class="sort align-middle text-end ps-4" scope="col" data-sort="price" style="width:150px;">PRIX UNITAIRE</th>
                <th class="sort align-middle text-end ps-4" scope="col" data-sort="time" style="width:150px;">QUANTITES</th>
                <th class="sort align-middle ps-3 w-auto" scope="col" data-sort="tags">UNITES</th>
                <th class="sort align-middle ps-3 w-auto" scope="col" data-sort="tags" style="width:75px;">COULEURS & TAILLES</th>
                {{--<th class="sort align-middle ps-3" scope="col" data-sort="vendor" style="width:100px;">TAILLES</th>--}}
                <th class="sort text-end align-middle pe-1 ps-4" scope="col">PANIERS</th>
              </tr>
            </thead>
            <tbody class="list" id="products-table-body">
              @foreach($products as $product)
                <tr class="position-static @if($product->quantity <= $product->qty_alert ) bg-warning  @elseif($product->quantity == 0) bg-danger @endif">
                  <td class="align-middle white-space-nowrap py-0"><a class="d-block border border-translucent rounded-2" href="{{ route('magasin.produit.edit',$product->id) }}"><img src="{{Storage::url($product->image)}}" alt="" width="53" /></a></td>
                  <td class="product align-middle ps-4"><a class="fw-semibold line-clamp-3 mb-0 @if( $product->quantity < 10 ) text-white @endif" href="{{ route('magasin.produit.edit',$product->id) }}">{{ $product->name }}</a></td>
                  <td class="price align-middle white-space-nowrap text-center fw-bold @if( $product->quantity < 10 ) text-white @else text-body-tertiary  @endif ps-4">{{ $product->reference }}</td>
                  
                  <td class="price align-middle white-space-nowrap text-center fw-bold @if( $product->quantity < 10 ) text-white @else text-body-tertiary  @endif ps-4">{{ $product->getPrice() }}</td>
                  
                  <form id="ajouterAuPanier-{{ $product->id }}" action="{{ route('magasin.panier.store') }}" method="POST" class="d-none">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">  
                    <td class="price align-middle white-space-nowrap text-left fw-bold @if( $product->quantity < 10 ) text-white @else text-body-tertiary  @endif ps-4">
                      <div class="input-group w-auto">
                        <span class="input-group-text text-center p-1">{{ $product->quantity }}</span>
                        <input class="form-control p-1" type="quantity" name="qty" aria-label="qty" required/>
                      </div>
                    </td>
                     <td class="align-middle review ps-3">
                        @if($product->vendor_systems->count() > 0)
                        <select class="form-select form-select-sm p-1" style="width: 75px;" aria-label="Default select example .form-select-sm" name="vendor_system" required>
                        <option>Choisir</option>
                          @foreach($product->vendor_systems as $vendor_system)
                            <option value="{{ $vendor_system->id }}" required> {{ $vendor_system->unite->code }} </option>
                          @endforeach
                        </select>
                      @else 
                        Null
                      @endif
                    </td>
                    <td class="align-middle review ps-3 text-center">
                      @if($product->product_color_sizes->count() > 0)
                        <select class="form-select form-select-sm p-1" style="width: 110px;" aria-label="Default select example .form-select-sm" name="getProductColorSize">
                        <option>Choisir</option>
                          @foreach($product->product_color_sizes as $getProductColorSize)
                            @if ($getProductColorSize->quantity > 0)
                              <option value="{{ $getProductColorSize->id }}">
                                <span class=""> {{$getProductColorSize->color->name}}</span> 
                                <span class=""> {{$getProductColorSize->size->name}}</span> 
                                <span class=""> {{$getProductColorSize->quantity}}</span> 
                              </option>
                            @endif
                          @endforeach
                        </select>
                      @else 
                        Null
                      @endif
                    </td>
                    {{-- 
                    <td class="align-middle review ps-3" >
                      @if($product->sizes->count())
                      <select class="form-select form-select-sm p-1" style="width: 75px;" aria-label=".form-select-sm example" name="size">
                      <option value="">Choisir</option>
                        @foreach($product->sizes as $sizeGet)
                          <option value="{{ $sizeGet->id }}"> {{$sizeGet->name}} </option>
                        @endforeach
                      </select>
                      @else 
                        Null
                      @endif
                    </td>
                     --}}
                    <td class="align-middle white-space-nowrap text-end pe-3 ps-4 btn-reveal-trigger">
                      @if($product->quantity > 0)
                        <a href="{{ route('magasin.panier.store') }}" onclick="event.preventDefault(); document.getElementById('ajouterAuPanier-{{ $product->id }}').submit();" data-fa-transform="shrink-3">
                          <span class="badge badge-phoenix fs-10 me-3 @if( $product->quantity < 10 ) badge-phoenix-secondary @else badge-phoenix-warning @endif"><span class="badge-label">Panier</span><span class="ms-1" data-feather="shopping-cart" style="height:12.8px;width:12.8px;"></span></span>
                        </a>
                      @else
                        <span class="text-white" style="margin-right: 4px;">Indisponible</span>
                      @endif
                    </td>
                  </form>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    @include('layouts.footer_admin')
  </div>
@endsection





