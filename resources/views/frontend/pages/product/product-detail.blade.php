@extends('frontend.layouts.master')

@section('content')



<div class="breadcrumb-area breadcrumb-area-padding-2 bg-gray-2">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <ul>
                <li>
                    <a href="{{route('home')}}">Accueil</a>
                </li>
                <li>
                    <a href="{{route('grandcategorie.detail',(\App\Models\Grandcategory::where('id',$product->grand_cat_id)->value('slug')))}}">{{\App\Models\Grandcategory::where('id',$product->grand_cat_id)->value('title')}}</a>
                </li>
                <li>
                    <a href="{{route('categorie.detail',(\App\Models\Category::where('id',$product->cat_id)->value('slug')))}}">{{\App\Models\Category::where('id',$product->cat_id)->value('title')}}</a>
                </li>
                @if ($product->child_cat_id !== null)
                <li>
                    <a href="{{route('souscategorie.detail',(\App\Models\Souscategory::where('id',$product->child_cat_id)->value('slug')))}}">{{\App\Models\Souscategory::where('id',$product->child_cat_id)->value('title')}}</a>
                </li>
                @endif

                <li class="active">{{$product->title}}</li>
            </ul>
        </div>
    </div>
</div>
<div class="product-details-area padding-30-row-col pt-75 pb-75">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="product-details-wrap">
                    <div class="product-details-wrap-top">
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="product-details-slider-wrap">
                                    <div class="pro-dec-big-img-slider">

                                        @php
                                            $photos = explode(",",$product->photo);
                                        @endphp
                                        @foreach ($photos as $photo )
                                        <div class="single-big-img-style">
                                            <div class="pro-details-big-img">
                                                <a class="img-popup" href="{{$photo}}">
                                                    <img src="{{$photo}}" alt="">
                                                </a>
                                            </div>
                                            @if ($product->stock == 0)
                                                <div class="pro-details-badges product-badges-position">
                                                    <span class="red">OUT OF STOCK !</span>
                                                </div>
                                            @endif



                                        </div>
                                        @endforeach


                                    </div>
                                    <div class="product-dec-slider-small product-dec-small-style1">
                                        @php
                                            $i = 0;
                                        @endphp
                                        @foreach ($photos as $photo )
                                        <div class="product-dec-small @if ($i==0) active @endif">
                                            <img src="{{$photo}}" alt="">
                                        </div>
                                        @php
                                            $i++;
                                        @endphp
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="product-details-content pro-details-content-pl">

                                    <div class="row">
                                        <div class="col-lg-10 col-md-10">
                                            <h1> {{$product->title}}</h1></div>
                                        <div class="col-lg-2 col-md-2">

                                            @if ($product->marque_id !== 0)

                                            <a href="{{route('marque.detail',(\App\Models\Partenaire::where('id',$product->marque_id)->value('slug')))}}" ><img src="{{\App\Models\Partenaire::where('id',$product->marque_id)->value('photo')}}" style="height: 100px;"  ></a>

                                            @endif

                                        </div>
                                    </div>

                                    <div class="pro-details-price-short-description">

                                        @if ($product->discount == 0)

                                        <div class="pro-details-price">
                                            <span style="color: rgb(105 134 41);" >{{number_format($product->price,3)}} TND</span>
                                        </div>
                                        @else
                                        <div class="pro-details-price">
                                            <span class="new-price">{{number_format(($product->price-$product->discount),3)}} TND</span>
                                            <span class="old-price">{{number_format($product->price,3)}} TND</span>
                                        </div>

                                            @if ($product->expiration_discount !== NULL)
                                                <br>
                                                <div id="timer-1-active-my" class="timer-style-1" style="margin-left: 0;background-color: #3782ee;" >
                                                    <span>Promotion finie dans :</span>
                                                    <div data-countdown="2024/8/30"></div>
                                                </div>

                                            @endif

                                        @endif
                                        <br>
                                        <div class="alert alert-warning ">
                                            Achetez ce produit maintenant et gagnez {{(int)($product->price-$product->discount)}} Points,100 points de fidélité peuvent être convertis en un bon de 2 TND !
                                        </div>

                                    </div>


                                    @if ($product->stock !== 0)
                                    <div class="product_data" >

                                        <div class="pro-details-quality-stock-area">
                                            <span>Quantité</span>
                                            <div class="pro-details-quality-stock-wrap">
                                                <div>
                                                    <input class="qty-input"  type="number" value="1" min="1" max="{{$product->stock}}" >
                                                    <input type="hidden" class="product_id" value="{{$product->id}}" >
                                                </div>
                                                
                                            </div>

                                        </div>
                                        <div class="pro-details-action-wrap">
                                            <div class="pro-details-add-to-cart">
                                                <button class="add-to-cart-btn" >Ajouter au panier</button>
                                            </div>
                                        </div>

                                    </div>
                                    @endif
                                    <br>
                                    <div class="product-details-social tooltip-style-4 a2a_kit a2a_kit_size_32 a2a_default_style">
                                        <p style="margin-right: 10px;" >Partager Sur : </p>
                                        <a aria-label="Facebook" class="facebook a2a_button_facebook" href="#"><i class="fab fa-facebook-f"></i></a>
                                        <a aria-label="Twitter" class="twitter a2a_button_twitter" href="#"><i class="fab fa-twitter"></i></a>
                                        <a aria-label="Linkedin" class="linkedin a2a_button_linkedin" href="#"><i class="fab fa-linkedin"></i></a>
                                        <script async src="https://static.addtoany.com/menu/page.js"></script>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-details-wrap-bottom">
                        <div class="tab-style-1 nav mb-35">
                            <a class="active" href="#product-details-1" data-toggle="tab"> Description </a>
                        </div>
                        <div class="tab-content">
                            <div id="product-details-1" class="tab-pane active">
                                <div class="product-details-description">
                                    <p>{!!$product->description!!}</p>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="product-area border-top-2 pt-75 pb-70">
    <div class="custom-container">
        <div class="section-title-1 mb-40">
            <h2>Produits connexes</h2>
        </div>
        <div class="product-slider-active-1 nav-style-2 nav-style-2-modify-3">
            @foreach ($related_products as $related_product )

                @php
                $photos = explode(',',$related_product->photo);

                @endphp
                <div class="product-plr-1">
                    <div class="single-product-wrap mb-50 wow tmFadeInUp">
                        <div class="product-img-action-wrap mb-10">
                            <div class="product-img product-img-zoom">
                                <a href="{{route('product.detail',$related_product->slug)}}">
                                    <img class="default-img" src="{{$photos[0]}}" style="height:300px;object-fit:cover;background:white;">
                                    @if (count($photos)>1)
                                    <img class="hover-img" src="{{$photos[1]}}" style="height:300px;object-fit:cover;background:white;">
                                    @endif
                                </a>
                            </div>

                            
                            @if ($related_product->stock !== 0)

                                <div class="product-action-1 text-center product_data" style="width: 100%" >

                                    <input class="qty-input"  type="hidden" value="1" min="1" max="{{$related_product->stock}}" >
                                    <input type="hidden" class="product_id" value="{{$related_product->id}}" >

                                    <button aria-label="Ajouter au panier" class="add-to-cart-btn" ><i class="far fa-shopping-bag"></i></button>


                                </div>

                            @endif


                            
                            @if ( $related_product->discount == "0")

                            @else
                            <div class="product-badges product-badges-position product-badges-mrg">
                                @if ((($related_product->discount/$related_product->price)*100) >= 30 )
                                <span class="hot yellow">Hot</span>
                                @endif
                                <span class="red">-{{round((($related_product->discount/$related_product->price)*100), 2)}}%</span>
                            </div>
                            @endif

                            @if ($related_product->stock == 0)
                            <div class="product-badges product-badges-position product-badges-mrg" style="left: unset;right: 0;" >
                                <span class="red-2">Out of stock</span>
                            </div>
                            @endif


                        </div>
                        <div class="product-content-wrap">
                            <div class="product-category">
                                <a href="{{route('grandcategorie.detail',(\App\Models\Grandcategory::where('id',$related_product->grand_cat_id)->value('slug')))}}">{{\App\Models\Grandcategory::where('id',$related_product->grand_cat_id)->value('title')}}</a>
                            </div>
                            <h2><a href="{{route('product.detail',$related_product->slug)}}">{{$related_product->title}}</a></h2>

                            @if ($related_product->discount == 0)
                            <div class="product-price">
                                <span>{{number_format($related_product->price,3)}} TND</span>
                            </div>
                            @else

                            <div class="product-price">
                                <span class="new-price">{{number_format(($related_product->price-$related_product->discount),3)}} TND</span>
                                <span class="old-price">{{number_format($related_product->price,3)}} TND</span>
                            </div>
                            @endif

                        </div>
                    </div>
                </div>
            @endforeach


        </div>
    </div>
</div>

@endsection




@section('scripts')



@if ($product->discount !== 0)
        @if ($product->expiration_discount !== NULL)
            <script>
                $('#timer-1-active-my').syotimer({
                    year: {{date('Y',strtotime($product->expiration_discount))}},
                    month: {{date('m',strtotime($product->expiration_discount))}},
                    day: {{date('d',strtotime($product->expiration_discount))}},
                    hour: 0,
                    minute: 0,
                    layout: 'dhms',
                    periodic: false,
                    periodUnit: 'm'
                });
            </script>
        @endif
@endif





@endsection
