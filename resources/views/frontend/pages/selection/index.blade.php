@extends('frontend.layouts.master')

@section('content')



<div class="breadcrumb-area breadcrumb-area-padding-2 bg-gray-2">
    <div class="custom-container">
        <div class="breadcrumb-content text-center">
            <ul>
                <li>
                    <a href="{{route('home')}}">Accueil</a>
                </li>
                <li class="active">Panier</li>
            </ul>
        </div>
    </div>
</div>

<div class="my-propertiestt" >
    @if(isset($cart_data) && !empty($cart_data))

            @if(Cookie::get('shopping_cart'))
            @php $total=0; @endphp

                <div class="cart-area pt-75 pb-35 ">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <form action="#">
                                <div class="row">
                                        <div class="col-lg-4 col-md-12 col-12">

                                        </div>
                                        <div class="col-lg-8 col-md-12 col-12">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-12">

                                                </div>
                                                <div class="col-lg-6 col-md-6 col-12">
                                                    <div class="grand-total-wrap mb-40">

                                                        <div class="grand-total">
                                                            <h4>Total <span class="basket-item-prix" id="total-haut-abab" ></span></h4>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="cart-table-content">
                                        <div class="table-content table-responsive">
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th class="width-thumbnail">Produit</th>
                                                        <th class="width-name"></th>
                                                        <th class="width-price"> Prix</th>
                                                        <th class="width-quantity">Quantité</th>
                                                        <th class="width-subtotal">Total</th>
                                                        <th class="width-remove"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @foreach ($cart_data as $data)
                                                        @php
                                                            $items_list = \App\Models\Product::find($data['item_id']);
                                                        @endphp
                                                            @if ($items_list)

                                                                @php
                                                                    $photos = explode(',',$items_list->photo);
                                                                @endphp

                                                                <tr class="cartpage" >
                                                                    <input type="hidden" class="product_id" value="{{ $data['item_id'] }}" >

                                                                    <td class="product-thumbnail">
                                                                        <a href="{{route('product.detail',$items_list->slug)}}"><img src="{{$photos[0]}}" alt=""></a>
                                                                    </td>
                                                                    <td class="product-name">
                                                                        <h5><a href="{{route('product.detail',$items_list->slug)}}">{{$items_list->title}}</a></h5>
                                                                    </td>



                                                                    <td class="product-price">
                                                                        @if ($items_list->discount == 0)
                                                                        <span class="amount">{{number_format($items_list->price,3)}} TND</span>
                                                                        @else
                                                                        <del>{{number_format($items_list->price,3)}} TND</del>
                                                                        <br>
                                                                        <span class="amount">{{number_format(($items_list->price-$items_list->discount),3)}} TND</span>

                                                                        @endif

                                                                        @php
                                                                        $total= $total +(($items_list->price-$items_list->discount)*$data['item_quantity']);
                                                                        @endphp

                                                                    </td>

                                                                    <td class="cart-product-quantity" >
                                                                        <div class="input-group quantity" style="width: 70%;" >
                                                                            <div class="input-group-prepend decrement-btn changeQuantity" style="cursor: pointer">
                                                                                <span class="input-group-text">-</span>
                                                                            </div>

                                                                            <input type="text" disabled class="qty-input form-control" maxlength="2" max="10" value="{{ $data['item_quantity'] }}">

                                                                            <div class="input-group-append increment-btn changeQuantity" style="cursor: pointer">
                                                                                <span class="input-group-text">+</span>
                                                                            </div>
                                                                        </div>
                                                                    </td>


                                                                    <td class="product-total"><span>{{number_format((($items_list->price-$items_list->discount)*$data['item_quantity']),3)}} TND</span></td>
                                                                    <td class="product-remove"><a href="" class="delete_cart_data" >Supprimer</a></td>
                                                                </tr>
                                                            @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="cart-shiping-update-wrapper">
                                            <div class="continure-clear-btn">
                                                <div class="continure-btn">
                                                    <a href="{{route('products')}}">Continuez shopping</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 col-md-12 col-12">
                                            <div class="coupon-wrap mb-40">
                                                <h4>Coupon de réduction</h4>
                                                <div class="coupon-content common-form-style coupon_data" >
                                                    <p>Entrez votre code promo si vous en avez un. </p>
                                                    <div class="input-style coupon-content-mrg">
                                                        <input type="text" placeholder="Code Coupon" class="coupon_id" required >
                                                    </div>
                                                    <div class="common-btn-style">
                                                        <a class="common-btn-padding-2 add-coupon-btn">Appliquer Coupon</a>
                                                    </div>
                                                </div>
                                                <div>
                                                    @if (!empty($array_cookie_coupon))
                                                    <br>
                                                        <div>
                                                            Code coupon enregistré : <b class="text-primary">{{$array_cookie_coupon->code_coupon}}</b><br>
                                                            Réduction : <b class="text-primary">-{{$array_cookie_coupon->discount}}%</b><br>
                                                            Date d'expiration : <b class="text-danger">{{$array_cookie_coupon->expiration}}</b><br>
                                                        </div>
                                                    @else
                                                    <br>
                                                       <span class="text-danger">*Il n'y a pas de coupon enregistré !</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-8 col-md-12 col-12">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-12">

                                                </div>
                                                <div class="col-lg-6 col-md-6 col-12">
                                                    <div class="grand-total-wrap mb-40">

                                                        <ul>
                                                            <li>Subtotal <h4>{{number_format($total,3)}} TND</h4></li>

                                                            @if ($total <= 99 )
                                                                <li>Prix de livraison <h4>{{number_format(get_setting('prix_livraison'),3)}} TND</h4></li>
                                                                @php
                                                                    $total = $total+get_setting('prix_livraison');
                                                                @endphp
                                                            @else
                                                                <li>Prix de livraison <h4>0 TND</h4></li>
                                                            @endif



                                                            @if ((!empty($array_cookie_coupon)) OR (isset(Auth::user()->points_convertie) AND (Auth::user()->points_convertie > 0)) )
                                                                @auth
                                                                    @if ((Auth::user()->points_convertie) > 0)
                                                                    <li>Réduction points fidélité <h4>-{{number_format(((Auth::user()->points_convertie/100)*2),3)}} TND</h4></li>
                                                                        @php
                                                                            $total = $total-((Auth::user()->points_convertie/100)*2);
                                                                        @endphp
                                                                    @endif
                                                                @endauth
                                                                @if (!empty($array_cookie_coupon))
                                                                <li>Réduction coupon <h4>-{{number_format((($total*$array_cookie_coupon->discount)/100),3)}} TND</h4></li>
                                                                @php
                                                                    $total = $total-(($total*$array_cookie_coupon->discount)/100);
                                                                @endphp
                                                                @endif

                                                            @endif
                                                        </ul>
                                                        <div class="grand-total">
                                                            <h4>Total <span class="basket-item-prix" >{{number_format($total,3)}} TND</span></h4>
                                                        </div>
                                                        <div class="grand-total-btn">

                                                            <a href="{{route('checkout.status')}}">Passer commande</a>



                                                        </div>
                                                    </div>
                                                    <div class="alert alert-warning ">
                                                        Achetez ces produits maintenant et gagnez {{(int)($total)}} Points,100 points de fidélité peuvent être convertis en un bon de 2 TND !
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                @auth
                                <div class="row">
                                    <div class="col-lg-4 col-md-12 col-12">
                                        <div class="coupon-wrap mb-40">
                                            <h4>Convertir mes points de fidélité</h4>
                                            <div class="coupon-content common-form-style points_data" >
                                                <p>Pour chaque 100 points vous recevez 2 TND de réduction </p>
                                                <p>Vous avez <u>{{Auth::user()->points}} points de fidélité</u> !</p>
                                                <div class="input-style coupon-content-mrg">
                                                    <input type="number" placeholder="Points à convertir" class="points_id" required >
                                                </div>
                                                <div class="common-btn-style">
                                                    <a class="common-btn-padding-2 add-points-btn">Convertir</a>
                                                </div>
                                            </div>
                                            <div>
                                                @if (Auth::user()->points_convertie > 0)
                                                <br>
                                                    <div>
                                                        Vous avez <b>{{Auth::user()->points_convertie}} points convertis</b> : <b class="text-primary">Donc {{(Auth::user()->points_convertie/100)*2}} TND réduction</b><br>
                                                    </div>
                                                @else
                                                <br>
                                                   <span class="text-danger">*vous avez aucune point converti ! donc 0 réduction</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                @endauth

                            </div>
                        </div>

                    </div>
                </div>
            @endif

    @else

    <div class="error-area">
        <div class="container">
            <div class="row align-items-center pt-75 pb-55">
                <div class="col-lg-8 ml-auto mr-auto">
                    <div class="error-content text-center">
                        <h2> Oops! Panier vide.</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

</div>




@endsection

@section('scripts')




<script>

    $(document).ready(function () {

        $('.increment-btn').click(function (e) {
            e.preventDefault();
            var incre_value = $(this).parents('.quantity').find('.qty-input').val();
            var value = incre_value;
            value = isNaN(value) ? 0 : value;

                value++;
                $(this).parents('.quantity').find('.qty-input').val(value);

        });

        $('.decrement-btn').click(function (e) {
            e.preventDefault();
            var decre_value = $(this).parents('.quantity').find('.qty-input').val();
            var value = decre_value;
            value = isNaN(value) ? 0 : value;
            if(value>1){
                value--;
                $(this).parents('.quantity').find('.qty-input').val(value);
            }
        });

    });


</script>


<script>
        // Update Cart Data
        $(document).ready(function () {

            $('.changeQuantity').click(function (e) {
                e.preventDefault();

                var input_q = $(this).closest(".cartpage").find('.qty-input');
                var quantity = input_q.val();
                var product_id = $(this).closest(".cartpage").find('.product_id').val();

                var data = {
                    '_token': $('input[name=_token]').val(),
                    'quantity':quantity,
                    'product_id':product_id,
                };


                $.ajax({
                    url: '{{route('update.cart')}}',
                    type: 'GET',
                    data: data,
                    success: function (response) {
                       // alert(quantity);


                        if(response.condition == 'no'){
                           // alert(response.old_quantityyy);
                            input_q.val(response.old_quantityyy);
                            alertify.set('notifier','position','bottom-right');
                            alertify.error(response.status);
                        }else{
                            alertify.set('notifier','position','bottom-right');
                            alertify.success(response.status);
                        }
                    }
                });
            });

        });
</script>



<script>
    // Delete Cart Data
    $(document).ready(function () {

        $('.delete_cart_data').click(function (e) {
            e.preventDefault();

            var product_id = $(this).closest(".cartpage").find('.product_id').val();
            var data = {
                '_token': $('input[name=_token]').val(),
                "product_id": product_id,
            };

         $(this).closest(".cartpage").remove();

            $.ajax({
                url: "{{route('deleteselection.status')}}",
                type: 'GET',
                data: data,
                success: function (response) {
                    $('.basket-item-count').html(response.count);
                    $('.basket-item-prix').html(response.total+" TND");
                   if(response.count == 0){

                       $('.my-propertiestt').html('<div class="error-area"><div class="container"><div class="row align-items-center pt-75 pb-55"><div class="col-lg-8 ml-auto mr-auto"><div class="error-content text-center"><h2> Oops! Panier vide.</h2></div></div></div></div></div>');
                   }
                    // window.location.reload();
                }
            });
        });

    });
</script>


<script>

    @if (isset($total))

        $('#total-haut-abab').html('{{number_format($total,3)}} TND');

    @endif

</script>

@endsection
