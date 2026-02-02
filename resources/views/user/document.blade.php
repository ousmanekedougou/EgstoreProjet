@extends('layouts.app',['title' => 'comment ça marche'])
<meta name="msapplication-TileImage" content="{{asset('../assets/img/favicons/mstile-150x150.png')}}">
@section('main-content')
<div class="content" style="padding-left:6rem ;padding-right:6rem ;margin-top:-15px;">
  <h2 class="text-bold mb-5 page-title-sticky-top">Comment ça marche</h2>
  <div class="row gx-xl-8 gx-xxl-11">
    <div class="col-xl-5 p-xxl-7">
      <div class="ms-xxl-3 d-none d-xl-block position-sticky" style="top: 30%">
        <img class="d-dark-none img-fluid" src="../assets/img/spot-illustrations/light_30.png" alt="" />
        <img class="d-light-none img-fluid" src="../assets/img/spot-illustrations/dark_30.png" alt="" />
      </div>
    </div>
    <div class="col-xl-7 scrollbar" style="margin-top: -4rem;">
      <div>
        <h4 class="py-3 border-y mb-5 ms-8">Comptes commerçant</h4>
        <div class="timeline-basic mb-9">

          <div class="timeline-item">
            <div class="row g-3">
              <div class="col-auto">
                <div class="timeline-item-bar position-relative">
                  <div class="icon-item icon-item-md rounded-7 border border-translucent"><span class="fa-solid fa-clipboard text-success fs-9"></span></div><span class="timeline-bar border-end border-dashed"></span>
                </div>
              </div>
              <div class="col">
                <div class="d-flex justify-content-between">
                  <div class="d-flex mb-2">
                    <h6 class="lh-sm mb-0 me-2 text-body-secondary timeline-item-title">Création de votre compte</h6>
                  </div>
                  <p class="text-body-quaternary fs-9 mb-0 text-nowrap timeline-time"></p>
                </div>
                <p class="fs-9 text-body-secondary w-sm-100 mb-3">
                  Pour créer un compte commerçant, clicker sur ce lien et enregistrer les informations demandées.
                  Tout en accéptant nos conditions d'utilisations et nos politiques de confidentialités.
                </p>
                <p class="fs-9 text-body-secondary w-sm-100 mb-3">
                  Aprés la validation de ces informations vous serez rediriger sur une page qui vous demande un code de validation que vous recevrez sur votre adrésse email que vous 
                  avez renseigner lors de votre inscription.
                </p>
                <p class="fs-9 text-body-secondary w-sm-100 mb-5">
                  En fin aprés cette étape vous accéderez a la page de connexion pour les comptes commerçant.
                </p>
              </div>
            </div>
          </div>

          <div class="timeline-item">
            <div class="row g-3">
              <div class="col-auto">
                <div class="timeline-item-bar position-relative">
                  <div class="icon-item icon-item-md rounded-7 border border-translucent"><span class="fa-solid fa-user-circle text-primary fs-9"></span></div><span class="timeline-bar border-end border-dashed"></span>
                </div>
              </div>
              <div class="col">
                <div class="d-flex justify-content-between">
                  <div class="d-flex mb-2">
                    <h6 class="lh-sm mb-0 me-2 text-body-secondary timeline-item-title">Vos agents commerçiaux</h6>
                  </div>
                  <p class="text-body-quaternary fs-9 mb-0 text-nowrap timeline-time"></p>
                </div>
                <h6 class="fs-10 fw-normal mb-3">Sérvices</h6>
                <p class="fs-9 text-body-secondary w-sm-100 mb-3">
                  Pour une fléxibilité de vos taches commerçiaux nous avons intégres une possibilité d'ajouter des comptes agents dans votre compte
                  commerçant.
                </p>
                <p class="fs-9 text-body-secondary w-sm-100 mb-3">
                  Aprés l'ajout d'un agent il recevra un email qui lui demandera d'activer son compte en cliquant sur un lient.
                </p>
                <p class="fs-9 text-body-secondary w-sm-100 mb-5">
                  L'agent commerçial aura des limtes dans l'application tel que la possibilités d'ajouter un agent, mais il feras toutes 
                  les autres taches.
                </p>
              </div>
            </div>
          </div>

          <div class="timeline-item">
            <div class="row g-3">
              <div class="col-auto">
                <div class="timeline-item-bar position-relative">
                  <div class="icon-item icon-item-md rounded-7 border border-translucent"><span class="fab fa-product-hunt text-info fs-9"></span></div><span class="timeline-bar border-end border-dashed"></span>
                </div>
              </div>
              <div class="col">
                <div class="d-flex justify-content-between">
                  <div class="d-flex mb-2">
                    <h6 class="lh-sm mb-0 me-2 text-body-secondary timeline-item-title">Géstion de vos produits</h6>
                  </div>
                  <p class="text-body-quaternary fs-9 mb-0 text-nowrap timeline-time"></p>
                </div>
                <h6 class="fs-10 fw-normal false">Sérvices</h6>
                <p class="fs-9 text-body-secondary w-sm-100 mb-3">
                  Le sérvice géstion des produits s'vfféctue par une organisation par catégories et sous-catégories.
                  De ce fait vous ajouter les produits en les mettant dans leurs catégories réspéctifs.
                </p>
                <p class="fs-9 text-body-secondary w-sm-100 mb-3">
                  Une catégorie s'ajoute comme suit le nom de la catégorie, le status (Visible / Cacher) et le type (Commercial / Location).
                  <br>
                  Les sous-catégorie s'ajoutent de la même procédure que les catégories.
                </p>
                <p class="fs-9 text-body-secondary w-sm-100 mb-3">
                  Pour ajouter des produits vous passer par la listes des sous-categories dans la sidebar de droite, vous 
                  clicker sur le bouton ajouter un produit en suite renseigner les informations du produit dans le formulaire
                  qui s'affiche et en fin enrégistrer le produit.
                </p>
                <p class="fs-9 text-info w-sm-100 mb-5">
                  Remarque : Un produit, une catégorie et une sous-catégorie ne s'ajoutent qu'une seul a la fois.
                </p>
              </div>
            </div>
          </div>

          <div class="timeline-item">
            <div class="row g-3">
              <div class="col-auto">
                <div class="timeline-item-bar position-relative">
                  <div class="icon-item icon-item-md rounded-7 border border-translucent"><span class="fa-solid fa-user-tie text-success fs-9"></span></div><span class="timeline-bar border-end border-dashed"></span>
                </div>
              </div>
              <div class="col">
                <div class="d-flex justify-content-between">
                  <div class="d-flex mb-2">
                    <h6 class="lh-sm mb-0 me-2 text-body-secondary timeline-item-title">Géstion de vos clients</h6>
                  </div>
                  <p class="text-body-quaternary fs-9 mb-0 text-nowrap timeline-time"></p>
                </div>
                <h6 class="fs-10 fw-normal false">Sérvices</h6>
                <p class="fs-9 text-body-secondary w-sm-100 mb-3">
                  Vous avez la possibilité d'enrégistre et de gérer des clients fidèles ou abonnés. L'objéctif de ce sérvice
                  est de vous pérmettre d'avoir une facturation automatique et un gain de temps des commandes ou achats de vos clients.
                </p>

                <p class="fs-9 text-body-secondary w-sm-100 mb-3">
                  Un client fidéles est un client dont l'inscription est éfféctuée par vous en tant qu'administrateur de votre
                  entreprise en renséignant son prenom et nom, son adrésse email, et son numero de téléphone. <br>
                </p>

                <p class="fs-9 text-body-secondary w-sm-100 mb-5">
                  Par contre le client abonné est un client qui s'abonne sur votre compte commerçant via son compte client.
                </p>

              </div>
            </div>
          </div>

          <div class="timeline-item">
            <div class="row g-3">
              <div class="col-auto">
                <div class="timeline-item-bar position-relative">
                  <div class="icon-item icon-item-md rounded-7 border border-translucent"><span class="fa-solid fa-cogs text-primary fs-9"></span></div><span class="timeline-bar border-end border-dashed"></span>
                </div>
              </div>
              <div class="col">
                <div class="d-flex justify-content-between">
                  <div class="d-flex mb-2">
                    <h6 class="lh-sm mb-0 me-2 text-body-secondary timeline-item-title">Les systémes de ventes</h6>
                  </div>
                  <p class="text-body-quaternary fs-9 mb-0 text-nowrap timeline-time"></p>
                </div>
                <h6 class="fs-10 fw-normal false">Sérvices</h6>
                <p class="fs-9 text-body-secondary w-sm-100 mb-3">
                  Nous faisons tout notre possible pour numériser toutes les taches manuéles de votre entreprise.Ainsi nous avons 
                  intégrés quelques systémes de ventes tél que:
                  
                  <li class="fs-9 fw-normal mb-2">
                    Un systéme de résérvation de bon de commande qui s'oppere par enrégistré le client bénéficiare du bon 
                    en suite lui ajouer les produits pour chaque commande éfféctué, c'est la même manoeuvre avéc la géstion des produit de vente.
                  </li>
                  <li class="fs-9 fw-normal mb-2">
                    Un systéme enrégistrement de facture à crédit, avéc ce sérvice vos clients fidéls ou abonnés pourront prendre une 
                    commande à crédit et le paye par tranche ou au complét selon votre delais, il est traçable automatique et fléxible.
                  </li>
                  <li class="fs-9 fw-normal mb-2">
                    Un systéme d'enrçgistrement de facture par dépots d'une somme dans votre entreprise.
                    C'est tout à fait le contraire de " la commande à crédit ". 
                    Ici le client une fois inscrit dépose son argent dans votre magasin ou boutique avéc l'objéctif de le recuperé par des commande
                    de produits.
                  </li>

                  <li class="fs-9 fw-normal">
                    Un systéme de commande sous ràsàrvation, ce sérvice vous facilite la géstion des commande de vos clients tout en n'aiant pas 
                    les produits dans votre entreprise. 
                  </li>

                </p>

              </div>
            </div>
          </div>

          <div class="timeline-item">
            <div class="row g-3">
              <div class="col-auto">
                <div class="timeline-item-bar position-relative">
                  <div class="icon-item icon-item-md rounded-7 border border-translucent"><span class="fa-solid fa-paperclip text-info fs-9"></span></div>
                </div>
              </div>
              <div class="col">
                <div class="d-flex justify-content-between">
                  <div class="d-flex mb-2">
                    <h6 class="lh-sm mb-0 me-2 text-body-secondary timeline-item-title">Autres options</h6>
                  </div>
                  <p class="text-body-quaternary fs-9 mb-0 text-nowrap timeline-time"></p>
                </div>
                <h6 class="fs-10 fw-normal false">Sérvices</h6>
                <p class="fs-9 text-body-secondary w-sm-100 mb-3">
                </p>
              </div>
            </div>
          </div>

          

        </div>
        <h4 class="py-3 border-y mb-5 ms-8">Compte clients</h4>
        <div class="timeline-basic mb-9">
          <div class="timeline-item">
            <div class="row g-3">
              <div class="col-auto">
                <div class="timeline-item-bar position-relative">
                  <div class="icon-item icon-item-md rounded-7 border border-translucent"><span class="fa-solid fa-user-plus text-primary fs-9"></span></div><span class="timeline-bar border-end border-dashed"></span>
                </div>
              </div>
              <div class="col">
                <div class="d-flex justify-content-between">
                  <div class="d-flex mb-2">
                    <h6 class="lh-sm mb-0 me-2 text-body-secondary timeline-item-title">Création de compte client</h6>
                  </div>
                  <p class="text-body-quaternary fs-9 mb-0 text-nowrap timeline-time"></p>
                </div>
                <p class="fs-9 text-body-secondary w-sm-100 mb-5">
                  Pour créer un compte client cliquer sur le lien et renséigner les information demander tout en accéptant notre politique de confidentialités et nos conditions
                  d'utilisation. <br>
                  Aprés avoir valider l'inscription vous serez rediriger sur une page de validation de compte avéc un code a renséigner. <br>
                  Veillez verifier votre adrésse email d'inscription et rvcuperer le code de validation du compte.
                </p>
              </div>
            </div>
          </div>
          <div class="timeline-item">
            <div class="row g-3">
              <div class="col-auto">
                <div class="timeline-item-bar position-relative">
                  <div class="icon-item icon-item-md rounded-7 border border-translucent"><span class="fa-solid fa-praying-hands text-success fs-9"></span></div><span class="timeline-bar border-end border-dashed"></span>
                </div>
              </div>
              <div class="col">
                <div class="d-flex justify-content-between">
                  <div class="d-flex mb-2">
                    <h6 class="lh-sm mb-0 me-2 text-body-secondary timeline-item-title">La particularité de E-Gstore</h6>
                  </div>
                  <p class="text-body-quaternary fs-9 mb-0 text-nowrap timeline-time"></p>
                </div>
                <h6 class="fs-10 fw-normal mb-3">Sérvices</h6>
                <p class="fs-9 text-body-secondary w-sm-100 mb-5">
                  E-Gstore est une application de gestion d'entreprise commercial, ce qui fait que vous aurez une multitude
                  de sérvices commercial dans votre profile avéc une diversité des produits.
                  Ainsi pour chaque entreprise vous pouvez accéder ses produits et faire vos achats. 
                </p>
              </div>
            </div>
          </div>
          <div class="timeline-item">
            <div class="row g-3">
              <div class="col-auto">
                <div class="timeline-item-bar position-relative">
                  <div class="icon-item icon-item-md rounded-7 border border-translucent"><span class="fa-solid fa-bell text-primary fs-9"></span></div><span class="timeline-bar border-end border-dashed"></span>
                </div>
              </div>
              <div class="col">
                <div class="d-flex justify-content-between">
                  <div class="d-flex mb-2">
                    <h6 class="lh-sm mb-0 me-2 text-body-secondary timeline-item-title">Un systéme d'abonnement</h6>
                  </div>
                  <p class="text-body-quaternary fs-9 mb-0 text-nowrap timeline-time"></p>
                </div>
                <h6 class="fs-10 fw-normal mb-3">Sérvices</h6>
                <p class="fs-9 text-body-secondary w-sm-100 mb-5">
                  Le systéme d'abonnement avéc les entreprise au choix permét de faciliter et d'automatiser les echanges 
                  commerciaux entre les clients et les fournisseurs de produits.
                  avéc l'abonnement le client est considérer comme un client fidéle de l'entreprise et bénéficie des privilèges de ce sérvice.
                </p>
              </div>
            </div>
          </div>
          <div class="timeline-item">
            <div class="row g-3">
              <div class="col-auto">
                <div class="timeline-item-bar position-relative">
                  <div class="icon-item icon-item-md rounded-7 border border-translucent"><span class="fa-solid fa-cogs text-success fs-9"></span></div><span class="timeline-bar border-end border-dashed"></span>
                </div>
              </div>
              <div class="col">
                <div class="d-flex justify-content-between">
                  <div class="d-flex mb-2">
                    <h6 class="lh-sm mb-0 me-2 text-body-secondary timeline-item-title">Les systémes de ventes</h6>
                  </div>
                  <p class="text-body-quaternary fs-9 mb-0 text-nowrap timeline-time"></p>
                </div>
                <h6 class="fs-10 fw-normal mb-3">Sérvice</h6>
                <p class="fs-9 text-body-secondary w-sm-100 mb-1">
                  Un client à plusieurs options pour faire des achats avéc une entreprise dans l'application E-Gstore.

                  <li class="fs-9 fw-normal mb-2">
                    Vous avez l'option des commande à crédit, avéc un accord entre vous et le fournisseur vous pouvez faire une
                    commande à crédit via votre compte client.
                    Cette demande sera validée par le fournisseur en quéstion aprés votre résérvation avéc l'étiquette (facture à crédit)
                  </li>

                  <li class="fs-9 fw-normal mb-2">
                    Il est aussi intégrer l'option de la commande par dépôt,
                    Il consiste de déposer votre argent dans l'entreprise commercial de votre choix qui sera récupéré par des commandes de produits.
                  </li>

                </p>
              </div>
            </div>
          </div>
          <div class="timeline-item">
            <div class="row g-3">
              <div class="col-auto">
                <div class="timeline-item-bar position-relative">
                  <div class="icon-item icon-item-md rounded-7 border border-translucent"><span class="fa-solid fa-paperclip text-info fs-9"></span></div>
                </div>
              </div>
              <div class="col">
                <div class="d-flex justify-content-between">
                  <div class="d-flex mb-2">
                    <h6 class="lh-sm mb-0 me-2 text-body-secondary timeline-item-title">Autres options</h6>
                  </div>
                  <p class="text-body-quaternary fs-9 mb-0 text-nowrap timeline-time"></p>
                </div>
                <p class="fs-9 text-body-secondary w-sm-100 mb-0"></p>
              </div>
            </div>
          </div>
        </div>
        <h4 class="py-3 border-y mb-5 ms-8">Les moyens de paiement</h4>
        <div class="timeline-basic mb-9">
          <div class="timeline-item">
            <div class="row g-3">
              <div class="col-auto">
                <div class="timeline-item-bar position-relative">
                  <div class="icon-item icon-item-md rounded-7 border border-translucent"><span class="fa-solid fa-money-check text-success fs-9"></span></div><span class="timeline-bar border-end border-dashed"></span>
                </div>
              </div>
              <div class="col">
                <div class="d-flex justify-content-between">
                  <div class="d-flex mb-2">
                    <h6 class="lh-sm mb-0 me-2 text-body-secondary timeline-item-title">Mobiles et bancaire</h6>
                  </div>
                  <p class="text-body-quaternary fs-9 mb-0 text-nowrap timeline-time"></p>
                </div>
                <h6 class="fs-10 fw-normal mb-3">Sérvice</h6>
                <p class="fs-9 text-body-secondary w-sm-100 mb-5">
                  Pour une facilité de paiement nous avons intégré des moyens de paiement mobile et bancaire notamment :
                  Wave, Orange Money,
                </p>
              </div>
            </div>
          </div>
          <div class="timeline-item">
            <div class="row g-3">
              <div class="col-auto">
                <div class="timeline-item-bar position-relative">
                  <div class="icon-item icon-item-md rounded-7 border border-translucent"><span class="fa-solid fa-file-pdf text-info fs-9"></span></div>
                </div>
              </div>
              <div class="col">
                <div class="d-flex justify-content-between">
                  <div class="d-flex mb-2">
                    <h6 class="mb-0 fs-9 mr-5"><span class="fa-solid fa-file-pdf me-1 text-body-tertiary"></span> Verifier nos <a target="_blank" href="{{ route('utilisateur.conditions') }}">conditions d'utilisations</a> ou nos <a target="_blank" href="{{ route('utilisateur.privacy') }}">politique de confidentialites</a></h6> 
                  </div>
                  <p class="text-body-quaternary fs-9 mb-0 text-nowrap timeline-time"></p>
                </div>
                <h6 class="fs-10 fw-normal false"></h6>
                <p class="fs-9 text-body-secondary w-sm-100 mb-0"></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection

<script src="{{asset('assets/polyfill.io/v3/polyfill.min58be.js?features=window.scroll')}}"></script>