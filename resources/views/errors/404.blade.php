@extends('frontend.layouts.master')

@section('content')


<div class="error-area">
    <div class="container">
        <div class="row align-items-center pt-75 pb-55">
            <div class="col-lg-8 ml-auto mr-auto">
                <div class="error-content text-center">
                    <div class="error-logo">
                        <a href="{{route('home')}}"><img src="{{asset('frontend/pp.png')}}" alt="logo"></a>
                    </div>
                    <div class="error-img">
                        <img src="{{asset('frontend/assets/images/banner/page-404-image.jpg')}}" alt="">
                    </div>
                    <h2> Oops! Page not found.</h2>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
