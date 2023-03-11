@extends('frontend.layouts.master')

@section('content')

<!-- START SECTION PROPERTIES LISTING -->
        <section class="properties-right featured portfolio ho-17 blog pt-5">
            <div class="container">
               <section class="headings-2 pt-0 pb-55">
                    <div class="pro-wrapper">
                        <div class="detail-wrapper-body">
                            <div class="listing-title-bar">

                            </div>
                        </div>
                    </div>
                </section>
                <div class="row">
                    <div class="col-lg-8 col-md-12 blog-pots">
                        <section class="headings-2 pt-0">
                            <div class="pro-wrapper">
                                <div class="detail-wrapper-body">
                                    <div class="listing-title-bar">
                                        <div class="text-heading text-left">
                                            <p class="font-weight-bold mb-0 mt-3">{{count($products)}} résultats</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="cod-pad single detail-wrapper mr-2 mt-0 d-flex justify-content-md-end align-items-center grid" >
                                    <div class="input-group border rounded input-group-lg w-auto mr-4">
                                        <label class="input-group-text bg-transparent border-0 text-uppercase letter-spacing-093 pr-1 pl-3" for="inputGroupSelect01"><i class="fas fa-align-left fs-16 pr-2"></i>trier par:</label>
                                        <select class="form-control border-0 bg-transparent shadow-none p-0 selectpicker sortby" data-style="bg-transparent border-0 font-weight-600 btn-lg pl-0 pr-3" id="sortBy" name="sortby">
                                            <option selected>Dérnier</option>
                                            <option @if (isset($_GET['sort'])&& ($_GET['sort'] == 'titleAsc'))
                                                selected
                                            @endif value="titleAsc">Alphabétique (croissant)</option>
                                            <option @if (isset($_GET['sort'])&& ($_GET['sort'] == 'titleDesc'))
                                            selected
                                        @endif value="titleDesc">Alphabétique (décroissant)</option>
                                            <option @if (isset($_GET['sort'])&& ($_GET['sort'] == 'priceAsc'))
                                            selected
                                        @endif value="priceAsc">Prix (croissant)</option>
                                            <option @if (isset($_GET['sort'])&& ($_GET['sort'] == 'priceDesc'))
                                            selected
                                        @endif value="priceDesc">Prix (décroissant)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <div class="row" id="product-data">
                            @include('frontend.layouts._single-product')

                        </div>
                        <div class="ajax-load text-center" style="display: none">
                            <img src="{{asset('frontend/images/loading.gif')}}" style="width: 30%;" >
                        </div>
                        @if (count($products)==0)


                            <p>Il n'y a pas de locaux</p>
                        @endif
                    </div>

                    <aside class="col-lg-4 col-md-12 car">
                        <div class="widget">
                            <!-- Search Fields -->
                            <div class="widget-boxed main-search-field">
                                <div class="widget-boxed-header">
                                    <h4>Filtres</h4>
                                </div>
                                <!-- Search Form -->
                                <div class="trip-search">
                                    <form class="form" method="GET">

                                        @if (isset($_GET['sort']))
                                            <input type="hidden" name="sort" value="{{$_GET['sort']}}" >
                                        @endif
                                        <!-- Form Lookin for -->
                                        <div class="form-group looking">
                                            <div class="first-select wide">
                                                <div class="main-search-input-item">
                                                    <input type="text" name="search"
                                                      @if (isset($_GET['search']))
                                                      value="{{$_GET['search']}}"
                                                    @endif

                                                    placeholder="Mots clés..." />
                                                </div>
                                            </div>
                                        </div>
                                        <!--/ End Form Lookin for -->
                                        <!-- Form city -->
                                        <input type="hidden" id="search-type-ville" name="ville" value="@if(isset($_GET['ville'])){{$_GET['ville']}}@endif">
                                        <div class="form-group categories">
                                            <div class="nice-select form-control wide" id="remove_open" tabindex="0">
                                                <span id="span_ville">
                                                    @if (isset($_GET['ville']))
                                                        @if ($_GET['ville'] !='')

                                                                        {{\App\Models\Category::where('slug', $_GET['ville'])->value('title')}}



                                                        @else
                                                        Toutes les villes
                                                        @endif
                                                    @else
                                                    Toutes les villes
                                                    @endif

                                                    </span>

                                                <ul id="selType-ville" class="list">
                                                    <li value="" class="option
                                                    @if (!isset($_GET['ville'])) selected @endif
                                                    @if (isset($_GET['ville']) && ($_GET['ville'] == "")) selected  @endif
                                                    " >Tous</li>
                                                    @foreach ($villes as $ville)
                                                    <li value="{{$ville->slug}}" data-title="{{$ville->title}}" id="@php if (isset($_GET['ville']) && ($_GET['ville'] == $ville->slug)) { echo "foo"; }@endphp" class="option
                                                    @if (isset($_GET['ville']) && ($_GET['ville'] == $ville->slug)) selected  @endif
                                                    " >{{$ville->title}}</li>
                                                    @endforeach

                                                </ul>
                                            </div>
                                        </div>

                                        <div id="child_cat_div" class="form-group margin-bottom-20 d-none">


                                        </div>
                                        <!--/ End Form city -->
                                        <!-- Form Categories -->
                                        <input type="hidden" id="search-type1" name="search_conditions" value="@if(isset($_GET['search_conditions'])){{$_GET['search_conditions']}}@endif">
                                        <div class="form-group categories">
                                            <div class="nice-select form-control wide" tabindex="0">
                                                <span id="span_fond">Conditions (
                                                    @if (isset($_GET['search_conditions']))
                                                        @if ($_GET['search_conditions']=='fdc')
                                                        Fond de commerce
                                                         @elseif ($_GET['search_conditions']=='dab')
                                                         Droit au bail
                                                         @elseif ($_GET['search_conditions']=='mc')
                                                         Murs commerciaux
                                                         @elseif ($_GET['search_conditions']=='lp')
                                                         Location pure
                                                        @else
                                                            Tous
                                                        @endif
                                                    @else
                                                    Tous
                                                    @endif

                                                    )</span>

                                                <ul id="selType1" class="list">
                                                    <li value="" class="option
                                                    @if (!isset($_GET['search_conditions'])) selected @endif
                                                    @if (isset($_GET['search_conditions']) && ($_GET['search_conditions'] == "")) selected  @endif
                                                    " >Tous</li>
                                                    <li value="fdc" class="option
                                                    @if (isset($_GET['search_conditions']) && ($_GET['search_conditions'] == "fdc")) selected  @endif
                                                    " >Fond de commerce</li>
                                                    <li value="dab" class="option
                                                    @if (isset($_GET['search_conditions']) && ($_GET['search_conditions'] == "dab")) selected  @endif
                                                    ">Droit au bail</li>
                                                    <li value="mc" class="option
                                                    @if (isset($_GET['search_conditions']) && ($_GET['search_conditions'] == "mc")) selected  @endif
                                                    ">Mure commerciaux</li>
                                                    <li value="lp" class="option
                                                    @if (isset($_GET['search_conditions']) && ($_GET['search_conditions'] == "lp")) selected  @endif
                                                    ">Location pure</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <!--/ End Form Categories -->

                                        <div class="widget price mb-30" style="margin-bottom: 28px;padding-top: 162px;">
                                            <label>Surface</label>
                                            <br>
                                            @if (isset($_GET['surface_range']))
                                            @php
                                                $get_surf = explode('-',$_GET['surface_range']);
                                                $min_surface_get = $get_surf[0];
                                                $max_surface_get = $get_surf[1];
                                            @endphp


                                            @endif
                                            <div class="widget-desc">
                                                <div class="slider-range">
                                                    <div id="slider-range" data-min="{{\App\Models\Product::min('surface')}}" data-max="{{\App\Models\Product::max('surface')}}" data-unit="m²" class="slider-range-surface ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all"
                                                    data-value-min="@if (isset($min_surface_get)){{$min_surface_get}}@else{{\App\Models\Product::min('surface')}}@endif"

                                                    data-value-max="@if (isset($max_surface_get)){{$max_surface_get}}@else{{\App\Models\Product::max('surface')}}@endif" data-label-result="Surface:">
                                                        <div class="ui-slider-range ui-widget-header ui-corner-all"></div>
                                                        <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                                                        <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                                                    </div>
                                                    <br>
                                                    <div class="range-price">Surface: m² @if (isset($min_surface_get)){{$min_surface_get}}@else{{\App\Models\Product::min('surface')}}@endif - m² @if (isset($max_surface_get)){{$max_surface_get}}@else{{\App\Models\Product::max('surface')}}@endif</div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="widget price mb-30" style="margin-bottom: 28px;">
                                            <label>Prix</label>
                                            <br>
                                            @if (isset($_GET['price_range']))
                                            @php
                                                $get_pr = explode('-',$_GET['price_range']);
                                                $min_price_get = $get_pr[0];
                                                $max_price_get = $get_pr[1];
                                            @endphp


                                            @endif
                                            <div class="widget-desc">
                                                <div class="slider-range">
                                                    <div id="slider-range" data-min="{{\App\Models\Product::min('price')}}" data-max="{{\App\Models\Product::max('price')}}" data-unit="€" class="slider-range-price ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" data-value-min="@if (isset($min_price_get)){{$min_price_get}}@else{{\App\Models\Product::min('price')}}@endif" data-value-max="@if (isset($max_price_get)){{$max_price_get}}@else{{\App\Models\Product::max('price')}}@endif" data-label-result="Prix:">
                                                        <div class="ui-slider-range ui-widget-header ui-corner-all"></div>
                                                        <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                                                        <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                                                    </div>
                                                    <br>
                                                    <div class="range-price">Prix: € @if (isset($min_price_get)){{$min_price_get}}@else{{\App\Models\Product::min('price')}}@endif - € @if (isset($max_price_get)){{$max_price_get}}@else{{\App\Models\Product::max('price')}}@endif</div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- More Search Options -->
                                <a href="#" style="color: #f55d2c;" class="more-search-options-trigger margin-bottom-10 margin-top-30" data-open-title="Spécialité commerciale" data-close-title="Spécialité commerciale"></a>

                                <div class="more-search-options relative">
                                    <!-- Checkboxes -->
                                    <div class="checkboxes one-in-row margin-bottom-10">
                                        @foreach ($speciality as $sp)
                                        <input id="check-{{$sp->id}}" value="{{$sp->id}}" checked type="checkbox" name="speciality[]">
                                        <label for="check-{{$sp->id}}">{{$sp->title}}</label>
                                        @endforeach


                                    </div>
                                    <!-- Checkboxes / End -->
                                </div>
                                <!-- More Search Options / End -->
                                        <div class="col-lg-12 no-pds">
                                            <div class="at-col-default-mar">
                                                <input type="hidden" id="price_range" name="price_range" value="@if (isset($_GET['price_range'])){{$_GET['price_range']}}@else{{\App\Models\Product::min('price')}}-{{\App\Models\Product::max('price')}}@endif">
                                                <input type="hidden" id="surface_range" name="surface_range" value="@if (isset($_GET['surface_range'])){{$_GET['surface_range']}}@else{{\App\Models\Product::min('surface')}}-{{\App\Models\Product::max('surface')}}@endif">

                                                <button class="btn btn-default hvr-bounce-to-right" type="submit">Filtrer</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>


                                <!-- Price Fields -->



                            </div>


                        </div>
                    </aside>
                </div>
            </div>
        </section>
        <!-- END SECTION PROPERTIES LISTING -->

@endsection
@section('upscripts')
<script src="{{asset('frontend/js/search.js')}}"></script>
<script src="{{asset('frontend/js/slick4.js')}}"></script>


@endsection
@section('scripts')

<script>
    $('#sortBy').change(function(){
        var sort=$('#sortBy').val();

        var get_fiter ='@if (isset($_GET['search']))&search=@php echo $_GET['search']@endphp@endif';
        get_fiter +='@if (isset($_GET['search_conditions']))&search_conditions=@php echo $_GET['search_conditions']@endphp@endif';
        get_fiter +='@if (isset($_GET['search_type']))&search_type=@php echo $_GET['search_type']@endphp@endif';
        get_fiter +='@if (isset($_GET['price_range']))&price_range=@php echo $_GET['price_range']@endphp@endif';
        get_fiter +='@if (isset($_GET['surface_range']))&surface_range=@php echo $_GET['surface_range']@endphp@endif';

        get_fiter +="@php if (isset($_GET['speciality'])){ foreach($_GET['speciality'] as $sps){ echo '&speciality[]='.$sps; } }@endphp";



        window.location="{{url(''.$route.'')}}?sort="+sort+get_fiter;
    });
    </script>
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

    // :: Price Range Code

    $('.slider-range-price').each(function () {
        var min = $(this).data('min'),
            max = $(this).data('max'),
            unit = $(this).data('unit'),
            value_min = $(this).data('value-min'),
            value_max = $(this).data('value-max'),
            label_result = $(this).data('label-result'),
            t = $(this);
        $(this).slider({
            range: true,
            min: min,
            max: max,
            values: [value_min, value_max],
            slide: function (event, ui) {
                var result = label_result + " " + unit + ui.values[0] + ' - ' + unit + ui.values[1];
                t.closest('.slider-range').find('.range-price').html(result);
               // $('#amount').val(ui.values[0]+"-"+ui.values[1]);
                $('#price_range').val(ui.values[0]+"-"+ui.values[1]);
            }
        });
    });
    $('.slider-range-surface').each(function () {
        var min = $(this).data('min'),
            max = $(this).data('max'),
            unit = $(this).data('unit'),
            value_min = $(this).data('value-min'),
            value_max = $(this).data('value-max'),
            label_result = $(this).data('label-result'),
            t = $(this);
        $(this).slider({
            range: true,
            min: min,
            max: max,
            values: [value_min, value_max],
            slide: function (event, ui) {
                var result = label_result + " " + unit + ui.values[0] + ' - ' + unit + ui.values[1];
                t.closest('.slider-range').find('.range-price').html(result);
               // $('#amount').val(ui.values[0]+"-"+ui.values[1]);
                $('#surface_range').val(ui.values[0]+"-"+ui.values[1]);
            }
        });
    });


</script>
<script>

    //Assign the value
    $("#selType1 li").click(function(){
$("#search-type1").val($(this).attr("value"));

if($(this).attr("value") == 'fdc'){
    $("#span_fond").html("Conditions (Fond de commerce)");

}
if($(this).attr("value") == 'dab'){
    $("#span_fond").html("Conditions (Droit au bail)");

}
if($(this).attr("value") == 'mc'){
    $("#span_fond").html("Conditions (Murs commerciaux)");

}
if($(this).attr("value") == 'lp'){
    $("#span_fond").html("Conditions (Location pure)");

}
if($(this).attr("value") == ''){
    $("#span_fond").html("Conditions (Tous)");

}

});

    //Assign the value
$("#selType-ville li").on("click",function(){
$("#search-type-ville").val($(this).attr("value"));

if($(this).attr("value") !== ''){
    $("#span_ville").html($(this).attr("data-title"));

    var cat_id=$(this).attr("value");
    @if (isset($_GET['debarquement']))
                    var debarquement_get = '{{$_GET['debarquement']}}';
                @endif

        if(cat_id != ''){
            //alert(cat_id);
            $.ajax({
                url:"/locaux/"+cat_id+"/child",
                type:"POST",
                data:{
                    _token:"{{csrf_token()}}",
                    cat_id:cat_id
                },
                success:function(response){
                    var html_option = "  <select style='background: none;border-radius: 5px;margin-top: 100px;' id='child_cat_id' class='form-control' name='debarquement'><option value=''>Tous Débarquements</option>";
                    if(response.status){
                //alert(cat_id);

                    $('#child_cat_div').removeClass('d-none');
                    $.each(response.data,function(slug,title){
                        html_option += "<option value='"+slug+"' "+@if (isset($_GET['debarquement'])) (debarquement_get==slug ? 'selected' : '') @else "" @endif+">"+title+"</option>";
                    });
                    html_option += '</select>';
                    }else{
                        $('#child_cat_div').addClass('d-none');

                    }
                    $('#child_cat_div').html(html_option);

                }
            });
        }

}

if($(this).attr("value") == ''){
    $("#span_ville").html("Toutes les villes");
    $('#child_cat_div').addClass('d-none');
    $('#child_cat_div').empty();

}

});
$( "#foo" ).trigger( "click" );
$("#remove_open").removeClass('open');
</script>


@endsection
