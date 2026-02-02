@extends('layouts.app',['title' => 'profile des clients'])

@section('main-content')
  <div class="content">
    <div class="mb-9">
      <div class="row align-items-center justify-content-between g-3 mb-4">
        <div class="col-auto">
          <h2 class="mb-0">Details de votre client</h2>
        </div>
      </div>
      <div class="row g-5">
        <div class="col-12 col-xxl-4">
          <div class="row g-3 g-xxl-0 h-100">
            <div class="col-12 col-md-7 col-xxl-12 mb-xxl-3">
              <div class="card h-100">
                <div class="card-body d-flex flex-column justify-content-between pb-3">
                  <div class="row align-items-center g-5 mb-3 text-center text-sm-start">
                    <div class="col-12 col-sm-auto mb-sm-2">
                      <div class="avatar avatar-5xl"><img class="rounded-circle" src="https://ui-avatars.com/api/?name={{$client->name}}" alt="" /></div>
                    </div>
                    <div class="col-12 col-sm-auto flex-1">
                      <h3>@if($client->type == 1){{ $client->name }}@else{{ $client->name_type }}@endif</h3>
                    </div>
                  </div>
                  <div class="d-flex flex-between-center border-top border-dashed pt-4">
                    <div>
                      <h6>Nom @if($client->type == 1) du client @else du representant @endif</h6>
                      <p class="fs-9 text-body-secondary mb-0">{{ $client->name }}</p>
                    </div>
                    <div>
                      <h6>Email @if($client->type == 1) du client @else de l'organisation @endif</h6>
                      <p class="fs-9 text-body-secondary mb-0">@if($client->type == 1){{ $client->email }}@else {{ $client->email_type }}@endif</p>
                    </div>
                    <div>
                      <h6>Telephone @if($client->type == 1) du client @else du representant @endif</h6>
                      <p class="fs-9 text-body-secondary mb-0">{{ $client->phone }}</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-md-5 col-xxl-12 mb-xxl-3">
              <div class="card h-100">
                <div class="card-body pb-3">
                  <div class="d-flex align-items-center mb-3">
                    <h3 class="me-1">
                      {{ $client->status_type }}
                    </h3>
                  </div>
                  
                  <div class="mb-3">
                    <h5 class="text-body-secondary">Telephone</h5><span class="text-body-secondary">{{$client->phone_type}}</span>
                  </div>
                   @if ($client->type != 1)
                    <div class="mb-3">
                      <h5 class="text-body-secondary">Registre de commerce</h5><span class="text-body-secondary">{{$client->rccm}}</span>
                    </div>
                    <div class="mb-3">
                      <h5 class="text-body-secondary">Ninea</h5><span class="text-body-secondary">{{$client->ninea}}</span>
                    </div>
                  @endif
                  <div class="mb-3">
                    <h5 class="text-body-secondary">Address</h5><span class="text-body-secondary">{{$client->adress}}</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-xxl-8">
          <div class="mb-6">
            <h3 class="mb-4">Commandes <span class="text-body-tertiary fw-normal">({{ $orders->count() }})</span></h3>
            <div class="border-top border-bottom border-translucent" id="customerOrdersTable" data-list='{"valueNames":["order","total","payment_status","fulfilment_status","delivery_type","date"],"page":10,"pagination":true}'>
              <div class="table-responsive scrollbar">
                <table class="table table-sm fs-9 mb-0">
                  <thead>
                    <tr>
                      <th class="sort white-space-nowrap align-middle ps-0 pe-3" scope="col" data-sort="order" style="width:10%;">COMMANDES</th>
                      <th class="sort align-middle text-end pe-7" scope="col" data-sort="total" style="width:10%;">TOTAL</th>
                      <th class="sort align-middle white-space-nowrap pe-3" scope="col" data-sort="payment_status" style="width:15%;">PAIMENT</th>
                      <th class="sort align-middle white-space-nowrap text-start" scope="col" data-sort="delivery_type" style="width:30%;">STATUS</th>
                      <th class="sort align-middle text-end pe-0" scope="col" data-sort="date">DATE</th>
                      <th class="sort text-end align-middle pe-0 ps-5" scope="col"></th>
                    </tr>
                  </thead>
                  <!-- alert-octagon -->
                  <tbody class="list" id="customer-order-table-body">
                    @foreach($orders as $order)
                    <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                      <td class="order align-middle white-space-nowrap ps-0"><a class="fw-semibold" href="{{ route('magasin.commande.show',$order->id) }}">Nº {{ $order->order }}</a></td>
                      <td class="total align-middle text-end fw-semibold pe-7 text-body-highlight">{{ $order->amount }}</td>
                      <td class="payment_status align-middle white-space-nowrap text-start fw-bold text-body-tertiary">
                        <span class="badge badge-phoenix fs-10  @if($order->status == 1) badge-phoenix-success @elseif($order->status == 2) badge-phoenix-info @else badge-phoenix-warning @endif">
                          <span class="badge-label">@if($order->status == 1) Terminé @elseif($order->status == 2) En cours @else Annulé @endif</span>
                          <span class="ms-1" 
                          @if($order->status == 1)
                            data-feather="check" 
                          @elseif($order->status == 2)
                            data-feather="chevrons-right"
                          @else 
                          data-feather="x"
                          @endif
                          style="height:12.8px;width:12.8px;"></span>
                          
                          
                        </span>
                      </td>
                      <td class="delivery_type align-middle white-space-nowrap text-body fs-9 text-start">
                        <span class="badge badge-phoenix fs-10  @if($order->type == 1) badge-phoenix-success @elseif($order->type == 2) badge-phoenix-info @else badge-phoenix-warning @endif">
                          <span class="badge-label">  
                            @if($order->type == 1) Retrait @elseif($order->type == 2) A crédit @else Normale  @endif
                          </span>
                          <span class="ms-1" 
                            @if($order->type == 1)
                              data-feather="check" 
                            @elseif($order->type == 2)
                              data-feather="chevrons-right"
                            @else 
                            data-feather="x"
                            @endif
                            style="height:12.8px;width:12.8px;">
                          </span>
                        </span>
                      </td>
                      <td class="date align-middle white-space-nowrap text-body-tertiary fs-9 ps-4 text-end">{{date('d-m-Y', strtotime( $order->date ))}}</td>
                      <td class="align-middle white-space-nowrap text-end pe-0 ps-5">
                        <a href="{{ route('magasin.commande.edit',$order->slug) }}" target="_blank" class="me-2 text-success"  data-fa-transform="shrink-3"><span class="fa fa-file-alt fs-7" ></span></span></a>
                        {{-- 
                        <div class="btn-reveal-trigger position-static"><button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs-10" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs-10"></span></button>
                          <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                            <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                          </div>
                        </div>
                        --}}
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <div class="row align-items-center justify-content-between py-2 pe-0 fs-9">
                <div class="col-auto d-flex">
                  <p class="mb-0 d-none d-sm-block me-3 fw-semibold text-body" data-list-info="data-list-info"></p><a class="fw-semibold" href="#!" data-list-view="*">Voire tout<span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a><a class="fw-semibold d-none" href="#!" data-list-view="less">View Less<span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a>
                </div>
                <div class="col-auto d-flex"><button class="page-link" data-list-pagination="prev"><span class="fas fa-chevron-left"></span></button>
                  <ul class="mb-0 pagination"></ul><button class="page-link pe-0" data-list-pagination="next"><span class="fas fa-chevron-right"></span></button>
                </div>
              </div>
            </div>
          </div>
          {{--
            <div class="mb-6">
              <h3 class="mb-4">Wishlist <span class="text-body-tertiary fw-normal">(43)</span></h3>
              <div class="border-translucent border-top border-bottom" id="customerWishlistTable" data-list='{"valueNames":["products","color","size","price","quantity","total"],"page":5,"pagination":true}'>
                <div class="table-responsive scrollbar">
                  <table class="table fs-9 mb-0">
                    <thead>
                      <tr>
                        <th class="sort white-space-nowrap align-middle fs-10" scope="col" style="width:5%;"></th>
                        <th class="sort white-space-nowrap align-middle" scope="col" style="width:35%; min-width:250px;" data-sort="products">PRODUCTS</th>
                        <th class="sort align-middle" scope="col" data-sort="color" style="width:15%;">COLOR</th>
                        <th class="sort align-middle" scope="col" data-sort="size" style="width:10%;">SIZE</th>
                        <th class="sort align-middle text-end" scope="col" data-sort="price" style="width:15%;">PRICE</th>
                        <th class="sort align-middle text-end" scope="col" data-sort="total" style="width:15%;">TOTAL</th>
                      </tr>
                    </thead>
                    <tbody class="list" id="customer-wishlist-table-body">
                      <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                        <td class="align-middle white-space-nowrap py-1"><a class="border border-translucent rounded-2 d-inline-block" href="../landing/product-details.html"><img src="../../../assets/img/products/1.png" alt="" width="40" height="40" /></a></td>
                        <td class="products align-middle"><a class="fw-semibold mb-0" href="../landing/product-details.html">Fitbit Sense Advanced Smartwatch wi...</a></td>
                        <td class="color align-middle white-space-nowrap fs-9 text-body">Pure matte black</td>
                        <td class="size align-middle white-space-nowrap text-body-tertiary fs-9 fw-semibold">42</td>
                        <td class="price align-middle text-body fs-9 fw-semibold text-end">$57</td>
                        <td class="total align-middle fw-bold text-body-highlight text-end">$57</td>
                      </tr>
                      <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                        <td class="align-middle white-space-nowrap py-1"><a class="border border-translucent rounded-2 d-inline-block" href="../landing/product-details.html"><img src="../../../assets/img/products/7.png" alt="" width="40" height="40" /></a></td>
                        <td class="products align-middle"><a class="fw-semibold mb-0" href="../landing/product-details.html">2021 Apple 12.9-inch iPad Pro (Wi‑Fi, ...</a></td>
                        <td class="color align-middle white-space-nowrap fs-9 text-body">Black</td>
                        <td class="size align-middle white-space-nowrap text-body-tertiary fs-9 fw-semibold">Pro</td>
                        <td class="price align-middle text-body fs-9 fw-semibold text-end">$1,499</td>
                        <td class="total align-middle fw-bold text-body-highlight text-end">$1499</td>
                      </tr>
                      <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                        <td class="align-middle white-space-nowrap py-1"><a class="border border-translucent rounded-2 d-inline-block" href="../landing/product-details.html"><img src="../../../assets/img/products/6.png" alt="" width="40" height="40" /></a></td>
                        <td class="products align-middle"><a class="fw-semibold mb-0" href="../landing/product-details.html">PlayStation 5 DualSense Wireless Cont...</a></td>
                        <td class="color align-middle white-space-nowrap fs-9 text-body">White</td>
                        <td class="size align-middle white-space-nowrap text-body-tertiary fs-9 fw-semibold">Regular</td>
                        <td class="price align-middle text-body fs-9 fw-semibold text-end">$299</td>
                        <td class="total align-middle fw-bold text-body-highlight text-end">$359</td>
                      </tr>
                      <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                        <td class="align-middle white-space-nowrap py-1"><a class="border border-translucent rounded-2 d-inline-block" href="../landing/product-details.html"><img src="../../../assets/img/products/3.png" alt="" width="40" height="40" /></a></td>
                        <td class="products align-middle"><a class="fw-semibold mb-0" href="../landing/product-details.html">Apple MacBook Pro 13 inch-M1-8/256G...</a></td>
                        <td class="color align-middle white-space-nowrap fs-9 text-body">Space Gray</td>
                        <td class="size align-middle white-space-nowrap text-body-tertiary fs-9 fw-semibold">Pro</td>
                        <td class="price align-middle text-body fs-9 fw-semibold text-end">$1,699</td>
                        <td class="total align-middle fw-bold text-body-highlight text-end">$1,799</td>
                      </tr>
                      <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                        <td class="align-middle white-space-nowrap py-1"><a class="border border-translucent rounded-2 d-inline-block" href="../landing/product-details.html"><img src="../../../assets/img/products/4.png" alt="" width="40" height="40" /></a></td>
                        <td class="products align-middle"><a class="fw-semibold mb-0" href="../landing/product-details.html">Apple iMac 24&quot; 4K Retina Display M1 8 C...</a></td>
                        <td class="color align-middle white-space-nowrap fs-9 text-body">Ocean Blue</td>
                        <td class="size align-middle white-space-nowrap text-body-tertiary fs-9 fw-semibold">21&quot;</td>
                        <td class="price align-middle text-body fs-9 fw-semibold text-end">$65</td>
                        <td class="total align-middle fw-bold text-body-highlight text-end">$65</td>
                      </tr>
                      <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                        <td class="align-middle white-space-nowrap py-1"><a class="border border-translucent rounded-2 d-inline-block" href="../landing/product-details.html"><img src="../../../assets/img/products/10.png" alt="" width="40" height="40" /></a></td>
                        <td class="products align-middle"><a class="fw-semibold mb-0" href="../landing/product-details.html">Apple Magic Mouse (Wireless, Recharg...</a></td>
                        <td class="color align-middle white-space-nowrap fs-9 text-body">White</td>
                        <td class="size align-middle white-space-nowrap text-body-tertiary fs-9 fw-semibold">Regular</td>
                        <td class="price align-middle text-body fs-9 fw-semibold text-end">$30</td>
                        <td class="total align-middle fw-bold text-body-highlight text-end">$60</td>
                      </tr>
                      <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                        <td class="align-middle white-space-nowrap py-1"><a class="border border-translucent rounded-2 d-inline-block" href="../landing/product-details.html"><img src="../../../assets/img/products/8.png" alt="" width="40" height="40" /></a></td>
                        <td class="products align-middle"><a class="fw-semibold mb-0" href="../landing/product-details.html">Amazon Basics Matte Black Wired Keybo...</a></td>
                        <td class="color align-middle white-space-nowrap fs-9 text-body">Black</td>
                        <td class="size align-middle white-space-nowrap text-body-tertiary fs-9 fw-semibold">MD</td>
                        <td class="price align-middle text-body fs-9 fw-semibold text-end">$40</td>
                        <td class="total align-middle fw-bold text-body-highlight text-end">$40</td>
                      </tr>
                      <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                        <td class="align-middle white-space-nowrap py-1"><a class="border border-translucent rounded-2 d-inline-block" href="../landing/product-details.html"><img src="../../../assets/img/products/12.png" alt="" width="40" height="40" /></a></td>
                        <td class="products align-middle"><a class="fw-semibold mb-0" href="../landing/product-details.html">HORI Racing Wheel Apex for PlayStation...</a></td>
                        <td class="color align-middle white-space-nowrap fs-9 text-body">Black</td>
                        <td class="size align-middle white-space-nowrap text-body-tertiary fs-9 fw-semibold">45</td>
                        <td class="price align-middle text-body fs-9 fw-semibold text-end">$130</td>
                        <td class="total align-middle fw-bold text-body-highlight text-end">$130</td>
                      </tr>
                      <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                        <td class="align-middle white-space-nowrap py-1"><a class="border border-translucent rounded-2 d-inline-block" href="../landing/product-details.html"><img src="../../../assets/img/products/17.png" alt="" width="40" height="40" /></a></td>
                        <td class="products align-middle"><a class="fw-semibold mb-0" href="../landing/product-details.html">Xbox Series S</a></td>
                        <td class="color align-middle white-space-nowrap fs-9 text-body">Space Gray</td>
                        <td class="size align-middle white-space-nowrap text-body-tertiary fs-9 fw-semibold">sm</td>
                        <td class="price align-middle text-body fs-9 fw-semibold text-end">$99</td>
                        <td class="total align-middle fw-bold text-body-highlight text-end">$99</td>
                      </tr>
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
            <div>
              <h3 class="mb-4">Ratings & reviews <span class="text-body-tertiary fw-normal">(43)</span></h3>
              <div class="border-top border-bottom border-translucent" id="customerRatingsTable" data-list='{"valueNames":["product","rating","review","status","date"],"page":5,"pagination":true}'>
                <div class="table-responsive scrollbar">
                  <table class="table fs-9 mb-0">
                    <thead>
                      <tr>
                        <th class="sort white-space-nowrap align-middle ps-0" scope="col" style="width:20%;" data-sort="product">PRODUCT</th>
                        <th class="sort align-middle" scope="col" data-sort="rating" style="width:10%;">RATING</th>
                        <th class="sort align-middle" scope="col" style="width:50%;" data-sort="review">REVIEW</th>
                        <th class="sort text-end align-middle" scope="col" style="width:10%;" data-sort="status">STATUS</th>
                        <th class="sort text-end align-middle" scope="col" style="width:10%;" data-sort="date">DATE</th>
                        <th class="sort text-end pe-0 align-middle" scope="col"></th>
                      </tr>
                    </thead>
                    <tbody class="list" id="customer-rating-table-body">
                      <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                        <td class="align-middle product white-space-nowrap"><a class="fw-semibold" href="../landing/product-details.html">Apple Magic Mouse (Wireless, Rech...</a></td>
                        <td class="align-middle rating white-space-nowrap fs-10"><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa-regular fa-star text-warning-light"></span></td>
                        <td class="align-middle review" style="min-width:350px;">
                          <p class="fw-semibold text-body-highlight mb-0">It's lovely, works right out of the box (as you'd expect from an Apple device), and has a number of useful functions.</p>
                        </td>
                        <td class="align-middle text-end status"><span class="badge badge-phoenix fs-10 badge-phoenix-success"><span class="badge-label">Success</span><span class="ms-1" data-feather="check" style="height:12.8px;width:12.8px;"></span></span></td>
                        <td class="align-middle text-end date white-space-nowrap">
                          <p class="text-body-tertiary mb-0">Just now</p>
                        </td>
                        <td class="align-middle white-space-nowrap text-end pe-0">
                          <div class="btn-reveal-trigger position-static"><button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs-10" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs-10"></span></button>
                            <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                              <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                        <td class="align-middle product white-space-nowrap"><a class="fw-semibold" href="../landing/product-details.html">Fitbit Sense Advanced Smartwatch ...</a></td>
                        <td class="align-middle rating white-space-nowrap fs-10"><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span></td>
                        <td class="align-middle review" style="min-width:350px;">
                          <p class="fw-semibold text-body-highlight mb-0">This is an exceptional smartwatch, featuring a wealth of useful functions at an affordable price. The watch is small ...<a href='#!'>See more</a></p>
                        </td>
                        <td class="align-middle text-end status"><span class="badge badge-phoenix fs-10 badge-phoenix-success"><span class="badge-label">Success</span><span class="ms-1" data-feather="check" style="height:12.8px;width:12.8px;"></span></span></td>
                        <td class="align-middle text-end date white-space-nowrap">
                          <p class="text-body-tertiary mb-0">Dec 9, 2:28PM</p>
                        </td>
                        <td class="align-middle white-space-nowrap text-end pe-0">
                          <div class="btn-reveal-trigger position-static"><button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs-10" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs-10"></span></button>
                            <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                              <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                        <td class="align-middle product white-space-nowrap"><a class="fw-semibold" href="../landing/product-details.html">HORI Racing Wheel Apex for PlaySt...</a></td>
                        <td class="align-middle rating white-space-nowrap fs-10"><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa-regular fa-star text-warning-light"></span></td>
                        <td class="align-middle review" style="min-width:350px;">
                          <p class="fw-semibold text-body-highlight mb-0">This steering wheel is a great buy! It works well and feels good, however I wish it had a wider diameter like a real ...<a href='#!'>See more</a></p>
                        </td>
                        <td class="align-middle text-end status"><span class="badge badge-phoenix fs-10 badge-phoenix-warning"><span class="badge-label">Pending</span><span class="ms-1" data-feather="alert-octagon" style="height:12.8px;width:12.8px;"></span></span></td>
                        <td class="align-middle text-end date white-space-nowrap">
                          <p class="text-body-tertiary mb-0">Dec 4, 12:56 PM</p>
                        </td>
                        <td class="align-middle white-space-nowrap text-end pe-0">
                          <div class="btn-reveal-trigger position-static"><button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs-10" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs-10"></span></button>
                            <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                              <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                        <td class="align-middle product white-space-nowrap"><a class="fw-semibold" href="../landing/product-details.html">Razer Kraken v3 x Wired 7.1 Surro...</a></td>
                        <td class="align-middle rating white-space-nowrap fs-10"><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa-regular fa-star text-warning-light"></span><span class="fa-regular fa-star text-warning-light"></span></td>
                        <td class="align-middle review" style="min-width:350px;">
                          <p class="fw-semibold text-body-highlight mb-0">My son says these are the greatest he's ever tasted.</p>
                        </td>
                        <td class="align-middle text-end status"><span class="badge badge-phoenix fs-10 badge-phoenix-secondary"><span class="badge-label">Cancelled</span><span class="ms-1" data-feather="x" style="height:12.8px;width:12.8px;"></span></span></td>
                        <td class="align-middle text-end date white-space-nowrap">
                          <p class="text-body-tertiary mb-0">Nov 28, 7:28 PM</p>
                        </td>
                        <td class="align-middle white-space-nowrap text-end pe-0">
                          <div class="btn-reveal-trigger position-static"><button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs-10" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs-10"></span></button>
                            <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                              <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                        <td class="align-middle product white-space-nowrap"><a class="fw-semibold" href="../landing/product-details.html">iPhone 13 pro max-Pacific Blue-12...</a></td>
                        <td class="align-middle rating white-space-nowrap fs-10"><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa-regular fa-star text-warning-light"></span><span class="fa-regular fa-star text-warning-light"></span></td>
                        <td class="align-middle review" style="min-width:350px;">
                          <p class="fw-semibold text-body-highlight mb-0">I chose wisely. The phone is in excellent condition, with no scratches or dents, excellent battery life, and flawless...<a href='#!'>See more</a></p>
                        </td>
                        <td class="align-middle text-end status"><span class="badge badge-phoenix fs-10 badge-phoenix-success"><span class="badge-label">Success</span><span class="ms-1" data-feather="check" style="height:12.8px;width:12.8px;"></span></span></td>
                        <td class="align-middle text-end date white-space-nowrap">
                          <p class="text-body-tertiary mb-0">Nov 24, 10:16 AM</p>
                        </td>
                        <td class="align-middle white-space-nowrap text-end pe-0">
                          <div class="btn-reveal-trigger position-static"><button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs-10" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs-10"></span></button>
                            <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                              <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                        <td class="align-middle product white-space-nowrap"><a class="fw-semibold" href="../landing/product-details.html">Apple MacBook Pro 13 inch-M1-8/25...</a></td>
                        <td class="align-middle rating white-space-nowrap fs-10"><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star-half-alt star-icon text-warning"></span></td>
                        <td class="align-middle review" style="min-width:350px;">
                          <p class="fw-semibold text-body-highlight mb-0">It's lovely, works right out of the box (as you'd expect from an Apple device), and has a number of useful functions.</p>
                        </td>
                        <td class="align-middle text-end status"><span class="badge badge-phoenix fs-10 badge-phoenix-warning"><span class="badge-label">Pending</span><span class="ms-1" data-feather="alert-octagon" style="height:12.8px;width:12.8px;"></span></span></td>
                        <td class="align-middle text-end date white-space-nowrap">
                          <p class="text-body-tertiary mb-0">Just now</p>
                        </td>
                        <td class="align-middle white-space-nowrap text-end pe-0">
                          <div class="btn-reveal-trigger position-static"><button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs-10" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs-10"></span></button>
                            <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                              <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                        <td class="align-middle product white-space-nowrap"><a class="fw-semibold" href="../landing/product-details.html">Apple iMac 24&quot; 4K Retina Display ...</a></td>
                        <td class="align-middle rating white-space-nowrap fs-10"><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa-regular fa-star text-warning-light"></span><span class="fa-regular fa-star text-warning-light"></span></td>
                        <td class="align-middle review" style="min-width:350px;">
                          <p class="fw-semibold text-body-highlight mb-0">The best experience we could hope for. Customer service team is amazing and the quality of their products is unsurpas...<a href='#!'>See more</a></p>
                        </td>
                        <td class="align-middle text-end status"><span class="badge badge-phoenix fs-10 badge-phoenix-warning"><span class="badge-label">Pending</span><span class="ms-1" data-feather="alert-octagon" style="height:12.8px;width:12.8px;"></span></span></td>
                        <td class="align-middle text-end date white-space-nowrap">
                          <p class="text-body-tertiary mb-0">Nov 09, 3:23 AM</p>
                        </td>
                        <td class="align-middle white-space-nowrap text-end pe-0">
                          <div class="btn-reveal-trigger position-static"><button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs-10" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs-10"></span></button>
                            <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                              <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                        <td class="align-middle product white-space-nowrap"><a class="fw-semibold" href="../landing/product-details.html">PlayStation 5 DualSense Wireless ...</a></td>
                        <td class="align-middle rating white-space-nowrap fs-10"><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa-regular fa-star text-warning-light"></span></td>
                        <td class="align-middle review" style="min-width:350px;">
                          <p class="fw-semibold text-body-highlight mb-0">My son says these are the greatest he's ever tasted.</p>
                        </td>
                        <td class="align-middle text-end status"><span class="badge badge-phoenix fs-10 badge-phoenix-success"><span class="badge-label">Success</span><span class="ms-1" data-feather="check" style="height:12.8px;width:12.8px;"></span></span></td>
                        <td class="align-middle text-end date white-space-nowrap">
                          <p class="text-body-tertiary mb-0">Nov 08, 8:53 AM</p>
                        </td>
                        <td class="align-middle white-space-nowrap text-end pe-0">
                          <div class="btn-reveal-trigger position-static"><button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs-10" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs-10"></span></button>
                            <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                              <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                        <td class="align-middle product white-space-nowrap"><a class="fw-semibold" href="../landing/product-details.html">2021 Apple 12.9-inch iPad Pro (Wi...</a></td>
                        <td class="align-middle rating white-space-nowrap fs-10"><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star-half-alt star-icon text-warning"></span></td>
                        <td class="align-middle review" style="min-width:350px;">
                          <p class="fw-semibold text-body-highlight mb-0">The response time and service I received when contacted the designers were Phenomenal!</p>
                        </td>
                        <td class="align-middle text-end status"><span class="badge badge-phoenix fs-10 badge-phoenix-warning"><span class="badge-label">Pending</span><span class="ms-1" data-feather="alert-octagon" style="height:12.8px;width:12.8px;"></span></span></td>
                        <td class="align-middle text-end date white-space-nowrap">
                          <p class="text-body-tertiary mb-0">Nov 07, 9:00 PM</p>
                        </td>
                        <td class="align-middle white-space-nowrap text-end pe-0">
                          <div class="btn-reveal-trigger position-static"><button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs-10" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs-10"></span></button>
                            <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                              <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                        <td class="align-middle product white-space-nowrap"><a class="fw-semibold" href="../landing/product-details.html">Amazon Basics Matte Black Wired K...</a></td>
                        <td class="align-middle rating white-space-nowrap fs-10"><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa-regular fa-star text-warning-light"></span><span class="fa-regular fa-star text-warning-light"></span></td>
                        <td class="align-middle review" style="min-width:350px;">
                          <p class="fw-semibold text-body-highlight mb-0">I chose wisely. The phone is in excellent condition, with no scratches or dents, excellent battery life, and flawless...<a href='#!'>See more</a></p>
                        </td>
                        <td class="align-middle text-end status"><span class="badge badge-phoenix fs-10 badge-phoenix-warning"><span class="badge-label">Pending</span><span class="ms-1" data-feather="alert-octagon" style="height:12.8px;width:12.8px;"></span></span></td>
                        <td class="align-middle text-end date white-space-nowrap">
                          <p class="text-body-tertiary mb-0">Nov 07, 11:20 AM</p>
                        </td>
                        <td class="align-middle white-space-nowrap text-end pe-0">
                          <div class="btn-reveal-trigger position-static"><button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs-10" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs-10"></span></button>
                            <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                              <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                            </div>
                          </div>
                        </td>
                      </tr>
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
          --}}
        </div>
      </div>
    </div>
    @include('layouts.footer_admin')
  </div>
@endsection