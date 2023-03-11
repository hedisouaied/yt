@extends('frontend.layouts.master')

@section('content')

<div class="breadcrumb-area breadcrumb-area-padding-2 bg-gray-2">
    <div class="custom-container">
        <div class="breadcrumb-content text-center">
            <ul>
                <li>
                    <a href="{{route('home')}}">Accueil</a>
                </li>
                <li class="active">{{$category->title}}</li>
            </ul>
        </div>
    </div>
</div>
<div class="shop-area pt-75 pb-55">
    <div class="custom-container">
        <div class="row flex-row-reverse">
            <div class="col-lg-9">
                <div class="shop-topbar-wrapper">
                    <div class="totall-product">
                        <p> Il y a <span>{{count($count_prod)}}</span> produits</p>
                    </div>
                    <div class="shop-filter mr-30">
                        <a class="shop-filter-active" href="#">
                            <span class="fal fa-filter"></span>
                            Filtres
                            <i class="far fa-angle-down angle-down"></i>
                            <i class="far fa-angle-up angle-up"></i>
                        </a>
                    </div>
                    <div class="sort-by-product-area">
                        <div class="sort-by-product-wrap">
                            <div class="sort-by">
                                <span><i class="far fa-align-left"></i>Trier par <i class="far fa-angle-down"></i></span>
                            </div>

                        </div>
                        <div class="sort-by-dropdown">
                            <ul>
                                <li><a class="sortBy" href="?sort">Par défault</a></li>
                                <li><a class="sortBy" href="?sort=titleAsc">Alphabétique (croissant)</a></li>
                                <li><a class="sortBy" href="?sort=titleDesc">Alphabétique (décroissant)</a></li>
                                <li><a class="sortBy" href="?sort=priceAsc">Prix (croissant)</a></li>
                                <li><a class="sortBy" href="?sort=priceDesc">Prix (décroissant)</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="product-filter-wrapper">
                    <div class="row">

                        <form>


                            @if (isset($_GET['category']))
                                <input type="hidden" name="category" value="{{$_GET['category']}}" >
                            @endif

                            @if (isset($_GET['sort']))
                                <input type="hidden" name="sort" value="{{$_GET['sort']}}" >
                            @endif

                            <div class="col-12 custom-common-column mt-30">
                                <div class="sidebar-widget sidebar-widget-height mb-20">
                                    <h4 class="sidebar-widget-title widget-title-font-dec">Mot clé </h4>
                                    <div class="price-filter">
                                        <div class="price-slider-amount">
                                            <div class="row">
                                                <div class="col-md-12 " >

                                                    <input type="text" name="search"  @if (isset($_GET['search']))
                                                    value="{{$_GET['search']}}"
                                                    @endif placeholder="Rechercher des produits"  />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <br>
                            <div class="col-12 custom-common-column">
                                <div class="sidebar-widget sidebar-widget-height mb-20">
                                    <h4 class="sidebar-widget-title widget-title-font-dec">Filtrer par marque(s) </h4>
                                    <div class="row">
                                        @foreach ($partenaires as $partenaire )


                                            <div class="col-md-2">
                                                <div class="login-register-wrap">

                                                    <div class="login-register-form">



                                                            <div class="lost-remember-wrap">
                                                                <div class="remember-wrap">
                                                                    <input type="checkbox" name="marques[]"
                                                                    @if (isset($_GET['marques']))
                                                                        @if (in_array($partenaire->id, $_GET['marques']) )
                                                                            checked
                                                                        @endif
                                                                    @endif

                                                                    value="{{$partenaire->id}}" >
                                                                    <span>{{$partenaire->title}}</span>
                                                                </div>

                                                            </div>

                                                    </div>
                                                </div>

                                            </div>

                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <br>
                            <br>
                            <div class="col-12 custom-common-column mt-30">
                                <div class="sidebar-widget sidebar-widget-height mb-20">
                                    <h4 class="sidebar-widget-title widget-title-font-dec">Filtrer par prix (TND) </h4>
                                    <div class="price-filter">
                                        <div class="price-slider-amount">
                                            <div class="row">
                                                <div class="col-md-6 " >

                                                    <input type="number" min="{{\App\Models\Product::where('status','active')->min('price');}}" max="{{\App\Models\Product::where('status','active')->max('price');}}" name="pricerangemin" value="<?php if(isset($_GET['pricerangemin'])){echo ($_GET['pricerangemin']);}else{ echo (\App\Models\Product::where('status','active')->min('price'));} ?>" placeholder="Prix minimum" step="0.001"  />
                                                </div>
                                                <div class="col-md-6 " >

                                                    <input type="number" min="{{\App\Models\Product::where('status','active')->min('price');}}" max="{{\App\Models\Product::where('status','active')->max('price');}}" name="pricerangemax" value="<?php if(isset($_GET['pricerangemax'])){echo ($_GET['pricerangemax']);}else{ echo (\App\Models\Product::where('status','active')->max('price'));} ?>" placeholder="Prix maximum" step="0.001"  />
                                                </div>
                                            </div>
                                            <button type="submit" >Filtrer</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="shop-bottom-area">
                    <div class="row" id="product-data" >
                        @include('frontend.layouts._single-product')

                    </div>
                    <div class="ajax-load text-center" style="display: none">
                        <img src="{{asset('frontend/pre.gif')}}" style="width: 30%;" >
                    </div>
                    @if (count($products)==0)
                        <p>Il n'y a pas de produits</p>
                    @endif
                </div>
            </div>

            <div class="col-lg-3">
                <div class="sidebar-wrapper sidebar-wrapper-mr1">
                    <div class="sidebar-widget sidebar-widget-wrap sidebar-widget-padding-1 mb-20">
                        <h4 class="sidebar-widget-title">Sous categories </h4>
                        <div class="sidebar-categories-list">
                            <ul>
                                @foreach (\App\Models\Category::where('status','active')->where('grand_cat_id',$category->id)->orderby('title','ASC')->get() as $souscat )
                                    <li><a href="{{route('categorie.detail',$souscat->slug)}}"><b>{{$souscat->title}}</b></a>
                                        @if (count(\App\Models\Souscategory::where('status','active')->where('sous_cat_id',$souscat->id)->get()) !==0 )
                                        <ul>
                                            @foreach (\App\Models\Souscategory::where('status','active')->where('sous_cat_id',$souscat->id)->get() as $soussouscat )

                                            <li><a href="{{route('souscategorie.detail',$soussouscat->slug)}}">{{$soussouscat->title}}</a></li>
                                            @endforeach
                                        </ul>
                                        @endif

                                    </li>
                                @endforeach

                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>




@endsection

@section('scripts')
<script>


    $(document).ready(function(){
        $('.sortBy').each(function(){
            var oldUrl = $(this).attr("href"); // Get current url

            var changeurl = oldUrl;

            @if (isset($_GET['search']))
            changeurl += "&search=@php echo $_GET['search']@endphp";
            @endif

            @if (isset($_GET['category']))
            changeurl += "&category=@php echo $_GET['category']@endphp";
            @endif

            @if (isset($_GET['pricerangemin']))
            changeurl += "&pricerangemin=@php echo $_GET['pricerangemin']@endphp";
            @endif

            @if (isset($_GET['pricerangemax']))
            changeurl += "&pricerangemax=@php echo $_GET['pricerangemax']@endphp";
            @endif

            @if (isset($_GET['marques']))
                @foreach ($_GET['marques'] as $get_marque)
                changeurl += "&marques%5B%5D=@php echo $get_marque@endphp";
                @endforeach
            @endif


            var newUrl = oldUrl.replace(oldUrl, changeurl); // Create new url
            $(this).attr("href", newUrl); // Set herf value
        });
    });
</script>

<script>
    function loadmoreData(page) {

        var search ="";
        var category="";
        var sort="";
        var pricerange="";
        var marques="";

        @if (isset($_GET['search']))
            search += '&search=<?php echo $_GET['search'] ; ?>';
        @endif

        @if (isset($_GET['category']))
            category += '&category=<?php echo $_GET['category'] ; ?>';
        @endif

        @if (isset($_GET['sort']))
            sort += '&sort=<?php echo $_GET['sort'] ; ?>';
        @endif

        @if (isset($_GET['pricerangemin']))
        pricerange += "&pricerangemin=@php echo $_GET['pricerangemin']@endphp";
        @endif

        @if (isset($_GET['pricerangemax']))
        pricerange += "&pricerangemax=@php echo $_GET['pricerangemax']@endphp";
        @endif

        @if (isset($_GET['marques']))
            @foreach ($_GET['marques'] as $get_marque)
            marques += "&marques%5B%5D=<?php echo $get_marque ; ?>";
            @endforeach
        @endif


        $.ajax({
            url: '?page='+page+search+category+sort+pricerange+marques,
            type: 'GET',
            beforeSend: function () {
                $('.ajax-load').show();
            },
        }).done(function(data){

            if(data.html == ''){
                $('.ajax-load').html('');
                return;
            }
            $('.ajax-load').hide();
            $('#product-data').append(data.html);
        }).fail(function(jqXHR, ajaxOptions, thrownError) {
            console.log('Somethong went wrong!! please try again');
        });
    }
    var page=1;
    $(window).scroll(function () {
        if($(window).scrollTop() +$(window).height()+420>=$(document).height()){
            page ++;
            loadmoreData(page);
        }
    });




</script>



@endsection