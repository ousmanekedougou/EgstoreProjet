@extends('layouts.app',['title' => 'Conditions d\'utilisation'])
@section('main-content')
<div class="content">
    <h2 class="text-bold mb-5 text-center">Conditions d'utilisation</h2>
    <div class="row gx-xl-8 gx-xxl-11">
        <div class="col-xl-2"></div>
        <div class="col-xl-8 scrollbar">
            <div>
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
                                <h6 class="lh-sm mb-0 me-2 text-body-secondary timeline-item-title">Dernière mise à jour le : 1er janvier 2024</h6>
                            </div>
                            <p class="text-body-quaternary fs-9 mb-0 text-nowrap timeline-time"></p>
                            </div>
                            <p class="fs-9 text-body-secondary w-sm-100 mb-5">
                                Bienvenue chez E-Gstore ! En créant un compte E-Gstore (tel que défini dans l'article 1) ou en utilisant les services E-Gstore (tels que définis ci-dessous), vous acceptez d'être lié par les conditions générales suivantes (les « Conditions d'Utilisation »).
                            </p>
                            <p class="fs-9 text-body-secondary w-sm-100 mb-5">
                                Dans les présentes conditions de service, « nous », « notre », « nos » et « E-Gstore » désignent la partie contractante de E-Gstore concernée (telle que définie à l'article 13 ci-dessous), et « vous » désigne l'utilisateur de E-Gstore (s'il s'inscrit à un service de E-Gstore ou l'utilise en tant que particulier), ou l'entreprise qui emploie l'utilisateur de E-Gstore (s'il s'inscrit à un service de E-Gstore ou l'utilise en tant qu'entreprise) et l'une de ses sociétés affiliées.
                            </p>
                            <p class="fs-9 text-body-secondary w-sm-100 mb-5">
                                E-Gstore fournit une plateforme commerciale complète qui permet aux commerçants d'unifier leurs activités commerciales. Cette plateforme comprend, entre autres, une gamme d'outils permettant aux commerçants de créer et de personnaliser des boutiques en ligne, de vendre en plusieurs endroits (y compris sur le web, les téléphones portables, les médias sociaux, les places de marché en ligne et d'autres emplacements en ligne (« Services en ligne ») et en personne (« Services POS »)), de gérer les produits, l'inventaire, les paiements, l'exécution, l'expédition, les opérations commerciales, le marketing et la publicité, et d'entrer en contact avec les clients existants et potentiels. Tous ces services offerts par E-Gstore sont désignés dans les présentes Conditions d'Utilisation comme le(s) « Service(s) ». Toute nouvelle fonctionnalité ou tout nouvel outil ajouté aux Services actuels sera également soumis aux Conditions d'Utilisation. Vous pouvez consulter la version actuelle des conditions d'utilisation à tout moment à l'adresse suivante : https://E-Gstore.com.
                            </p>
                        </div>
                        </div>
                    </div>

                    <div class="timeline-item">
                        <div class="row g-3">
                        <div class="col-auto">
                            <div class="timeline-item-bar position-relative">
                            <div class="icon-item icon-item-md rounded-7 border border-translucent"><span class="fa-solid fa-envelope text-danger fs-9"></span></div><span class="timeline-bar border-end border-dashed"></span>
                            </div>
                        </div>
                        <div class="col">
                            <div class="d-flex justify-content-between">
                            <div class="d-flex mb-2">
                                <h6 class="lh-sm mb-0 me-2 text-body-secondary timeline-item-title">Conditions d'utilisation du compte <br class="d-sm-none"></h6>
                            </div>
                            <p class="text-body-quaternary fs-9 mb-0 text-nowrap timeline-time"></p>
                            </div>
                            <p class="fs-9 text-body-secondary w-sm-100 mb-5">
                            En créant un compte sur notre plateforme, vous acceptez de vous conformer aux conditions générales suivantes. Ces conditions régissent votre utilisation des services fournis par E-Gstore et vous engagent dès votre inscription. Vous devez être âgé d'au moins 18 ans ou avoir atteint l'âge légal de la majorité dans votre juridiction pour créer un compte. Si vous créez un compte au nom d'une entreprise ou d'une organisation, vous déclarez et garantissez que vous avez le pouvoir de lier cette entité à ces conditions.
                            </p>
                            <p class="fs-9 text-body-secondary w-sm-100 mb-5">
                            Vous êtes responsable du maintien de la confidentialité des informations d'identification de votre compte, y compris votre nom d'utilisateur et votre mot de passe. Toute activité se déroulant sous votre compte relève de votre seule responsabilité et vous devez informer E-Gstore immédiatement de toute utilisation non autorisée ou de toute atteinte à la sécurité. Le non-respect de cette obligation peut entraîner la suspension ou la résiliation de votre compte.
                            </p>
                            <p class="fs-9 text-body-secondary w-sm-100 mb-5">
                            Vous vous engagez à fournir des informations exactes, à jour et complètes au cours de la procédure d'inscription et à mettre à jour ces informations si nécessaire pour qu'elles restent exactes, à jour et complètes. E-Gstore se réserve le droit de suspendre ou de résilier votre compte si l'une des informations fournies s'avère fausse, trompeuse ou incomplète.
                            </p>
                            <p class="fs-9 text-body-secondary w-sm-100 mb-5">
                            Vous ne pouvez pas utiliser votre compte à des fins illégales ou non autorisées. Cela inclut, sans s'y limiter, la violation de toute loi dans votre juridiction, la violation des droits de propriété intellectuelle ou la participation à des activités frauduleuses. E-Gstore se réserve le droit d'enquêter et de prendre les mesures légales appropriées à l'encontre de tout utilisateur qui violerait ces conditions.
                            </p>
                            <p class="fs-9 text-body-secondary w-sm-100 mb-5">
                            E-Gstore peut, à sa seule discrétion, refuser le service, résilier les comptes ou limiter l'accès à la plate-forme pour quelque raison que ce soit, y compris, mais sans s'y limiter, en cas de violation des présentes conditions, d'activité frauduleuse ou d'utilisation abusive de la plate-forme. Vous reconnaissez que E-Gstore n'est pas responsable des pertes ou dommages résultant de ces actions.
                            </p>
                        </div>
                        </div>
                    </div>

                    <div class="timeline-item">
                        <div class="row g-3">
                        <div class="col-auto">
                            <div class="timeline-item-bar position-relative">
                            <div class="icon-item icon-item-md rounded-7 border border-translucent"><span class="fa-solid fa-swatchbook text-primary fs-9"></span></div><span class="timeline-bar border-end border-dashed"></span>
                            </div>
                        </div>
                        <div class="col">
                            <div class="d-flex justify-content-between">
                            <div class="d-flex mb-2">
                                <h6 class="lh-sm mb-0 me-2 text-body-secondary timeline-item-title">Activation du compte</h6>
                            </div>
                            <p class="text-body-quaternary fs-9 mb-0 text-nowrap timeline-time"></p>
                            </div>
                            <h6 class="fs-10 fw-bold mb-3"><span class="fa-regular fa-clock me-1"></span>Propriétaire de magasin</h6>
                            <p class="fs-9 text-body-secondary w-sm-100 mb-5">
                            En tant que propriétaire de magasin, vous êtes responsable de l'activation et de la gestion de votre magasin sur la plateforme E-Gstore. Une fois l'inscription réussie, il vous sera demandé d'achever le processus d'activation, qui peut inclure la vérification de votre identité, la fourniture de détails commerciaux et l'acceptation de conditions supplémentaires spécifiques aux propriétaires de magasins.
                            </p>
                            <p class="fs-9 text-body-secondary w-sm-100 mb-5">
                            Une fois que votre magasin est activé, vous avez accès à des outils et à des fonctions qui vous permettent de gérer vos produits, de traiter les commandes et d'interagir avec les clients. Vous êtes seul responsable du contenu, des produits et des services répertoriés dans votre magasin, ainsi que du respect de toutes les lois et réglementations applicables.
                            </p>
                            <p class="fs-9 text-body-secondary w-sm-100 mb-5">
                            E-Gstore se réserve le droit d'examiner et d'approuver votre boutique avant sa mise en ligne. Si votre boutique ne répond pas à nos directives ou enfreint des conditions, nous pouvons retarder ou refuser l'activation. Vous pouvez faire appel de ces décisions en fournissant des informations supplémentaires ou en apportant les modifications nécessaires pour vous conformer à nos exigences.
                            </p>
                            <h6 class="fs-10 fw-bold mb-3">Comptes du personnel</h6>
                            <p class="fs-9 text-body-secondary w-sm-100 mb-5">
                            En tant que propriétaire d'un magasin, vous pouvez créer des comptes de personnel afin d'accorder un accès aux employés ou aux sous-traitants qui vous aident à gérer votre magasin. Chaque compte d'employé doit être associé à une adresse électronique unique et vous êtes tenu de veiller à ce que les membres du personnel respectent les présentes conditions.
                            </p>
                            <p class="fs-9 text-body-secondary w-sm-100 mb-5">
                            Vous pouvez attribuer des rôles et des autorisations spécifiques aux comptes d'employés, en limitant leur accès à certaines fonctions ou données de votre magasin. Il vous incombe de surveiller et de gérer les comptes des employés afin d'empêcher tout accès non autorisé ou toute utilisation abusive de la plateforme.
                            </p>
                            <p class="fs-9 text-body-secondary w-sm-100 mb-5">
                            E-Gstore n'est pas responsable des actions entreprises par les comptes d'employés de votre magasin. Si un compte de personnel enfreint les présentes conditions ou se livre à des activités frauduleuses, votre magasin peut être suspendu ou résilié. Vous devez immédiatement désactiver tout compte de personnel qui n'est plus autorisé à accéder à votre magasin.
                            </p>
                        </div>
                        </div>
                    </div>

                    <div class="timeline-item">
                        <div class="row g-3">
                        <div class="col-auto">
                            <div class="timeline-item-bar position-relative">
                            <div class="icon-item icon-item-md rounded-7 border border-translucent"><span class="fa-solid fa-swatchbook text-primary fs-9"></span></div><span class="timeline-bar border-end border-dashed"></span>
                            </div>
                        </div>
                        <div class="col">
                            <div class="d-flex justify-content-between">
                            <div class="d-flex mb-2">
                                <h6 class="lh-sm mb-0 me-2 text-body-secondary timeline-item-title">Droits de E-Gstore</h6>
                            </div>
                            <p class="text-body-quaternary fs-9 mb-0 text-nowrap timeline-time"></p>
                            </div>
                            <p class="fs-9 text-body-secondary w-sm-100 mb-5">
                            E-Gstore se réserve le droit de modifier, de suspendre ou d'interrompre toute partie de la plate-forme à tout moment et sans préavis. Cela inclut les changements de caractéristiques, de fonctionnalités ou de prix. Nous ne sommes pas responsables vis-à-vis de vous ou d'un tiers de ces modifications ou interruptions.
                            </p>
                            <p class="fs-9 text-body-secondary w-sm-100 mb-5">
                            Nous pouvons contrôler votre utilisation de la plateforme afin d'assurer le respect des présentes conditions et d'améliorer nos services. Cela peut inclure l'examen du contenu du magasin, des données de transaction et de l'activité de l'utilisateur. Si nous identifions des violations, nous pouvons prendre des mesures correctives, y compris, mais sans s'y limiter, l'émission d'avertissements, la suspension de comptes ou la résiliation de services.
                            </p>
                            <p class="fs-9 text-body-secondary w-sm-100 mb-5">
                            E-Gstore a le droit de refuser le service à quiconque pour quelque raison que ce soit et à tout moment. Cela inclut, sans s'y limiter, les utilisateurs qui se livrent à des activités frauduleuses, qui violent les droits de propriété intellectuelle ou qui utilisent la plateforme à mauvais escient. Nous pouvons également refuser de servir les utilisateurs dans les juridictions où nos services sont restreints ou interdits par la loi.
                            </p>
                            <p class="fs-9 text-body-secondary w-sm-100 mb-5">
                            Nous nous réservons le droit de supprimer ou de désactiver l'accès à tout contenu qui enfreint les présentes conditions ou qui est jugé inapproprié, nuisible ou illégal. Cela inclut les listes de produits, les commentaires des clients et le contenu généré par les utilisateurs. E-Gstore n'est pas responsable des pertes ou dommages résultant de la suppression ou de la désactivation d'un tel contenu.
                            </p>
                            <p class="fs-9 text-body-secondary w-sm-100 mb-5">
                            E-Gstore peut utiliser des données agrégées et anonymes provenant de votre magasin à des fins d'analyse, de marketing ou d'amélioration. Ces données ne vous identifient pas personnellement, ni vos clients, et sont utilisées pour améliorer l'expérience globale de l'utilisateur sur la plateforme.
                            </p>
                            <p class="fs-9 text-body-secondary w-sm-100 mb-5">
                            En cas de litige entre vous et un autre utilisateur, E-Gstore se réserve le droit d'intervenir et de prendre les mesures appropriées pour résoudre le problème. Il peut s'agir de suspendre les transactions, de retenir des fonds ou de fournir des services de résolution des litiges. Notre décision en la matière est définitive et contraignante. 
                            </p>
                        </div>
                        </div>
                    </div>

                    <div class="timeline-item">
                        <div class="row g-3">
                        <div class="col-auto">
                            <div class="timeline-item-bar position-relative">
                            <div class="icon-item icon-item-md rounded-7 border border-translucent"><span class="fa-solid fa-swatchbook text-primary fs-9"></span></div><span class="timeline-bar border-end border-dashed"></span>
                            </div>
                        </div>
                        <div class="col">
                            <div class="d-flex justify-content-between">
                            <div class="d-flex mb-2">
                                <h6 class="lh-sm mb-0 me-2 text-body-secondary timeline-item-title">Vos responsabilités</h6>
                            </div>
                            <p class="text-body-quaternary fs-9 mb-0 text-nowrap timeline-time"></p>
                            </div>
                            <p class="fs-9 text-body-secondary w-sm-100 mb-5">
                            Vous êtes seul responsable du contenu, des produits et des services figurant dans votre boutique. Vous devez notamment veiller à ce que tout le contenu soit exact, à jour et conforme aux lois et réglementations en vigueur. Vous ne devez pas proposer d'articles interdits ni vous livrer à des activités illégales sur la plateforme.
                            </p>
                            <p class="fs-9 text-body-secondary w-sm-100 mb-5">
                            Vous êtes responsable du traitement des commandes, de la satisfaction des demandes des clients et de l'assistance à la clientèle. Il s'agit notamment de répondre aux demandes, de résoudre les litiges et d'effectuer des remboursements ou des retours conformément aux politiques de votre magasin et aux lois en vigueur.
                            </p>
                            <p class="fs-9 text-body-secondary w-sm-100 mb-5">
                            Vous devez assurer la sécurité de votre compte et de votre magasin. Cela inclut l'utilisation de mots de passe forts, l'activation de l'authentification à deux facteurs et la surveillance régulière des accès non autorisés. Si vous soupçonnez une violation de la sécurité, vous devez en informer E-Gstore immédiatement.
                            </p>
                            <p class="fs-9 text-body-secondary w-sm-100 mb-5">
                            Vous acceptez d'indemniser et de dégager E-Gstore de toute responsabilité en cas de réclamation, de dommage ou de perte résultant de votre utilisation de la plateforme. Cela inclut, sans s'y limiter, les réclamations liées à la responsabilité du produit, à la violation de la propriété intellectuelle ou à la violation des présentes conditions.
                            </p>
                        </div>
                        </div>
                    </div>

                    <div class="timeline-item">
                        <div class="row g-3">
                        <div class="col-auto">
                            <div class="timeline-item-bar position-relative">
                            <div class="icon-item icon-item-md rounded-7 border border-translucent"><span class="fa-solid fa-swatchbook text-primary fs-9"></span></div><span class="timeline-bar border-end border-dashed"></span>
                            </div>
                        </div>
                        <div class="col">
                            <div class="d-flex justify-content-between">
                            <div class="d-flex mb-2">
                                <h6 class="lh-sm mb-0 me-2 text-body-secondary timeline-item-title">Confidentialité</h6>
                            </div>
                            <p class="text-body-quaternary fs-9 mb-0 text-nowrap timeline-time"></p>
                            </div>
                            <p class="fs-9 text-body-secondary w-sm-100 mb-5">
                            Vous acceptez de préserver la sécurité et la confidentialité de toutes les informations confidentielles fournies par E-Gstore. Cela comprend, sans s'y limiter, les informations techniques, les stratégies commerciales et les données relatives aux clients. Vous ne devez pas divulguer ces informations à des tiers sans autorisation écrite préalable.
                            </p>
                            <p class="fs-9 text-body-secondary w-sm-100 mb-5">
                            E-Gstore traitera vos informations confidentielles avec le même soin. Toutefois, nous pouvons divulguer vos informations si la loi l'exige ou si cela est nécessaire pour faire respecter les présentes conditions ou protéger nos droits.
                            </p>
                            <p class="fs-9 text-body-secondary w-sm-100 mb-5">
                            Les deux parties conviennent de prendre des mesures raisonnables pour protéger les informations confidentielles contre tout accès, utilisation ou divulgation non autorisés. Ces mesures comprennent la mise en œuvre de protocoles de sécurité et la restriction de l'accès aux seules personnes autorisées.
                            </p>
                            <p class="fs-9 text-body-secondary w-sm-100 mb-5">
                            Les obligations de confidentialité décrites dans cette section resteront en vigueur même après la résiliation de votre compte ou des présentes conditions.
                            </p>
                        </div>
                        </div>
                    </div>

                    <div class="timeline-item">
                        <div class="row g-3">
                        <div class="col-auto">
                            <div class="timeline-item-bar position-relative">
                            <div class="icon-item icon-item-md rounded-7 border border-translucent"><span class="fa-solid fa-swatchbook text-primary fs-9"></span></div><span class="timeline-bar border-end border-dashed"></span>
                            </div>
                        </div>
                        <div class="col">
                            <div class="d-flex justify-content-between">
                            <div class="d-flex mb-2">
                                <h6 class="lh-sm mb-0 me-2 text-body-secondary timeline-item-title">Limitation de responsabilité et indemnisation</h6>
                            </div>
                            <p class="text-body-quaternary fs-9 mb-0 text-nowrap timeline-time"></p>
                            </div>
                            <p class="fs-9 text-body-secondary w-sm-100 mb-5">
                            E-Gstore n'est pas responsable des dommages indirects, accessoires ou consécutifs résultant de votre utilisation de la plate-forme. Cela inclut, sans s'y limiter, la perte de profits, de données ou d'opportunités commerciales.
                            </p>
                            <p class="fs-9 text-body-secondary w-sm-100 mb-5">
                            Notre responsabilité totale envers vous pour toute réclamation découlant des présentes conditions ou de votre utilisation de la plate-forme est limitée au montant que vous avez payé à E-Gstore au cours des six derniers mois. Si vous n'avez effectué aucun paiement, notre responsabilité est limitée à 100 $.
                            </p>
                            <p class="fs-9 text-body-secondary w-sm-100 mb-5">
                            Vous acceptez d'indemniser et de dégager E-Gstore de toute responsabilité en cas de réclamation, de dommage ou de perte résultant de votre utilisation de la plateforme. Cela inclut, sans s'y limiter, les réclamations liées à la responsabilité du produit, à la violation de la propriété intellectuelle ou à la violation des présentes conditions.
                            </p>
                            <p class="fs-9 text-body-secondary w-sm-100 mb-5">
                            E-Gstore n'est pas responsable des services ou contenus de tiers liés ou intégrés à la plate-forme. L'utilisation de ces services se fait à vos risques et périls, et vous devez prendre connaissance des conditions générales de ces services et vous y conformer.
                            </p>
                        </div>
                        </div>
                    </div>

                    <div class="timeline-item">
                        <div class="row g-3">
                        <div class="col-auto">
                            <div class="timeline-item-bar position-relative">
                            <div class="icon-item icon-item-md rounded-7 border border-translucent"><span class="fa-solid fa-swatchbook text-primary fs-9"></span></div><span class="timeline-bar border-end border-dashed"></span>
                            </div>
                        </div>
                        <div class="col">
                            <div class="d-flex justify-content-between">
                                <div class="d-flex mb-2">
                                    <h6 class="lh-sm mb-0 me-2 text-body-secondary timeline-item-title">Propriété intellectuelle et votre matériel</h6>
                                </div>
                            </div>
                            <h6 class="fs-10 fw-bold mb-3">1 Votre matériel</h6>
                            <p class="fs-9 text-body-secondary w-sm-100 mb-5">
                            Vous restez propriétaire de tous les contenus, matériels et propriété intellectuelle que vous téléchargez ou créez sur la plate-forme. Cela inclut les listes de produits, les images et les descriptions. 
                            </p>
                            <p class="fs-9 text-body-secondary w-sm-100 mb-5">
                            En téléchargeant ces éléments, vous accordez à E-Gstore une licence non exclusive, mondiale et libre de redevances pour les utiliser, les afficher et les distribuer en relation avec la plate-forme, d'utiliser, d'afficher et de distribuer ces éléments dans le cadre de la plate-forme.
                            </p>
                            <p class="fs-9 text-body-secondary w-sm-100 mb-5">
                            Vous déclarez et garantissez que vous disposez des droits nécessaires à tous les matériaux téléchargés sur la plate-forme. Cela inclut l'obtention des licences, permissions ou consentements appropriés licences, permissions ou consentements appropriés pour tout contenu de tiers utilisé dans votre magasin.
                            </p>
                            <p class="fs-9 text-body-secondary w-sm-100 mb-5">
                            E-Gstore n'est pas responsable de toute violation des droits de propriété intellectuelle découlant de votre matériel. Si nous recevons une plainte valide pour violation des droits de propriété intellectuelle, nous pouvons supprimer ou désactiver l'accès au contenu litigieux sans préavis.
                            </p>
                            <p class="fs-9 text-body-secondary w-sm-100 mb-5">
                            Vous vous engagez à ne pas télécharger ou distribuer de matériel diffamatoire, obscène ou contraire à la loi ou à la réglementation. E-Gstore se réserve le droit de supprimer de tels éléments et de prendre les mesures appropriées à l'encontre de votre compte.
                            </p>
                            <h6 class="fs-10 fw-bold mb-3">2 Propriété intellectuelle de E-Gstore</h6>
                            <p class="fs-9 text-body-secondary w-sm-100 mb-5">
                            Tous les droits de propriété intellectuelle de la plate-forme, y compris, mais sans s'y limiter, les logiciels, les dessins, les logos et les marques, sont détenus par E-Gstore ou ses concédants de licence. Il est interdit d'utiliser, de copier ou de distribuer ces éléments sans autorisation écrite préalable.
                            </p>
                            <p class="fs-9 text-body-secondary w-sm-100 mb-5">
                            Il est interdit de procéder à l'ingénierie inverse, de décompiler ou de désassembler toute partie de la plate-forme. Cela inclut toute tentative d'accès au code source ou aux algorithmes sous-jacents sans autorisation.
                            </p>
                            <p class="fs-9 text-body-secondary w-sm-100 mb-5">
                            Tout retour d'information ou suggestion que vous fournissez à E-Gstore concernant la plate-forme peut être utilisé par nous sans compensation ni obligation à votre égard. En soumettant des commentaires, vous accordez à E-Gstore une licence perpétuelle et irrévocable d'utilisation et de mise en œuvre de ces commentaires.
                            </p>
                            <p class="fs-9 text-body-secondary w-sm-100 mb-5">
                            E-Gstore se réserve le droit d'intenter une action en justice contre tout utilisateur qui enfreint ses droits de propriété intellectuelle. Cela inclut, sans s'y limiter, l'engagement de poursuites judiciaires, l'obtention d'injonctions ou la demande de dommages-intérêts.
                            </p>
                        </div>
                        </div>
                    </div>


                    <div class="timeline-item">
                        <div class="row g-3">
                        <div class="col-auto">
                            <div class="timeline-item-bar position-relative">
                            <div class="icon-item icon-item-md rounded-7 border border-translucent"><span class="fa-solid fa-swatchbook text-primary fs-9"></span></div><span class="timeline-bar border-end border-dashed"></span>
                            </div>
                        </div>
                        <div class="col">
                            <div class="d-flex justify-content-between">
                            <div class="d-flex mb-2">
                                <h6 class="lh-sm mb-0 me-2 text-body-secondary timeline-item-title">Services supplémentaires</h6>
                            </div>
                            <p class="text-body-quaternary fs-9 mb-0 text-nowrap timeline-time"></p>
                            </div>
                            <p class="fs-9 text-body-secondary w-sm-100 mb-5">
                            E-Gstore peut offrir des services supplémentaires, tels que des outils marketing, des analyses ou une assistance premium, moyennant des frais supplémentaires. Ces services sont soumis à des conditions générales distinctes, qui vous seront communiquées avant l'activation.
                            </p>
                            <p class="fs-9 text-body-secondary w-sm-100 mb-5">
                            Vous pouvez vous retirer des services supplémentaires à tout moment en contactant le service d'assistance de E-Gstore. Toutefois, les frais payés pour ces services ne sont pas remboursables, sauf indication contraire dans les conditions du service spécifique.
                            </p>
                            <p class="fs-9 text-body-secondary w-sm-100 mb-5">
                            E-Gstore se réserve le droit de modifier ou d'interrompre des services supplémentaires à tout moment. Nous vous informerons dans un délai raisonnable de tout changement susceptible d'affecter votre utilisation de ces services.
                            </p>
                            <p class="fs-9 text-body-secondary w-sm-100 mb-5">
                            En utilisant des services supplémentaires, vous acceptez de vous conformer à toutes les conditions applicables. Le non-respect de ces conditions peut entraîner la suspension ou la résiliation du service.
                            </p>
                            <p class="fs-9 text-body-secondary w-sm-100 mb-5">
                            E-Gstore n'est pas responsable des pertes ou dommages résultant de l'utilisation des services supplémentaires. Ceci inclut, mais n'est pas limité à, des erreurs dans les données analytiques, des campagnes de marketing inefficaces, ou des retards dans les réponses du support.
                            </p>
                            <p class="fs-9 text-body-secondary w-sm-100 mb-5">
                            En utilisant la plateforme E-Gstore, vous reconnaissez avoir lu, compris et accepté les présentes conditions d'utilisation. Si vous n'êtes pas d'accord avec une partie de ces conditions, vous ne devez pas utiliser la plateforme.
                            </p>
                        </div>
                        </div>
                    </div>


                    <div class="timeline-item">
                        <div class="row g-3">
                            <div class="col-auto">
                                <div class="timeline-item-bar position-relative">
                                <div class="icon-item icon-item-md rounded-7 border border-translucent"><span class="fa-solid fa-video text-info fs-9"></span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2"></div>
    </div>
</div>
@endsection