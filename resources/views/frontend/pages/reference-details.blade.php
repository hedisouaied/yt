@extends('frontend.layouts.master')


@section('content')

<!--Project Single Section-->
<section class="project-single-section">
    <div class="auto-container">
        <div class="upper-box">
            <div class="row clearfix">

                <!--Image Column-->
                <div class="image-column col-lg-8 col-md-12 col-sm-12">
                    <div class="image">
                        <img src="{{$blog->photo}}" alt="" style="height: 400px;object-fit: cover;" />
                    </div>
                </div>
                <!--List Column-->
                <div class="list-column col-lg-4 col-md-12 col-sm-12">
                    <div class="inner-column">
                        <ul class="project-list">
                            <li><span class="icon fa fa-universal-access"></span><strong>Client :</strong>    {{$blog->client}}</li>
                            <li><span class="icon fa fa-map-marker"></span><strong>Pays :</strong>    {{$blog->pays}}</li>

                            <li><span class="icon fa fa-globe"></span><strong>Domaine d'activité :</strong>    <a href="{{route('domaine.detail',$domaine->slug)}}" >{{$domaine->title}}</a></li>

                            <li class="social-icons">
                                <span class="follow">Partager Sur :</span>
                                <br><br>

                                <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
                                    <a class="a2a_button_facebook"></a>
                                    <a class="a2a_button_linkedin"></a>
                                    <a class="a2a_button_twitter"></a>
                                </div>
                                <script async src="https://static.addtoany.com/menu/page.js"></script>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>

        <div class="lower-box">
            <h2>{{$blog->title}}</h2>
            <div class="text">{!!$blog->description!!}</div>

        </div>

    </div>
</section>


@endsection


@section('scripts')



@endsection

