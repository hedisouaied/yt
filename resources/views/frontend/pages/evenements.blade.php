@extends('frontend.layouts.master')

@section('content')
<div class="section-full p-t120 m-t120 p-b70 bg-gray what-we-do-section">

    <div class="container">

        <div class="section-head center wt-small-separator-outer">
            <div class="wt-small-separator site-text-primary">
                <div class="sep-leaf-left"></div>
                <div>Événements</div>
                <div class="sep-leaf-right"></div>
            </div>
        </div>

        <div class="section-head left wt-small-separator-outer">
            <div class="wt-small-separator site-text-primary">
                <div class="sep-leaf-left"></div>
                <div class="sep-leaf-right"></div>
            </div>
            <h2>Participation dans les foires et les salons nationaux et internationaux</h2>
        </div>

        <div class="section-content what-we-do-content">
            <div class="row">



                @foreach ($evenements as $event )


                <div class="col-lg-6 col-md-12 p-b40">
                    <div class="whatWedo-media-section" style="height: 100%;box-shadow: 5px 18px 24px #7c7c7c;" >
                        <div class="wt-media" style="height: 100%;" >
                            <img src="{{$event->photo}}" alt="" style="height: 100%;object-fit: cover;" >
                        </div>
                        <div class="whatWedo-media-content text-white">
                            <div class="whatWedo-media-inner">
                                <h3>{{$event->title}}</h3>
                                <p><i class="fa fa-map-marker" ></i> Pays : {{$event->pays}}</p>
                                <p><i class="fa fa-calendar" ></i> Date début : {{date('d M , Y',strtotime($event->date_debut))}}</p>
                                <p><i class="fa fa-calendar" ></i> Date fin : {{date('d M , Y',strtotime($event->date_fin))}}</p>
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

