@extends('frontend.layouts.master')

@section('content')

<style>
    @media only screen and (max-width: 600px) {
  .hedi-menu {
    height: 180px !important;
  }
}
</style>
<!-- Page Title -->
<section class="page-title hedi-menu" style="background:black;height: 128px;">
    <div class="auto-container">
        <div class="content-box" style="padding: 63px 0px;">
            <div class="content-wrapper">

            </div>
        </div>
    </div>
</section>

<!-- Service details -->
<div class="service-details-page">
    <div class="auto-container">
        <div class="row">
            <div class="col-lg-8">
                <div class="service-details">
                    <div class="image"><img src="{{$blog->photo}}" alt=""></div>
                    <div class="text-block">
                        <h2>{{$blog->title}}</h2>
                        <div class="text">
                            <p>{!!$blog->description!!}</p>
                        </div>
                    </div>


                </div>
            </div>
            <div class="col-lg-4">

                    @if ($blog->doc != null)
                    <div class="link-btn mb-3">
                        <a href="{{$blog->doc}}" style="border: solid #ee3032 1px;" class="theme-btn style-seven btn-block " download><i class="flaticon-download-1"></i><span> Télécharger Catalogue</span></a>
                    </div>
                    @endif


                <aside class="service-sidebar">
                    <div class="widget category-widget">
                        <ul>
                            @foreach ($related_blogs as $all )
                            <li
                            @if ($all->id == $blog->id)
                            class="active"
                            @endif

                            >
                            <a href="{{route('service.detail',$all->slug)}}">
                                {{$all->title}}
                            </a>
                            </li>
                            @endforeach

                        </ul>
                    </div>


                </aside>
            </div>
        </div>
    </div>
</div>


@endsection
