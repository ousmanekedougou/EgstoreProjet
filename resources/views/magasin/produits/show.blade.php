@extends('layouts.app',['title' => 'affichage des produits'])
@section('headSection')
  <link href="{{asset('vendors/choices/choices.min.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/css/bootstrap-tagsinput.css')}}" rel="stylesheet" />
  <link href="{{asset('vendors/flatpickr/flatpickr.min.css')}}" rel="stylesheet" /> 
@endsection
@section('main-content')
<div class="content">
   
  <!-- ============================================-->
  <!-- <section> begin ============================-->
  <section class="py-0">
      <div class="row g-5 mb-5 mb-lg-8" data-product-details="data-product-details">
        <div class="col-12 col-lg-6">
          <div class="row g-3 mb-3">
            <div class="col-12 col-md-2 col-lg-12 col-xl-2">
              <div class="swiper-products-thumb swiper swiper theme-slider overflow-visible" id="swiper-products-thumb"></div>
            </div>
            <div class="col-12 col-md-10 col-lg-12 col-xl-10">
              <div class="d-flex align-items-center border border-translucent rounded-3 text-center p-5 h-100">
                <div>
                  <img src="{{Storage::url($product->image)}}" alt="" style="width: 100%;height:auto;" />
                </div>
              </div>
            </div>
          </div>
          <div class="d-flex">
            <button data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight-{{ $product->id }}" aria-controls="offcanvasRight-{{ $product->id }}" class="btn btn-sm btn-outline-primary rounded-pill w-100 me-3 px-2 px-sm-4 fs-9 fs-sm-8">
              <span data-feather="edit-3" class="me-2"></span>Modifier ce produit
            </button>
            @if($product->quantity > 0)
              <a href="{{ route('magasin.panier.store') }}" onclick="event.preventDefault(); document.getElementById('ajouterAuPanier-{{ $product->id }}').submit();" class="btn btn-sm btn-warning rounded-pill w-100 fs-9 fs-sm-8">
                <span data-feather="shopping-cart" class=" me-2"></span>Ajouter au panier
              </a>
            @else
              <span>Indisponible</span>
            @endif
          </div>
        </div>
        <div class="col-12 col-lg-5">
          <div class="d-flex flex-column justify-content-between h-100">
            <div>
              <div class="d-flex flex-wrap mb-2">
                <div class="me-2"><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span></div>
                <p class="text-primary fw-semibold mb-2">
                  <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#">{{$product->sub_category->category->name}}</a></li>
                    <li class="breadcrumb-item"><a href="#">{{$product->sub_category->name}}</a></li>
                  </ol>  
                </p>
              </div>
              <h4 class="mb-3 lh-sm">{{$product->name}}</h4>
              @if($product->promot == 1)
              <div class="d-flex flex-wrap align-items-start mb-3">
                <span class="badge text-bg-info fs-9 rounded-pill me-2 fw-semibold">#En promotion</span>
              </div>
              @endif
              <div class="d-flex flex-wrap align-items-center">
                <h1 class="me-3">@if($product->promot == 1) {{$product->getPromotPrice()}} @else {{$product->getPrice()}} @endif</h1>
                <p class="text-body-quaternary text-decoration-line-through fs-6 mb-0 me-3">@if($product->promot == 1){{$product->getPrice()}} @endif</p>
              </div>
              <div class="d-flex flex-wrap align-items-start mb-3">
                <span class="badge text-bg-primary fs-8 rounded-pill me-2 fw-bold">Il vous reste {{ $product->quantity }} articles dans le stock pour ce produit</span>
              </div>
              <h5 class="mb-3 lh-sm">Description du produit</h5>
              <p class="mb-2 text-body-secondary">
                {{$product->desc}}
              </p>
              <p class="fw-bold mb-5 mb-lg-0 mb-1">Fournisseur : 
                
                @if ($product->supply_id == null)
                  {{$product->supply_name}}
                @else
                  {{$product->supply->name}}
                @endif
              
              </p>
            </div>
            <div>
              <div class="mb-3">
                <p class="fw-semibold mb-2 text-body"><span class="text-body-emphasis" data-product-color="data-product-color">images</span> complémentaires</p>
                <div class="d-flex product-color-variants" data-product-color-variants="data-product-color-variants">
                  
                  <div class="rounded-1 border border-translucent me-2 active" data-variant="images" data-products-images='["{{Storage::url($product->image)}}"]'>
                    <img src="{{Storage::url($product->image)}}" alt="" width="38" />
                  </div>
                  @if(AuthMagasinAgentVisible() == 1)
                    @if($product->images != '')
                      @foreach(json_decode($product->images, true) as $imageSim)
                        <div class="rounded-1 border border-translucent me-2" data-variant="images" data-products-images='["{{Storage::url($imageSim)}}"]'>
                          <img src="{{Storage::url($imageSim)}}" alt="" width="38" />
                        </div>
                      @endforeach
                    @endif
                  @endif
                </div>
              </div>
              <form id="ajouterAuPanier-{{ $product->id }}" action="{{ route('magasin.panier.store') }}" method="POST" class="">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <div class="row g-3 g-sm-5 align-items-end">
                  <div class="col-4">
                    <p class="fw-semibold mb-2 text-body">Unités : </p>
                    <div class="d-flex align-items-center">
                      @if($product->vendor_systems->count() > 0)
                        <select class="form-select w-auto @error('colors') is-invalid @enderror" name="color" id="organizerSingle" data-choices="data-choices" data-options='{"removeItemButton":true,"placeholder":true}'>
                          <option value="">Choisir</option> 
                          @foreach($product->vendor_systems as $vendor_system)
                            <option value="{{ $vendor_system->id }}"> {{ $vendor_system->unite->code }} </option>
                          @endforeach
                        </select>
                        @error('color')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      @else 
                        Null
                      @endif
                    </div>
                  </div>
                  
                  <div class="col-4">
                    <p class="fw-semibold mb-2 text-body">Couleurs|Tailles: </p>
                    <div class="d-flex align-items-center">
                      @if($product->product_color_sizes->count() > 0)
                        <select class="form-select w-auto @error('size') is-invalid @enderror" name="size" id="organizerSingle" data-choices="data-choices" data-options='{"removeItemButton":true,"placeholder":true}'>
                          <option value="">Choisir</option>
                            @foreach($product->product_color_sizes as $getProductColorSize)
                              @if ($getProductColorSize->quantity > 0)
                                <option value="{{ $getProductColorSize->id }}">
                                  <span> {{$getProductColorSize->color->name}}</span> 
                                  <span> {{$getProductColorSize->size->name}}</span> 
                                  <span> {{$getProductColorSize->quantity}}</span> 
                                </option>
                              @endif
                            @endforeach
                        </select>
                        @error('size')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      @else 
                        Null
                      @endif
                    </div>
                  </div>
                  <div class="col-4">
                    <p class="fw-semibold mb-2 text-body">Quantité : </p>
                    <div class="d-flex justify-content-between align-items-end">
                      <div class="d-flex flex-between-center" data-quantity="data-quantity">
                        <span class="btn btn-phoenix-primary px-3" data-type="minus"><span class="fas fa-minus"></span></span>
                        <input name="qty" class="form-control text-center input-spin-none bg-transparent border-0 outline-none" style="width:50px;" type="number" min="1" value="1" />
                        <span class="btn btn-phoenix-primary px-3" data-type="plus"><span class="fas fa-plus"></span>
                      </span>
                    </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <ul class="nav nav-underline fs-9 mb-4" id="productTab" role="tablist">
        <li class="nav-item"><a class="nav-link active" id="description-tab" data-bs-toggle="tab" href="#tab-description" role="tab" aria-controls="tab-description" aria-selected="true">Description</a></li>
        <li class="nav-item"><a class="nav-link" id="specification-tab" data-bs-toggle="tab" href="#tab-specification" role="tab" aria-controls="tab-specification" aria-selected="false">Specifications</a></li>
        <li class="nav-item"><a class="nav-link" id="inventaire-tab" data-bs-toggle="tab" href="#tab-inventaire" role="tab" aria-controls="tab-inventaire" aria-selected="false">Invantaire</a></li>
        {{--<li class="nav-item"><a class="nav-link" id="reviews-tab" data-bs-toggle="tab" href="#tab-reviews" role="tab" aria-controls="tab-reviews" aria-selected="false">Ratings &amp; reviews</a></li>--}}
      </ul>
      <div class="row gx-3 gy-7">
        <div class="col-12 col-lg-7 col-xl-8">
          <div class="tab-content" id="productTabContent">
            <div class="tab-pane pe-lg-6 pe-xl-12 fade show active text-body-emphasis" id="tab-description" role="tabpanel" aria-labelledby="description-tab">
              <p class="mb-5">{{$product->desc}}</p>
            </div>


            <div class="tab-pane pe-lg-6 pe-xl-12 fade" id="tab-specification" role="tabpanel" aria-labelledby="specification-tab">
              
              <table class="table">
                <thead>
                  <tr>
                    <th style="width: 40%"> </th>
                    <th style="width: 60%"></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="bg-body-highlight align-middle">
                      <h6 class="mb-0 text-body text-uppercase fw-bolder px-4 fs-9 lh-sm">Couleurs</h6>
                    </td>
                    <td class="px-5 mb-0">
                      @if($product->colors->count() > 0)
                        @foreach($product->colors as $color)
                          {{$color->name}}, 
                        @endforeach
                      @else
                        NULL
                      @endif
                    </td>
                  </tr>
                  <tr>
                    <td class="bg-body-highlight align-middle">
                      <h6 class="mb-0 text-body text-uppercase fw-bolder px-4 fs-9 lh-sm">Tailles</h6>
                    </td>
                    <td class="px-5 mb-0">
                      @if($product->sizes->count() > 0)
                        @foreach($product->sizes as $size)
                          {{$size->name}}, 
                        @endforeach
                      @else
                        NULL
                      @endif
                    </td>
                  </tr>
                  <tr>
                    <td class="bg-body-highlight align-middle">
                      <h6 class="mb-0 text-body text-uppercase fw-bolder px-4 fs-9 lh-sm">Quantites</h6>
                    </td>
                    <td class="px-5 mb-0">{{ $product->quantity }}</td>
                  </tr>
                  <tr>
                    <td class="bg-body-highlight align-middle">
                      <h6 class="mb-0 text-body text-uppercase fw-bolder px-4 fs-9 lh-sm">Ventes du mois</h6>
                    </td>
                    <td class="px-5 mb-0">{{ $product->ventes->count() }}</td>
                  </tr>
                </tbody>
              </table>
            </div>

            <div class="tab-pane pe-lg-6 pe-xl-12 fade" id="tab-inventaire" role="tabpanel" aria-labelledby="inventaire-tab">
              <h5 class="mb-0 ms-4 fw-bold">Informations avant vente</h5> <br>
              <table class="table mb-4">
                <thead>
                  <tr>
                    <th class="bg-body-highlight align-middle" style="width: 34%"> <h6 class="mb-0 text-body text-uppercase fw-bolder px-4 fs-9 lh-sm">Qts depart</h6> </th>
                    <th class="bg-body-highlight align-middle" style="width: 33%"><h6 class="mb-0 text-body text-uppercase fw-bolder px-4 fs-9 lh-sm">Qts Vendus</h6></th>
                    <th class="bg-body-highlight align-middle" style="width: 33%"><h6 class="mb-0 text-body text-uppercase fw-bolder px-4 fs-9 lh-sm">Qts Actuelle</h6></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="px-5 mb-0">{{ $product->stock }}</td>
                    <td class="px-5 mb-0">{{ $product->ventes->count() }}</td>
                    <td class="px-5 mb-0">{{ $product->quantity }}</td>
                  </tr>
                </tbody>
              </table>

              <h5 class="mb-0 ms-4 fw-bold mt-5">Nombre de ventes par jour</h5> <br>
              <table class="table">
                <thead>
                  <tr>
                    <th class="bg-body-highlight align-middle" style="width: 34%"> <h6 class="mb-0 text-body text-uppercase fw-bolder px-4 fs-9 lh-sm">Dates</h6> </th>
                    <th class="bg-body-highlight align-middle text-end" style="width: 33%"><h6 class="mb-0 text-body text-uppercase fw-bolder px-4 fs-9 lh-sm">Quantites</h6></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($product->ventes as $vente)
                    <tr>
                      <td class="px-5 mb-0">{{date('d-m-Y', strtotime( $vente->date ))}}</td>
                      <td class="px-5 mb-0 text-end">{{ $vente->quantity }}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>


            {{--
            <div class="tab-pane fade" id="tab-reviews" role="tabpanel" aria-labelledby="reviews-tab">
              <div class="bg-body-emphasis rounded-3 p-4 border border-translucent">
                <div class="row g-3 justify-content-between mb-4">
                  <div class="col-auto">
                    <div class="d-flex align-items-center flex-wrap">
                      <h2 class="fw-bolder me-3">4.9<span class="fs-8 text-body-quaternary fw-bold">/5</span></h2>
                      <div class="me-3"><span class="fa fa-star text-warning fs-6"></span><span class="fa fa-star text-warning fs-6"></span><span class="fa fa-star text-warning fs-6"></span><span class="fa fa-star text-warning fs-6"></span><span class="fa fa-star-half-alt star-icon text-warning fs-6"></span></div>
                      <p class="text-body mb-0 fw-semibold fs-7">6548 ratings and 567 reviews</p>
                    </div>
                  </div>
                  <div class="col-auto"><button class="btn btn-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#reviewModal">Rate this product</button>
                    <div class="modal fade" id="reviewModal" tabindex="-1" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content p-4">
                          <div class="d-flex flex-between-center mb-2">
                            <h5 class="modal-title fs-8 mb-0">Your rating</h5><button class="btn p-0 fs-10">Clear</button>
                          </div>
                          <div class="mb-3" data-rater='{"starSize":32,"step":0.5}'></div>
                          <div class="mb-3">
                            <h5 class="text-body-highlight mb-3">Your review</h5><textarea class="form-control" id="reviewTextarea" rows="5" placeholder="Write your review"> </textarea>
                          </div>
                          <div class="dropzone dropzone-multiple p-0 mb-3" id="my-awesome-dropzone" data-dropzone>
                            <div class="fallback"><input name="file" type="file" multiple></div>
                            <div class="dz-preview d-flex flex-wrap">
                              <div class="border border-translucent bg-body-emphasis rounded-3 d-flex flex-center position-relative me-2 mb-2" style="height:80px;width:80px;"><img class="dz-image" src="../../../assets/img/products/23.png" alt="..." data-dz-thumbnail><a class="dz-remove text-body-quaternary" href="#!" data-dz-remove><span data-feather="x"></span></a></div>
                            </div>
                            <div class="dz-message text-body-tertiary text-opacity-85 fw-bold fs-9 p-4" data-dz-message> Drag your photo here <span class="text-body-secondary">or </span><button class="btn btn-link p-0">Browse from device </button><br><img class="mt-3 me-2" src="../../../assets/img/icons/image-icon.png" width="24" alt=""></div>
                          </div>
                          <div class="d-sm-flex flex-between-center">
                            <div class="form-check flex-1"><input class="form-check-input" id="reviewAnonymously" type="checkbox" value="" checked=""><label class="form-check-label mb-0 text-body-emphasis fw-semibold" for="reviewAnonymously">Review anonymously</label></div><button class="btn ps-0" data-bs-dismiss="modal">Close</button><button class="btn btn-primary rounded-pill">Submit</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="mb-4 hover-actions-trigger btn-reveal-trigger">
                  <div class="d-flex justify-content-between">
                    <h5 class="mb-2"><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="text-body-secondary ms-1"> by</span> Zingko Kudobum</h5>
                    <div class="btn-reveal-trigger position-static"><button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs-10"></span></button>
                      <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                        <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                      </div>
                    </div>
                  </div>
                  <p class="text-body-tertiary fs-9 mb-1">35 mins ago</p>
                  <p class="text-body-highlight mb-3">100% satisfied</p>
                  <div class="row g-2 mb-2">
                    <div class="col-auto"><a href="../../../assets/img/e-commerce/review-11.jpg" data-gallery="gallery-0"><img src="../../../assets/img/e-commerce/review-11.jpg" alt="" height="164" /></a></div>
                    <div class="col-auto"><a href="../../../assets/img/e-commerce/review-12.jpg" data-gallery="gallery-0"><img src="../../../assets/img/e-commerce/review-12.jpg" alt="" height="164" /></a></div>
                    <div class="col-auto"><a href="../../../assets/img/e-commerce/review-13.jpg" data-gallery="gallery-0"><img src="../../../assets/img/e-commerce/review-13.jpg" alt="" height="164" /></a></div>
                  </div>
                  <div class="d-flex"><span class="fas fa-reply fa-rotate-180 me-2"></span>
                    <div>
                      <h5>Respond from store<span class="text-body-tertiary fs-9 ms-2">5 mins ago</span></h5>
                      <p class="text-body-highlight mb-0">Thank you for your valuable feedback</p>
                    </div>
                  </div>
                  <div class="hover-actions top-0"><button class="btn btn-sm btn-phoenix-secondary me-2"><span class="fas fa-thumbs-up"></span></button><button class="btn btn-sm btn-phoenix-secondary me-1"><span class="fas fa-thumbs-down"></span></button></div>
                </div>
                <div class="mb-4 hover-actions-trigger btn-reveal-trigger">
                  <div class="d-flex justify-content-between">
                    <h5 class="mb-2"><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa-regular fa-star text-warning-light"></span><span class="text-body-secondary ms-1"> by</span> Piere Auguste Renoir</h5>
                    <div class="btn-reveal-trigger position-static"><button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs-10"></span></button>
                      <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                        <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                      </div>
                    </div>
                  </div>
                  <p class="text-body-tertiary fs-9 mb-1">23 Oct, 12:09 PM</p>
                  <p class="text-body-highlight mb-1">Since the spring loaded event, I've been wanting an iMac, and it's exceeded my expectations. The screen is clear, the colors are vibrant (I got the blue one! ), and the performance is more than adequate for my needs as a college student. That's how good it is.</p>
                  <div class="hover-actions top-0"><button class="btn btn-sm btn-phoenix-secondary me-2"><span class="fas fa-thumbs-up"></span></button><button class="btn btn-sm btn-phoenix-secondary me-1"><span class="fas fa-thumbs-down"></span></button></div>
                </div>
                <div class="mb-4 hover-actions-trigger btn-reveal-trigger">
                  <div class="d-flex justify-content-between">
                    <h5 class="mb-2"><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star-half-alt star-icon text-warning"></span><span class="fa-regular fa-star text-warning-light"></span><span class="text-body-secondary ms-1"> by</span> Abel Kablmann </h5>
                    <div class="btn-reveal-trigger position-static"><button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs-10"></span></button>
                      <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                        <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                      </div>
                    </div>
                  </div>
                  <p class="text-body-tertiary fs-9 mb-1">21 Oct, 12:00 PM</p>
                  <p class="text-body-highlight mb-1">Over the years, I've preferred Apple products. My job has allowed me to use Windows products on laptops and PCs. I've owned Windows laptops and desktops for home use in the past and will never use them again.</p>
                  <div class="hover-actions top-0"><button class="btn btn-sm btn-phoenix-secondary me-2"><span class="fas fa-thumbs-up"></span></button><button class="btn btn-sm btn-phoenix-secondary me-1"><span class="fas fa-thumbs-down"></span></button></div>
                </div>
                <div class="mb-4 hover-actions-trigger btn-reveal-trigger">
                  <div class="d-flex justify-content-between">
                    <h5 class="mb-2"><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="text-body-secondary ms-1"> by</span> Pennywise Alfred</h5>
                    <div class="btn-reveal-trigger position-static"><button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs-10"></span></button>
                      <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                        <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
                      </div>
                    </div>
                  </div>
                  <p class="text-body-tertiary fs-9 mb-1">35 mins ago</p>
                  <p class="text-body-highlight mb-3">Nice and beautiful product.</p>
                  <div class="row g-2 mb-2">
                    <div class="col-auto"><a href="../../../assets/img/e-commerce/review-14.jpg" data-gallery="gallery-3"><img src="../../../assets/img/e-commerce/review-14.jpg" alt="" height="164" /></a></div>
                    <div class="col-auto"><a href="../../../assets/img/e-commerce/review-15.jpg" data-gallery="gallery-3"><img src="../../../assets/img/e-commerce/review-15.jpg" alt="" height="164" /></a></div>
                    <div class="col-auto"><a href="../../../assets/img/e-commerce/review-16.jpg" data-gallery="gallery-3"><img src="../../../assets/img/e-commerce/review-16.jpg" alt="" height="164" /></a></div>
                  </div>
                  <div class="hover-actions top-0"><button class="btn btn-sm btn-phoenix-secondary me-2"><span class="fas fa-thumbs-up"></span></button><button class="btn btn-sm btn-phoenix-secondary me-1"><span class="fas fa-thumbs-down"></span></button></div>
                </div>
                <div class="d-flex justify-content-center">
                  <nav>
                    <ul class="pagination mb-0">
                      <li class="page-item"><a class="page-link" href="#!"><span class="fas fa-chevron-left"> </span></a></li>
                      <li class="page-item"><a class="page-link" href="#!">1</a></li>
                      <li class="page-item"><a class="page-link" href="#!">2</a></li>
                      <li class="page-item"><a class="page-link" href="#!">3</a></li>
                      <li class="page-item active"><a class="page-link" href="#!">4</a></li>
                      <li class="page-item"><a class="page-link" href="#!">5</a></li>
                      <li class="page-item"><a class="page-link" href="#!"><span class="fas fa-chevron-right"></span></a></li>
                    </ul>
                  </nav>
                </div>
              </div>
            </div>
            --}}
          </div>
        </div>
        
        
        
      </div>
    </div><!-- end of .container-->
  </section><!-- <section> close ============================-->
  <!-- ============================================-->

 


  <div class="card-body p-0">
    <div class="p-4 code-to-copy">
      <!-- Right Offcanvas-->
      <div class="offcanvas offcanvas-end" id="offcanvasRight-{{ $product->id }}" tabindex="-1" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
          <h5 id="offcanvasRightLabel">Modification de produit</h5><button class="btn-close text-reset" type="button" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <form method="POST" action="{{ route('magasin.produit.update',$product->id) }}" enctype="multipart/form-data">
            @csrf
            {{ method_field('PUT') }}
            <input type="hidden" name="sub_category_id" value="{{ $product->sub_category->id }}">
            <div class="mb-3 text-start">
              <label class="form-label" for="organizerSingle">Sélectionner un fournisseur</label>
              <select class="form-select @error('supply_id') is-invalid @enderror" name="supply_id" id="organizerSingle" data-choices="data-choices" data-options='{"removeItemButton":true,"placeholder":true}'>
                <option value="">Sélectionner un...</option>
                @foreach ($supplies as $supplie)
                  <option value="{{ old('supply_id') ?? $supplie->id }}" @if($supplie->id == $product->supply_id) selected="" @endif > @if ($supplie->magasin_id != '') {{ $supplie->magasin->name }} @else {{ $supplie->name }} @endif</option>
                @endforeach
              </select>
              @error('supply_id')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
            <div class="mb-3 text-start">
                <label class="form-label" for="name">Titre du produit</label>
                <input id="name" type="text" placeholder="Titre du produit" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $product->name }}" required autocomplete="name" autofocus>

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3 text-start">
              <label class="form-label" for="reference">Reference du produit</label>
              <input id="reference" type="text" placeholder="Reference du produit" class="form-control @error('reference') is-invalid @enderror" name="reference" value="{{ old('reference') ?? $product->reference }}" required autocomplete="reference" autofocus>

              @error('reference')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
            <div class="row mb-3 text-start">
                <div class="col-lg-6">
                  <label class="form-label" for="quantity">Quantite du produit</label>
                  <input id="quantity" type="quantity" class="form-control @error('quantity') is-invalid @enderror" name="quantity" value="{{ old('quantity') ?? $product->quantity }}" placeholder="Quantite du produit" required autocomplete="quantity">

                  @error('quantity')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
                <div class="col-lg-6">
                  <label class="form-label" for="qty_alert">Quantite d'alerte</label>
                  <input id="qty_alert" type="qty_alert" class="form-control @error('qty_alert') is-invalid @enderror" name="qty_alert" value="{{ old('qty_alert') ?? $product->qty_alert }}" placeholder="Quantite d'alerte" required autocomplete="qty_alert">

                  @error('qty_alert')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
            </div>

            <div class="row mb-3 text-start">
              <div class="col-lg-6">
                <label class="form-label" for="image">Image du produit</label>
                <img src="{{Storage::url($product->image)}}" alt="" width="38" style="float: right;"/>
                <input class="form-control @error('image') is-invalid @enderror" id="image" name="image" type="file" value="{{ old('image') ?? $product->image }}"  autocomplete="image"/>
                @error('image')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              <div class="col-lg-6">
                <label class="form-label mb-3" for="datepicker">Date d'expiration</label>
                <input type="text" id="datepicker" class="form-control datetimepicker @error('exp_date') is-invalid @enderror" name="exp_date" value="{{ old('exp_date') ?? $product->exp_date }}" data-options='{"disableMobile":true,"dateFormat":"d/m/y"}' required autocomplete="exp_date">

                @error('exp_date')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
            </div>

            <div class="mb-3 text-start">
              <label class="form-label" for="desc">Description du produit </label>
              <textarea class="form-control @error('desc') is-invalid @enderror" id="desc" name="desc" required autocomplete="desc" rows="4"> {{ $product->desc}} </textarea>
              @error('desc')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>

            <div class="mb-3 text-start">
              <label class="form-label" for="email">Status du produit</label> <br>
              
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-check form-switch">
                    <input onchange="enableBrand(this)" class="form-check-input @error('promot') is-invalid @enderror" id="flexSwitchCheckDefault" name="promot" type="checkbox" @if($product->promot == 1) checked @endif value="1" />
                    <label class="form-check-label mt-1" for="flexSwitchCheckDefault">En promotion</label>
                  </div>
                  @error('promot')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>

                <div class="col-lg-6">
                  <div class="form-check form-check-inline">
                    <input class="form-check-input text-success @error('visible') is-invalid @enderror" @if($product->visible == 1) checked="" @endif id="inlineRadioA-{{ $product->id }}" type="radio" name="visible" value=" 1 ">
                    <label class="form-check-label text-success" for="inlineRadioA-{{ $product->id }}">Visible</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input text-warning @error('visible') is-invalid @enderror" @if($product->visible == 0) checked="" @endif id="inlineRadioB-{{ $product->id }}" type="radio" name="visible" value=" 0 ">
                    <label class="form-check-label text-warning" for="inlineRadioB-{{ $product->id }}">Cacher</label>
                  </div>
                  @error('visible')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>

                <div class="col-lg-12 mb-3 @if($product->promot != 1) d-none @endif" id="clientEditNone">
                  <label class="form-label" for="price_promotion">Prix du produit en promotion</label>
                  <input id="price_promotion" type="numeric" class="form-control @error('price_promotion') is-invalid @enderror" name="price_promotion" value="{{ old('price_promotion') ?? $product->promo_price }}" placeholder="Prix du produit" autocomplete="price_promotion">

                  @error('price_promotion')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
              

            </div>

            @if(AuthMagasinAgentVisible() == 1)
              <div class="mb-3 text-start">
                <label class="form-label" for="images">Modifier les images similaires (facultatif)</label> <br>
                  @if($product->images != '')
                    @foreach(json_decode($product->images, true) as $image)
                      <img src="{{Storage::url($image)}}" alt="" width="38" />
                    @endforeach
                  @endif
                  <input type="file" name="images[]" multiple="multiple" class="form-control form-control-sm mb-4" id="customFileSm"> 
              </div>
            @endif

            <button class="btn btn-primary w-100 mb-3" type="submit">Enregistrer les modifications</button>
          </form>
        </div>
      </div>
    </div>
  </div>


  <div class="modal fade" id="DeleteProduct-{{ $product->id }}" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-danger" id="exampleModalLabel">Suppresion de produit</h5><button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close"><svg class="svg-inline--fa fa-xmark fs-9" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="xmark" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path fill="currentColor" d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z"></path></svg><!-- <span class="fas fa-times fs-9"></span> Font Awesome fontawesome.com --></button>
        </div>
        <form action="{{ route('magasin.produit.destroy',$product->id) }}" method="post">
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



    @include('layouts.footer_admin')


</div>
@endsection
@section('footerSection')
<script src="{{ asset('assets/js/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap-tagsinput.js') }}"></script> 
<script src="{{asset('vendors/choices/choices.min.js')}}"></script>
<script src="{{asset('vendors/flatpickr/flatpickr.min.js')}}"></script>
<script type="text/javascript">
  $("#colors").tagsinput();
  $("#sizes").tagsinput();
  $(".colorsUpdate").tagsinput();
  $(".sizesUpdate").tagsinput();
</script>


<script>
    function enableBrand(answer){
      if (answer.checked == 1) {
          document.getElementById('clientEditNone').classList.remove('d-none')
      }else{
          document.getElementById('clientEditNone').classList.add('d-none')
      }
    }
</script>
@endsection