@extends('frontend.layouts.master')


@section('content')

<section class="our-team section-padding">
    <div class="auto-container">
        <div class="sec-title centered">
            <h2>Notre équipe</h2>
            <div class="separater"></div>
        </div>
        <div class="team-slider row clearfix team-grids">

                @foreach ($equipe as $team )
                    <div class="team-grid col-lg-3 col-md-6 col-sm-12">
                        <div class="member-pic-social square-hover-effect-parent">
                            <div class="square-hover-effect">
                                <span class="hover-1"></span>
                                <span class="hover-2"></span>
                                <span class="hover-3"></span>
                                <span class="hover-4"></span>
                            </div>
                            <div class="member-pic">
                                <img src="{{$team->photo}}" alt style="height: 300px;object-fit: cover;" >
                            </div>
                            <div class="social">
                                <ul class="social-links">
                                    <li><a href="{{$team->fb}}"><i class="fa fa-facebook"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="member-info">
                            <h3>{{$team->title}}</h3>
                            <p>{{$team->post}}</p>
                            <p><strong> <i class="fa fa-envelope-o" ></i> {{$team->email}}</strong></p>
                            <p><strong> <i class="fa fa-phone" ></i> {{$team->phone}}</strong></p>
                        </div>
                    </div>
                @endforeach


        </div>

    </div>
</section>

@endsection


@section('scripts')



@endsection

