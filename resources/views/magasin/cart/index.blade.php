@extends('layouts.app',['title' => 'panier'])

@section('main-content')
<div class="content">
   
  <!-- ============================================-->
      <!-- <section> begin ============================-->
      <section class="pt-5 pb-9">
        <div class="container-small cart">
          <h2 class="mb-6">Panier</h2>
          <div class="row g-5">
            <div class="col-12 col-lg-8">
              <div id="cartTable" data-list='{"valueNames":["products","color","size","price","quantity","total"],"page":10}'>
                <div class="table-responsive scrollbar mx-n1 px-1">
                  <table class="table fs-9 mb-0 border-top border-translucent">
                    <thead>
                      <tr>
                        <th class="sort white-space-nowrap align-middle fs-10" scope="col"></th>
                        <th class="sort white-space-nowrap align-middle" scope="col" style="min-width:200px;">PRODUITS</th>
                        <th class="sort align-middle" scope="col" style="width:80px;">COULEURS</th>
                        <th class="sort align-middle" scope="col" style="width:50px;">TAILLES</th>
                        <th class="sort align-middle text-end" scope="col" style="width:100%;">PRIX</th>
                        <th class="sort align-middle ps-5" scope="col" style="width:200px;">QUANTITES</th>
                        <th class="sort align-middle" scope="col" style="width:80px;">UNITES</th>
                        <th class="sort align-middle text-end" scope="col" style="width:250px;">TOTAL</th>
                        <th class="sort text-end align-middle pe-0" scope="col"></th>
                      </tr>
                    </thead>
                    <tbody class="list cartpage" id="cart-table-body">
                      @if(Cart::count() > 0)
                        @foreach(Cart::content() as $product) 
                          <tr class="cart-table-row btn-reveal-trigger">
                            <td class="align-middle white-space-nowrap py-0"><a class="d-block border border-translucent rounded-2"><img src="{{Storage::url($product->model->image)}}" alt="" width="53" /></a></td>
                            <td class="products align-middle"><a class="fw-semibold mb-0 line-clamp-2">{{$product->model->name}}</a></td>
                            <td class="color align-middle white-space-nowrap fs-9 text-body">@if($product->options->color != null){{ $product->options->color }}@else Null @endif</td>
                            <td class="size align-middle white-space-nowrap text-body-tertiary fs-9 fw-semibold">@if($product->options->size != null){{ $product->options->size }}@else Null @endif</td>
                            <td class="price align-middle text-body fs-9 fw-semibold text-end" style="width:auto;">{{$product->model->getPrice()}}</td>
                            <td class="quantity align-middle fs-8 ps-5">
                              <div class="input-group input-group-sm flex-nowrap" data-quantity="data-quantity">
                                <a href="{{ route('magasin.panier.edit',$product->rowId) }}" class="btn btn-sm px-2" data-type="minus">-</a>
                                  <input disabled="" class="form-control text-center input-spin-none bg-transparent border-0 px-0" data-id="{{ $product->rowId }}" id="qty" name="qty" type="number" min="1" value="{{ $product->qty }}" aria-label="Amount (to the nearest dollar)" />
                                <a class="btn btn-sm px-2" href="{{ route('magasin.panier.show',$product->rowId) }}" data-type="plus">+</a>
                              </div>
                            </td>
                            <td class="color align-middle white-space-nowrap fs-9 text-body text-center">@if($product->options->unite != null){{$product->options->request_qty }} - {{ $product->options->unite }} @else Null @endif</td>
                            <td class="total align-middle fw-bold text-body-highlight text-end fs-9"> {{$product->model->getProductSubtotal($product->subtotal())}}</td>
                            <td class="align-middle white-space-nowrap text-end pe-0 ps-3">
                              <a href="{{ route('magasin.panier.destroy',$product->rowId) }}" onclick="event.preventDefault(); document.getElementById('SupprimerAuPanier-{{ $product->id }}').submit();" class="btn btn-sm text-body-tertiary text-opacity-85 text-body-tertiary-hover me-2"><span class="text-warning fs-7" data-feather="trash-2"></span></a>
                              <form id="SupprimerAuPanier-{{ $product->id }}" action="{{ route('magasin.panier.destroy',$product->rowId) }}" method="POST" class="d-none">
                                @csrf
                                @method('DELETE')
                              </form>
                            </td>
                          </tr>
                        @endforeach
                      @else
                        <h3 class="card-title mb-4">Votre panier est vide</h3>
                      @endif
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="d-flex flex-between-center py-3 border-bottom border-translucent mb-6">
                <p class="text-body-emphasis fw-semibold lh-sm mb-0">Montant total des articles :</p>
                <p class="text-body-emphasis fw-bold lh-sm mb-0">{{ number_format( str_replace(',', '', Cart::subtotal()),2, ',','.'). ' CFA'; }}</p>
              </div>
            </div>
            <div class="col-12 col-lg-4">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-between-center mb-3">
                    <h3 class="card-title mb-0">Résumé</h3>
                  </div>
                  <form action="{{ route('magasin.commande.store') }}" method="post">
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

                    

                    {{--
                      <label class="form-label" for="client">Selectionner un client</label>
                      <select class="form-select mb-3 @error('client') is-invalid @enderror" name="client" aria-label="delivery type" onchange="enableBrand(this)">
                        <option></option>
                        <option value="-1">Un simple client</option>
                        <optgroup label="Un client fideles">
                          @foreach($clients as $client)
                            <option value="{{ $client->id }}">{{ $client->name }} ( @if($client->account == 1) Actif @elseif($client->account == 2) Passif @else Neutre @endif )</option>
                          @endforeach
                        </optgroup>

                        <optgroup label="Un client abonnes">
                          @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }} ( @if($user->account == 1) Actif @elseif($user->account == 2) Passif @else Neutre @endif )</option>
                          @endforeach
                        </optgroup>
                      </select>
                      @error('client')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                      class="d-none" id="clientNone"
                    --}}
                    
                    <div class="mb-3 text-start ">
                      <label class="form-label" for="name">Prenom et nom du client</label>
                      <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Prenom et nom du client" autocomplete="name">

                      @error('name')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>
                    <div class="mb-3 text-start">
                      <label class="form-label" for="phone">Numero de telephone</label>
                      <input id="phone" type="numeric" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" placeholder="Numero de telephone" autocomplete="phone">

                      @error('phone')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>

                    <div class="col-auto mb-3">
                      <div class="form-check mb-0">
                        <input class="form-check-input" name="passif" id="basic-checkbox" value="1" type="checkbox" />
                        <label class="form-check-label mt-1" for="basic-checkbox">Accepter cette commande en credit</label>
                      </div>
                    </div>

                    {{--
                    <div>
                      <div class="d-flex justify-content-between">
                        <p class="text-body fw-semibold">Tax :</p>
                        <p class="text-body-emphasis fw-semibold">{{ Cart::tax() }}</p>
                      </div>
                      <div class="d-flex justify-content-between">
                        <p class="text-body fw-semibold">Subtotal :</p>
                        <p class="text-body-emphasis fw-semibold">{{ Cart::subtotal() }}</p>
                      </div>
                    </div>
                    --}}
                    
                    <div class="d-flex justify-content-between border-y border-dashed py-3 mb-4">
                      <h4 class="mb-0">Total :</h4>
                      <h4 class="mb-">{{ number_format( str_replace(',', '', Cart::subtotal()),2, ',','.'). ' CFA'; }}</h4>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Enregistrer la commande
                      <span class="fas fa-chevron-right ms-1 fs-10"></span>
                    </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div><!-- end of .container-->
      </section><!-- <section> close ============================-->
      <!-- ============================================-->





      @include('layouts.footer_admin')


</div>
@endsection


<script>
   function enableBrand(answer){
        if (answer.value == -1) {
            document.getElementById('clientNone').classList.remove('d-none')
        }else{
            document.getElementById('clientNone').classList.add('d-none')
        }
      }
</script>