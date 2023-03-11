

<footer class="footer-area bg-gray-2 pt-75">
    <div class="custom-container">
        <div class="footer-top pb-30">
            <div class="row">
                <div class="col-width-33 custom-common-column">
                    <div class="footer-widget footer-about-2 mb-40">
                        <div class="footer-logo logo-width-1">
                            <a href="{{route('home')}}"><img src="{{asset('frontend/pp_1.png')}}" alt="logo"></a>
                        </div>
                        <div class="footer-contact-info">
                            <p>Appelez-nous <span>{{get_setting('phone')}}</span></p>
                            <p>{{get_setting('address')}}</p>
                            <p>{{get_setting('email')}}</p>
                        </div>
                        <div class="footer-social-icon tooltip-style-4">
                            <a aria-label="Facebook" class="facebook" href="{{get_setting('facebook')}}" target="_blank" ><i class="fab fa-facebook-f"></i></a>
                            <a aria-label="Instagram" class="instagram" href="{{get_setting('instagram')}}" target="_blank" ><i class="fab fa-instagram"></i></a>
                            <a aria-label="Youtube" class="youtube" href="{{get_setting('youtube')}}" target="_blank" ><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-width-33 custom-common-column">
                    <div class="footer-widget mb-40">
                        <h3 class="footer-title">Catégories</h3>
                        <div class="footer-info-list">
                            <ul>
                                @foreach (\App\Models\Grandcategory::where('status','active')->get() as $grandcat )
                                    <li><a href="{{route('grandcategorie.detail',$grandcat->slug)}}"> {{$grandcat->title}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-width-33 custom-common-column">
                    <div class="footer-widget mb-40">
                        <h3 class="footer-title">Informations</h3>
                        <div class="footer-info-list">
                            <ul>
                                <li><a href="{{route('home')}}">Accueil</a></li>
                                <li><a href="{{route('products')}}">Tous les produits</a></li>
                                <li><a href="{{route('about.us')}}">À propos</a></li>
                                <li><a href="{{route('blog.list')}}">Nos articles</a></li>
                                <li><a href="{{route('contact.us')}}">Contacter-nous</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
               
            </div>
        </div>
        <div class="footer-bottom border-top-1">
            <div class="row flex-row-reverse align-items-center">

                <div class="col-lg-12 col-md-12 col-12">
                    <div class="copyright copyright-center">
                        <p>Copyright © 2022 | <a target="_blank" href="https://tounesconnect.com/">Tounes connect</a> All Rights Reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

</div>

    <div class="mobile-header-active mobile-header-wrapper-style">
        <div class="mobile-header-wrapper-inner">
            <div class="mobile-header-top">
                <div class="mobile-header-logo">
                    <a href="{{route('home')}}"><img src="{{asset('frontend/pp_1.png')}}" alt="logo"></a>
                </div>
                <div class="mobile-menu-close close-style-wrap close-style-position-inherit">
                    <button class="close-style search-close">
                        <i class="icon-top"></i>
                        <i class="icon-bottom"></i>
                    </button>
                </div>
            </div>
            <div class="mobile-header-content-area">

                <div class="mobile-search search-style-3 mobile-header-border" style="width: 85%;" >
                    <form action="{{route('products')}}">
                        <input type="text" placeholder="Chercher des produits …"

                        @if (isset($_GET['search']))
                            value="{{$_GET['search']}}"
                        @endif

                        name="search" id="select-search-1" class="autocomplete" >

                        <button type="submit"> <i class="far fa-search"></i> </button>
                    </form>
                </div>

                <div class="mobile-menu-wrap mobile-header-border">
                    <!-- mobile menu start -->
                    <nav>
                        <ul class="mobile-menu">

                            <li><a href="{{route('home')}}">Accueil</a></li>
                            <li><a href="{{route('products')}}">Tous les produits</a></li>

                            @foreach (\App\Models\Grandcategory::where('status','active')->get() as $grandcat )
                            <li class="menu-item-has-children"><a href="{{route('grandcategorie.detail',$grandcat->slug)}}">{{$grandcat->title}}</a>
                                <ul class="dropdown">
                                    @foreach ( \App\Models\Category::where('status','active')->where('grand_cat_id',$grandcat->id)->get() as $cat )
                                    <li class="menu-item-has-children"><a href="{{route('categorie.detail',$cat->slug)}}">{{$cat->title}}</a>
                                        <ul class="dropdown">
                                            @foreach (\App\Models\Souscategory::where('status','active')->where('sous_cat_id',$cat->id)->get() as $souscat )
                                                <li><a href="{{route('souscategorie.detail',$souscat->slug)}}">{{$souscat->title}}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                    @endforeach
                                </ul>
                            </li>
                            @endforeach

                            <li><a href="{{route('about.us')}}">À propos</a></li>
                            <li><a href="{{route('blog.list')}}">Nos articles</a></li>
                            <li><a href="{{route('contact.us')}}">Contacter-nous</a></li>

                        </ul>
                    </nav>
                </div>


                <div class="mobile-social-icon mt-20">
                    <a class="facebook" href="{{get_setting('facebook')}}" target="_blank" ><i class="fab fa-facebook-f"></i></a>
                    <a class="instagram" href="{{get_setting('instagram')}}" target="_blank"><i class="fab fa-instagram"></i></a>
                    <a class="instagram" href="{{get_setting('youtube')}}" target="_blank"><i class="fab fa-youtube"></i></a>

                </div>
            </div>
        </div>
    </div>
