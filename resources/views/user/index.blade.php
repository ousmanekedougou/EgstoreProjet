@extends('layouts.app')
<style>
  .right{
    margin-top: -6rem;
  }
  .btn{
    width: 100%;
  }
  
</style>
@section('main-content')
<section class="section overflow-hidden py-0">
  <div class="bg-holder opacity-50" style="background-image:url(assets/img/bg/26.png);background-position:14%;background-size: contain; height:100%;" data-gsap-parallax='{"y":"-40%"}'></div>
  <div class="container-small position-relative py-8">
    <div class="row align-items-center gx-xxl-13">
      <div class="col-lg-6 mb-6 z-1"><img class="mw-100" src="assets/img/sections/63.webp" alt="" /></div>
      <div class="col-lg-6 p-2">
        <a class="d-flex flex-center text-decoration-none mb-4 right" href="/">
          <div class="d-flex align-items-center fw-bolder fs-3 d-inline-block">
            <img src="{{asset('assets/img/icons/logo.png')}}" alt="phoenix" width="58" />
          </div>
        </a>
        <h1 class="text-secondary fw-normal mb-4 text-center">Service<br class="d-none d-lg-block d-xl-none" /><span class="text-primary-secondary ms-2 fw-bolder">KStore</span></h1>
        <p class="text-secondary text-lg-start pl-3 mb-4">Built with all top-notch technologies, this admin dashboard is fully responsive, and the clean codebase helps it to stay intact without breaking down the layout around any device or screen size or web browser.</p>
        <div class="d-flex">
          <a href="{{ route('magasin.register') }}" class="btn btn-subtle-primary me-1 mb-1">Creer votre entreprise</a>
          <a href="{{ route('register') }}" class="btn btn-subtle-info me-1 mb-1">Creer votre compte client</a>
        </div>
      </div>
    </div>
  </div>
</section>


@endsection