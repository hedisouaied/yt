@extends('frontend.layouts.master')


@section('content')

<div class="edu-breadcrumb-area breadcrumb-style-4">
    <div class="container">
        <div class="breadcrumb-inner">
            <div class="page-title">
                <span class="pre-title">Podcast</span>
                <h1 class="title">{{$blog->title}}</h1>
            </div>
            <ul class="course-meta">
                <li><i class="icon-27"></i>{{date('d M, Y',strtotime($blog->date))}}</li>
                <li><i class="icon-43"></i>{{$blog->radio}}</li>
            </ul>
        </div>
    </div>
    <ul class="shape-group">
        <li class="shape-1"><img src="{{asset('frontend/assets/images/about/shape-22.png')}}" alt="shape"></li>
        <li class="shape-2 scene"><img data-depth="2" src="{{asset('frontend/assets/images/about/shape-13.png')}}" alt="shape"></li>
        <li class="shape-3 scene"><img data-depth="-2" src="{{asset('frontend/assets/images/about/shape-15.png')}}" alt="shape"></li>
        <li class="shape-4"><img src="{{asset('frontend/assets/images/about/shape-22.png')}}" alt="shape"></li>
        <li class="shape-5 scene"><img data-depth="2" src="{{asset('frontend/assets/images/about/shape-07.png')}}" alt="shape"></li>
    </ul>
</div>


<section class="event-details-area edu-section-gap" style="padding-top: 0;" >
    <div class="container">
        <div class="event-details">

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="main-thumbnail">
                        <style>
                        .flowplayer a{

                            background-origin: content-box;
                        }
                        </style>

                        <div style="width: 100%;" data-player-id="3b1e15bd-ab89-43e9-8542-a6b3f02f8b8c"><script src="//cdn.flowplayer.com/players/c65ee26c-b42a-4623-8e0f-619a6435dd98/native/flowplayer.async.js">{"src": "{{$blog->video}}","my_option" : "my_value","poster": "{{$blog->photo}}"}</script></div>

                    </div>
                    <div class="details-content">
                        <p>{!!$blog->description!!}</p>

                    </div>
                    <div class="share-area">
                        <h4 class="title">Partager sur:</h4>
                        <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
                            <a class="a2a_button_facebook"></a>
                            <a class="a2a_button_linkedin"></a>
                            <a class="a2a_button_twitter"></a>
                        </div>
                        <script async src="https://static.addtoany.com/menu/page.js"></script>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>


@endsection


@section('scripts')



@endsection

