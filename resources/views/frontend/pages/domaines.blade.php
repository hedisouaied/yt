@extends('frontend.layouts.master')


@section('content')



<!--Services Section-->
<section class="services-section">
    <div class="auto-container">
        <!--Sec Title-->
        <div class="sec-title centered">
            <h2>Domaines d'activités</h2>
            <div class="separater"></div>
        </div>
        <div class="row clearfix">

            @foreach ($domaines as $domaine )
                <div class="services-block col-lg-4 col-md-6 col-sm-12">
                    <div class="inner-box">
                        <div class="upper-box">
                            <span class="icon fa fa-hand-o-right"></span>
                            <h3 style="line-height: unset;margin-bottom: 6px;"><a href="{{route('domaine.detail',$domaine->slug)}}">{{$domaine->title}}</a></h3>
                        </div>
                        <div class="lower-box">
                            <div class="image">
                                <img src="{{$domaine->photo}}" alt="" style="height: 300px;object-fit: cover;" />
                                <div class="overlay-box">
                                    <a href="{{route('domaine.detail',$domaine->slug)}}" class="link-btn"><span class="fa fa-link"></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach



        </div>
    </div>
</section>
<!--End Services Section-->


@endsection


@section('scripts')



@endsection

