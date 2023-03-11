

<header class="header-area header-height-2">

    <div class="header-top header-top-ptb-1 d-none d-lg-block">
        <div class="custom-container">
            <div class="row align-items-center">
                <div class="col-xl-3 col-lg-4">
                    <div class="header-info">
                        <ul>
                            <li><a href="tel:{{get_setting('phone')}}">{{get_setting('phone')}}</a></li>
                            <li><a target="_blank" href="https://goo.gl/maps/JuTUxSkXhPVuHURSA"><i class="fal fa-map-marker-alt" ></i> Store location</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-4">
                    <div class="covid-update text-center">
                        <p><a href="" style="background-color: #c81c24;" >3.500TND FRAIS DE LIVRAISON JUSQU'À LA FIN DU MOIS DE RAMADAN !</a></p>
                        <p><a href="" style="background-color: #c81c24;" >LIVRAISON GRATUITE À PARTIR DE 99TND !</a></p>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4">
                    <div class="header-info header-info-right">
                        <ul>
                            <li><a href="{{route('about.us')}}">À propos</a></li>
                            <li><a href="{{route('blog.list')}}">Nos articles</a></li>
                            <li><a href="{{route('contact.us')}}">Contacter-nous</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="header-middle header-middle-ptb-1 d-none d-lg-block">
        <div class="custom-container">
            <div class="header-wrap header-space-between"  >
                <div class="logo logo-width-1">
                    <a href="{{route('home')}}"><img src="{{asset('frontend/pp_2.png')}}" alt="logo" style="width: 220px;" ></a>
                </div>
                <div class="search-style-2">
                    <form action="{{route('products')}}">
                        <select name="category" >
                            <option value="" >Catégories</option>
                            @foreach (\App\Models\Grandcategory::where('status','active')->get() as $grandcat )

                                <option
                                @if (isset($_GET['category']))
                                    @if ($_GET['category'] == $grandcat->id )
                                        selected
                                    @endif
                                @endif
                                value="{{$grandcat->id}}" >{{$grandcat->title}}</option>

                            @endforeach
                        </select>

                        <input type="text" placeholder="Chercher des produits …"

                        @if (isset($_GET['search']))
                            value="{{$_GET['search']}}"
                        @endif

                        name="search" id="select-search" class="autocomplete"  >


                        <button type="submit"> <i class="far fa-search"></i> </button>
                    </form>
                </div>
                <div class="header-action-right">
                    <div class="header-action-2">

                        @auth
                        <div class="header-info header-info-right">
                            <ul>
                                <li>
                                    <a class="language-dropdown-active" href="#">Mon compte <i class="fa fa-chevron-down"></i></a>
                                    <ul class="language-dropdown">
                                        <li><a href="{{route('seller.compte')}}">Mon compte & mes commandes</a></li>
                                        <li>
                                            <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="icofont-logout"></i> Déconnexion</a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                @csrf
                                            </form>
                                        </li>
                                    </ul>
                                </li>

                            </ul>
                        </div>
                        @else
                            <div class="header-action-icon-2">
                                <a href="{{route('seller.login.form')}}">
                                    <img class="injectable" alt="" src="{{asset('frontend/assets/images/icon-img/user.svg')}}">
                                </a>
                            </div>
                        @endauth


                        <div class="header-action-icon-2">
                            <a class="mini-cart-icon" href="{{route('maselection.status')}}">
                                <img class="injectable" alt="" src="{{asset('frontend/assets/images/icon-img/cart-2.svg')}}">
                                <span class="pro-count blue basket-item-count">0</span>
                            </a>

                        </div>




                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-bottom header-bottom-bg-color sticky-bar gray-bg sticky-blue-bg">
        <div class="custom-container" style="max-width: 95%;" >
            <div class="header-wrap header-space-between position-relative">
                <div class="logo logo-width-1 d-block d-lg-none">
                    <a href="{{route('home')}}"><img src="{{asset('frontend/pp_2.png')}}" alt="logo"></a>
                </div>

                <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block main-menu-light-white hover-boder hover-boder-white">
                    <nav>
                        <ul>
                            <li><a href="{{route('home')}}">Accueil</a></li>

                            @foreach (\App\Models\Grandcategory::where('status','active')->get() as $grandcat )
                            <li class="position-static"><a href="{{route('grandcategorie.detail',$grandcat->slug)}}">{{$grandcat->title}} <i class="fa fa-chevron-down"></i></a>
                                <ul class="mega-menu">
                                    @foreach ( \App\Models\Category::where('status','active')->where('grand_cat_id',$grandcat->id)->get() as $cat )
                                        <li class="sub-mega-menu sub-mega-menu-width-22" style="margin-top: 20px;" >
                                            <a class="menu-title" href="{{route('categorie.detail',$cat->slug)}}">{{$cat->title}}</a>
                                            <ul>
                                                @foreach (\App\Models\Souscategory::where('status','active')->where('sous_cat_id',$cat->id)->get() as $souscat )
                                                    <li style="width: 100%;"><a href="{{route('souscategorie.detail',$souscat->slug)}}">{{$souscat->title}}</a></li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            @endforeach


                        </ul>
                    </nav>
                </div>
                <div class="hotline d-none d-lg-block">
                    <p style="font-size: 12px;" ><i class="fa fa-phone" style="font-size: 16px;" ></i> {{get_setting('phone')}}</p>
                </div>

                <div class="header-action-right d-block d-lg-none">
                    <div class="header-action-2">

                        @auth
                        <div class="header-info header-info-right">
                            <ul>
                                <li>
                                    <a class="language-dropdown-active" href="#">Mon compte <i class="fa fa-chevron-down"></i></a>
                                    <ul class="language-dropdown">
                                        <li><a href="{{route('seller.compte')}}">Mon compte & mes commandes</a></li>
                                        <li>
                                            <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="icofont-logout"></i> Déconnexion</a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                @csrf
                                            </form>
                                        </li>
                                    </ul>
                                </li>

                            </ul>
                        </div>
                        @else
                            <div class="header-action-icon-2">
                                <a href="{{route('seller.login.form')}}">
                                    <img class="injectable" alt="" src="{{asset('frontend/assets/images/icon-img/user.svg')}}">
                                </a>
                            </div>
                        @endauth


                        <div class="header-action-icon-2" style="margin-right:15px;" >
                            <a class="mini-cart-icon" href="{{route('maselection.status')}}">
                                <img class="injectable" alt="" src="{{asset('frontend/assets/images/icon-img/cart-2.svg')}}">
                                <span class="pro-count blue basket-item-count">0</span>
                            </a>
                        </div>





                        <div class="header-action-icon-2 d-block d-lg-none">
                            <div class="burger-icon burger-icon-white">
                                <span class="burger-icon-top"></span>
                                <span class="burger-icon-bottom"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
