@extends('layouts.app',['title' => 'clients fideles'])

@section('main-content')
  <div class="content">
    <div class="mb-9">
      <div class="row g-2 mb-4">
        <div class="col-auto">
          <h2 class="mb-0">Mes clients fidèles</h2>
        </div>
      </div>
      <div id="products" data-list='{"valueNames":["customer","email","total-orders","total-spent","city","last-seen","last-order"],"page":10,"pagination":true}'>
        <div class="mb-4">
          <div class="row g-3">
            <div class="search-box" style="width: 70%;">
              <form class="position-relative"><input class="form-control search-input search" type="search" placeholder="rechercher un fidèle client" aria-label="Search" />
                <span data-feather="search" class="search-box-icon"></span>
              </form>
            </div>
            <div class="col-auto ms-auto">
                <button type="button" class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                  <span data-feather="plus" class="me-2"></span>Ajouter un client
                </button>
            </div>
          </div>
        </div>
        <div class="mx-n4 px-4 mx-lg-n6 px-lg-6 bg-body-emphasis border-top border-bottom border-translucent position-relative top-1">
          <div class="table-responsive scrollbar-overlay mx-n1 px-1">
            <table class="table table-sm fs-9 mb-0">
              <thead>
                <tr>
                  <th class="sort align-middle pe-5" scope="col" data-sort="customer" style="width:10%;">CLIENTS</th>
                  <th class="sort align-middle pe-5" scope="col" data-sort="email" style="width:20%;">EMAIL</th>
                  <th class="sort align-middle text-end" scope="col" data-sort="total-orders" style="width:10%">TELEPHONES</th>
                  <th class="sort align-middle text-end" scope="col" data-sort="total-spent" style="width:15%">COMMANDES</th>
                  <th class="sort align-middle ps-7" scope="col" data-sort="city" style="width:25%;">TYPE</th>
                  <th class="sort align-middle ps-7" scope="col" data-sort="city" style="width:25%;">ADRESSE</th>
                  <th class="sort align-middle text-end pe-0" scope="col" data-sort="last-order" style="width:10%;min-width: 150px;">STATUS</th>
                  <th class="sort align-middle text-end pe-0" scope="col" data-sort="last-order" style="width:10%;min-width: 150px;">MONTANT</th>
                  <th class="sort align-middle text-end pe-0" scope="col" data-sort="last-order" style="width:10%;min-width: 150px;">MT-ACTIFS</th>
                  <th class="sort align-middle text-end pe-0" scope="col" data-sort="last-seen" style="width:10%;min-width: 150px;">MT-CREDITS</th>
                  <th class="sort align-middle text-end pe-0" scope="col" data-sort="last-order" style="width:10%;min-width: 150px;">ACTIONS</th>
                </tr>
              </thead>
              <tbody class="list" id="customers-table-body">
                @foreach($clients as $client)
                <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                  <td class="customer align-middle white-space-nowrap pe-5"><a class="d-flex align-items-center text-body-emphasis" href="{{ route('magasin.client.edit',$client->id) }}">
                      <div class="avatar avatar-m"><img class="rounded-circle" src="https://ui-avatars.com/api/?name={{$client->name}}" alt="" /></div>
                      <p class="mb-0 ms-3 text-body-emphasis fw-bold">@if($client->type == 1){{ $client->name }}@else{{ $client->name_type }}@endif</p>
                    </a></td>
                  <td class="email align-middle white-space-nowrap pe-5"><a class="fw-semibold" href="mailto:{{$client->email}}">@if($client->type == 1){{ $client->email }}@else{{ $client->email_type }}@endif</a></td>
                  <td class="total-orders align-middle white-space-nowrap fw-semibold text-center text-body-highlight">@if($client->type == 1){{ $client->phone }}@else{{ $client->phone_type }}@endif</td>
                  <td class="total-orders align-middle white-space-nowrap fw-semibold text-center text-body-highlight">{{ $client->getOrderCount($client->id) }}</td>
                  <td class="city align-middle white-space-nowrap text-body-highlight ps-7">{{ $client->status_type }}</td>
                  <td class="city align-middle white-space-nowrap text-body-highlight ps-7">{{ $client->adress }}</td>
                  <td class="last-order align-middle white-space-nowrap text-body-tertiary text-end">
                    <span class="badge badge-phoenix fs-10 @if($client->account == 1) badge-phoenix-info @elseif($client->account == 2) badge-phoenix-warning @else badge-phoenix-success @endif"> 
                      @if($client->account == 1) Actif @elseif($client->account == 2) Passif @else Neutre @endif
                      <span class="ms-1" 
                        @if($client->account == 1)
                          data-feather="chevrons-right"
                        @elseif($client->account == 2)
                          data-feather="x"
                        @else 
                          data-feather="check" 
                        @endif
                        style="height:12.8px;width:12.8px;">
                      </span> 
                    </span>
                  </td>
                  <td class="last-order align-middle white-space-nowrap text-body-tertiary text-end">{{$client->getAmount()}}</td>
                  <td class="last-order align-middle white-space-nowrap text-body-tertiary text-end">{{$client->getDepot()}}</td>
                  <td class="last-order align-middle white-space-nowrap text-body-tertiary text-end">{{$client->getCredit()}}</td>
                  <td class="align-middle white-space-nowrap text-end pe-0 ps-4 btn-reveal-trigger">
                    <span class="me-3 text-success fs-7" data-feather="edit-3" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight-{{ $client->id }}" aria-controls="offcanvasRight-{{ $client->id }}" data-fa-transform="shrink-3"></span>
                    @if($client->account == 3)
                      <span class="me-2 text-danger fs-7" data-feather="trash-2" data-bs-toggle="modal" data-bs-target="#DeleteCompte-{{ $client->id }}" data-fa-transform="shrink-3"></span>
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
            <h5 id="offcanvasRightLabel">Ajouter un nouveau client</h5><button class="btn-close text-reset" type="button" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">
            <form method="POST" action="{{ route('magasin.client.store') }}">
              @csrf

              <div class="mb-1 text-start">
                <label class="form-label mt-2" for="">Le type de client</label> <br>
                <div class="form-check form-check-inline">
                  <input class="form-check-input text-success @error('type') is-invalid @enderror" id="Indivivuel" type="radio" name="type" value="1" onclick="typeClient(1)">
                  <label class="form-check-label mt-1 text-success" for="Indivivuel">INDIVIDUEL</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input text-warning @error('type') is-invalid @enderror"  id="Entreprise" type="radio" name="type" value="2" onclick="typeClient(2)">
                  <label class="form-check-label text-warning mt-1" for="Entreprise">ENTREPRISE / ONG / GIE / AUTRE</label>
                </div>
                @error('type')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              <div class="mb-3 text-start">
                  <label class="form-label" for="name">Prenom et nom du client</label>
                  <input id="name" type="text" placeholder="Prenom et nom du client" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                  @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>


              <div class="mb-3 text-start" id="EMAILCLIENT">
                  <label class="form-label" for="email">Email du client</label>
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="email@gmail.com" required autocomplete="email">

                  @error('email')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>


              <div class="mb-3 text-start">
                  <label class="form-label" for="phone">Telephone du client</label>
                  <input id="phone" type="numeric" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" placeholder="Numero de telephone du client" required autocomplete="phone">

                  @error('phone')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>

              <div class="mb-3 text-start">
                  <label class="form-label" for="adress">Adresse <span class="d-none" id="showAdresseType">de votre organisation</span></label>
                  <input id="adress" type="adress" class="form-control @error('adress') is-invalid @enderror" name="adress" value="{{ old('adress') }}" placeholder="Adresse" required autocomplete="adress">

                  @error('adress')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>

               <div class="mb-3 text-start d-none" id="STATUSTYPE">
                <label class="form-label" for="status_type">Status de votre organisation</label>
                <input id="status_type" type="status_type" class="form-control @error('status_type') is-invalid @enderror" name="status_type" value="{{ old('status_type') }}" placeholder="Status de votre organisation" autocomplete="status_type">

                @error('status_type')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>

              <div class="mb-3 text-start d-none" id="NAMETYPE">
                <label class="form-label" for="name_type">Nom de votre organisation</label>
                <input id="name_type" type="name_type" class="form-control @error('name_type') is-invalid @enderror" name="name_type" value="{{ old('name_type') }}" placeholder="Nom de votre organisation" autocomplete="name_type">

                @error('name_type')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>

              <div class="mb-3 text-start d-none" id="EMAILTYPE">
                <label class="form-label" for="email_type">Email de votre organisation</label>
                <input id="email_type" type="text" class="form-control @error('email_type') is-invalid @enderror" name="email_type" value="{{ old('email_type') }}" placeholder="Email de votre organisation" autocomplete="email_type">

                @error('email_type')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>

               <div class="mb-3 text-start d-none" id="PHONETYPE">
                  <label class="form-label" for="phone_type">Telephone de votre organisation</label>
                  <input id="phone_type" type="text" class="form-control @error('phone_type') is-invalid @enderror" name="phone_type" value="{{ old('phone_type') }}" placeholder="Telephone de votre organisation" autocomplete="phone_type">

                  @error('phone_type')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>

              <div class="mb-3 text-start d-none" id="RCCM">
                  <label class="form-label" for="rccm">RCCM</label>
                  <input id="rccm" type="rccm" class="form-control @error('rccm') is-invalid @enderror" name="rccm" value="{{ old('rccm') }}" placeholder="Numero du registre de commerce de votre organisation" autocomplete="rccm">

                  @error('rccm')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>

              <div class="mb-3 text-start d-none" id="NINEA">
                  <label class="form-label" for="ninea">NINEA</label>
                  <input id="ninea" type="ninea" class="form-control @error('ninea') is-invalid @enderror" name="ninea" value="{{ old('ninea') }}" placeholder="Numero ninea de votre organisation" autocomplete="ninea">

                  @error('ninea')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>

              <div class="mb-3 text-start">
                <label class="form-label mb-1" for="email">Deposer de l'argent dans ce compte</label> <br>
                <div class="form-check form-check-inline">
                  <input class="form-check-input text-success @error('account') is-invalid @enderror" onchange="enableBrand(this)"  id="inlineRadio1" type="radio" name="account" value=" 1 ">
                  <label class="form-check-label text-success mt-1" for="inlineRadio1">Deposer des actifs</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input text-primary @error('account') is-invalid @enderror" onchange="enableBrand(this)"  id="inlineRadio3" type="radio" name="account" value=" 3 ">
                  <label class="form-check-label text-primary mt-1" for="inlineRadio3">Compte neutre</label>
                </div>
                @error('account')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              <div class="mb-3 text-start d-none" id="clientNone">
                <label class="form-label" for="depot">Montant actif a deposer</label>
                <input id="depot" type="numeric" class="form-control @error('depot') is-invalid @enderror" name="depot" value="{{ old('depot') }}" placeholder="Montant actif a deposer" autocomplete="depot">

                @error('depot')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>

              <button class="btn btn-primary w-100 mb-3" type="submit">Enreistrer ce client</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    @foreach($clients as $client)
      <div class="card-body p-0">
        <div class="p-4 code-to-copy">
          <!-- Right Offcanvas-->
          <div class="offcanvas offcanvas-end" id="offcanvasRight-{{ $client->id }}" tabindex="-1" aria-labelledby="offcanvasRightLabel-{{ $client->id }}">
            <div class="offcanvas-header">
              <h5 id="offcanvasRightLabel">Modification d'un client</h5><button class="btn-close text-reset" type="button" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            
            <div class="offcanvas-body">
              <div class="row mb-3">
                <div class="col-xl-12 col-xxl-12">
                  <div class="card">
                    <div class="card-body">
                      <div class="row align-items-center g-3 mb-3">
                        <div class="col-12 col-sm-auto flex-1">
                          <div class="d-md-flex d-xl-block align-items-center justify-content-between mb-5">
                            <div class="d-flex align-items-center mb-3 mb-md-0 mb-xl-3">
                              <div class="avatar avatar-xl me-3"><img class="rounded-circle" src="https://ui-avatars.com/api/?name={{$client->name}}" alt="" /></div>
                              <div>
                                <h5>{{ $client->name }}</h5>
                                <div style="width: 100%;">
                                  <span class="badge badge-phoenix @if($client->account == 1) badge-phoenix-info @elseif($client->account == 2) badge-phoenix-warning @else badge-phoenix-success @endif mt-2 me-2">
                                    @if($client->account == 1) Compte actif @elseif($client->account == 2) Compte passif @else Compte neutre @endif
                                  </span>
                                  <span class="badge badge-phoenix badge-phoenix-secondary">
                                  @if($client->account == 1) Depot : {{ $client->getDepot() }} @elseif($client->account == 2) Credit  : {{ $client->getCredit() }} @else Montant  : {{ $client->getAmount() }} @endif
                                  </span>
                                </div>
                              </div>
                            </div>
                            <div class="d-flex align-items-center mb-4">
                              <h5 class="mb-0 me-4">
                                <span class="d-inline-block lh-sm me-1" data-feather="grid" style="height:16px;width:16px;"></span>
                                {{$client->status_type}}
                              </h5>
                            </div>
                             @if ($client->type != 1)
                              <div>
                                <div class="d-flex justify-content-between">
                                  <p class="text-body fw-semibold">@if ($client->type == 2) Entreprise @elseif ($client->type == 3) ONG @endif :</p>
                                  <p class="text-body-emphasis fw-semibold">{{ $client->name_type }}</p>
                                </div>
                                <div class="d-flex justify-content-between">
                                  <p class="text-body fw-semibold">EMAIL :</p>
                                  <p class="text-body-emphasis fw-semibold">{{ $client->email_type }}</p>
                                </div>
                                <div class="d-flex justify-content-between">
                                  <p class="text-body fw-semibold">TELEPHONE :</p>
                                  <p class="text-body-emphasis fw-semibold">{{ $client->phone_type }}</p>
                                </div>
                                <div class="d-flex justify-content-between">
                                  <p class="text-body fw-semibold">RCCM :</p>
                                  <p class="text-body-emphasis fw-semibold">{{ $client->rccm }}</p>
                                </div>
                                <div class="d-flex justify-content-between">
                                  <p class="text-body fw-semibold">NINEA :</p>
                                  <p class="text-body fw-semibold">{{ $client->ninea }}</p>
                                </div>
                              </div>
                              @endif
                          </div>
                          @if ($client->account == 2)
                          <div class="progress mb-2" style="height:5px">
                            <div class="progress-bar bg-primary-lighter" data-bs-theme="light" role="progressbar" style="width: 40%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                          <div class="d-flex align-items-center justify-content-between">
                            <p class="mb-0"> Montant @if($client->account == 1) actif depenser @elseif($client->account == 2) des versements @endif</p>
                            <div>
                              <span class="d-inline-block lh-sm me-1" data-feather="money" style="height:16px;width:16px;"></span>
                              <span class="d-inline-block lh-sm"> {{ $client->getAmount() }}</span>
                            </div>
                          </div>

                          <div class="d-flex align-items-center justify-content-between bg-primary-lighter mt-3 p-1">
                            <p class="mb-0"> Il vous reste a paye </p>
                            <div>
                              <span class="d-inline-block lh-sm me-1" data-feather="money" style="height:16px;width:16px;"></span>
                              <span class="d-inline-block lh-sm"> {{ $client->getRestant() }} CFA</span>
                            </div>
                          </div>
                          @endif
                        </div>
                      </div>
                      @if ($client->account == 2)
                      <div class="table-responsive scrollbar">
                        <table class="reports-details-chart-table table table-sm fs-9 mb-0">
                          <thead>
                            <tr>
                              <th class="align-middle pe- text-body-tertiary fw-bold fs-10 text-uppercase text-nowrap" scope="col" style="width:35%;">Date de versement</th>
                              <th class="align-middle text-end ps-4 text-body-tertiary fw-bold fs-10 text-uppercase" scope="col" style="width:30%;">Montant verse</th>
                            </tr>
                          </thead>
                          <tbody class="list" id="report-data-body">
                            @foreach ($client->payments as $payment)
                              <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                                <td class="align-middle white-space-nowrap fw-semibold text-body-highlight py-2">{{ date("d-m-Y", strtotime($payment->date)) }}</td>
                                <td class="align-middle text-end white-space-nowrap ps-4 fw-semibold text-body-highlight"><span class="badge badge-phoenix badge-phoenix-info">{{ $payment->getAmount() }}</span></td>
                              </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                      @endif
                    </div>
                  </div>
                </div>
              </div>
              <div class="mb-1 text-start">
                <div class="form-check form-check-inline">
                  <input class="form-check-input text-success @error('showOrhieInput') is-invalid @enderror" id="ShowInput" type="radio" name="showOrhieInput" value="1" onclick="showOrHideInput(1)">
                  <label class="form-check-label mt-1 text-success" for="ShowInput">Afficher tous les champs</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input text-warning @error('showOrhieInput') is-invalid @enderror"  id="HideInput" type="radio" name="showOrhieInput" value="2" onclick="showOrHideInput(2)">
                  <label class="form-check-label text-warning mt-1" for="HideInput">Cacher les champs</label>
                </div>
              </div>
              <form method="POST" action="{{ route('magasin.client.update',$client->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-3 text-start" id="FirstInput">
                  <label class="form-label" for="name">Prenom et nom du client</label>
                  <input id="name" type="text" placeholder="Prenom et nom du client" class="form-control mb-3 @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $client->name }}" required autocomplete="name" autofocus>

                  @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror

                  @if ($client->type == 1)
                    <label class="form-label" for="email">Adresse email du client</label>
                    <input id="email" type="email" class="form-control mb-3 @error('email') is-invalid @enderror" name="email" value="{{ old('email') ?? $client->email }}" placeholder="email@gmail.com" required autocomplete="email">
                  @endif
                  
                  @error('email')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror

                  <label class="form-label" for="phone">Numero de telephone du client</label>
                  <input id="phone" type="phone" class="form-control mb-3 @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') ?? $client->phone }}" placeholder="Numero de telephone du client" required autocomplete="phone">

                  @error('phone')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror

                  <label class="form-label" for="adress">Adresse @if ($client->type == 1) du client @else de votre organisation @endif</label>
                  <input id="adress" type="text" class="form-control mb-3 @error('adress') is-invalid @enderror" name="adress" value="{{ old('adress') ?? $client->adress }}" placeholder="Adresse du client" required autocomplete="adress">

                  @error('adress')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>

                @if ($client->type != 1)

                  <div class="mb-3 text-start d-none" id="ShowOtherInput">

                    <label class="form-label" for="status_type">Status de votre organisation</label>
                    <input id="status_type" type="status_type" class="form-control mb-3 @error('status_type') is-invalid @enderror" name="status_type" value="{{ old('status_type') ?? $client->status_type }}" placeholder="Numero du registre de commerce client" autocomplete="status_type">

                    @error('status_type')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <label class="form-label" for="name_type">Nom de votre organisation</label>
                    <input id="name_type" type="name_type" class="form-control mb-3 @error('name_type') is-invalid @enderror" name="name_type" value="{{ old('name_type') ?? $client->name_type }}" placeholder="Numero du registre de commerce client" autocomplete="name_type">

                    @error('name_type')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <label class="form-label" for="email_type">Email de l'organisation</label>
                    <input id="email_type" type="text" class="form-control @error('email_type') is-invalid @enderror mb-3" name="email_type" value="{{ old('email_type') ?? $client->email_type }}"  autocomplete="email_type">

                    @error('email_type')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <label class="form-label" for="phone_type">Telephone de votre organisation</label>
                    <input id="phone_type" type="text" class="form-control @error('phone_type') is-invalid @enderror mb-3" name="phone_type" value="{{ old('phone_type') ?? $client->phone_type }}"  autocomplete="phone_type">

                    @error('phone_type')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <label class="form-label" for="rccm">RCCM</label>
                    <input id="rccm" type="rccm" class="form-control @error('rccm') is-invalid @enderror mb-3" name="rccm" value="{{ old('rccm') ?? $client->rccm }}" autocomplete="rccm">

                    @error('rccm')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <label class="form-label" for="ninea">NINEA</label>
                    <input id="ninea" type="ninea" class="form-control @error('ninea') is-invalid @enderror mb-3" name="ninea" value="{{ old('ninea') ?? $client->ninea }}"  autocomplete="ninea">

                    @error('ninea')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                  </div>
                  
                @endif

                <div class="mb-3 mt-4 text-start">
                  @if($client->account == 2)
                    <label class="form-label mb-1" for="amount">Entrer la tranche de reglage</label>
                    <input id="amount" type="number" class="form-control  @error('amount') is-invalid @enderror" name="amount" value="{{ old('amount')  }}" placeholder="Entrer la tranche de reglage" required autocomplete="amount">
                  @elseif($client->account == 3 || $client->account == null)
                    <div class="mb-3 text-start">
                      <label class="form-label" for="depot">Deposer des actifs dans ce compte</label>
                      <input id="depot" type="numeric" class="form-control @error('depot') is-invalid @enderror" name="depot" value="{{ old('depot') }}" placeholder="Deposer des actifs dans ce compte" autocomplete="depot">
                      
                      @error('depot')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  @endif
                </div>

                <button class="btn btn-primary w-100 mb-3" type="submit">Enreistrer les modification</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    @endforeach


    @foreach($clients as $client)
      <div class="modal fade" id="DeleteCompte-{{ $client->id }}" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title text-danger" id="exampleModalLabel">Suppresion de client</h5><button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close"><svg class="svg-inline--fa fa-xmark fs-9" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="xmark" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path fill="currentColor" d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z"></path></svg><!-- <span class="fas fa-times fs-9"></span> Font Awesome fontawesome.com --></button>
            </div>
            <form action="{{ route('magasin.client.destroy',$client->id) }}" method="post">
              @csrf
              {{ method_field('DELETE') }}
              <div class="modal-body">
                <p class="text-body-tertiary lh-lg mb-3"> Etes vous sure de bien vouloire supprimer le client {{$client->name}} </p>
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

<script>
   function enableBrand(answer){
      if (answer.value == 1 || answer.value == 2) {
          document.getElementById('clientNone').classList.remove('d-none')
      }else{
          document.getElementById('clientNone').classList.add('d-none')
      }
    }

  function typeClient(x){
    if (x == 1) {
      document.getElementById('NAMETYPE').classList.add('d-none')
      document.getElementById('STATUSTYPE').classList.add('d-none')
      document.getElementById('RCCM').classList.add('d-none')
      document.getElementById('NINEA').classList.add('d-none')
      document.getElementById('EMAILTYPE').classList.add('d-none')
      document.getElementById('PHONETYPE').classList.add('d-none')
      document.getElementById('showAdresseType').classList.add('d-none')
      document.getElementById('EMAILCLIENT').classList.remove('d-none')
    }else {
      document.getElementById('NAMETYPE').classList.remove('d-none')
      document.getElementById('STATUSTYPE').classList.remove('d-none')
      document.getElementById('RCCM').classList.remove('d-none')
      document.getElementById('NINEA').classList.remove('d-none')
      document.getElementById('EMAILTYPE').classList.remove('d-none')
      document.getElementById('PHONETYPE').classList.remove('d-none')
      document.getElementById('showAdresseType').classList.remove('d-none')
      document.getElementById('EMAILCLIENT').classList.add('d-none')
    }
  }

  function showOrHideInput(showOrHide){
     if (showOrHide == 2) {
      document.getElementById('FirstInput').classList.add('d-none')
      document.getElementById('ShowOtherInput').classList.add('d-none')
    }else {
      document.getElementById('FirstInput').classList.remove('d-none')
      document.getElementById('ShowOtherInput').classList.remove('d-none')
    }
  }
</script>