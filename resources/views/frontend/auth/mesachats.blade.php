@extends('frontend.layouts.master')

@section('content')



<div class="edu-breadcrumb-area">
    <div class="container">
        <div class="breadcrumb-inner">
            <div class="page-title">
                <h1 class="title">Mes Achats</h1>
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



<div class="edu-course-area course-area-1 section-gap-equal">
    <div class="container">
        <div class="row g-5">

            <div class="col-lg-12 col-pl--35">

                @foreach ($cours as $cour )
                <div class="edu-course course-style-4 course-style-8">
                    <div class="inner">

                        <div class="thumbnail">
                            <a >
                                <img src="{{$cour->photo}}" style="height: 200px;width: 200px;object-fit: cover;">
                            </a>
                            <div class="time-top">
                                <span class="duration"><i class="icon-27"></i>le {{date('d M, Y',strtotime($cour->date_debut))}}</span>
                            </div>
                        </div>
                        <div class="content">

                            <h6 class="title">
                                <a>{{$cour->title}}</a>
                            </h6>

                            <p>Lorem ipsum dolor sit amet consectur elit sed eiusmod tempor incidid unt labore dolore magna.</p>
                            <ul class="course-meta">
                                <li><i class="icon-24"></i>{{$cour->nb_seance}} Séances</li>
                                <li><i class="icon-59"></i>{{$cour->langue}}</li>
                            </ul>
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
            alertify.set('notifier','position','bottom-right');
            alertify.success('{{session()->get('success')}}');
        })
    </script>
    @endif


@endsection
