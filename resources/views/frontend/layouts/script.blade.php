

 <script src="{{asset('frontend/assets/js/vendor/modernizr-3.6.0.min.js')}}"></script>
 <script src="{{asset('frontend/assets/js/vendor/jquery-3.5.1.min.js')}}"></script>
 <script src="{{asset('frontend/assets/js/vendor/jquery-migrate-3.3.0.min.js')}}"></script>
 <script src="{{asset('frontend/assets/js/vendor/bootstrap.bundle.min.js')}}"></script>
 <script src="{{asset('frontend/assets/js/plugins/slick.js')}}"></script>
 <script src="{{asset('frontend/assets/js/plugins/jquery.syotimer.min.js')}}"></script>
 <script src="{{asset('frontend/assets/js/plugins/wow.js')}}"></script>
 <script src="{{asset('frontend/assets/js/plugins/svg-inject.min.js')}}"></script>
 <script src="{{asset('frontend/assets/js/plugins/jquery-ui.js')}}"></script>
 <script src="{{asset('frontend/assets/js/plugins/jquery-ui-touch-punch.js')}}"></script>
 <script src="{{asset('frontend/assets/js/plugins/magnific-popup.js')}}"></script>
 <script src="{{asset('frontend/assets/js/plugins/select2.min.js')}}"></script>
 <script src="{{asset('frontend/assets/js/plugins/clipboard.js')}}"></script>
 <script src="{{asset('frontend/assets/js/plugins/vivus.js')}}"></script>
 <script src="{{asset('frontend/assets/js/plugins/waypoints.js')}}"></script>
 <script src="{{asset('frontend/assets/js/plugins/counterup.js')}}"></script>
 <script src="{{asset('frontend/assets/js/plugins/mouse-parallax.js')}}"></script>
 <script src="{{asset('frontend/assets/js/plugins/images-loaded.js')}}"></script>
 <script src="{{asset('frontend/assets/js/plugins/isotope.js')}}"></script>
 <script src="{{asset('frontend/assets/js/plugins/scrollup.js')}}"></script>
 <script src="{{asset('frontend/assets/js/plugins/ajax-mail.js')}}"></script>
 <!-- Main JS -->
 <script src="{{asset('frontend/assets/js/main.js')}}"></script>

 
 <script src="https://www.hajj-omra.ch/frontend/js/materialize.min.js"></script>



 <script>

var array_id_title = {
                @foreach (\App\Models\Product::where('status','active')->limit("1200")->get() as $search_prod)
                    @php
                        $photo = explode(',',$search_prod->photo);
                    @endphp
                    "<?php echo $search_prod->title ; ?>": '<?php echo $search_prod->slug; ?>',
                @endforeach
};


    $(document).ready(function() {


            $('#select-search,#select-search-1,#select-search-2.autocomplete').autocomplete({
            data: {
                @foreach (\App\Models\Product::where('status','active')->limit("1200")->get() as $search_prod)
                    @php
                        $photo = explode(',',$search_prod->photo);
                    @endphp
                    "<?php echo $search_prod->title ; ?>": '<?php echo $photo[0]; ?>',
                @endforeach
            },
            limit: 8, // The max amount of results that can be shown at once. Default: Infinity.
            onAutocomplete: function(val) {
                // Callback function when value is autcompleted.

                //alert(array_id_title[val]);

                window.location.href = '{{asset("product-detail/")}}'+'/'+array_id_title[val];


            },
            minLength: 1, // The minimum length of the input for the autocomplete to start. Default: 1.
        });
    });
</script>




 <script>
    $(document).ready(function () {
            $('.add-to-news-btn').click(function (e) {
                e.preventDefault();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                var news_id = $(this).closest('.news_data').find('.news_id').val();
                //alert(news_id);
                $.ajax({
                    url:"{{route('addtonews.status')}}",
                    method: "POST",
                    data: {
                        _token:'{{csrf_token()}}',
                        'email': news_id,
                    },
                    success: function (response) {
                        if(response.condition == 'no'){
                            alertify.set('notifier','position','bottom-right');
                            alertify.error(response.status);
                            $('.news_id').val('');
                        }else{
                            alertify.set('notifier','position','bottom-right');
                            alertify.success(response.status);
                            $('.news_id').val('');
                        }
                    // alert(response.status);

                    }
                });
            });
        });
</script>


<script>
    $(document).ready(function () {
            $('.add-coupon-btn').click(function (e) {
                e.preventDefault();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                var news_id = $('.coupon_id').val();
                //alert(news_id);
                $.ajax({
                    url:"{{route('addcoupon.status')}}",
                    method: "POST",
                    data: {
                        _token:'{{csrf_token()}}',
                        'coupon': news_id,
                    },
                    success: function (response) {
                        if(response.condition == 'no'){
                            alertify.set('notifier','position','bottom-right');
                            alertify.error(response.status);
                            $('.coupon_id').val('');
                        }else{
                            alertify.set('notifier','position','bottom-right');
                            alertify.success(response.status);
                            $('.coupon_id').val('');

                            window.location.href = "{{route('maselection.status')}}";
                        }
                    // alert(response.status);

                    }
                });
            });
        });
</script>



<script>
    $(document).ready(function () {
            $('.add-points-btn').click(function (e) {
                e.preventDefault();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                var news_id = $('.points_id').val();
                //alert(news_id);
                $.ajax({
                    url:"{{route('addpoints.status')}}",
                    method: "POST",
                    data: {
                        _token:'{{csrf_token()}}',
                        'points': news_id,
                    },
                    success: function (response) {
                        if(response.condition == 'no'){
                            alertify.set('notifier','position','bottom-right');
                            alertify.error(response.status);
                            $('.points_id').val('');
                        }else{
                            alertify.set('notifier','position','bottom-right');
                            alertify.success(response.status);
                            $('.points_id').val('');

                            window.location.href = "{{route('maselection.status')}}";
                        }
                    // alert(response.status);

                    }
                });
            });
        });
</script>




    <script>

        $(document).ready(function () {
            $('.add-to-cart-btn').click(function (e) {

                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var product_id = $(this).closest('.product_data').find('.product_id').val();
                var quantity = $(this).closest('.product_data').find('.qty-input').val();

                //alert(quantity);

                $.ajax({
                    url:"{{route('addtocart.status')}}",
                    method: "POST",
                    data: {
                        _token:'{{csrf_token()}}',
                        'quantity': quantity,
                        'product_id': product_id,
                    },
                    success: function (response) {


                        if(response.condition == 'no'){
                            alertify.set('notifier','position','bottom-left');
                            alertify.error(response.status);
                        }else{
                            alertify.set('notifier','position','bottom-left');
                            alertify.success(response.status);
                            window.location.href = "{{route('maselection.status')}}";
                        }
                        //alert(response.status)
                       cartload();
                    }
                });
            });
        });


        $(document).ready(function () {
            cartload();
        });

        function cartload()
        {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{route('loadtocart.status')}}",
                method: "GET",
                success: function (response) {
                    $('.basket-item-count').html('');
                    var parsed = jQuery.parseJSON(response)
                    var value = parsed; //Single Data Viewing
                    $('.basket-item-count').append(value['totalcart']);
                }
            });
        }
    </script>


<!--
<script>
    function doPoll(x = {{count(\App\Models\Product::where('status','active')->get())}} ) {

        var nb_prod = x ;
        // Get the JSON
        $.ajax({
            url: '{{route("push.notification")}}',
            method: "POST",
            data: {
                _token:'{{csrf_token()}}',
                'nb_prod': nb_prod,
            },
             success: function(data){
                    if(data.notify == true) {

                        // Yeah, there is a new notification! Show it to the user
                        var notification = new Notification(data.title, {
                            icon:data.img,
                            body: data.desc,
                        });
                        notification.onclick = function () {
                            window.open(data.url);
                        };
                        nb_prod = nb_prod+1 ;
                    }
                    // Retry after a second
                    setTimeout(doPoll(x=nb_prod),1000);
                }, dataType: "json"});
    }
    if (Notification.permission !== "granted")
    {
        // Request permission to send browser notifications
        Notification.requestPermission().then(function(result) {
            if (result === 'default') {
                // Permission granted
                doPoll();
            }
        });
    } else {
        doPoll();
    }
    </script>

-->

 @yield('scripts')
