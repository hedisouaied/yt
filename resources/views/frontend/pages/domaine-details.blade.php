@extends('frontend.layouts.master')


@section('content')

 <div class="section-full p-t120 p-b80 m-t120">


    <div class="container woo-entry">

        <div class="row m-b30">
            <div class="col-lg-4 col-md-4 m-b30 ">
                <div class="wt-team-1">

                    <div class="wt-media">
                        <img src="{{$blog->photo}}" alt="">

                    </div>



                </div>
            </div>
            <div class="col-lg-8 col-md-8 m-b30">

                <div class="row">
                    <div class="col-md-12">
                        <div class="wt-tabs border bg-tabs">
                            <ul class="nav nav-tabs">
                                <li><a data-toggle="tab" href="#web-design-19" class="active">Description</a></li>
                                <li><a data-toggle="tab" href="#graphic-design-19">Séléction de projets</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="web-design-19" class="tab-pane active">

                                    <div class="wt-team-1-single p-3">
                                        <h3 class="m-t0">
                                            <a  class="site-text-secondry">{{$blog->title}}</a>
                                        </h3>
                                        <ul class="wt-team-1-single-info bg-white">
                                            <div>{!!$blog->description!!}</div>
                                            @php
                                            $missions = explode(',',$blog->missions);
                                            @endphp
                                            <ul class="list-check-circle primary">
                                                @foreach ($missions as $mission )
                                                <li>{{$mission}}</li>
                                                @endforeach
                                            </ul>
                                        </ul>
                                    </div>
                                </div>
                                <div id="graphic-design-19" class="tab-pane">
                                    <div class="section-full p-t80">
                                        <div class="container">
                                            <div class="section-content">
                                                <div class="owl-carousel project-detail-slider owl-btn-vertical-center mfp-gallery">

                                                    @foreach ($references as $reference )
                                                    <div class="item">
                                                        <div class="">
                                                            <img src="{{$reference->photo}}" style="height:500px;object-fit:cover;" alt="" />
                                                        </div>
                                                        <div class="wt-post-title p-t20">
                                                            <h3 class="post-title"><a class="site-text-secondry">{{$reference->title}}</a></h3>
                                                        </div>
                                                        <div class="wt-post-meta ">
                                                            <ul>
                                                                <li class="post-date"> <i class="fa fa-map-marker"></i> Pays</li>
                                                                <li class="post-comment">{{$reference->pays}}</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    @endforeach

                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>


    </div>
    <!-- PRODUCT DETAILS -->

</div>




@endsection


@section('scripts')



@endsection

