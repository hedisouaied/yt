@extends('frontend.layouts.master')

@section('content')

    <div class="section-full  p-t120 m-t120 p-b50 bg-white  bg-bottom-right bg-no-repeat" style="background-image:url({{asset('frontendddd/images/background/bg-5.png')}})">
        <div class="container">

            <div class="section-head center wt-small-separator-outer">
                <div class="wt-small-separator site-text-primary">
                    <div class="sep-leaf-left"></div>
                    <div>Moyens Industriels</div>
                    <div class="sep-leaf-right"></div>
                </div>
            </div>

            <div class="row d-flex justify-content-center">

                @foreach ($moyens as $moyen )
                    <div class="col-lg-4 col-md-6 animate_line">
                        <div class="service-border-box3 shadow text-center" style="height: 100%;box-shadow: 5px 3px 24px #7c7c7c !important;" >
                            <div class="wt-icon-box-wraper bg-white p-tb50 p-lr20" style="height: 100%;" >
                                <div class="icon-lg inline-icon	 m-b50">
                                    <img src="{{$moyen->photo}}" alt="" style="height: unset;width: 100%;" >
                                </div>
                                <div class="icon-content">
                                 <h3 class="wt-tilte m-b20"><a href="{{route('moyen.detail',$moyen->slug)}}" >{{$moyen->title}}</a></h3>
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

