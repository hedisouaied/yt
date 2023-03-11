@extends('frontend.layouts.master')

@section('content')
<style>
 @media only screen and (max-width: 600px) {
  .hedi-menu {
    height: 180px !important;
  }
}
</style>
<!-- Page Title -->
<section class="page-title hedi-menu" style="background:black;height: 128px;">
    <div class="auto-container">
        <div class="content-box" style="padding: 63px 0px;">
            <div class="content-wrapper">

            </div>
        </div>
    </div>
</section>

<!-- shop-details -->
<section class="shop-details" style="padding: 120px 0px 0px 0px;">
    <div class="auto-container">
        <div class="product-details-content">
            <div class="row clearfix">

                <div class="col-lg-12 content-column">

                    <div class="product-details">
                        @if ($categories->photo !== "")
                        <div >

                                            <div class="image" style="text-align: center"><img style="width: 80%;" src="{{$categories->photo}}" alt=""></div>


                        </div>
                        @endif


                        <div class="title-box">
                            <h3>{{$categories->title}}</h3>
                        </div>
                        @if ($categories->description)
                        <div class="text">
                            <p>{!!$categories->description!!}</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<!-- shop-details end -->
@if (count($gammes) !== 0)



    <section class="projects-section-two" style="background:none;padding-top:0;">
        <div class="auto-container">

            <!--Filter-->
            <div class="filters">
                <ul class="filter-tabs filter-btns">
                    @php
                        $i = 0 ;
                    @endphp
                    @foreach ( $gammes as $gamme )
                    <li class="filter @if ($i==0) active @endif" data-role="button" data-filter=".gamme-{{$gamme->id}}">{{$gamme->title}}</li>
                        @php
                        if($i == 0){
                            $first_gamme = $gamme->id;
                        }
                        $i++ ;
                        @endphp
                    @endforeach
                </ul>
            </div>

            <!--Sortable Galery-->
            <div class="sortable-masonry">

                <div class="items-container row" style="position: relative; height: max-content;">
                    @if (count( \App\Models\SousGamme::where('child_cat_id',$categories->id)->get()) == 0 )

                        @php
                        $i = 0 ;
                        @endphp
                        @foreach ( $products as $item )
                            @php
                                $photos = explode(",",$item->photo);
                            @endphp
                                <div class="col-lg-3 col-md-6 project-block masonry-item @if ($item->gamme_id== $first_gamme) all @endif gamme-{{$item->gamme_id}}" >
                                    <div class="inner-box">
                                        <div class="image">
                                            <img src="{{$item->photo}}" style="height: 250px;object-fit: contain;" alt="">
                                        </div>
                                        <div class="overlay-content">
                                            <div>
                                                <h4>{{$item->title}}</h4>
                                            </div>
                                            <div class="link-btn"><a href="{{route('product.detail',$item->slug)}}"><span class="flaticon-arrow-1"></span></a></div>
                                        </div>
                                    </div>
                                </div>
                            @php
                            $i++ ;
                            @endphp
                        @endforeach


                    @else

                        @php
                        $k = 0 ;
                        $i = 0 ;
                        @endphp
                        @foreach ( $gammes as $gamme )
                        <div class="col-lg-12 col-md-12 project-block masonry-item @if ($i == 0) all @endif gamme-{{$gamme->id}}" >
                        <!-- faq section -->
                        <section class="faq-section style-two" style="padding-top: 0">
                            <div class="auto-container">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <ul class="accordion-box style-two mb-30">
                                            @php
                                                $i_sous = 0 ;
                                            @endphp
                                            @foreach (\App\Models\SousGamme::where('gamme_id',$gamme->id)->get() as $sous_gamme )


                                            <!--Accordion Block-->
                                            <li class="accordion block">
                                                <div class="acc-btn @if ($i_sous == 0) active @endif" style="padding: 20px;background: black;color:white;">{{$sous_gamme->title}}</div>
                                                <div class="acc-content @if ($i_sous == 0) current @endif">
                                                    <div class="content">
                                                        <div class="row">
                                                            @foreach ( $products as $item )
                                                            @php
                                                                $photos = explode(",",$item->photo);
                                                            @endphp
                                                            @if ($item->sous_gamme_id == $sous_gamme->id)
                                                            <div class="col-lg-3 col-md-6 project-block " >
                                                                <div class="inner-box">
                                                                    <div class="image">
                                                                        <img src="{{$item->photo}}" style="height: 250px;object-fit: contain;" alt="">
                                                                    </div>
                                                                    <div class="overlay-content">
                                                                        <div>
                                                                            <h4>{{$item->title}}</h4>
                                                                        </div>
                                                                        <div class="link-btn"><a href="{{route('product.detail',$item->slug)}}"><span class="flaticon-arrow-1"></span></a></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @php
                                                            $i++ ;
                                                            @endphp
                                                            @endif

                                                        @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>


                                            @php
                                            $i_sous++ ;
                                            @endphp
                                            @endforeach
                                    </div>

                                </div>
                            </div>
                        </section>

                        @php
                        $i++ ;
                        @endphp
                        </div>
                        @endforeach



                    @endif



                </div>
            </div>
        </div>
    </section>

@else
<!-- Shop section -->
<section class="shop-section" style="padding: 0px 0 90px;">
    <div class="auto-container">
        <div class="row" id="product-data">
            @include('frontend.layouts._single-product')


        </div>
        <div class="ajax-load text-center" style="display: none">
            <img src="{{asset('frontend/images/loading.gif')}}" style="width: 30%;" >
        </div>
        @if (count($products)==0)
         <p>Il n'y a pas de produits</p>
        @endif
    </div>
</section>
@endif


    @if ($categories->partenaire_ids != null)
    <section class="cta-section-three" style="padding-top: 0;">
        @php
        $partenaires = explode(',',$categories->partenaire_ids);
        @endphp
        <div class="auto-container">
            <div class="content" >

                @foreach ( $partenaires as $para )

                <img src="{{\App\Models\Brand::where('id',$para)->value('photo')}}" alt="">
                @endforeach


            </div>
        </div>
    </section>
    @endif


@endsection

@section('scripts')
    @if (count($gammes) == 0)


    <script>
        function loadmoreData(page) {
            $.ajax({
                url: '?page='+page,
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


    @endif
@endsection

