@extends('frontend.layouts.master')


@section('styles')

<!--
<style>
    @import url(https://fonts.googleapis.com/css?family=Pacifico);

    .bgoverlay{

    overflow: hidden;
    color: #fff;
    background: rgb(103,58,183);
    background: rgba(103,58,183,0.7);


    }
    .container2{
    position: relative;
    margin: 120px auto 0 auto;
    width: 320px;
    }


    .ico{
    display: block;
    width: 320px;
    height: 320px;
    }
    .open .ico{
    animation: open 4s;
    transform: scale(10);
    }
    .ico .title{
    position: absolute;
    top: 50%;
    left: 50%;
    margin-left: -95px;
    margin-top: -73px;
    z-index: 4;
    font-size: 50px;
    color: #fff;
    cursor: pointer;
    text-shadow: 2px 4px 3px rgba(0,0,0,0.3);
    }
    .open .ico .title{
    opacity: 0;
    transition: all 0.3s ease;
    top:-100px;
    }
    .ico:before,
    .ico:after,
    .fa-heart:before,
    .fa-heart:after{
    position: absolute;
    top:0;
    left: 26px;
    }
    .ico:before,
    .ico:after,
    .fa-heart:before,
    .fa-heart:after{
    display: block;
    font-size: 20em;
    color: #ff4081;
    text-rendering: auto;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    }
    .fa-heart:before,
    .fa-heart:after{
    color: #e91e63;
    }
    .ico:before{
    z-index: 3;
    }
    .ico:after{
    animation: explode 4s infinite;
    }


    .fa-heart:before{
    animation: explodeSmall 3s infinite;
    }
    .fa-heart:after{
    animation: explodeSmall 2s infinite;
    }


    .endtext{
    opacity:0;
    position: absolute;
    top:-100px;
    width:100%;
    }
    .open .endtext{
    top:0;
    opacity: 1;
    animation: show 5s;
    }
    .endtext .close{
    position: absolute;
    top: 0;
    right: 0;
    cursor: pointer;
    text-shadow: 2px 4px 3px rgba(0,0,0,0.3);
    }
    .endtext h1,
    .endtext h2,
    .endtext h3{
    text-shadow: 2px 4px 3px rgba(0,0,0,0.3);
    text-align: center;
    font-weight: normal;
    color: white;
    }
    .endtext h1{
    font-size: 50px;
    }
    .endtext h2{
    font-size: 30px;
    }
    .endtext h3{
    font-size: 20px;
    }


    @keyframes explode {
        from {
        transform: scale(1);
        opacity: 1;
        }
        to {
        transform: scale(1.6);
        opacity: 0;
        }
    }
    @keyframes explodeSmall {
        from {
        transform: scale(1);
        opacity: 1;
        }
        to {
        transform: scale(1.2);
        opacity: 0;
        }
    }


    @keyframes open {
        from {
        transform: scale(1);
        }
        to {
        transform: scale(10);
        }
    }

    @keyframes show {
        from {
        opacity: 0;
        top: -100px;
        }
        to {
        opacity: 1;
        top:0;
        }
    }
</style>
-->
<style>
    .banniere_fixiha{
        position: relative;top: 19%;
    }

    @media only screen and (max-width: 767px) {
      .banniere_fixiha {
        top: 0%;
      }
    }


    </style>

@endsection

@section('content')

        <div class="slider-area">
            <div class="hero-slider-active-2 dot-style-1 dot-style-1-position-1">

                @foreach ($banners as $banner )
                <div class="single-hero-slider single-animation-wrap slider-height-2 custom-d-flex custom-align-item-center bg-img" style="background-image:url({{$banner->photo}});">
                    <div class="custom-container" style="">
                        <div class="row slider-animated-1">

                        <div class="col-lg-9 col-md-9 col-12 col-sm-6"></div>

                            <div class="col-lg-3 col-md-3 col-12 col-sm-6">
                                <div class="hero-slider-content-2">
                                    <h1 class="animated" style="padding: 12px;background: rgba(0,0,0,0.5);border-radius: 6px;color:white;margin-bottom:20px;" >{{$banner->title}}</h1>

                                    <div class="btn-style-1">
                                        <a class="animated btn-1-padding-3" href="{{route('products')}}"> Voir tous les produits </a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                @endforeach


            </div>
        </div>


        <div class="product-area pt-80 pb-75 products">
            <div class="custom-container">
                <div class="product-area-border">
                    <div class="section-title-timer-wrap">
                        <div class="section-title-1 section-title-hm2">
                            <h2>Offre quotidienne du jour</h2>

                        </div>
                        <div  class="timer-style-1">
                            <span>Ne ratez pas l'offre</span>
                        </div>

                    </div>
                    <div class="product-slider-active-1 nav-style-2 product-hm1-mrg">

                                <?php
                                    $userAgent = $_SERVER['HTTP_USER_AGENT'];

                                    $isMobile = false;

                                    if (preg_match('/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/', $userAgent)) {
                                        $isMobile = true;
                                    }

                                    if ($isMobile) {

                                ?>
                                @foreach ($hot_products->chunk(2) as $hotproductchandek )


                                    <div class="product-plr-1">
                                        <div class="row">

                                            @foreach ($hotproductchandek as $hotproduct )
                                                @php
                                                    $photos = explode(',',$hotproduct->photo);
                                                @endphp
                                                <div class="col-md-6 col-6">
                                                    <div class="single-product-wrap">
                                                        <div class="product-badges product-badges-mrg">
                                                                @if ((($hotproduct->discount/$hotproduct->price)*100) >= 30 )
                                                                <span class="hot yellow">Hot</span>
                                                                @endif



                                                            <span class="discount red">-{{round((($hotproduct->discount/$hotproduct->price)*100), 2)}}%</span>

                                                        </div>

                                                        @if ($hotproduct->stock == 0)
                                                            <div class="product-badges product-badges-position product-badges-mrg" style="left: unset;right: 0;" >
                                                                <span class="red-2">Out of stock</span>
                                                            </div>
                                                        @endif



                                                        <div class="product-content-wrap">
                                                            <div class="product-category">
                                                                <a href="{{route('grandcategorie.detail',(\App\Models\Grandcategory::where('id',$hotproduct->grand_cat_id)->value('slug')))}}">{{\App\Models\Grandcategory::where('id',$hotproduct->grand_cat_id)->value('title')}}</a>
                                                            </div>
                                                            <h2><a href="{{route('product.detail',$hotproduct->slug)}}">{{$hotproduct->title}}</a></h2>
                                                            <div class="product-price">
                                                                <span class="new-price">{{number_format(($hotproduct->price-$hotproduct->discount),3)}} TND</span>
                                                                <span class="old-price">{{number_format($hotproduct->price,3)}} TND</span>
                                                            </div>
                                                        </div>
                                                        <div class="product-img-action-wrap mb-20 mt-25">
                                                            <div class="product-img product-img-zoom">
                                                                <a href="{{route('product.detail',$hotproduct->slug)}}">

                                                                    <img class="default-img" src="{{$photos[0]}}" style="height:300px;object-fit:cover;background:white;">
                                                                    @if (count($photos)>1)
                                                                    <img class="hover-img" src="{{$photos[1]}}" style="height:300px;object-fit:cover;background:white;">
                                                                    @endif

                                                                </a>
                                                            </div>


                                                            @if ($hotproduct->stock !== 0)

                                                                <div class="product-action-1 text-center product_data" style="width: 100%" >

                                                                    <input class="qty-input"  type="hidden" value="1" min="1" max="{{$hotproduct->stock}}" >
                                                                    <input type="hidden" class="product_id" value="{{$hotproduct->id}}" >

                                                                    <button aria-label="Ajouter au panier" class="add-to-cart-btn" ><i class="far fa-shopping-bag"></i></button>


                                                                </div>

                                                            @endif


                                                        </div>

                                                    </div>
                                                </div>
                                            @endforeach




                                        </div>
                                    </div>

                                 @endforeach
                                <?php
                                    } else {
                                ?>

                                @foreach ($hot_products as $hotproduct )


                                    <div class="product-plr-1">


                                        @php
                                            $photos = explode(',',$hotproduct->photo);
                                        @endphp

                                            <div class="single-product-wrap">
                                                <div class="product-badges product-badges-mrg">
                                                        @if ((($hotproduct->discount/$hotproduct->price)*100) >= 30 )
                                                        <span class="hot yellow">Hot</span>
                                                        @endif



                                                    <span class="discount red">-{{round((($hotproduct->discount/$hotproduct->price)*100), 2)}}%</span>

                                                </div>

                                                @if ($hotproduct->stock == 0)
                                                    <div class="product-badges product-badges-position product-badges-mrg" style="left: unset;right: 0;" >
                                                        <span class="red-2">Out of stock</span>
                                                    </div>
                                                @endif



                                                <div class="product-content-wrap">
                                                    <div class="product-category">
                                                        <a href="{{route('grandcategorie.detail',(\App\Models\Grandcategory::where('id',$hotproduct->grand_cat_id)->value('slug')))}}">{{\App\Models\Grandcategory::where('id',$hotproduct->grand_cat_id)->value('title')}}</a>
                                                    </div>
                                                    <h2><a href="{{route('product.detail',$hotproduct->slug)}}">{{$hotproduct->title}}</a></h2>
                                                    <div class="product-price">
                                                        <span class="new-price">{{number_format(($hotproduct->price-$hotproduct->discount),3)}} TND</span>
                                                        <span class="old-price">{{number_format($hotproduct->price,3)}} TND</span>
                                                    </div>
                                                </div>
                                                <div class="product-img-action-wrap mb-20 mt-25">
                                                    <div class="product-img product-img-zoom">
                                                        <a href="{{route('product.detail',$hotproduct->slug)}}">

                                                            <img class="default-img" src="{{$photos[0]}}" style="height:300px;object-fit:cover;background:white;">
                                                            @if (count($photos)>1)
                                                            <img class="hover-img" src="{{$photos[1]}}" style="height:300px;object-fit:cover;background:white;">
                                                            @endif

                                                        </a>
                                                    </div>


                                                    @if ($hotproduct->stock !== 0)

                                                        <div class="product-action-1 text-center product_data" style="width: 100%" >

                                                            <input class="qty-input"  type="hidden" value="1" min="1" max="{{$hotproduct->stock}}" >
                                                            <input type="hidden" class="product_id" value="{{$hotproduct->id}}" >

                                                            <button aria-label="Ajouter au panier" class="add-to-cart-btn" ><i class="far fa-shopping-bag"></i></button>


                                                        </div>

                                                    @endif


                                                </div>

                                            </div>



                                    </div>

                                @endforeach
                                <?php
                                 }
                                ?>






                    </div>

                </div>
            </div>
        </div>



        <!-- Happy Valentines day Codepen!
<div class="bgoverlay" style="margin-bottom: 25px;">
    <div class="container2">
      <span class="ico">
        <span class="fa fa-heart"></span>
        <span class="title">Click Me</span>
      </span>
      <div class="endtext">
        <h1>I love you </h1>
        <h2>Be my valentine?</h2>
        <h3>~MS PARA</h3>
      </div>
    </div>
  </div>
-->


        @foreach ($grandcats as $grandcat )

        <div class="product-area pb-30 blog-block">
            <div class="custom-container">
                <div class="section-title-btn-wrap st-btn-wrap-xs-center wow tmFadeInUp mb-35">
                    <div class="section-title-1 section-title-hm2">
                        <h2>{{$grandcat->title}}</h2>
                    </div>
                    <div class="btn-style-2 mrg-top-xs">
                        <a href="{{route('products')}}">Voir tous les produits <i class="far fa-long-arrow-right"></i></a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3">
                        <div class="slidebar-product-wrap slidebar-product-bg-1 wow tmFadeInUp">

                            <div class="slidebar-product-details">
                                <ul>
                                    @foreach (\App\Models\Category::where('status','active')->where('grand_cat_id',$grandcat->id)->orderby('title','ASC')->get() as $cat )
                                    <li><a href="{{route('categorie.detail',$cat->slug)}}"><i class="far fa-long-arrow-alt-right"></i> {{$cat->title}}</a></li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="row">

                            @foreach (\App\Models\Product::where('status','active')->where('grand_cat_id',$grandcat->id)->where('price' , '!=' , 0)->inRandomOrder()->limit('4')->get() as $product )
                            @php
                            $photos = explode(',',$product->photo);
                            @endphp

                            <div class="col-xl-3 col-lg-4 col-md-4 col-12 col-sm-6">
                                <div class="single-product-wrap mb-50 wow tmFadeInUp">
                                    <div class="product-img-action-wrap mb-10">
                                        <div class="product-img product-img-zoom">
                                            <a href="{{route('product.detail',$product->slug)}}">
                                                <img class="default-img" src="{{$photos[0]}}" style="height:300px;object-fit:cover;background:white;">
                                                @if (count($photos)>1)
                                                <img class="hover-img" src="{{$photos[1]}}" style="height:300px;object-fit:cover;background:white;">
                                                @endif
                                            </a>
                                        </div>




                                        @if ($product->stock !== 0)

                                            <div class="product-action-1 text-center product_data" style="width: 100%" >

                                                <input class="qty-input"  type="hidden" value="1" min="1" max="{{$product->stock}}" >
                                                <input type="hidden" class="product_id" value="{{$product->id}}" >

                                                <button aria-label="Ajouter au panier" class="add-to-cart-btn" ><i class="far fa-shopping-bag"></i></button>


                                            </div>

                                        @endif



                                        @if ( $product->discount == "0")

                                            @else
                                            <div class="product-badges product-badges-position product-badges-mrg">
                                                @if ((($product->discount/$product->price)*100) >= 30 )
                                                <span class="hot yellow">Hot</span>
                                                @endif
                                                <span class="red">-{{round((($product->discount/$product->price)*100), 2)}}%</span>
                                            </div>
                                        @endif

                                        @if ($product->stock == 0)
                                        <div class="product-badges product-badges-position product-badges-mrg" style="left: unset;right: 0;" >
                                            <span class="red-2">Out of stock</span>
                                        </div>
                                        @endif



                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            <a href="{{route('grandcategorie.detail',$grandcat->slug)}}">{{$grandcat->title}}</a>
                                        </div>
                                        <h2><a href="{{route('product.detail',$product->slug)}}">{{$product->title}}</a></h2>

                                        @if ($product->discount == 0)
                                        <div class="product-price">
                                            <span>{{number_format($product->price,3)}} TND</span>
                                        </div>
                                        @else

                                        <div class="product-price">
                                            <span class="new-price">{{number_format(($product->price-$product->discount),3)}} TND</span>
                                            <span class="old-price">{{number_format($product->price,3)}} TND</span>
                                        </div>
                                        @endif

                                    </div>
                                </div>
                            </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>

        @endforeach



        <div class="blog-testimonial-area pt-75 pb-75">
            <div class="custom-container">
                <div class="row">
                    <div class="col-width-44">
                        <div class="blog-area">
                            <div class="section-title-1 mb-40 wow tmFadeInUp">
                                <h2><a href="{{route('blog.list')}}" >Nos Derniers articles</a></h2>
                            </div>

                            @foreach ($blogs as $blog )
                                <div class="blog-wrap mb-40 wow tmFadeInUp">
                                    <div class="blog-img">
                                        <a href="{{route('blog.detail',$blog->slug)}}"><img src="{{$blog->photo}}" alt=""></a>

                                    </div>
                                    <div class="blog-content">
                                        <div class="blog-meta">
                                            <span><i class="far fa-calendar"></i> {{date('M d, Y',strtotime($blog->updated_at))}}</span>
                                        </div>
                                        <h3><a href="{{route('blog.detail',$blog->slug)}}">{{$blog->title}}</a></h3>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                    <div class="col-width-56">
                        <div class="testimonial-area wow tmFadeInUp">
                            <span class="pagingInfo"></span>
                            <div class="testimonial-active-2 nav-style-3">

                                @foreach ($feedbacks as $feedback )
                                <div class="testimonial-plr-1">
                                    <div class="single-testimonial-2">

                                        <p><q>{{$feedback->description}}</q></p>
                                        <div class="client-info-2">
                                            <img src="{{$feedback->photo}}" style="width: 100px;height:100px;object-fit:cover;border-radius:50%;"  >
                                            <h5>{{$feedback->title}}</h5>
                                        </div>
                                    </div>
                                </div>
                                @endforeach


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>





        <div class="product-area pt-80 pb-75 products">
            <div class="custom-container">
                <div style="border: none;" class="product-area-border">
                    <div class="section-title-timer-wrap">
                        <div class="section-title-1 section-title-hm2">
                            <h2>Nos Marques</h2>
                        </div>


                    </div>
                    <div class="product-slider-active-1 nav-style-2 product-hm1-mrg">

                        @foreach ($partenaires as $partenaire )


                            <div class="product-plr-1">
                                <div class="single-product-wrap">

                                    <div class="product-content-wrap">

                                        <h2><a href="{{route('marque.detail',$partenaire->slug)}}">{{$partenaire->title}}</a></h2>

                                    </div>
                                    <div class="product-img-action-wrap mb-20 mt-25">

                                        <div class="single-brand-logo mb-30 wow tmFadeInUp">
                                            <a href="{{route('marque.detail',$partenaire->slug)}}" ><img src="{{$partenaire->photo}}" style="height:250px;object-fit:contain;" alt=""></a>
                                        </div>

                                    </div>

                                </div>
                            </div>

                        @endforeach


                    </div>
                </div>
            </div>
        </div>



@endsection


@section('scripts')

    @if (session()->has('success'))
    <script>
        $(document).ready(function(){
            alertify.set('notifier','position','bottom-left');
            alertify.success('{{session()->get('success')}}');
        })
    </script>
    @endif

    <script>
        $(document).ready(function(){
          $('.title').click(function(){
            $('.container2').addClass('open');
          });


          $('.close').click(function(){
            $('.container2').removeClass('open');
          });
        });
     </script>




@endsection

