@extends('frontend.layouts.master')


@section('content')


 <div class="section-full p-t120 p-b60 overlay-wraper bg-no-repeat bg-bottom-left bg-cover services-main-section" style="background-image:url({{asset('frontend/images/background/bg-3.jpg')}});margin-bottom: 0;">
    <div class="overlay-main site-bg-secondry opacity-08"></div>

    <div class="section-content services-section-content" style="padding: 80px 15px;">
        <div class="row">
            <div class="col-xl-6 col-lg-12 col-md-12">
                <div class="services-section-content-left">
                    <div class="left wt-small-separator-outer text-white">
                        <div class="wt-small-separator site-text-primary">
                            <div  class="sep-leaf-left"></div>
                            <div>Moyen industriel</div>
                            <div  class="sep-leaf-right"></div>
                        </div>
                        <h2>{{$blog->title}}</h2>
                        <div class="text-white" >
                        <p>{!!$blog->description!!}</p>
                        </div>
                        <img src="{{$blog->photo}}" alt="" style="border: 6px solid #ff5e15;"  >
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-lg-12 col-md-12">
                <div class="services-section-content-right">
                    <div class="owl-carousel services-slider owl-btn-vertical-center mfp-gallery">

                        @php
                            $galeries = explode(',',$blog->galerie)
                        @endphp

                        @foreach ($galeries as $galerie )
                            <div class="item">
                                <div class="project-img-effect-1">
                                    <img src="{{$galerie}}" alt="" style="height: 200px;object-fit: cover;" />
                                   <a href="{{$galerie}}" class="mfp-link"><i class="fa fa-eye"></i></a>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection


@section('scripts')



@endsection

