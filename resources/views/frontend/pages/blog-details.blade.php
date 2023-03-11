@extends('frontend.layouts.master')

@section('content')



<div class="breadcrumb-area breadcrumb-area-padding-2 bg-gray-2">
    <div class="custom-container">
        <div class="breadcrumb-content text-center">
            <ul>
                <li>
                    <a href="{{route('home')}}">Accueil</a>
                </li>
                <li>
                    <a href="{{route('blog.list')}}">Nos articles</a>
                </li>
                <li class="active">{{$blog->title}}</li>
            </ul>
        </div>
    </div>
</div>
<div class="blog-details-area padding-30-row-col pt-75 pb-75">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 ml-auto mr-auto">
                <div class="blog-details-wrapper">
                    <div class="blog-details-top-content">
                        <h1>{{$blog->title}}</h1>
                        <div class="blog-meta-3">
                            <ul>
                                <li><i class="far fa-calendar"></i> April 21, 2020</li>
                            </ul>
                        </div>
                    </div>
                    <img src="{{$blog->photo}}" alt="">
                    <div>
                        <p>{!!$blog->description!!}</p>
                    </div>
                    <div class="blog-tag-share-wrap">

                        <div class="blog-share-wrap">
                            <div class="blog-share-content">
                                <span> Partager sur:</span>
                            </div>
                            <div class="blog-share-icon">
                                <span class="fas fa-share-alt"></span>
                                <div class="blog-share-list tooltip-style-4 bs-list-responsive a2a_kit a2a_kit_size_32 a2a_default_style">
                                    <a class="a2a_button_facebook" aria-label="Facebook" href="#"><i class="fab fa-facebook-f"></i></a>
                                    <a class="a2a_button_twitter" aria-label="Twitter" href="#"><i class="fab fa-twitter"></i></a>
                                    <a class="a2a_button_linkedin" aria-label="Linkedin" href="#"><i class="fab fa-linkedin"></i></a>
                                </div>

                                <script async src="https://static.addtoany.com/menu/page.js"></script>
                            </div>

                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>



@endsection
