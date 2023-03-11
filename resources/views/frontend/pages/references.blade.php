@extends('frontend.layouts.master')


@section('content')


  <div class="section-full  p-t120 p-b80 m-t120 bg-white ">
    <div class="container">
        <div class="section-head center wt-small-separator-outer text-center">
            <div class="wt-small-separator site-text-primary">
                <div class="sep-leaf-left"></div>
                <div>Nos réferences</div>
                <div class="sep-leaf-right"></div>
            </div>
        </div>

        <div class="section-content">
            <div class="row d-flex justify-content-center">


                @foreach ($references as $reference )
                <div class="col-lg-4 col-md-6 col-sm-12" style="margin-bottom: 25px;">
                    <div class="blog-post date-style-2" style="height: 100%;box-shadow: 5px 18px 24px #7c7c7c;padding: 13px;">
                        <div class="wt-post-media wt-img-effect zoom-slow">
                            <a href="javascript:;"><img src="{{$reference->photo}}" style="height:300px;object-fit:cover;"  alt=""></a>
                        </div>
                        <div class="wt-post-info bg-white p-t30">
                            <div class="wt-post-meta ">
                                <ul>
                                    <li class="post-category"><span>{{\App\Models\Domaineactivite::where('id', $reference->domaine_id)->value('title')}}</span> </li>
                                    <li class="post-date"> <i class="fa fa-map-marker"></i> Pays</li>
                                    <li class="post-comment">{{$reference->pays}}</li>
                                </ul>
                            </div>
                            <div class="wt-post-title ">
                                <h3 class="post-title"><a class="site-text-secondry">{{$reference->title}}</a></h3>
                            </div>
                            <div class="wt-post-readmore ">

                            </div>
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



@endsection

