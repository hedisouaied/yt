@extends('frontend.layouts.master')

@section('content')


<div class="breadcrumb-area breadcrumb-area-padding-2 bg-gray-2">
    <div class="custom-container">
        <div class="breadcrumb-content text-center">
            <ul>
                <li>
                    <a href="{{route('home')}}">Accueil</a>
                </li>
                <li class="active">Nos articles</li>
            </ul>
        </div>
    </div>
</div>
<div class="blog-area pt-75 pb-75">
    <div class="container">
        <div class="row grid">
            @foreach ($blogs as $blog )
            <div class="col-lg-4 col-md-6 col-12 col-sm-6 grid-item wow tmFadeInUp">
                <div class="blog-wrap-2 mb-30">
                    <div class="blog-img-2">
                        <a href="{{route('blog.detail',$blog->slug)}}"><img src="{{$blog->photo}}" alt="" style="height: 270px;object-fit: cover;"></a>
                    </div>
                    <div class="blog-content-2">
                        <div class="blog-meta-2">
                            <ul>
                                <li><i class="far fa-calendar"></i> {{date('M d, Y',strtotime($blog->updated_at))}}</li>
                            </ul>
                        </div>
                        <h3><a href="{{route('blog.detail',$blog->slug)}}">{{$blog->title}}</a></h3>
                        <div class="blog-btn">
                            <a href="{{route('blog.detail',$blog->slug)}}">Lire plus <i class="far fa-long-arrow-right"></i></a>
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
