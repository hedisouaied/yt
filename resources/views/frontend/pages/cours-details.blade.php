@extends('frontend.layouts.master')


@section('content')


        <div class="edu-breadcrumb-area breadcrumb-style-3" style="padding: 95px 0 0px;" >
            <div class="container">
                <div class="breadcrumb-inner">

                    <div class="page-title">
                        <h1 class="title">{{$blog->title}}</h1>
                    </div>
                    <ul class="course-meta">
                        <li><i class="icon-58"></i>by {{get_setting('heading')}}</li>

                    </ul>
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


        <section class="edu-section-gap course-details-area">
            <div class="container">
                <div class="row row--30">
                    <div class="col-lg-8">
                        <div class="course-details-content course-details-2">
                            <div class="course-overview">
                                <h3 class="heading-title" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">À propos de ce Cours</h3>

                                <p data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                                    {!!$blog->description!!}
                                </p>


                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="course-sidebar-3 sidebar-top-position">
                            <div class="edu-course-widget widget-course-summery">
                                <div class="inner">
                                    <div class="thumbnail">
                                        <img src="{{$blog->photo}}" alt="Cours">
                                    </div>
                                    <div class="content">
                                        <h4 class="widget-title">Le cours comprend :</h4>
                                        <ul class="course-item">
                                            <li>
                                                <span class="label"><i class="icon-60"></i>Prix:</span>
                                                <span class="value price">
                                                    @if ($blog->discount == 0)
                                                        {{number_format($blog->price,2)}} TND
                                                    @else
                                                    <del>{{number_format($blog->price,2)}} TND</del> <br>{{number_format(($blog->price-$blog->discount),2)}} TND
                                                    @endif
                                                </span>
                                            </li>
                                            <li>
                                                <span class="label"><i class="icon-27"></i>Début le:</span>
                                                <span class="value">{{date('d M, Y',strtotime($blog->date_debut))}}</span>
                                            </li>
                                            <li>
                                                <span class="label">
                                                    <img class="svgInject" src="{{asset('frontend/assets/images/svg-icons/books.svg')}}" alt="book icon">
                                                    Séances:</span>
                                                <span class="value">{{$blog->nb_seance}}</span>
                                            </li>
                                            <li>
                                                <span class="label"><i class="icon-59"></i>Langue:</span>
                                                <span class="value">{{$blog->langue}}</span>
                                            </li>
                                        </ul>

                                        <div class="read-more-btn product_data">
                                            <input type="hidden" class="product_id" value="{{$blog->id}}">

                                            <button type="button" class="edu-btn add-to-cart-btn">Ajouter au panier <i class="icon-3"></i></button>
                                        </div>

                                        <div class="share-area">
                                            <h4 class="title">Partager sur:</h4>
                                            <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
                                                <a class="a2a_button_facebook"></a>
                                                <a class="a2a_button_linkedin"></a>
                                                <a class="a2a_button_twitter"></a>
                                            </div>
                                            <script async src="https://static.addtoany.com/menu/page.js"></script>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>


@endsection


@section('scripts')



@endsection

