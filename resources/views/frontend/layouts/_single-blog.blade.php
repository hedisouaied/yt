@foreach ($blogs as $item)
<div class="col-lg-4 news-block">
    <div class="inner-box">
        <div class="image">
            <img src="{{$item->photo}}" style="height: 270px;object-fit: cover;" alt="">
            <div class="overlay-two" style="background: rgb(27 27 27 / 0.9);">
                <a href="{{route('blog.detail',$item->slug)}}"><span class="fa fa-chevron-right"></span></a>
            </div>
        </div>
        <div class="lower-content">
            <div class="category">[<i class="fas fa-folder"></i>
            @if ($item->type_blog == "event")
                Evenements
            @else
                News
            @endif
             ]</div>
            <h3><a href="{{route('blog.detail',$item->slug)}}">{{$item->title}}</a></h3>
            <ul class="post-meta">
                <li><a><i class="far fa-clock"></i>
                @php
                    $date = date('Y-m-d',strtotime($item->updated_at));
                    setlocale (LC_TIME, 'fr_FR.utf8','fra');
                    echo (strftime("%A %d %B %Y",strtotime($date)));
                @endphp
                </a></li>
            </ul>

        </div>
    </div>
</div>
@endforeach
