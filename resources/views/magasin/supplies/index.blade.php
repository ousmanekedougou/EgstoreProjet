@extends('layouts.app',['title' => 'Autres magasins'])

@section('main-content')
<div class="content">

<!-- ============================================-->
      <!-- <section> begin ============================-->
      <section class="py-0 mb-3">
        <div class="container-small">
          <div class="ecommerce-topbar">
            <nav class="navbar navbar-expand-lg navbar-light px-0">
              <div class="row gx-0 gy-2 w-100 flex-between-center">
                <div class="col-auto">
                  <h2 class="mb-3">Autres magasins</h2>
                </div>
                <div class="col-12 col-sm-4 col-md-3 col-lg-8">
                  <div class="search-box  w-100">
                    <form class="position-relative">
                      <input class="form-control search-input search form-control-md" type="search" placeholder="Rechercher votre magasin" aria-label="Search" />
                      <span class="fas fa-search search-box-icon"></span>
                    </form>
                  </div>
                </div>
              </div>
            </nav>
          </div>
        </div><!-- end of .container-->
      </section><!-- <section> close ============================-->
      <!-- ============================================-->
  
 <!-- ============================================-->
      <!-- <section> begin ============================-->
      <section class="pt-0 pb-9">
        <div class="container-small">
          
          <div class="row gx-3 gy-5">
            @foreach ($magasins as $magasin)
              <div class="col-6 col-sm-4 col-md-3 col-lg-2 hover-actions-trigger btn-reveal-trigger">
                <div class="border border-translucent d-flex flex-center rounded-3 mb-3 p-4" style="height:180px;"><img class="mw-100" src="@if($magasin->logo == '') https://ui-avatars.com/api/?name={{$magasin->name}} @else {{(Storage::url($magasin->logo))}} @endif" alt="{{ $magasin->name }}" /></div>
                <h5 class="mb-2">{{ $magasin->name }}</h5>
                <a class="btn btn-link p-0" href="{{ route('magasin.autres-magasins.show',$magasin->slug) }}">A propos<span data-feather="chevron-right" class="ms-1 fs-10"></span></a>
                <div class="hover-actions top-0 end-0 mt-2 me-3">
                  <div class="btn-reveal-trigger"><button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal p-2 lh-1 bg-body-highlight rounded-1" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs-9"></span></button>
                    <div class="dropdown-menu dropdown-menu-end py-0">
                      <a class="dropdown-item" href="{{ route('magasin.fournisseurs.addSupply',$magasin->id) }}">Ajouter comme fornisseur</a>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div><!-- end of .container-->
      </section><!-- <section> close ============================-->
      <!-- ============================================-->

      @include('layouts.footer_admin')
</div>
@endsection
