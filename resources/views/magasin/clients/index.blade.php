@extends('layouts.app',['title' => 'clients abonnes'])

@section('main-content')
  <div class="content">
    <div class="mb-9">
      <div class="row g-2 mb-4">
        <div class="col-auto">
          <h2 class="mb-0">Clients abonnés</h2>
        </div>
      </div>
      <div id="products" data-list='{"valueNames":["customer","email","total-orders","total-spent","city","last-seen","last-order"],"page":10,"pagination":true}'>
        <div class="mb-4">
          <div class="row g-3">
            <div class="search-box" style="width: 70%;">
              <form class="position-relative"><input class="form-control search-input search" type="search" placeholder="rechercher un client" aria-label="Search" />
                <span data-feather="search" class="search-box-icon"></span>
              </form>
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
                  <th class="sort align-middle text-end" scope="col" data-sort="total-orders" style="width:15%">COMMANDES</th>
                  <th class="sort align-middle ps-7" scope="col" data-sort="city" style="width:25%;">VILLES</th>
                  <th class="sort align-middle text-end pe-0" scope="col" data-sort="last-order" style="width:10%;min-width: 150px;">DERNIER  COMMANDE</th>
                </tr>
              </thead>
              <tbody class="list" id="customers-table-body">
                @foreach($clients as $client)
                <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                  <td class="customer align-middle white-space-nowrap pe-5"><a class="d-flex align-items-center text-body-emphasis" href="{{ route('magasin.client.show',$client->id) }}">
                      <div class="avatar avatar-m"><img class="rounded-circle" src="{{Storage::url($client->image)}}" alt="" /></div>
                      <p class="mb-0 ms-3 text-body-emphasis fw-bold">{{ $client->name }}</p>
                    </a></td>
                  <td class="email align-middle white-space-nowrap pe-5"><a class="fw-semibold" href="mailto:{{$client->email}}">{{$client->email}}</a></td>
                  <td class="total-orders align-middle white-space-nowrap fw-semibold text-center text-body-highlight">{{ $client->phone }}</td>
                  <td class="total-orders align-middle white-space-nowrap fw-semibold text-center text-body-highlight">{{ $client->getOrderCount($client->id) }}</td>
                  <td class="city align-middle white-space-nowrap text-body-highlight ps-7">Ville</td>
                  <td class="last-order align-middle white-space-nowrap text-body-tertiary text-end">Dec 12, 12:56 PM</td>
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
    @include('layouts.footer_admin')
  </div>
@endsection