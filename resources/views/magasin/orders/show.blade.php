@extends('layouts.app',['title' => 'affichage des commande'])

@section('main-content')
  <div class="content">
    <div class="mb-9">
      <h2 class="mb-0"><span> Nº {{ $order->order }} - BC : {{ $order->bon_commande }}</span></h2>
      <div class="d-sm-flex flex-between-center mb-3">
        <p class="text-body-secondary lh-sm mb-0 mt-2 mt-sm-0">
          Client : <a class="fw-bold" href="#!" style="margin-right: 15px;">  @if($order->user_id == '' && $order->client_id == '') {{ $order->name }} @elseif($order->user_id != '') {{ $order->user->name }} @elseif($order->client_id != '') {{ $order->client->name }} @endif</a>
          Telepone : <a class="fw-bold" href="#!"> @if($order->user_id == '' && $order->client_id == '') {{ $order->phone }} @elseif($order->user_id != '') {{ $order->user->phone }} @elseif($order->client_id != '') {{ $order->client->phone }} @endif</a>
        </p>
        <div class="d-flex">
          <a class="btn btn-primary" href="{{ route('magasin.commande.edit',$order->slug) }}" target="_blank" class="btn btn-link text-primary pe-3 ps-0 text-body">
            <span class="me-2 fas fa-file-pdf"></span>Voir la facture
          </a>
        </div>
      </div>
      <div class="row g-5 gy-7">
        <div class="col-12 col-xl-8 col-xxl-9">
          <div id="orderTable" data-list='{"valueNames":["products","color","size","price","quantity","total"]}'>
            <div class="table-responsive scrollbar">
              <table class="table fs-9 mb-0 border-top border-translucent">
                <thead>
                  <tr>
                    <th class="sort white-space-nowrap align-middle fs-10" scope="col"></th>
                    <th class="sort white-space-nowrap align-middle" scope="col" style="min-width:200px;" data-sort="products">PRODUITS</th>
                    <th class="sort align-middle" scope="col" style="width:80px;">COULEURS</th>
                    <th class="sort align-middle" scope="col" style="width:50px;">TAILLES</th>
                    <th class="sort align-middle text-end ps-4" scope="col" data-sort="price" style="width:100px;">PRIX</th>
                    <th class="sort align-middle text-end ps-4" scope="col" data-sort="quantity" style="width:100px;">QUANTITES</th>
                    <th class="sort align-middle text-end ps-4" scope="col" data-sort="quantity" style="width:100px;">UNITES</th>
                    <th class="sort align-middle text-end ps-4" scope="col" data-sort="total" style="width:100px;">TOTAL</th>
                  </tr>
                </thead>
                <tbody class="list" id="order-table-body">
                  @foreach(unserialize($order->products) as $product)
                    <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                      <td class="align-middle white-space-nowrap py-2">
                        <span class="d-block border border-translucent rounded-2">
                          <img src="{{Storage::url($product[0])}}" alt="" width="53" />
                        </span>
                    </td>
                      <td class="products align-middle py-0"><span class="fw-semibold line-clamp-2 mb-0">{{$product[1]}}</span></td>
                      <td class="color align-middle white-space-nowrap fs-9 text-body">@if($product[4] != ''){{$product[4]}} @else Null @endif</td>
                      <td class="size align-middle white-space-nowrap text-body-tertiary fs-9 fw-semibold">@if($product[5] != ''){{$product[5]}} @else Null @endif</td>
                      <td class="price align-middle text-body fw-semibold text-end py-0 ps-4">{{$product[2]}}</td>
                      <td class="quantity align-middle text-center py-0 ps-4 text-body-tertiary">{{$product[3]}}</td>
                      <td class="quantity align-middle text-center py-0 ps-4 text-body-tertiary">{{$product[7]}}  {{$product[6]}}</td>
                      <td class="total align-middle fw-bold text-body-highlight text-end py-0 ps-4" style="width: 100%;">{{$product[2] * $product[3]}}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
          <div class="d-flex flex-between-center py-3 border-bottom border-translucent mb-6">
            <p class="text-body-emphasis fw-semibold lh-sm mb-0">Montant total :</p>
            <p class="text-body-emphasis fw-bold lh-sm mb-0">{{ $order->amount }} CFA</p>
          </div>
        </div>
        <div class="col-12 col-xl-4 col-xxl-3">
          <div class="row">
          @if ($order->status == 1)
            <div class="col-12">
              <div class="card mb-3">
                <div class="card-body">
                  <h3 class="card-title mb-4">Résumé</h3>
                  <div>
                    <div class="d-flex justify-content-between">
                      <p class="text-body fw-semibold">Nombre d'articles :</p>
                      <p class="text-body-emphasis fw-semibold">{{ $order->count() }}</p>
                    </div>
                    <div class="d-flex justify-content-between">
                      <p class="text-body fw-semibold">Status :</p>
                      <p class="text-success fw-semibold">Payé</p>
                    </div>
                    <div class="d-flex justify-content-between">
                      <p class="text-body fw-semibold">Méthode :</p>
                      <p class="text-body-emphasis fw-semibold">
                        @if ($order->methode == 1)
                          <span class="text-info">Wave</span>
                        @elseif ($order->methode == 2)
                          <span class="text-warning">Orange money</span>
                        @elseif ($order->methode == 3)
                          <span class="text-success">Cache</span>
                        @endif
                      </p>
                    </div>
                  </div>
                  <div class="d-flex justify-content-between border-top border-translucent border-dashed pt-4">
                    <h4 class="mb-0">Total :</h4>
                    <h4 class="mb-0">{{ $order->amount }} CFA</h4>
                  </div>
                </div>
              </div>
            </div>
          @else  
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title mb-4">Paiement de la commande</h4>
                  @if($order->type != 2)
                  <form action="{{ route('magasin.commande.update',$order->id) }}" method="post">
                    @csrf
                    {{ method_field('PUT') }}
                    <div class="modal-body">
                      <p class="text-body-tertiary lh-lg mb-3"> Commande Nº {{ $order->order }} </p>
                      <p class="text-body-tertiary lh-lg mb-3">
                        <h6 class="mb-2">Selectionner un status</h6>
                        <select onchange="enableBrand(this)" class="form-select mb-4 @error('status') is-invalid @enderror" name="status" id="status"aria-label="delivery type">
                          <option value=""></option>
                          <option class="text-success" value="1" @if($order->status == 1) selected="" @endif>Terminé</option>
                          <option class="text-primary" value="2" @if($order->status == 2) selected="" @endif>En cours</option>
                          <option class="text-danger" value="3" @if($order->status == 3) selected="" @endif>Annulé</option>
                        </select>
                        @error('status')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </p>
                      <div class="mb-3 text-start d-none" id="clientNone" data-id="{{ $order->id }}">
                        <label class="form-label" for="email">Methode de paiement</label> <br>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input text-primary @error('methode') is-invalid @enderror" @if($order->methode == 1) checked="" @endif id="inlineRadioA-{{ $order->id }}" type="radio" name="methode" value=" 1 ">
                          <label class="form-check-label text-primary" for="inlineRadioA-{{ $order->id }}" style="margin-top: 2px;">Wave</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input text-warning @error('methode') is-invalid @enderror" @if($order->methode == 2) checked="" @endif id="inlineRadioB-{{ $order->id }}" type="radio" name="methode" value=" 2 ">
                          <label class="form-check-label text-warning" for="inlineRadioB-{{ $order->id }}" style="margin-top: 2px;">Orange M</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input text-success @error('methode') is-invalid @enderror" @if($order->methode == 3) checked="" @endif id="inlineRadioC-{{ $order->id }}" type="radio" name="methode" value=" 3 ">
                          <label class="form-check-label text-success" for="inlineRadioC-{{ $order->id }}" style="margin-top: 2px;">Cache</label>
                        </div>
                        @error('methode')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button class="btn btn-success" style="width: 100%;" type="submit">Enregistre le status</button>
                    </div>
                  </form>
                  @else
                   Cette commande est a crédit
                  @endif
                </div>
              </div>
            </div>
          @endif
          </div>
        </div>
      </div>
    </div>
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