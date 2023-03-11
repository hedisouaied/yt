@extends('frontend.layouts.master')

@section('content')



<div class="edu-course-area course-area-1 gap-tb-text">
    <div class="container">


        <div class="edu-sorting-area">
            <div class="sorting-left">
                <h6 class="showing-text">Il y'a <span>{{count($cours)}}</span> cours disponible pour vous</h6>
            </div>
        </div>

        <div class="row g-5">

            @foreach ($cours as $cour )
                <div class="col-md-6 col-lg-4 col-xl-4" data-sal-delay="100" data-sal="slide-up" data-sal-duration="800">
                    <div class="edu-course course-style-1 course-box-shadow hover-button-bg-white">
                        <div class="inner">
                            <div class="thumbnail">
                                <a href="{{route('cours.detail',$cour->slug)}}">
                                    <img src="{{$cour->photo}}" alt="Cours" style="height: 450px;object-fit: cover;">
                                </a>
                                <div class="time-top">
                                    <span class="duration"><i class="icon-27"></i>le {{date('d M, Y',strtotime($cour->date_debut))}}</span>
                                </div>
                            </div>
                            <div class="content">
                                <h6 class="title">
                                    <a href="#">{{$cour->title}}</a>
                                </h6>
                                <div class="course-price">
                                    @if ($cour->discount == 0)
                                        {{number_format($cour->price,2)}} TND
                                    @else
                                    <del>{{number_format($cour->price,2)}} TND</del> {{number_format(($cour->price-$cour->discount),2)}} TND
                                    @endif
                                </div>
                                <ul class="course-meta">
                                    <li><i class="icon-24"></i>{{$cour->nb_seance}} Séances</li>
                                    <li><i class="icon-59"></i>{{$cour->langue}}</li>
                                </ul>
                            </div>
                        </div>
                        <div class="course-hover-content-wrapper">
                            <button class="wishlist-btn"><i class="icon-22"></i></button>
                        </div>

                        <div class="course-hover-content">
                            <div class="content">
                                <h6 class="title">
                                    <a href="{{route('cours.detail',$cour->slug)}}">{{$cour->title}}</a>
                                </h6>

                                <div class="course-price">
                                    @if ($cour->discount == 0)
                                        {{number_format($cour->price,2)}} TND
                                    @else
                                    <del>{{number_format($cour->price,2)}} TND</del> {{number_format(($cour->price-$cour->discount),2)}} TND
                                    @endif
                                </div>
                                <p style="overflow: hidden;text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 2;-webkit-box-orient: vertical;" >{!!filter_var($cour->description,FILTER_SANITIZE_STRING)!!}</p>
                                <ul class="course-meta">
                                    <li><i class="icon-24"></i>{{$cour->nb_seance}} Séances</li>
                                    <li><i class="icon-59"></i>{{$cour->langue}}</li>
                                </ul>
                                <a href="{{route('cours.detail',$cour->slug)}}" class="edu-btn btn-secondary btn-small">Lire la suite <i class="icon-4"></i></a>
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

