@extends('frontend.layouts.master')

@section('content')



<div class="edu-breadcrumb-area">
    <div class="container">
        <div class="breadcrumb-inner">
            <div class="page-title">
                <h1 class="title">Radio energy podcast</h1>
            </div>
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

<div class="edu-event-area event-area-1 section-gap-equal">
    <div class="container">
        <div class="row g-5">

            @foreach ($podcasts as $podcast )
            <div class="col-lg-4 col-md-6" data-sal-delay="100" data-sal="slide-up" data-sal-duration="800">
                <div class="edu-event event-style-1">
                    <div class="inner">
                        <div class="thumbnail">
                            <a href="{{route('podcast.detail',$podcast->slug)}}">
                                <img src="{{$podcast->photo}}" alt="Podcast Images">
                            </a>
                            <div class="event-time" >
                                <span  style="background: #e10000;"><i class="icon-43"></i>{{$podcast->radio}}</span>
                            </div>
                        </div>
                        <div class="content">
                            <div class="event-date">
                                <span class="day">{{date('d',strtotime($podcast->date))}}</span>
                                <span class="month">{{date('M',strtotime($podcast->date))}}</span>
                            </div>
                            <h5 class="title"><a href="{{route('podcast.detail',$podcast->slug)}}">{{$podcast->title}}</a></h5>

                            <div class="read-more-btn">
                                <a class="edu-btn btn-small btn-secondary" href="{{route('podcast.detail',$podcast->slug)}}">Voir plus <i class="icon-4"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach


        </div>


    </div>
</div>




@endsection


@section('scripts')



@endsection

