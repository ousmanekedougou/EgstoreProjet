@extends('layouts.app',['title' => 'commandes sous réservation'])

@section('main-content')
<div class="content">
  <div class="mb-9">
    <div class="row g-3 mb-4">
      <div class="col-auto">
        <h2 class="mb-0">Les commandes sous réservation </h2>
      </div>
    </div>
    <div id="orderTable" data-list='{"valueNames":["order","total","customer","payment_status","fulfilment_status","delivery_type","date"]}'>
      <div class="mb-4">
        <div class="row g-3">
          <div class="search-box" style="width: 70%;">
            <form class="position-relative"><input class="form-control search-input search" type="search" placeholder="Rechercer des réservations pro-format" aria-label="Search" />
              <span class="fas fa-search search-box-icon"></span>
            </form>
          </div>
          <div class="col-auto ms-auto">
            <button class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
              <span class="me-2" data-feather="plus"></span>Ajouter une réservation 
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
                <th class="sort white-space-nowrap align-middle pe-3" scope="col" data-sort="order" style="width:5%;">Nº RESERVES</th>
                <th class="sort align-middle text-center" scope="col" data-sort="total" style="width:100%;">TOTAL</th>
                <th class="sort align-middle ps-8" scope="col" data-sort="customer" style="width:28%; min-width: 250px;">CLIENTS</th>
                <th class="sort align-middle text-start pe-3" scope="col" data-sort="fulfilment_status" style="width:20%; min-width: 100px;">TELEPHONE</th>
                <th class="sort align-middle pe-3 text-center" scope="col" data-sort="payment_status" style="width:12%; min-width: 200px;">BON DE COMMANDE</th>
                <th class="sort align-middle pe-3" scope="col" data-sort="payment_status" style="width:10%;">STATUS</th>
                <th class="sort align-middle text-start pe-3" scope="col" data-sort="delivery_type" style="width:30%;">METHODES</th>
                <th class="sort align-middle text-center pe-3" scope="col" data-sort="date">DATE</th>
                <th class="sort align-middle text-end pe-0" scope="col" data-sort="date">ACTIONS</th>
              </tr>
            </thead>
            <tbody class="list" id="order-table-body">
              @foreach($reserves as $reserve)
                <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                  <td class="fs-9 align-middle px-0 py-3">
                    <div class="form-check mb-0 fs-8"><input class="form-check-input" type="checkbox" data-bulk-select-row='{"order":2453,"total":87,"customer":{"avatar":"/team/32.webp","name":"Carry Anna"},"payment_status":{"label":"Complete","type":"badge-phoenix-success","icon":"check"},"fulfilment_status":{"label":"Cancelled","type":"badge-phoenix-secondary","icon":"x"},"delivery_type":"Cash on delivery","date":"Dec 12, 12:56 PM"}' /></div>
                  </td>
                  <td class="order align-middle white-space-nowrap py-0"><a class="fw-semibold" href="{{ route('magasin.reserve.show',$reserve->id) }}">Nº-{{ str_pad($reserve->order, 5, '0', STR_PAD_LEFT) }}</a></td>
                  <td class="total align-middle text-center fw-semibold text-body-highlight"><b>{{ number_format($reserve->amount,2, ',','.') }}</b></td>
                  <td class="customer align-middle white-space-nowrap ps-8">
                    <a class="d-flex align-items-center text-body" href="{{ route('magasin.reserve.show',$reserve->id) }}">
                      <div class="avatar avatar-m"><img class="rounded-circle" src="@if($reserve->user_id != '' ) {{Storage::url($reserve->user->image)}} @else https://ui-avatars.com/api/?name=@if($reserve->user_id == '' && $reserve->client_id == '') {{ $reserve->name }} @elseif($reserve->user_id != '') {{ $reserve->user->name }} @elseif($reserve->client_id != '') {{ $reserve->client->name }} @endif @endif" alt="" /></div>
                      <h6 class="mb-0 ms-3 text-body">@if($reserve->user_id == '' && $reserve->client_id == '') {{ $reserve->name }} @elseif($reserve->user_id != '') {{ $reserve->user->name }} @elseif($reserve->client_id != '') {{ $reserve->client->name }} @endif</h6>
                    </a>
                  </td>
                  <td class="fulfilment_status align-middle white-space-nowrap text-start fw-bold text-body-tertiary">@if($reserve->user_id == '' && $reserve->client_id == '') {{ $reserve->phone }} @elseif($reserve->user_id != '') {{ $reserve->user->phone }} @elseif($reserve->client_id != '') {{ $reserve->client->phone }} @endif</td>
                  <td class="total align-middle text-center fw-semibold text-body-highlight">@if($reserve->bon_commande != ''){{ $reserve->bon_commande }} @else Pas de bon @endif</td>
                  <td class="payment_status align-middle white-space-nowrap text-start fw-bold text-body-tertiary">
                    <span class="badge badge-phoenix fs-10 @if ($reserve->bagages->count() > 0)   @if($reserve->status == 1) badge-phoenix-success @elseif($reserve->status == 2) badge-phoenix-info @else badge-phoenix-warning @endif @else badge-phoenix-secondary @endif">
                      <span class="badge-label">@if ($reserve->bagages->count() > 0)  @if($reserve->status == 1) Terminé @elseif($reserve->status == 2) En cours @else Annulé @endif  @endif</span>
                      <span class="ms-1" 
                      @if ($reserve->bagages->count() > 0) 
                        @if($reserve->status == 1)
                          data-feather="check" 
                        @elseif($reserve->status == 2)
                          data-feather="chevrons-right"
                        @else 
                        data-feather="x"
                        @endif
                      @endif
                      style="height:12.8px;width:12.8px;"></span>
                      
                      
                    </span>
                  </td>
                  <td class="delivery_type align-middle white-space-nowrap text-body fs-9 text-center">
                    @if ($reserve->bagages->count() > 0) 
                      @if ($reserve->methode == 1)
                        <span class="text-info">Wave</span>
                      @elseif ($reserve->methode == 2)
                        <span class="text-warning">Orange Money</span>
                      @elseif ($reserve->methode == 3)
                        <span class="text-success">En cache</span>
                      @else
                        Non paye
                      @endif
                    @else
                    0 commande
                    @endif
                  </td>
                  <td class="date align-middle white-space-nowrap text-body-tertiary fs-9 ps-4 text-end">{{date('d-m-Y', strtotime( $reserve->date ))}}</td>
                  <td class=" align-middle white-space-nowrap text-body-tertiary fs-9 ps-4 text-end">
                    @if($reserve->status == 1)
                      <a href="{{ route('magasin.reserve.edit',$reserve->slug) }}" class="me-3 text-success" data-fa-transform="shrink-3"><span class="fs-7" data-feather="file-text"></span></a>
                    @elseif($reserve->status != 1)
                      @if ($reserve->bagages->count() > 0)
                        <span class="me-3 text-info fs-7" data-feather="shopping-bag" data-bs-toggle="modal" data-bs-target="#OrderState-{{ $reserve->id }}" data-fa-transform="shrink-3"></span>
                      @endif
                    @endif
                    <span class="me-2 text-danger fs-7" data-feather="trash-2" data-bs-toggle="modal" data-bs-target="#DeleteCompte-{{ $reserve->id }}" data-fa-transform="shrink-3"></span>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        {{ $reserves->links('vendor.pagination.bootstrap-5') }}
      </div>
    </div>
  </div>


  <div class="card-body p-0">
      <div class="p-4 code-to-copy">
        <!-- Right Offcanvas-->
        <div class="offcanvas offcanvas-end" id="offcanvasRight" tabindex="-1" aria-labelledby="offcanvasRightLabel">
          <div class="offcanvas-header">
            <h5 id="offcanvasRightLabel">Ajouter une commande sous pro-format</h5><button class="btn-close text-reset" type="button" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">
            <form  method="POST" action="{{ route('magasin.reserve.store') }}" >
              @csrf
              <div class="mb-3 text-start">
                <label class="form-label" for="bon_commande">Bon de commande (Facultatif)</label>
                <input id="bon_commande" type="text" class="form-control @error('bon_commande') is-invalid @enderror" name="bon_commande" value="{{ old('bon_commande') }}" placeholder="Bon de commande (Facultatif)" autocomplete="bon_commande">

                @error('bon_commande')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              <div class="mb-3 text-start">
                  <label class="form-label" for="name">Prenom et nom de votre client</label>
                  <input id="name" type="text" placeholder="Prenom et nom de votre client" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                  @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>
              <div class="mb-3 text-start">
                  <label class="form-label" for="email">Adresse email de votre client</label>
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="email@gmail.com" required autocomplete="email">

                  @error('email')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>
              <div class="mb-3 text-start">
                  <label class="form-label" for="phone">Numero de telephone de votre client</label>
                  <input id="phone" type="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" placeholder="Numero de telephone de votre client" required autocomplete="phone">

                  @error('phone')
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


    @foreach($reserves as $reserve)
      <div class="modal fade" id="DeleteCompte-{{ $reserve->id }}" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title text-danger" id="exampleModalLabel">Suppresion de reservation</h5><button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close"><svg class="svg-inline--fa fa-xmark fs-9" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="xmark" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path fill="currentColor" d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z"></path></svg><!-- <span class="fas fa-times fs-9"></span> Font Awesome fontawesome.com --></button>
            </div>
            <form action="{{ route('magasin.reserve.destroy',$reserve->id) }}" method="post">
              @csrf
              {{ method_field('DELETE') }}
              <div class="modal-body">
                <p class="text-body-tertiary lh-lg mb-3"> Etes vous sure de bien vouloire supprimer cette commande {{$reserve->name}} </p>
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


    @foreach($reserves as $reserve)
      <div class="modal fade" id="OrderState-{{ $reserve->id }}" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Status de la reservation</h5><button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close"><svg class="svg-inline--fa fa-xmark fs-9" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="xmark" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path fill="currentColor" d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z"></path></svg><!-- <span class="fas fa-times fs-9"></span> Font Awesome fontawesome.com --></button>
            </div>
            <form action="{{ route('magasin.reserve.update',$reserve->id) }}" method="post">
              @csrf
              {{ method_field('PUT') }}
              <div class="modal-body">
                <p class="text-body-tertiary lh-lg mb-3"> Reservation Nº {{ $reserve->order }} de  {{$reserve->name}} </p>
                <p class="text-body-tertiary lh-lg mb-3">
                  <h6 class="mb-2">Selectionner un status</h6>
                  <select onchange="enableBrand(this)" class="form-select mb-4 @error('status') is-invalid @enderror" name="status" id="status"aria-label="delivery type">
                    <option value=""></option>
                    <option value="1" @if($reserve->status == 1) selected="" @endif>Terminé</option>
                    <option value="2" @if($reserve->status == 2) selected="" @endif>En cours</option>
                    <option value="3" @if($reserve->status == 3) selected="" @endif>Annulé</option>
                  </select>
                  @error('status')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </p>
                <div class="mb-3 text-start d-none" id="clientNone" data-id="{{ $reserve->id }}">
                  <label class="form-label" for="email">Methode de paiement</label> <br>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input text-primary @error('methode') is-invalid @enderror" @if($reserve->methode == 1) checked="" @endif id="inlineRadioA-{{ $reserve->id }}" type="radio" name="methode" value=" 1 ">
                    <label class="form-check-label text-primary" for="inlineRadioA-{{ $reserve->id }}" style="margin-top: 2px;">Wave</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input text-warning @error('methode') is-invalid @enderror" @if($reserve->methode == 2) checked="" @endif id="inlineRadioB-{{ $reserve->id }}" type="radio" name="methode" value=" 2 ">
                    <label class="form-check-label text-warning" for="inlineRadioB-{{ $reserve->id }}" style="margin-top: 2px;">Orange Money</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input text-success @error('methode') is-invalid @enderror" @if($reserve->methode == 3) checked="" @endif id="inlineRadioC-{{ $reserve->id }}" type="radio" name="methode" value=" 3 ">
                    <label class="form-check-label text-success" for="inlineRadioC-{{ $reserve->id }}" style="margin-top: 2px;">Cache</label>
                  </div>
                  @error('methode')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
              <div class="modal-footer">
                <button class="btn btn-success" type="submit">Enregistre le status</button>
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

<script>
    function enableBrand(answer){
      if (answer.value == 1) {
          document.getElementById('clientNone').classList.remove('d-none')
      }else{
          document.getElementById('clientNone').classList.add('d-none')
      }
    }
</script>