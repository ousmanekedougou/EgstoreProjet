@extends('layouts.app',['title' => 'client-boutique'])

@section('main-content')

      <nav class="ecommerce-navbar navbar-expand navbar-light bg-body-emphasis justify-content-between">
        <div class="container-small d-flex flex-between-center" data-navbar="data-navbar">
          <div class="dropdown"><button class="btn text-body ps-0 pe-5 text-nowrap dropdown-toggle dropdown-caret-none" data-category-btn="data-category-btn" data-bs-toggle="dropdown"><span class="fas fa-bars me-2"></span>Category</button>
            <div class="dropdown-menu border border-translucent py-0 category-dropdown-menu">
              <div class="card border-0 scrollbar" style="max-height: 657px;">
                <div class="card-body p-6 pb-3">
                  <div class="row gx-7 gy-5 mb-5">
                    <div class="col-12 col-sm-6 col-md-3">
                      <div class="d-flex align-items-center mb-3"><span class="text-primary me-2" data-feather="pocket" style="stroke-width:3;"></span>
                        <h6 class="text-body-highlight mb-0 text-nowrap">Collectibles &amp; Art</h6>
                      </div>
                      <div class="ms-n2"><a class="text-body-emphasis d-block mb-1 text-decoration-none bg-body-highlight-hover px-2 py-1 rounded-2" href="#!">Collectibles</a><a class="text-body-emphasis d-block mb-1 text-decoration-none bg-body-highlight-hover px-2 py-1 rounded-2" href="#!">Antiques</a><a class="text-body-emphasis d-block mb-1 text-decoration-none bg-body-highlight-hover px-2 py-1 rounded-2" href="#!">Sports memorabilia </a><a class="text-body-emphasis d-block mb-1 text-decoration-none bg-body-highlight-hover px-2 py-1 rounded-2" href="#!">Art</a></div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4">
                      <div class="d-flex align-items-center mb-3"><span class="text-primary me-2" data-feather="home" style="stroke-width:3;"></span>
                        <h6 class="text-body-highlight mb-0 text-nowrap">Home &amp; Gardan</h6>
                      </div>
                      <div class="ms-n2"><a class="text-body-emphasis d-block mb-1 text-decoration-none bg-body-highlight-hover px-2 py-1 rounded-2" href="#!">Yard, Garden &amp; Outdoor</a><a class="text-body-emphasis d-block mb-1 text-decoration-none bg-body-highlight-hover px-2 py-1 rounded-2" href="#!">Crafts</a><a class="text-body-emphasis d-block mb-1 text-decoration-none bg-body-highlight-hover px-2 py-1 rounded-2" href="#!">Home Improvement</a><a class="text-body-emphasis d-block mb-1 text-decoration-none bg-body-highlight-hover px-2 py-1 rounded-2" href="#!">Pet Supplies</a></div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4">
                      <div class="d-flex align-items-center mb-3"><span class="text-primary me-2" data-feather="globe" style="stroke-width:3;"></span>
                        <h6 class="text-body-highlight mb-0 text-nowrap">Sporting Goods</h6>
                      </div>
                      <div class="ms-n2"><a class="text-body-emphasis d-block mb-1 text-decoration-none bg-body-highlight-hover px-2 py-1 rounded-2" href="#!">Outdoor Sports</a><a class="text-body-emphasis d-block mb-1 text-decoration-none bg-body-highlight-hover px-2 py-1 rounded-2" href="#!">Team Sports</a><a class="text-body-emphasis d-block mb-1 text-decoration-none bg-body-highlight-hover px-2 py-1 rounded-2" href="#!">Exercise &amp; Fitness</a><a class="text-body-emphasis d-block mb-1 text-decoration-none bg-body-highlight-hover px-2 py-1 rounded-2" href="#!">Golf</a></div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4">
                      <div class="d-flex align-items-center mb-3"><span class="text-primary me-2" data-feather="monitor" style="stroke-width:3;"></span>
                        <h6 class="text-body-highlight mb-0 text-nowrap">Electronics</h6>
                      </div>
                      <div class="ms-n2"><a class="text-body-emphasis d-block mb-1 text-decoration-none bg-body-highlight-hover px-2 py-1 rounded-2" href="#!">Computers &amp; Tablets</a><a class="text-body-emphasis d-block mb-1 text-decoration-none bg-body-highlight-hover px-2 py-1 rounded-2" href="#!">Camera &amp; Photo</a><a class="text-body-emphasis d-block mb-1 text-decoration-none bg-body-highlight-hover px-2 py-1 rounded-2" href="#!">TV, Audio &amp; Surveillance</a><a class="text-body-emphasis d-block mb-1 text-decoration-none bg-body-highlight-hover px-2 py-1 rounded-2" href="#!">Cell Ohone &amp; Accessories</a></div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4">
                      <div class="d-flex align-items-center mb-3"><span class="text-primary me-2" data-feather="truck" style="stroke-width:3;"></span>
                        <h6 class="text-body-highlight mb-0 text-nowrap">Auto Parts &amp; Accessories</h6>
                      </div>
                      <div class="ms-n2"><a class="text-body-emphasis d-block mb-1 text-decoration-none bg-body-highlight-hover px-2 py-1 rounded-2" href="#!">GPS &amp; Security Devices</a><a class="text-body-emphasis d-block mb-1 text-decoration-none bg-body-highlight-hover px-2 py-1 rounded-2" href="#!">Rader &amp; Laser Detectors</a><a class="text-body-emphasis d-block mb-1 text-decoration-none bg-body-highlight-hover px-2 py-1 rounded-2" href="#!">Care &amp; Detailing</a><a class="text-body-emphasis d-block mb-1 text-decoration-none bg-body-highlight-hover px-2 py-1 rounded-2" href="#!">Scooter Parts &amp; Accessories</a></div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4">
                      <div class="d-flex align-items-center mb-3"><span class="text-primary me-2" data-feather="codesandbox" style="stroke-width:3;"></span>
                        <h6 class="text-body-highlight mb-0 text-nowrap">Toys &amp; Hobbies</h6>
                      </div>
                      <div class="ms-n2"><a class="text-body-emphasis d-block mb-1 text-decoration-none bg-body-highlight-hover px-2 py-1 rounded-2" href="#!">Radio Control</a><a class="text-body-emphasis d-block mb-1 text-decoration-none bg-body-highlight-hover px-2 py-1 rounded-2" href="#!">Kids Toys</a><a class="text-body-emphasis d-block mb-1 text-decoration-none bg-body-highlight-hover px-2 py-1 rounded-2" href="#!">Action Figures</a><a class="text-body-emphasis d-block mb-1 text-decoration-none bg-body-highlight-hover px-2 py-1 rounded-2" href="#!">Dolls &amp; Bears</a></div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4">
                      <div class="d-flex align-items-center mb-3"><span class="text-primary me-2" data-feather="watch" style="stroke-width:3;"></span>
                        <h6 class="text-body-highlight mb-0 text-nowrap">Fashion</h6>
                      </div>
                      <div class="ms-n2"><a class="text-body-emphasis d-block mb-1 text-decoration-none bg-body-highlight-hover px-2 py-1 rounded-2" href="#!">Women</a><a class="text-body-emphasis d-block mb-1 text-decoration-none bg-body-highlight-hover px-2 py-1 rounded-2" href="#!">Men</a><a class="text-body-emphasis d-block mb-1 text-decoration-none bg-body-highlight-hover px-2 py-1 rounded-2" href="#!">Jewelry &amp; Watches</a><a class="text-body-emphasis d-block mb-1 text-decoration-none bg-body-highlight-hover px-2 py-1 rounded-2" href="#!">Shoes</a></div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4">
                      <div class="d-flex align-items-center mb-3"><span class="text-primary me-2" data-feather="music" style="stroke-width:3;"></span>
                        <h6 class="text-body-highlight mb-0 text-nowrap">Musical Instruments &amp; Gear</h6>
                      </div>
                      <div class="ms-n2"><a class="text-body-emphasis d-block mb-1 text-decoration-none bg-body-highlight-hover px-2 py-1 rounded-2" href="#!">Guitar</a><a class="text-body-emphasis d-block mb-1 text-decoration-none bg-body-highlight-hover px-2 py-1 rounded-2" href="#!">Pro Audio Equipment</a><a class="text-body-emphasis d-block mb-1 text-decoration-none bg-body-highlight-hover px-2 py-1 rounded-2" href="#!">String</a><a class="text-body-emphasis d-block mb-1 text-decoration-none bg-body-highlight-hover px-2 py-1 rounded-2" href="#!">Stage Lighting &amp; Effects</a></div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4">
                      <div class="d-flex align-items-center mb-3"><span class="text-primary me-2" data-feather="grid" style="stroke-width:3;"></span>
                        <h6 class="text-body-highlight mb-0 text-nowrap">Other Categories</h6>
                      </div>
                      <div class="ms-n2"><a class="text-body-emphasis d-block mb-1 text-decoration-none bg-body-highlight-hover px-2 py-1 rounded-2" href="#!">Video Games &amp; Consoles</a><a class="text-body-emphasis d-block mb-1 text-decoration-none bg-body-highlight-hover px-2 py-1 rounded-2" href="#!">Health &amp; Beauty</a><a class="text-body-emphasis d-block mb-1 text-decoration-none bg-body-highlight-hover px-2 py-1 rounded-2" href="#!">Baby</a><a class="text-body-emphasis d-block mb-1 text-decoration-none bg-body-highlight-hover px-2 py-1 rounded-2" href="#!">Business &amp; Industrial</a></div>
                    </div>
                  </div>
                  <div class="text-center border-top border-translucent pt-3"><a class="fw-bold" href="#!">See all Categories<span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a></div>
                </div>
              </div>
            </div>
          </div>
          <ul class="navbar-nav justify-content-end align-items-center">
            <li class="nav-item" data-nav-item="data-nav-item"><a class="nav-link ps-0" href="homepage.html">Home</a></li>
            <li class="nav-item" data-nav-item="data-nav-item"><a class="nav-link" href="favourite-stores.html">My Favorites Stores</a></li>
            <li class="nav-item" data-nav-item="data-nav-item"><a class="nav-link active" href="products-filter.html">Products</a></li>
            <li class="nav-item" data-nav-item="data-nav-item"><a class="nav-link" href="wishlist.html">Wishlist</a></li>
            <li class="nav-item" data-nav-item="data-nav-item"><a class="nav-link" href="shipping-info.html">Shipping Info</a></li>
            <li class="nav-item" data-nav-item="data-nav-item"><a class="nav-link" href="../admin/add-product.html">Be a vendor</a></li>
            <li class="nav-item" data-nav-item="data-nav-item"><a class="nav-link" href="order-tracking.html">Track order</a></li>
            <li class="nav-item" data-nav-item="data-nav-item"><a class="nav-link pe-0" href="checkout.html">Checkout</a></li>
            <li class="nav-item dropdown" data-nav-item="data-nav-item" data-more-item="data-more-item"><a class="nav-link dropdown-toggle dropdown-caret-none fw-bold pe-0" href="javascript: void(0)" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" data-boundary="window" data-bs-reference="parent"> More<span class="fas fa-angle-down ms-2"></span></a>
              <div class="dropdown-menu dropdown-menu-end category-list" aria-labelledby="navbarDropdown" data-category-list="data-category-list"></div>
            </li>
          </ul>
        </div>
      </nav>

      <!-- ============================================-->
      <!-- <section> begin ============================-->
      <section class="pt-5 pb-9">
        <div class="product-filter-container"><button class="btn btn-sm btn-phoenix-secondary text-body-tertiary mb-5 d-lg-none" data-phoenix-toggle="offcanvas" data-phoenix-target="#productFilterColumn"><span class="fa-solid fa-filter me-2"></span>Filter</button>
          <div class="row">
            {{--
            <div class="col-lg-3 col-xxl-2 ps-2 ps-xxl-3">
              <div class="phoenix-offcanvas-filter bg-body scrollbar phoenix-offcanvas phoenix-offcanvas-fixed" id="productFilterColumn" style="top: 92px">
                <div class="d-flex justify-content-between align-items-center mb-3">
                  <h3 class="mb-0">Filters</h3><button class="btn d-lg-none p-0" data-phoenix-dismiss="offcanvas"><span class="uil uil-times fs-8"></span></button>
                </div><a class="btn px-0 d-block collapse-indicator" data-bs-toggle="collapse" href="#collapseAvailability" role="button" aria-expanded="true" aria-controls="collapseAvailability">
                  <div class="d-flex align-items-center justify-content-between w-100">
                    <div class="fs-8 text-body-highlight">Availability</div><span class="fa-solid fa-angle-down toggle-icon text-body-quaternary"></span>
                  </div>
                </a>
                <div class="collapse show" id="collapseAvailability">
                  <div class="mb-2">
                    <div class="form-check mb-0"><input class="form-check-input mt-0" id="inStockInput" type="checkbox" name="color" checked><label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0" for="inStockInput">In stock</label></div>
                    <div class="form-check mb-0"><input class="form-check-input mt-0" id="preBookInput" type="checkbox" name="color"><label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0" for="preBookInput">Pre-book</label></div>
                    <div class="form-check mb-0"><input class="form-check-input mt-0" id="outOfStockInput" type="checkbox" name="color"><label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0" for="outOfStockInput">Out of stock</label></div>
                  </div>
                </div><a class="btn px-0 d-block collapse-indicator" data-bs-toggle="collapse" href="#collapseColorFamily" role="button" aria-expanded="true" aria-controls="collapseColorFamily">
                  <div class="d-flex align-items-center justify-content-between w-100">
                    <div class="fs-8 text-body-highlight">Color family</div><span class="fa-solid fa-angle-down toggle-icon text-body-quaternary"></span>
                  </div>
                </a>
                <div class="collapse show" id="collapseColorFamily">
                  <div class="mb-2">
                    <div class="form-check mb-0"><input class="form-check-input mt-0" id="flexCheckBlack" type="checkbox" name="color" checked><label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0" for="flexCheckBlack">Black</label></div>
                    <div class="form-check mb-0"><input class="form-check-input mt-0" id="flexCheckBlue" type="checkbox" name="color"><label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0" for="flexCheckBlue">Blue</label></div>
                    <div class="form-check mb-0"><input class="form-check-input mt-0" id="flexCheckRed" type="checkbox" name="color"><label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0" for="flexCheckRed">Red</label></div>
                  </div>
                </div><a class="btn px-0 d-block collapse-indicator" data-bs-toggle="collapse" href="#collapseBrands" role="button" aria-expanded="true" aria-controls="collapseBrands">
                  <div class="d-flex align-items-center justify-content-between w-100">
                    <div class="fs-8 text-body-highlight">Brands</div><span class="fa-solid fa-angle-down toggle-icon text-body-quaternary"></span>
                  </div>
                </a>
                <div class="collapse show" id="collapseBrands">
                  <div class="mb-2">
                    <div class="form-check mb-0"><input class="form-check-input mt-0" id="flexCheckBlackberry" type="checkbox" name="brands" checked><label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0" for="flexCheckBlackberry">Blackberry
                      </label></div>
                    <div class="form-check mb-0"><input class="form-check-input mt-0" id="flexCheckApple" type="checkbox" name="brands"><label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0" for="flexCheckApple">Apple
                      </label></div>
                    <div class="form-check mb-0"><input class="form-check-input mt-0" id="flexCheckNokia" type="checkbox" name="brands"><label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0" for="flexCheckNokia">Nokia
                      </label></div>
                    <div class="form-check mb-0"><input class="form-check-input mt-0" id="flexCheckSony" type="checkbox" name="brands"><label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0" for="flexCheckSony">Sony
                      </label></div>
                    <div class="form-check mb-0"><input class="form-check-input mt-0" id="flexCheckLG" type="checkbox" name="brands"><label class="form-check-label d-block lh-sm fs-8 text-body mb-0 fw-normal" for="flexCheckLG">LG
                      </label></div>
                  </div>
                </div><a class="btn px-0 d-block collapse-indicator" data-bs-toggle="collapse" href="#collapsePriceRange" role="button" aria-expanded="true" aria-controls="collapsePriceRange">
                  <div class="d-flex align-items-center justify-content-between w-100">
                    <div class="fs-8 text-body-highlight">Price range</div><span class="fa-solid fa-angle-down toggle-icon text-body-quaternary"></span>
                  </div>
                </a>
                <div class="collapse show" id="collapsePriceRange">
                  <div class="d-flex justify-content-between mb-3">
                    <div class="input-group me-2"><input class="form-control" type="text" aria-label="First name" placeholder="Min"><input class="form-control" type="text" aria-label="Last name" placeholder="Max"></div><button class="btn btn-phoenix-primary px-3" type="button">Go</button>
                  </div>
                </div><a class="btn px-0 y-4 d-block collapse-indicator" data-bs-toggle="collapse" href="#collapseRating" role="button" aria-expanded="true" aria-controls="collapseRating">
                  <div class="d-flex align-items-center justify-content-between w-100">
                    <div class="fs-8 text-body-highlight">Rating</div><span class="fa-solid fa-angle-down toggle-icon text-body-quaternary"></span>
                  </div>
                </a>
                <div class="collapse show" id="collapseRating">
                  <div class="d-flex align-items-center mb-1"><input class="form-check-input me-3" id="flexRadio1" type="radio" name="flexRadio"><span class="fa fa-star text-warning fs-9 me-1"></span><span class="fa fa-star text-warning fs-9 me-1"></span><span class="fa fa-star text-warning fs-9 me-1"></span><span class="fa fa-star text-warning fs-9 me-1"></span><span class="fa fa-star text-warning fs-9 me-1"></span></div>
                  <div class="d-flex align-items-center mb-1"><input class="form-check-input me-3" id="flexRadio2" type="radio" name="flexRadio"><span class="fa fa-star text-warning fs-9 me-1"></span><span class="fa fa-star text-warning fs-9 me-1"></span><span class="fa fa-star text-warning fs-9 me-1"></span><span class="fa fa-star text-warning fs-9 me-1"></span><span class="fa-regular fa-star text-warning-light fs-9 me-1"></span>
                    <p class="ms-1 mb-0">&amp; above</p>
                  </div>
                  <div class="d-flex align-items-center mb-1"><input class="form-check-input me-3" id="flexRadio3" type="radio" name="flexRadio"><span class="fa fa-star text-warning fs-9 me-1"></span><span class="fa fa-star text-warning fs-9 me-1"></span><span class="fa fa-star text-warning fs-9 me-1"></span><span class="fa-regular fa-star text-warning-light fs-9 me-1"></span><span class="fa-regular fa-star text-warning-light fs-9 me-1"></span>
                    <p class="ms-1 mb-0">&amp; above </p>
                  </div>
                  <div class="d-flex align-items-center mb-1"><input class="form-check-input me-3" id="flexRadio4" type="radio" name="flexRadio"><span class="fa fa-star text-warning fs-9 me-1"></span><span class="fa fa-star text-warning fs-9 me-1"></span><span class="fa-regular fa-star text-warning-light fs-9 me-1"></span><span class="fa-regular fa-star text-warning-light fs-9 me-1"></span><span class="fa-regular fa-star text-warning-light fs-9 me-1"></span>
                    <p class="ms-1 mb-0">&amp; above</p>
                  </div>
                  <div class="d-flex align-items-center mb-3"><input class="form-check-input me-3" id="flexRadio5" type="radio" name="flexRadio"><span class="fa fa-star text-warning fs-9 me-1"></span><span class="fa-regular fa-star text-warning-light fs-9 me-1"></span><span class="fa-regular fa-star text-warning-light fs-9 me-1"></span><span class="fa-regular fa-star text-warning-light fs-9 me-1"></span><span class="fa-regular fa-star text-warning-light fs-9 me-1"></span>
                    <p class="ms-1 mb-0">&amp; above </p>
                  </div>
                </div><a class="btn px-0 d-block collapse-indicator" data-bs-toggle="collapse" href="#collapseDisplayType" role="button" aria-expanded="true" aria-controls="collapseDisplayType">
                  <div class="d-flex align-items-center justify-content-between w-100">
                    <div class="fs-8 text-body-highlight">Display type</div><span class="fa-solid fa-angle-down toggle-icon text-body-quaternary"></span>
                  </div>
                </a>
                <div class="collapse show" id="collapseDisplayType">
                  <div class="mb-2">
                    <div class="form-check mb-0"><input class="form-check-input mt-0" id="lcdInput" type="checkbox" name="displayType" checked><label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0" for="lcdInput">LCD</label></div>
                    <div class="form-check mb-0"><input class="form-check-input mt-0" id="ipsInput" type="checkbox" name="displayType"><label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0" for="ipsInput">IPS</label></div>
                    <div class="form-check mb-0"><input class="form-check-input mt-0" id="oledInput" type="checkbox" name="displayType"><label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0" for="oledInput">OLED</label></div>
                    <div class="form-check mb-0"><input class="form-check-input mt-0" id="amoledInput" type="checkbox" name="displayType"><label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0" for="amoledInput">AMOLED</label></div>
                    <div class="form-check mb-0"><input class="form-check-input mt-0" id="retinaInput" type="checkbox" name="displayType"><label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0" for="retinaInput">Retina</label></div>
                  </div>
                </div><a class="btn px-0 d-block collapse-indicator" data-bs-toggle="collapse" href="#collapseCondition" role="button" aria-expanded="true" aria-controls="collapseCondition">
                  <div class="d-flex align-items-center justify-content-between w-100">
                    <div class="fs-8 text-body-highlight">Condition</div><span class="fa-solid fa-angle-down toggle-icon text-body-quaternary"></span>
                  </div>
                </a>
                <div class="collapse show" id="collapseCondition">
                  <div class="mb-2">
                    <div class="form-check mb-0"><input class="form-check-input mt-0" id="newInput" type="checkbox" name="condition" checked><label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0" for="newInput">New</label></div>
                    <div class="form-check mb-0"><input class="form-check-input mt-0" id="usedInput" type="checkbox" name="condition"><label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0" for="usedInput">Used</label></div>
                    <div class="form-check mb-0"><input class="form-check-input mt-0" id="refurbrishedInput" type="checkbox" name="condition"><label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0" for="refurbrishedInput">Refurbrished</label></div>
                  </div>
                </div><a class="btn px-0 d-block collapse-indicator" data-bs-toggle="collapse" href="#collapseDelivery" role="button" aria-expanded="true" aria-controls="collapseDelivery">
                  <div class="d-flex align-items-center justify-content-between w-100">
                    <div class="fs-8 text-body-highlight">Delivery</div><span class="fa-solid fa-angle-down toggle-icon text-body-quaternary"></span>
                  </div>
                </a>
                <div class="collapse show" id="collapseDelivery">
                  <div class="mb-2">
                    <div class="form-check mb-0"><input class="form-check-input mt-0" id="freeShippingInput" type="checkbox" name="delivery" checked><label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0" for="freeShippingInput">Free Shipping</label></div>
                    <div class="form-check mb-0"><input class="form-check-input mt-0" id="oneDayShippingInput" type="checkbox" name="delivery"><label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0" for="oneDayShippingInput">One-day Shipping</label></div>
                    <div class="form-check mb-0"><input class="form-check-input mt-0" id="codInput" type="checkbox" name="delivery"><label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0" for="codInput">Cash on Delivery</label></div>
                  </div>
                </div><a class="btn px-0 d-block collapse-indicator" data-bs-toggle="collapse" href="#collapseCampaign" role="button" aria-expanded="true" aria-controls="collapseCampaign">
                  <div class="d-flex align-items-center justify-content-between w-100">
                    <div class="fs-8 text-body-highlight">Campaign</div><span class="fa-solid fa-angle-down toggle-icon text-body-quaternary"></span>
                  </div>
                </a>
                <div class="collapse show" id="collapseCampaign">
                  <div class="mb-2">
                    <div class="form-check mb-0"><input class="form-check-input mt-0" id="summerSaleInput" type="checkbox" name="campaign"><label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0" for="summerSaleInput">Summer Sale</label></div>
                    <div class="form-check mb-0"><input class="form-check-input mt-0" id="marchMadnessInput" type="checkbox" name="campaign"><label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0" for="marchMadnessInput">March Madness</label></div>
                    <div class="form-check mb-0"><input class="form-check-input mt-0" id="flashSaleInput" type="checkbox" name="campaign"><label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0" for="flashSaleInput">Flash Sale</label></div>
                    <div class="form-check mb-0"><input class="form-check-input mt-0" id="bogoBlastInput" type="checkbox" name="campaign"><label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0" for="bogoBlastInput">BOGO Blast</label></div>
                  </div>
                </div><a class="btn px-0 d-block collapse-indicator" data-bs-toggle="collapse" href="#collapseWarranty" role="button" aria-expanded="true" aria-controls="collapseWarranty">
                  <div class="d-flex align-items-center justify-content-between w-100">
                    <div class="fs-8 text-body-highlight">Warranty</div><span class="fa-solid fa-angle-down toggle-icon text-body-quaternary"></span>
                  </div>
                </a>
                <div class="collapse show" id="collapseWarranty">
                  <div class="mb-2">
                    <div class="form-check mb-0"><input class="form-check-input mt-0" id="threeMonthInput" type="checkbox" name="warranty"><label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0" for="threeMonthInput">3 months</label></div>
                    <div class="form-check mb-0"><input class="form-check-input mt-0" id="sixMonthInput" type="checkbox" name="warranty"><label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0" for="sixMonthInput">6 months</label></div>
                    <div class="form-check mb-0"><input class="form-check-input mt-0" id="oneYearInput" type="checkbox" name="warranty"><label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0" for="oneYearInput">1 year</label></div>
                    <div class="form-check mb-0"><input class="form-check-input mt-0" id="twoYearsInput" type="checkbox" name="warranty"><label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0" for="twoYearsInput">2 years</label></div>
                    <div class="form-check mb-0"><input class="form-check-input mt-0" id="threeYearsInput" type="checkbox" name="warranty"><label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0" for="threeYearsInput">3 years</label></div>
                    <div class="form-check mb-0"><input class="form-check-input mt-0" id="fiveYearsInput" type="checkbox" name="warranty"><label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0" for="fiveYearsInput">5 years</label></div>
                  </div>
                </div><a class="btn px-0 d-block collapse-indicator" data-bs-toggle="collapse" href="#collapseWarrantyType" role="button" aria-expanded="true" aria-controls="collapseWarrantyType">
                  <div class="d-flex align-items-center justify-content-between w-100">
                    <div class="fs-8 text-body-highlight">Warranty Type</div><span class="fa-solid fa-angle-down toggle-icon text-body-quaternary"></span>
                  </div>
                </a>
                <div class="collapse show" id="collapseWarrantyType">
                  <div class="mb-2">
                    <div class="form-check mb-0x"><input class="form-check-input mt-0" id="replacementInput" type="checkbox" name="warrantyType"><label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0" for="replacementInput">Replacement</label></div>
                    <div class="form-check mb-0"><input class="form-check-input mt-0" id="serviceInput" type="checkbox" name="warrantyType"><label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0" for="serviceInput">Service</label></div>
                    <div class="form-check mb-0"><input class="form-check-input mt-0" id="partialCoveregeInput" type="checkbox" name="warrantyType"><label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0" for="partialCoveregeInput">Partial Coverage</label></div>
                    <div class="form-check mb-0"><input class="form-check-input mt-0" id="appleCareInput" type="checkbox" name="warrantyType"><label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0" for="appleCareInput">Apple Care</label></div>
                    <div class="form-check mb-0"><input class="form-check-input mt-0" id="moneyBackInput" type="checkbox" name="warrantyType"><label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0" for="moneyBackInput">Money back</label></div>
                    <div class="form-check mb-0"><input class="form-check-input mt-0" id="extendableInput" type="checkbox" name="warrantyType"><label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0" for="extendableInput">Extendable</label></div>
                  </div>
                </div><a class="btn px-0 d-block collapse-indicator" data-bs-toggle="collapse" href="#collapseCertification" role="button" aria-expanded="true" aria-controls="collapseCertification">
                  <div class="d-flex align-items-center justify-content-between w-100">
                    <div class="fs-8 text-body-highlight">Certification</div><span class="fa-solid fa-angle-down toggle-icon text-body-quaternary"></span>
                  </div>
                </a>
                <div class="collapse show" id="collapseCertification">
                  <div>
                    <div class="form-check mb-0"><input class="form-check-input mt-0" id="rohsInput" type="checkbox" name="certification"><label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0" for="rohsInput">RoHS</label></div>
                    <div class="form-check mb-0"><input class="form-check-input mt-0" id="fccInput" type="checkbox" name="certification"><label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0" for="fccInput">FCC</label></div>
                    <div class="form-check mb-0"><input class="form-check-input mt-0" id="conflictInput" type="checkbox" name="certification"><label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0" for="conflictInput">Conflict Free</label></div>
                    <div class="form-check mb-0"><input class="form-check-input mt-0" id="isoOneInput" type="checkbox" name="certification"><label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0" for="isoOneInput">ISO 9001:2015</label></div>
                    <div class="form-check mb-0"><input class="form-check-input mt-0" id="isoTwoInput" type="checkbox" name="certification"><label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0" for="isoTwoInput">ISO 27001:2013</label></div>
                    <div class="form-check mb-0"><input class="form-check-input mt-0" id="isoThreeInput" type="checkbox" name="certification"><label class="form-check-label d-block lh-sm fs-8 text-body fw-normal mb-0" for="isoThreeInput">IEC 61000-4-2</label></div>
                  </div>
                </div>
              </div>
              <div class="phoenix-offcanvas-backdrop d-lg-none" data-phoenix-backdrop style="top: 92px"></div>
            </div>
            --}}
            <div class="col-lg-12 col-xxl-10">
              <div class="row gx-3 gy-6 mb-8">
                @foreach($magasin->products as $product)
                <div class="col-12 col-sm-6 col-md-3 col-xxl-2">
                  <div class="product-card-container h-100">
                    <div class="position-relative text-decoration-none product-card h-100">
                      <div class="d-flex flex-column justify-content-between h-100">
                        <div>
                          <div class="border border-1 border-translucent rounded-3 position-relative mb-3"><button class="btn btn-wish btn-wish-primary z-2 d-toggle-container" data-bs-toggle="tooltip" data-bs-placement="top" title="Add to wishlist"><span class="fas fa-heart d-block-hover"></span><span class="far fa-heart d-none-hover"></span></button><img class="img-fluid" src="../../../assets/img/products/6.png" alt="" /></div><a class="stretched-link" href="product-details.html">
                            <h6 class="mb-2 lh-sm line-clamp-3 product-name">PlayStation 5 DualSense Wireless Controller</h6>
                          </a>
                          <p class="fs-9"><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="fa fa-star text-warning"></span><span class="text-body-quaternary fw-semibold ms-1">(67 people rated)</span></p>
                        </div>
                        <div>
                          <p class="fs-9 text-body-tertiary mb-2">dbrand skin available</p>
                          <div class="d-flex align-items-center mb-1">
                            <p class="me-2 text-body text-decoration-line-through mb-0">$125.00</p>
                            <h3 class="text-body-emphasis mb-0">$89.00</h3>
                          </div>
                          <p class="text-body-tertiary fw-semibold fs-9 lh-1 mb-0">2 colors</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                @endforeach
              </div>
              <div class="d-flex justify-content-end">
                <nav aria-label="Page navigation example">
                  <ul class="pagination mb-0">
                    <li class="page-item">
                      <a class="page-link" href="#">
                        <span class="fas fa-chevron-left"> </span>
                      </a>
                    </li>
                    <li class="page-item">
                      <a class="page-link" href="#">1</a>
                    </li>
                    <li class="page-item">
                      <a class="page-link" href="#">2</a>
                    </li>
                    <li class="page-item">
                      <a class="page-link" href="#">3</a>
                    </li>
                    <li class="page-item active" aria-current="page">
                      <a class="page-link" href="#">4</a>
                    </li>
                    <li class="page-item">
                      <a class="page-link" href="#">5</a>
                    </li>
                    <li class="page-item">
                      <a class="page-link" href="#"> <span class="fas fa-chevron-right"></span></a>
                    </li>
                  </ul>
                </nav>
              </div>
            </div>
          </div>
        </div><!-- end of .container-->
      </section><!-- <section> close ============================-->
      <!-- ============================================-->

@endsection