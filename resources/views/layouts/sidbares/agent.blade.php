<nav class="navbar navbar-vertical navbar-expand-lg">
    <script>
        var navbarStyle = window.config.config.phoenixNavbarStyle;
        if (navbarStyle && navbarStyle !== 'transparent') {
        document.querySelector('body').classList.add(`navbar-${navbarStyle}`);
        }
    </script>
    <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
        <!-- scrollbar removed-->
        <div class="navbar-vertical-content">
            <ul class="navbar-nav flex-column" id="navbarVerticalNav">
                <li class="nav-item">
                    <!-- label-->
                    <p class="navbar-vertical-label">Géstion des achats</p>
                    <hr class="navbar-vertical-line" /><!-- parent pages-->
                    <div class="nav-item-wrapper">
                        <a class="nav-link label-1 {{ set_active_roote('magasin.autres-magasins.index') }} " href="{{ route('magasin.autres-magasins.index') }}" role="button" data-bs-toggle="" aria-expanded="false">
                            <div class="d-flex align-items-center"><span class="nav-link-icon"><span data-feather="briefcase" class="ms-1 me-1 fa-lg"></span></span><span class="nav-link-text-wrapper"><span class="nav-link-text">Autres magasins</span></span></div>
                        </a>
                    </div><!-- parent pages-->
                    <div class="nav-item-wrapper">
                        <a class="nav-link label-1 {{ set_active_roote('magasin.fournisseurs.create') }} " href="{{ route('magasin.fournisseurs.create') }}" role="button" data-bs-toggle="" aria-expanded="false">
                            <div class="d-flex align-items-center"><span class="nav-link-icon"><span data-feather="gift" class="ms-1 me-1 fa-lg"></span></span><span class="nav-link-text-wrapper"><span class="nav-link-text">Mes fournisseurs</span></span></div>
                        </a>
                    </div><!-- parent pages-->
                    <div class="nav-item-wrapper">
                        <a class="nav-link label-1 {{ set_active_roote('magasin.devis.index') }} " href="{{ route('magasin.devis.index') }}" role="button" data-bs-toggle="" aria-expanded="false">
                            <div class="d-flex align-items-center"><span class="nav-link-icon"><span data-feather="box" class="ms-1 me-1 fa-lg"></span></span><span class="nav-link-text-wrapper"><span class="nav-link-text">Devis reçues</span></span></div>
                        </a>
                    </div><!-- parent pages-->
                    
                    @if(Auth::guard('magasin')->user())
                        <p class="navbar-vertical-label">Géstion des agents</p>
                        <hr class="navbar-vertical-line" /><!-- parent pages-->
                        <div class="nav-item-wrapper">
                            <a class="nav-link label-1 {{ set_active_roote('magasin.agent.index') }} " href="{{ route('magasin.agent.index') }}" role="button" data-bs-toggle="" aria-expanded="false">
                                <div class="d-flex align-items-center"><span class="nav-link-icon"><span data-feather="user-check" class="ms-1 me-1 fa-lg"></span></span><span class="nav-link-text-wrapper"><span class="nav-link-text">Agents</span></span></div>
                            </a>
                        </div><!-- parent pages-->
                    @endif
                    <p class="navbar-vertical-label">Produits & Catégories</p>
                    <hr class="navbar-vertical-line" /><!-- parent pages-->
                    <div class="nav-item-wrapper">
                        <a class="nav-link label-1 {{ set_active_roote('magasin.categorie.index') }}" href="{{ route('magasin.categorie.index') }}" role="button" data-bs-toggle="" aria-expanded="false">
                            <div class="d-flex align-items-center"><span class="nav-link-icon"><span data-feather="menu"></span></span><span class="nav-link-text-wrapper"><span class="nav-link-text">Catégories</span></span></div>
                        </a>
                        <a class="nav-link label-1 {{ set_active_roote('magasin.produit.index') }}" href="{{ route('magasin.produit.index') }}" role="button" data-bs-toggle="" aria-expanded="false">
                            <div class="d-flex align-items-center"><span class="nav-link-icon"><span data-feather="shopping-bag"></span></span><span class="nav-link-text-wrapper"><span class="nav-link-text">Produits</span></span></div>
                        </a>
                    </div><!-- parent pages-->

                    <p class="navbar-vertical-label">Géstion des commandes</p>
                    <hr class="navbar-vertical-line" /><!-- parent pages-->
                    <div class="nav-item-wrapper">
                        <a class="nav-link label-1 {{ set_active_roote('magasin.commande.index') }}" href="{{ route('magasin.commande.index') }}" role="button" data-bs-toggle="" aria-expanded="false">
                            <div class="d-flex align-items-center"><span class="nav-link-icon"><span data-feather="command"></span></span><span class="nav-link-text-wrapper"><span class="nav-link-text">Commandes</span></span></div>
                        </a>
                    </div><!-- parent pages-->

                    <div class="nav-item-wrapper">
                        <a class="nav-link label-1 {{ set_active_roote('magasin.reserve.index') }}" href="{{ route('magasin.reserve.index') }}" role="button" data-bs-toggle="" aria-expanded="false">
                            <div class="d-flex align-items-center"><span class="nav-link-icon"><span data-feather="file-plus"></span></span><span class="nav-link-text-wrapper"><span class="nav-link-text">Pro-format</span></span></div>
                        </a>
                    </div><!-- parent pages-->

                    <div class="nav-item-wrapper">
                        <a class="nav-link label-1 {{ set_active_roote('magasin.bon.index') }}" href="{{ route('magasin.bon.index') }}" role="button" data-bs-toggle="" aria-expanded="false">
                            <div class="d-flex align-items-center"><span class="nav-link-icon"><span data-feather="file-text"></span></span><span class="nav-link-text-wrapper"><span class="nav-link-text">Bons mensuelle</span></span></div>
                        </a>
                    </div><!-- parent pages-->

                    <p class="navbar-vertical-label">Géstion des clients</p>
                    <hr class="navbar-vertical-line" /><!-- parent pages-->
                    <div class="nav-item-wrapper">
                        <a class="nav-link label-1 {{ set_active_roote('magasin.client.index') }}" href="{{ route('magasin.client.index') }}" role="button" data-bs-toggle="" aria-expanded="false">
                            <div class="d-flex align-items-center"><span class="nav-link-icon"><span data-feather="bell"></span></span><span class="nav-link-text-wrapper"><span class="nav-link-text">Abonnés</span></span></div>
                        </a>
                        <a class="nav-link label-1 {{ set_active_roote('magasin.agent.client') }}" href="{{ route('magasin.client.create') }}" role="button" data-bs-toggle="" aria-expanded="false">
                            <div class="d-flex align-items-center"><span class="nav-link-icon"><span data-feather="users"></span></span><span class="nav-link-text-wrapper"><span class="nav-link-text">Clients</span></span></div>
                        </a>
                    </div><!-- parent pages-->
                    {{--
                        <div class="nav-item-wrapper">
                            <a class="nav-link label-1" href="#" role="button" data-bs-toggle="" aria-expanded="false">
                                <div class="d-flex align-items-center"><span class="nav-link-icon"><span data-feather="git-merge"></span></span><span class="nav-link-text-wrapper"><span class="nav-link-text">Locations</span></span></div>
                            </a>
                        </div><!-- parent pages-->
                        
                        <div class="nav-item-wrapper">
                            <a class="nav-link label-1" href="#" role="button" data-bs-toggle="" aria-expanded="false">
                                <div class="d-flex align-items-center"><span class="nav-link-icon"><span data-feather="git-merge"></span></span><span class="nav-link-text-wrapper"><span class="nav-link-text">Pointages</span></span></div>
                            </a>
                        </div><!-- parent pages-->
                    --}}

                </li>

                <li class="nav-item">
                <!-- label-->
                <p class="navbar-vertical-label">Documentation</p>
                <hr class="navbar-vertical-line" /><!-- parent pages-->
                  <div class="nav-item-wrapper">
                    <a class="nav-link dropdown-indicator label-1" href="#nv-customization" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="nv-customization">
                    <div class="d-flex align-items-center">
                      <div class="dropdown-indicator-icon"><span class="fas fa-caret-right"></span></div><span class="nav-link-icon"><span data-feather="settings"></span></span><span class="nav-link-text">Configuration</span>
                    </div>
                  </a>
                  <div class="parent-wrapper label-1">
                    <ul class="nav collapse parent" data-bs-parent="#navbarVerticalCollapse" id="nv-customization">
                      <li class="collapsed-nav-item-title d-none">Configuration</li>

                      <li class="nav-item">
                        <a class="nav-link {{ set_active_roote('magasin.unite.index') }}" href="{{ route('magasin.unite.index') }}">
                          <div class="d-flex align-items-center"><span class="nav-link-text">Unités de géstion</span></div>
                        </a><!-- more inner pages-->
                      </li>

                      <li class="nav-item"><a class="nav-link" href="">
                          <div class="d-flex align-items-center"><span class="nav-link-text">Méthodes de paiement</span></div>
                        </a><!-- more inner pages-->
                      </li>
                      
                    </ul>
                  </div>
                </div><!-- parent pages-->
              </li>

                <p class="navbar-vertical-label">Vos avis</p>
                <div class="nav-item-wrapper">
                    <a class="nav-link label-1 {{ set_active_roote('magasin.ide.index') }}" href="{{ route('magasin.ide.index') }}" role="button" data-bs-toggle="" aria-expanded="false">
                        <div class="d-flex align-items-center"><span class="nav-link-icon"><span data-feather="git-merge"></span></span><span class="nav-link-text-wrapper"><span class="nav-link-text">Idées & Suggéstions</span></span></div>
                    </a>
                </div><!-- parent pages-->
            </ul>
        </div>
    </div>
    <div class="navbar-vertical-footer">
        <a href="{{ route('magasin.icons') }}" target="_blank" class="{{ set_active_roote('magasin.autres-magasins.index') }} btn navbar-vertical-toggle border-0 fw-semibold w-100 white-space-nowrap d-flex align-items-center">
            <span data-feather="grid" class="fs-8"></span>
            <span class="navbar-vertical-footer-text ms-2">Sérvices icons</span>
        </a>
    </div>
</nav>



