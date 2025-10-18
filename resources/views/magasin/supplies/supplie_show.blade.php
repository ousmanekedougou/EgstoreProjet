@extends('layouts.app',['title' => 'A propos du magasin'])

@section('main-content')

<div class="content">
    <div class="mb-9">
      <div class="row align-items-center justify-content-between g-3 mb-4">
        <div class="col-auto">
          <h2 class="mb-0">Informations sur {{ $magasin->name }}</h2>
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
                      <div class="avatar avatar-5xl"><img class="rounded-circle" src="@if($magasin->logo == '') https://ui-avatars.com/api/?name={{$magasin->name}} @else {{(Storage::url($magasin->logo))}} @endif" alt="" /></div>
                    </div>
                    <div class="col-12 col-sm-auto flex-1">
                      <h3>{{ $magasin->name }}</h3>
                      <p class="text-body-secondary">Inscrit il y'a {{ $duration }}</p>
                      <div>
                        @if ($magasin->social)

                        <a class="me-2" target="_blank" href="{{ $magasin->social->facebook }}">
                          <span class="fab fa-facebook text-body-quaternary text-opacity-75 text-primary-hover"></span>
                        </a>
                        
                        <a class="me-2" target="_blank" href="{{ $magasin->social->whatsapp }}">
                          <span class="fab fa-whatsapp text-body-quaternary text-opacity-75 text-primary-hover"></span>
                        </a>
                        
                        <a class="me-2" target="_blank" href="{{ $magasin->social->instagram }}">
                          <span class="fab fa-instagram text-body-quaternary text-opacity-75 text-primary-hover"></span>
                        </a>

                        <a target="_blank" href="{{ $magasin->social->tiktok }}">
                          <span class="fab fa-tiktok text-body-quaternary text-opacity-75 text-primary-hover"></span>
                        </a>
                       @endif

                      </div>
                    </div>
                  </div>
                  <div class="d-flex flex-between-center border-top border-dashed pt-4">
                    <div>
                      <h6>Employé(s)</h6>
                      <p class="fs-7 text-body-secondary mb-0 text-center">{{ $magasin->agents->count() }}</p>
                    </div>
                    <div>
                      <h6>Clients abonné(s)</h6> 
                      <p class="fs-7 text-body-secondary mb-0 text-center">{{ $magasin->users->count() }}</p>
                    </div>
                    <div>
                      <h6>Clients enrégistré(s)</h6>
                      <p class="fs-7 text-body-secondary mb-0 text-center">{{ $magasin->clients->count() }}</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-md-5 col-xxl-12 mb-xxl-3">
              <div class="card h-100">
                <div class="card-body pb-3">
                  <div class="d-flex align-items-center mb-3">
                    <h3 class="me-1">Adresse par défaut</h3><button class="btn btn-link p-0"><span class="fas fa-pen fs-8 ms-3 text-body-quaternary"></span></button>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <h5 class="text-body-secondary">Adresse</h5>
                      <p class="text-body-secondary">{{ $magasin->adresse }}</p>
                      <div class="mb-3">
                        <h5 class="text-body-secondary">Email</h5><a href="mailto:{{ $magasin->email }}">{{ $magasin->email }}</a>
                      </div>
                      <h5 class="text-body-secondary">Téléphone</h5><a class="text-body-secondary" href="tel:{{ $magasin->phone }}">{{ $magasin->phone }}</a>
                    </div>
                    <div class="col-lg-6">
                      <h5 class="text-body-secondary">RCCM</h5>
                      <p class="text-body-secondary">{{ $magasin->registre_com }}</p>
                      <div class="mb-3">
                        <h5 class="text-body-secondary">NINEA</h5>
                        <p class="text-body-secondary">{{ $magasin->ninea }}</p>
                      </div>
                      <h5 class="text-body-secondary">Tél magasin</h5><a class="text-body-secondary" href="tel:{{ $magasin->shop_phone }}">{{ $magasin->shop_phone }}</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="card h-100">
                <div class="card-body">
                  <h3 class="mb-4">Notes sur le magasin</h3>
                  <div class="fs-9 fw-semibold pb-3 mb-4 border-bottom border-dashed">
                    <h6 class="mb-4">Histoire de {{ $magasin->name }}</h6>
                    <p class="text-body-highlight mb-1">{{ $magasin->about ? $magasin->about->our_history : '......' }}</p>
                  </div>
                  <div class="fs-9 fw-semibold pb-3 mb-4 border-bottom border-dashed">
                    <h6 class="mb-4">Vision de {{ $magasin->name }}</h6>
                    <p class="text-body-highlight mb-1">{{ $magasin->about ? $magasin->about->our_vision : '......' }}</p>
                  </div>
                  <div class="fs-9 fw-semibold pb-3 mb-4 border-bottom border-dashed">
                    <h6 class="mb-4">Mission de {{ $magasin->name }}</h6>
                    <p class="text-body-highlight mb-1">{{ $magasin->about ? $magasin->about->our_mission : '......' }}</p>
                  </div>
                  <div class="fs-9 fw-semibold">
                    <h6 class="mb-4">Les valeurs de {{ $magasin->name }}</h6>
                    <p class="text-body-highlight mb-1">{{ $magasin->about ? $magasin->about->our_values : '......' }}</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div>
          <div class="scrollbar">
            <ul class="nav nav-underline fs-9 flex-nowrap mb-3 pb-1" id="myTab" role="tablist">

              <li class="nav-item me-3" role="presentation">
                <a class="nav-link text-nowrap active" id="categorys-tab" data-bs-toggle="tab" href="#tab-categorys" role="tab" aria-controls="tab-orders" aria-selected="true">
                  <span class="fas fa-bars me-2"></span>  <span class="text-body-tertiary fw-normal"> Categories</span>
                </a>
              </li>

              <li class="nav-item me-3" role="presentation">
                <a class="nav-link text-nowrap" id="products-tab" data-bs-toggle="tab" href="#tab-products" role="tab" aria-controls="tab-orders" aria-selected="false" tabindex="-1">
                 <span class="fab fa-product-hunt me-2"></span><span class="text-body-tertiary fw-normal"> Produits</span>
                </a>
              </li>

              <li class="nav-item me-3" role="presentation">
                <a class="nav-link text-nowrap" id="social-tab" data-bs-toggle="tab" href="#tab-social" role="tab" aria-controls="tab-orders" aria-selected="false" tabindex="-1">
                 <span class="fas fa-globe me-2"></span>Nos reseaux sociaux
                </a>
              </li>

            </ul>
          </div>
          <div class="tab-content" id="profileTabContent">

            <div class="tab-pane fade active show" id="tab-categorys" role="tabpanel" aria-labelledby="categorys-tab">
              <div class="border-translucent" id="profileOrdersTable" data-list="{&quot;valueNames&quot;:[&quot;order&quot;,&quot;status&quot;,&quot;delivery&quot;,&quot;date&quot;,&quot;total&quot;],&quot;page&quot;:6,&quot;pagination&quot;:true}">
              <div class="card border-0 scrollbar" style="max-height: 657px;">
                <div class="card-body p-6 pb-3">
                  <div class="row gx-7 gy-5 mb-5">
                    @foreach($magasin->categories as $category)
                      <div class="col-12 col-sm-6 col-md-4">
                        <div class="d-flex align-items-center mb-3"><span data-feather="{{ $category->icon }}" class="text-primary me-2 fs-9" style="stroke-width:3;"></span>
                          <h6 class="text-body-highlight mb-0 text-nowrap">{{$category->name}}</h6>
                        </div>
                        <div class="ms-n2">
                            @foreach($category->sub_categories as $subcategory)
                              @if($subcategory->visible == 1)
                                <a class="text-body-emphasis fs-9 d-block mb-1 text-decoration-none bg-body-highlight-hover px-2 py-1 rounded-2" href="#">{{$subcategory->name}}</a>
                              @endif
                            @endforeach
                        </div>
                      </div>
                    @endforeach
                  </div>
                  <div class="text-center border-top border-translucent pt-3"></div>
                </div>
              </div>
              </div>
            </div>

            <div class="tab-pane fade" id="tab-products" role="tabpanel" aria-labelledby="products-tab">
              <div class="border-y" id="profileRatingTable" data-list="{&quot;valueNames&quot;:[&quot;product&quot;,&quot;rating&quot;,&quot;review&quot;,&quot;status&quot;,&quot;date&quot;],&quot;page&quot;:6,&quot;pagination&quot;:true}">
                <div class="mb-6 pt-3">
                  <div class="swiper-theme-container products-slider">
                    <div class="swiper swiper theme-slider" data-swiper='{"slidesPerView":1,"spaceBetween":16,"breakpoints":{"450":{"slidesPerView":2,"spaceBetween":16},"576":{"slidesPerView":3,"spaceBetween":20},"768":{"slidesPerView":4,"spaceBetween":20},"992":{"slidesPerView":5,"spaceBetween":20},"1200":{"slidesPerView":6,"spaceBetween":16}}}'>
                      <div class="swiper-wrapper">
                        @foreach ($products as $product)
                          <div class="swiper-slide">
                            <div class="position-relative text-decoration-none product-card h-100">
                              <div class="d-flex flex-column justify-content-between h-100">
                                <div>
                                  <div class="border border-1 border-translucent rounded-3 position-relative mb-3">
                                    <img class="img-fluid" src="{{Storage::url($product->image)}}" alt="" />
                                  </div>
                                  <a class="stretched-link" href="">
                                    <h6 class="mb-2 lh-sm line-clamp-3 product-name">{{ $product->name }}</h6>
                                  </a>
                                  <p class="fs-9">
                                    <span class="fa fa-star text-warning"></span>
                                    <span class="fa fa-star text-warning"></span>
                                    <span class="fa fa-star text-warning"></span>
                                    <span class="fa fa-star text-warning"></span>
                                    <span class="fa fa-star text-warning"></span>
                                    <span class="text-body-quaternary fw-semibold ms-1"><!--(59 people rated)--></span>
                                  </p>
                                </div>
                                <div>
                                  <h3 class="text-body-emphasis fs-8">{{$product->getPrice()}}</h3>
                                  <p class="text-body-tertiary fw-semibold fs-9 lh-1 mb-0">{{ $product->color }}</p>
                                </div>
                              </div>
                            </div>
                          </div>
                        @endforeach
                      </div>
                    </div>
                    <div class="swiper-nav">
                      <div class="swiper-button-next"><span class="fas fa-chevron-right nav-icon"></span></div>
                      <div class="swiper-button-prev"><span class="fas fa-chevron-left nav-icon"></span></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="tab-pane fade" id="tab-social" role="tabpanel" aria-labelledby="social-tab">
              <div class="" id="productWishlistTable" data-list="{&quot;valueNames&quot;:[&quot;products&quot;,&quot;color&quot;,&quot;size&quot;,&quot;price&quot;,&quot;quantity&quot;,&quot;total&quot;],&quot;page&quot;:5,&quot;pagination&quot;:true}">
                <div class="card border mb-3">
                  <div class="card-body">
                    @if ($magasin->social)
                      <div class="row list" id="icon-list">

                        <div class="col-lg-3 col-md-4 col-sm-6">
                          <a target="_blank" href="{{ $magasin->social->facebook }}">
                            <div class="border rounded-2 p-3 mb-4 text-center bg-body-emphasis dark__bg-gray-1000 shadow-sm">
                              <span class="text-body fs-2 fa-brands fa-facebook"></span>
                              <p class="form-control form-control-sm mt-3 text-center w-100 text-dark dark__text-gray-100 bg-body-secondary" readonly="readonly">Facebook</p>
                            </div>
                          </a>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6">
                          <a target="_blank" href="{{ $magasin->social->whatsapp }}">
                            <div class="border rounded-2 p-3 mb-4 text-center bg-body-emphasis dark__bg-gray-1000 shadow-sm">
                              <span class="text-body fs-2 fa-brands fa-whatsapp"></span>
                              <p class="form-control form-control-sm mt-3 text-center w-100 text-dark dark__text-gray-100 bg-body-secondary" readonly="readonly">Whatsapp</p>
                            </div>
                          </a>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6">
                          <a target="_blank" href="{{ $magasin->social->instagram }}">
                            <div class="border rounded-2 p-3 mb-4 text-center bg-body-emphasis dark__bg-gray-1000 shadow-sm">
                              <span class="text-body fs-2 fa-brands fa-instagram"></span>
                              <p class="form-control form-control-sm mt-3 text-center w-100 text-dark dark__text-gray-100 bg-body-secondary" readonly="readonly">Instagram</p>
                            </div>
                          </a>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6">
                          <a target="_blank" href="{{ $magasin->social->tiktok }}">
                            <div class="border rounded-2 p-3 mb-4 text-center bg-body-emphasis dark__bg-gray-1000 shadow-sm">
                              <span class="text-body fs-2 fa-brands fa-tiktok"></span>
                              <p class="form-control form-control-sm mt-3 text-center w-100 text-dark dark__text-gray-100 bg-body-secondary" readonly="readonly">TikTok</p>
                            </div>
                          </a>
                        </div>

                      </div>
                    @else
                      Ce magasin n'a pas encore ajouter ses réseaux sociaux
                    @endif
                    

                  </div>
                </div>
              </div>
            </div>
            
          </div>
        </div>
      </div>
    </div>
    @include('layouts.footer_admin')
  </div>
@endsection
