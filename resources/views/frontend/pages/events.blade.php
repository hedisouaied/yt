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
<section class="shop-details" style="padding: 120px 0px 0px 0px;">
    <div class="auto-container">
        <div class="product-details-content">
            <div class="row clearfix">

                <div class="col-lg-12 content-column">

                    <div class="product-details">
                        <div class="title-box">
                            <h3>Evenements</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<!-- News Section -->
<section class="news-section default-style" style="padding: 0px 0 90px;">
    <div class="auto-container">
        <div class="row" id="product-data">
            @include('frontend.layouts._single-blog')

            <div class="ajax-load text-center" style="display: none">
                <img src="{{asset('frontend/images/loading.gif')}}" style="width: 30%;" >
            </div>
            @if (count($blogs)==0)
         <p>Il n'y a pas d'évenements</p>
        @endif
        </div>

    </div>
</section>


@endsection
@section('scripts')
<script>
    function loadmoreData(page) {
        $.ajax({
            url: '?page='+page,
            type: 'GET',
            beforeSend: function () {
                $('.ajax-load').show();
            },
        }).done(function(data){

            if(data.html == ''){
                $('.ajax-load').html('');
                return;
            }
            $('.ajax-load').hide();
            $('#product-data').append(data.html);
        }).fail(function(jqXHR, ajaxOptions, thrownError) {
            console.log('Somethong went wrong!! please try again');
        });
    }
    var page=1;
    $(window).scroll(function () {
        if($(window).scrollTop() +$(window).height()+420>=$(document).height()){
            page ++;
            loadmoreData(page);
        }
    });


</script>
@endsection
