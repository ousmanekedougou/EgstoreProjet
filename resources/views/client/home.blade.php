@extends('layouts.app',['title' => 'client-acceuil'])

@section('main-content')
    <!-- ============================================-->
    <!-- <section> begin ============================-->
    <section class="pt-5 pb-9 py-0 px-xl-3">
        <div class="container px-xl-0 px-xxl-3">
            <h2 class="mb-1">Mes magasins préférés</h2>
            <p class="mb-5 text-body-tertiary fw-semibold">Indispensable pour une vie meilleure</p>

            <div class="row g-3 mb-9">
                <div class="col-12">
                <div class="whooping-banner w-100 rounded-3 overflow-hidden">
                    <div class="bg-holder z-n1 product-bg" style="background-image:url(../../../assets/img/e-commerce/whooping_banner_product.png);background-position: bottom right;"></div>
                    <!--/.bg-holder-->
                    <div class="bg-holder z-n1 shape-bg" style="background-image:url(../../../assets/img/e-commerce/whooping_banner_shape_2.png);background-position: bottom left;"></div>
                    <!--/.bg-holder-->
                    <div class="banner-text" data-bs-theme="light">
                    <h2 class="text-warning-light fw-bolder fs-lg-3 fs-xxl-2">Whooping <span class="gradient-text">60% </span>Off</h2>
                    <h3 class="fw-bolder fs-lg-5 fs-xxl-3 text-white">on everyday items</h3>
                    </div><a class="btn btn-lg btn-primary rounded-pill banner-button" href="#!">Shop Now</a>
                </div>
                </div>
            </div>
            <div class="row gx-3 gy-5">
                @foreach($magasins as $magasin)
                <div class="col-6 col-sm-4 col-md-3 col-lg-2 hover-actions-trigger btn-reveal-trigger">
                    <div class="border border-translucent d-flex flex-center rounded-3 mb-3 p-4" style="height:180px;"><img class="mw-100" src="{{asset($magasin->logo)}}" alt="{{$magasin->name}}" /></div>
                    <h5 class="mb-2">{{$magasin->name}}</h5>
                    <div class="mb-1 fs-9"><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa-regular fa-star text-warning-light"></span></div>
                    <p class="text-body-quaternary fs-9 mb-2 fw-semibold">(1263 people rated)</p>
                    <a class="btn btn-link p-0" target="_blank" href="{{ route('client.magasin.show',$magasin->slug) }}">Visiter ce magasin
                        <span class="fas fa-chevron-right ms-1 fs-10"></span>
                    </a>
                    <div class="hover-actions top-0 end-0 mt-2 me-3">
                        <div class="btn-reveal-trigger">
                            <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal p-2 lh-1 bg-body-highlight rounded-1" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs-9"></span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end py-2">
                            <a class="dropdown-item" href="#!">Voire</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-warning" href="#!">Retirer</a>
                        </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

        </div><!-- end of .container-->
    </section><!-- <section> close ============================-->
    <!-- ============================================-->
@endsection