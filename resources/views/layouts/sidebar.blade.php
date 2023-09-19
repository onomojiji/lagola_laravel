<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="{{route("home")}}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ URL::asset('images/logo_lagola_title.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('images/logo_lagola_title.png') }}" alt="" height="57">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="{{route("home")}}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ URL::asset('images/logo_lagola_title.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('images/logo_lagola_title.png') }}" alt="" height="57">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span>{{__("Tableau de bord")}}</span></li>
                <li class="nav-item">
                    <a href="{{route("home")}}" class="nav-link"><i class="las la-tachometer-alt"></i> {{__("Accueil")}}</a>
                </li> <!-- end Dashboard Menu -->

                <li class="menu-title"><span>{{__("Business")}}</span></li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#agences" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="agences">
                        <i class="lab la-fonticons"></i> <span> {{__("Agences")}} </span>
                    </a>
                    <div class="collapse menu-dropdown" id="agences">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{route("companies.create")}}" class="nav-link">{{__("Ajouter une agence")}}</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route("companies.index")}}" class="nav-link">{{__("Lister les agences")}}</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sellers" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sellers">
                        <i class="lab la-fonticons"></i> <span> {{__("Vendeurs(ses)")}} </span>
                    </a>
                    <div class="collapse menu-dropdown" id="sellers">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="#" class="nav-link">{{__("Ajouter un(e) vendeur(se)")}}</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">{{__("Lister les vendeurs(ses)")}}</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#catalogs" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="catalogs">
                        <i class="lab la-fonticons"></i> <span> {{__("Catalogue")}} </span>
                    </a>
                    <div class="collapse menu-dropdown" id="catalogs">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="#categories" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="categories">
                                    <i class="lab la-fonticons"></i> <span> {{__("Catégories")}} </span>
                                </a>
                                <div class="collapse menu-dropdown" id="categories">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">{{__("Ajouter une catégorie")}}</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">{{__("Lister les catégories")}}</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="#products" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="products">
                                    <i class="lab la-fonticons"></i> <span> {{__("Produits")}} </span>
                                </a>
                                <div class="collapse menu-dropdown" id="products">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">{{__("Ajouter un produit")}}</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">{{__("Lister les produits")}}</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="menu-title"><span>{{__("Administration")}}</span></li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#users" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="users">
                        <i class="lab la-fonticons"></i> <span> {{__("Utilisateurs")}} </span>
                    </a>
                    <div class="collapse menu-dropdown" id="users">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{route("users.create")}}" class="nav-link">{{__("Ajouter un utilisateur")}}</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route("users.index")}}" class="nav-link">{{__("Lister les utilisateurs")}}</a>
                            </li>
                        </ul>
                    </div>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>
