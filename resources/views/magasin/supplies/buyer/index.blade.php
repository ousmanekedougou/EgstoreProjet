@extends('layouts.app',['title' => 'commande des fournisseurs'])
@section('headSection')
@endsection
@section('main-content')
<div class="content">
  <div class="mb-9">
    <div class="row g-3 mb-4">
      <div class="col-auto">
        <h2 class="mb-3">Mes commandes du magasin @if($supplie->magasin_id != ''){{ $supplie->magasin->name }}@else {{ $supplie->name }} @endif</h2>
        <div class="d-sm-flex flex-between-center mb-0">
          <p class="text-body-secondary lh-sm mb-0 mt-2 mt-sm-0">
            Email : <a class="fw-bold" href="#!" style="margin-right: 15px;"> @if($supplie->magasin_id != ''){{ $supplie->magasin->email }}@else {{ $supplie->email }} @endif</a>
            Téléphone : <a class="fw-bold" href="#!"> @if($supplie->magasin_id != ''){{ $supplie->magasin->phone }}@else {{ $supplie->phone }} @endif</a>
          </p>
        </div>
      </div>
    </div>
    <div id="orderTable" data-list='{"valueNames":["order","total","customer","payment_status","fulfilment_status","delivery_type","date"]}'>
      <div class="mb-4">
        <div class="row g-3">
          <div class="search-box" style="width: 70%;">
            <form class="position-relative"><input class="form-control search-input search" type="search" placeholder="Rechercer" aria-label="Search" />
              <span class="fas fa-search search-box-icon"></span>
            </form>
          </div>
          <div class="col-auto ms-auto">
            <button class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
              <span data-feather="plus" class="me-2"></span>Ajouter une nouvelle commande
            </button>
          </div>
        </div>
      </div>
      <div class="mx-n4 px-4 mx-lg-n6 px-lg-6 bg-body-emphasis border-top border-bottom border-translucent position-relative top-1">
        <div class="table-responsive scrollbar mx-n1 px-1">
          <table class="table table-sm fs-9 mb-0">
            <thead>
              <tr>
                <th class="white-space-nowrap fs-9 align-middle ps-0" style="width:26px;">
                  <div class="form-check mb-0 fs-8"><input class="form-check-input" id="checkbox-bulk-order-select" type="checkbox" data-bulk-select='{"body":"order-table-body"}' /></div>
                </th>
                <th class="sort white-space-nowrap align-middle pe-3" scope="col" data-sort="order" style="width:5%;">Nº COMMANDES</th>
                <th class="sort align-middle text-start" scope="col" data-sort="total" style="width:30%;">TOTAL</th>
                <th class="sort align-middle text-start ps-8" scope="col" data-sort="customer" style="width:108%; min-width: 50px;">BON DE COMMANDE</th>
                <th class="sort align-middle pe-3" scope="col" data-sort="payment_status" style="width:10%;">STATUS</th>
                <th class="sort align-middle text-start pe-3" scope="col" data-sort="delivery_type" style="width:30%;">METHODES</th>
                <th class="sort align-middle text-center pe-3" scope="col" data-sort="livraison">LIVRAISON</th>
                <th class="sort align-middle text-center pe-3" scope="col" data-sort="date">DATE DEMANDE</th>
                <th class="sort align-middle text-center pe-3" scope="col" data-sort="date_livraison">DATE LIVRAISON</th>
                <th class="sort align-middle text-end pe-0" scope="col" data-sort="date">ACTIONS</th>
              </tr>
            </thead>
            <tbody class="list" id="order-table-body">
              @foreach($orders as $order)
                <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                  <td class="fs-9 align-middle px-0 py-3">
                    <div class="form-check mb-0 fs-8"><input class="form-check-input" type="checkbox" data-bulk-select-row='{"order":2453,"total":87,"customer":{"avatar":"/team/32.webp","name":"Carry Anna"},"payment_status":{"label":"Complete","type":"badge-phoenix-success","icon":"check"},"fulfilment_status":{"label":"Cancelled","type":"badge-phoenix-secondary","icon":"x"},"delivery_type":"Cash on delivery","date":"Dec 12, 12:56 PM"}' /></div>
                  </td>
                  <td class="order align-middle white-space-nowrap py-0"><a class="fw-semibold" href="{{ route('magasin.devis-produits.show',$order->slug) }}">Nº-{{ str_pad($order->order, 5, '0', STR_PAD_LEFT) }}</a></td>
                  <td class="total align-middle text-center fw-semibold text-body-highlight"><b>{{ number_format($order->amount,2, ',','.') }}</b></td>
                  <td class="customer align-middle white-space-nowrap ps-8">
                    <a class="d-flex align-items-center text-body" href="{{ route('magasin.devis-produits.show',$order->slug) }}">
                      <h6 class="mb-0 ms-3 text-body">{{ $order->bon_commande }}</h6>
                    </a>
                  </td>
                  <td class="payment_status align-middle white-space-nowrap text-start fw-bold text-body-tertiary">
                    <span class="badge badge-phoenix fs-10 @if ($order->supply_order_products->count() > 0)   @if($order->status == 1) badge-phoenix-success @elseif($order->status == 2) badge-phoenix-info @else badge-phoenix-warning @endif @else badge-phoenix-secondary @endif">
                      <span class="badge-label">@if ($order->supply_order_products->count() > 0)  @if($order->status == 1) Terminé @elseif($order->status == 2) En cours @else Annulé @endif @else 0 produits  @endif</span>
                      <span class="ms-1" 
                      @if ($order->supply_order_products->count() > 0) 
                        @if($order->status == 1)
                          data-feather="check" 
                        @elseif($order->status == 2)
                          data-feather="chevrons-right"
                        @else 
                        data-feather="x"
                        @endif
                      @endif
                      style="height:12.8px;width:12.8px;"></span>
                      
                      
                    </span>
                  </td>
                  <td class="delivery_type align-middle white-space-nowrap text-body fs-9 text-center">
                    @if ($order->supply_order_products->count() > 0) 
                      @if ($order->methode == 1)
                        <span class="text-info">Wave</span>
                      @elseif ($order->methode == 2)
                        <span class="text-warning">Orange Money</span>
                      @elseif ($order->methode == 3)
                        <span class="text-success">En cache</span>
                      @else
                        Non paye
                      @endif
                    @else
                    0 commande
                    @endif
                  </td>
                  <td class="livraison align-middle white-space-nowrap text-body-tertiary fs-9 ps-4 text-start">
                    <span class="badge badge-phoenix fs-10 @if ($order->supply_order_products->count() > 0)   @if($order->status == 1) badge-phoenix-success @elseif($order->status == 2) badge-phoenix-info @else badge-phoenix-warning @endif @else badge-phoenix-secondary @endif">
                      <span class="badge-label">@if ($order->supply_order_products->count() > 0)  @if($order->delivery == 1) Livraison reçue @elseif($order->delivery == 2) En cours @else Annulé @endif @else 0 produits  @endif</span>
                        <span class="ms-1" 
                          @if ($order->supply_order_products->count() > 0) 
                            @if($order->status == 1)
                              data-feather="check" 
                            @elseif($order->status == 2)
                              data-feather="chevrons-right"
                            @else 
                            data-feather="x"
                            @endif
                          @endif
                          style="height:12.8px;width:12.8px;"
                        >
                        </span>
                    </span>
                  </td>
                  <td class="date align-middle white-space-nowrap text-body-tertiary fs-9 ps-4 text-start">{{date('d-m-Y', strtotime( $order->created_at ))}}</td>
                  <td class="date_livraison align-middle white-space-nowrap text-body-tertiary fs-9 ps-4 text-start">{{date('d-m-Y', strtotime( $order->date ))}}</td>
                  <td class=" align-middle white-space-nowrap text-body-tertiary fs-9 ps-4 text-end">
                    @if($order->status == 1)
                      @if($order->delivery == 1)
                        <a target="_blank" href="{{ route('magasin.devis.edit',$order->slug) }}" class="me-3 text-success" data-fa-transform="shrink-3"><span data-feather="file-text" ></span></a>
                      @else
                        <span class="me-3 text-info" data-feather="truck" data-bs-toggle="modal" data-bs-target="#DevisDelivery-{{ $order->id }}" data-fa-transform="shrink-3"></span>
                      @endif
                    @elseif($order->status == 2)
                      <span class="me-3 text-success" data-feather="edit-3" data-bs-toggle="modal" data-bs-target="#OrderState-{{ $order->id }}" data-fa-transform="shrink-3"></span>
                      @if ($order->supply_order_products->count() > 0)
                        <span class="me-2 text-info" data-feather="shopping-bag" data-bs-toggle="modal" data-bs-target="#OrderPayment-{{ $order->id }}" data-fa-transform="shrink-3"></span>
                      @endif
                      @endif
                    <span class="me-2 text-danger" data-feather="trash-2" data-bs-toggle="modal" data-bs-target="#DeleteCompte-{{ $order->id }}" data-fa-transform="shrink-3"></span>
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
          <h5 id="offcanvasRightLabel">Ajouter une commande de devis</h5><button class="btn-close text-reset" type="button" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <form  method="POST" action="{{ route('magasin.devis.store') }}" >
            @csrf
            <input type="hidden" name="supply_id" value="{{ $supplie->id }}">
            <div class="mb-3 text-start">
              <label class="form-label" for="bon_commande">Bon de commande</label>
              <input id="bon_commande" type="text" class="form-control @error('bon_commande') is-invalid @enderror" name="bon_commande" value="{{ old('bon_commande') }}" placeholder="Bon de commande" autocomplete="bon_commande">

              @error('bon_commande')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>

            <div class="mb-3 text-start">
              <label class="form-label" for="delivery_date">Date de livraison</label>
                <input type="date" id="delivery_date" class="form-control @error('delivery_date') is-invalid @enderror" name="delivery_date" value="{{ old('delivery_date') }}" placeholder="dd/mm/yyyy" data-options='{"disableMobile":true,"dateFormat":"d/m/y"}' required autocomplete="delivery_date">

                @error('delivery_date')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <button class="btn btn-primary w-100 mb-3" type="submit">Enreistrer cette reservation</button>
          </form>
        </div>
      </div>
    </div>
  </div>


    @foreach($orders as $order)
      <div class="modal fade" id="DeleteCompte-{{ $order->id }}" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title text-danger" id="exampleModalLabel">Suppresion de la commande de devis</h5><button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close"><svg class="svg-inline--fa fa-xmark fs-9" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="xmark" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path fill="currentColor" d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z"></path></svg><!-- <span class="fas fa-times fs-9"></span> Font Awesome fontawesome.com --></button>
            </div>
            <form action="{{ route('magasin.devis.destroy',$order->id) }}" method="post">
              @csrf
              {{ method_field('DELETE') }}
              <input type="hidden" name="supply_id" value="{{ $supplie->id }}">
              <div class="modal-body">
                <p class="text-body-tertiary lh-lg mb-3"> Etes vous sure de bien vouloire supprimer cette commande {{$order->bon_commande}} </p>
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


    @foreach($orders as $order)
      <div class="modal fade" id="DevisDelivery-{{ $order->id }}" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Validation de la livraison du bon de commande  <br> Nº  {{ $order->bon_commande }}</h5><button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close"><svg class="svg-inline--fa fa-xmark fs-9" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="xmark" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path fill="currentColor" d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z"></path></svg><!-- <span class="fas fa-times fs-9"></span> Font Awesome fontawesome.com --></button>
            </div>
            <form action="{{ route('magasin.devis.create',$order->id) }}" method="post">
              @csrf
              {{ method_field('PUT') }}
              <input type="hidden" name="supply_id" value="{{ $supplie->id }}">
              <div class="modal-body">
                <p class="text-body-tertiary lh-lg mb-3">
                   Etes vous sure de bien vouloire confirmer la livraison cette commande Nº {{$order->bon_commande}} 
                </p>
                <table class="table">
                  <thead>
                    <tr>
                      <th style="width: 50%"> </th>
                      <th style="width: 50%"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="bg-body-highlight align-middle">
                        <h6 class="mb-0 text-body text-uppercase fw-bolder px-4 fs-9 lh-sm">Bon de commande</h6>
                      </td>
                      <td class="px-5 mb-0">{{ $order->bon_commande }}</td>
                    </tr>
                    <tr>
                      <td class="bg-body-highlight align-middle">
                        <h6 class="mb-0 text-body text-uppercase fw-bolder px-4 fs-9 lh-sm">Montan total</h6>
                      </td>
                      <td class="px-5 mb-0">{{ number_format($order->amount,2, ',','.') }} CFA</td>
                    </tr>
                    <tr>
                      <td class="bg-body-highlight align-middle">
                        <h6 class="mb-0 text-body text-uppercase fw-bolder px-4 fs-9 lh-sm">Date livraison</h6>
                      </td>
                      <td class="px-5 mb-0">{{date('d-m-Y', strtotime( $order->date ))}}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="modal-footer">
                <button class="btn btn-success" type="submit">Oui je veux bien</button>
                <button class="btn btn-outline-primary" type="button" data-bs-dismiss="modal">Anuller</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    @endforeach 


    @foreach($orders as $order)
      <div class="modal fade" id="OrderState-{{ $order->id }}" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Modifier le devis {{ $order->bon_commande }}</h5><button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close"><svg class="svg-inline--fa fa-xmark fs-9" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="xmark" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path fill="currentColor" d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z"></path></svg><!-- <span class="fas fa-times fs-9"></span> Font Awesome fontawesome.com --></button>
            </div>
            <form action="{{ route('magasin.devis.update',$order->id) }}" method="post">
              @csrf
              {{ method_field('PUT') }}
              <div class="modal-body">
                <p class="text-body-tertiary lh-lg mb-3"> Commande devis Nº {{ $order->order }} de  {{$order->name}} </p>
                
                <input type="hidden" name="supply_id" value="{{ $supplie->id }}">

                <div class="mb-3 text-start">
                  <label class="form-label" for="bon_commande">Bon de commande</label>
                  <input id="bon_commande" type="text" class="form-control @error('bon_commande') is-invalid @enderror" name="bon_commande" value="{{ old('bon_commande') ?? $order->bon_commande }}" placeholder="Bon de commande" autocomplete="bon_commande">

                  @error('bon_commande')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>

                <div class="mb-3 text-start">
                  <label class="form-label" for="delivery_date">Date de livraison</label>
                    <input type="date" id="delivery_date" class="form-control datetimepicker @error('delivery_date') is-invalid @enderror" name="delivery_date" value="{{ old('delivery_date') ?? $order->date }}" placeholder="dd/mm/yyyy" data-options='{"disableMobile":true,"dateFormat":"d/m/y"}' required autocomplete="delivery_date">

                    @error('delivery_date')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
              </div>
              <div class="modal-footer">
                <button class="btn btn-success" type="submit">Enregistre les modification</button>
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
@section('footerSection')
<script>
    function enableBrand(answer){
      if (answer.value == 1) {
          document.getElementById('clientNone').classList.remove('d-none')
      }else{
          document.getElementById('clientNone').classList.add('d-none')
      }
    }
</script>
@endsection