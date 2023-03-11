@extends('frontend.layouts.master')

@section('content')

<div class="breadcrumb-area breadcrumb-area-padding-2 bg-gray-2">
    <div class="custom-container">
        <div class="breadcrumb-content text-center">
            <ul>
                <li>
                    <a href="{{route('home')}}">Accueil</a>
                </li>
                <li class="active">À propos</li>
            </ul>
        </div>
    </div>
</div>

<div class="about-us-area fix about-us-img pt-65 pb-75">
    <div class="container">

        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="about-us-img wow tmFadeInUp">
                    <img src="{{get_setting('image')}}" alt="">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-us-content wow tmFadeInUp">

                    <h3>À Propos</h3>
                    <p>{!!get_setting('content')!!}</p>

                </div>
            </div>
        </div>
    </div>
    <div class="mouse-scroll-area-2" id="scene">
        <div data-depth="0.3" class="layer about-us-shape-1">
            <div class="medizin-shape"></div>
        </div>
    </div>
</div>




@endsection
