@extends('frontend.layouts.master')

@section('content')

@php $total=0; @endphp

@foreach ($cart_data as $data)
@php
    $items_list = \App\Models\Product::find($data['item_id']);
@endphp
    @if ($items_list)

        @php

         $total= $total +((($items_list->price-$items_list->discount)*$data['item_quantity']));
        @endphp

    @endif
@endforeach



<div class="breadcrumb-area breadcrumb-area-padding-2 bg-gray-2">
    <div class="custom-container">
        <div class="breadcrumb-content text-center">
            <ul>
                <li>
                    <a href="{{route('home')}}">Accueil</a>
                </li>
                <li class="active">Passer commande</li>
            </ul>
        </div>
    </div>
</div>

<div class="checkout-area pt-75 pb-75">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">

            @auth

            @else

            <div class="customer-zone padding-20-row-col mb-10">
                            <p class="cart-page-title">Déjà client? <a class="checkout-click1" href="#">Cliquez ici pour vous identifier</a></p>
                            <div class="checkout-login-info">
                                <form action="{{route('seller.login')}}" method="POST" >
                                    @csrf

                                    @if (session()->has('errorpass'))
                                    <span class="text-danger mb-3">{{session()->get('errorpass')}}</span>
                                    @endif


                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="sin-checkout-login input-style mrg-small-device">
                                                <label>Email *</label>
                                                <input type="text" name="email">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="sin-checkout-login input-style">
                                                <label>mot de passe *</label>
                                                <input type="password"name="password" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="button-remember-wrap">

                                        <button class="button" type="submit">Login</button>
                                    </div>

                                </form>
                            </div>
                        </div>
            <br>

            @endauth

                <div class="billing-info-wrap padding-20-row-col contact-from-area">


                    @auth

                    <form action="{{route('checkout')}}" method="POST" class="contact-form-style" >
                        @csrf


                            <input type="hidden" name="authi" value="yes" >

                            <div class="row">

                                    <div class="col-lg-6 col-md-6">
                                        <div class="billing-info input-style mb-35">
                                            <label>Nom & prénom : {{$user->full_name}}</label>
                                        </div>
                                    </div>


                                    <div class="col-lg-12 col-md-12">
                                        <div class="billing-info input-style mb-35">
                                            <label>Phone : {{$user->phone}}</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="billing-info input-style mb-35">
                                            <label>Email : {{$user->email}}</label>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="select-style billing-select mb-35">
                                            <label>Gouvernorat : {{$user->gouvernorat}}</label>

                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="billing-info input-style mb-35">
                                            <label>Ville : {{$user->address}}</label>
                                        </div>
                                    </div>
                                    <div class="grand-total-btn">
                                        @if (!empty($array_cookie_coupon))
                                            <input type="hidden" value="{{$array_cookie_coupon->discount}}" name="coupon_discount" >
                                        @endif

                                        @if ($total <= 99 )
                                            <input type="hidden" value="{{get_setting('prix_livraison')}}" name="prix_livraison" >

                                        @else
                                            <input type="hidden" value="0" name="prix_livraison" >
                                        @endif

                                        <button type="submit" >Confirmer commande</button>
                                    </div>


                            </div>

                    </form>


                        @else


                        <form action="{{route('checkout')}}" method="POST" class="contact-form-style" >
                            @csrf

                            <input type="hidden" name="authi" value="no" >


                                <div class="row">

                                        <div class="col-lg-6 col-md-6">
                                            <div class="billing-info input-style mb-35">
                                                <label>Nom *</label>
                                                <input type="text" required name="nom" >
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="billing-info input-style mb-35">
                                                <label>Prénom *</label>
                                                <input type="text" required name="prenom" >
                                            </div>
                                        </div>

                                        <div class="col-lg-12 col-md-12">
                                            <div class="billing-info input-style mb-35">
                                                <label>Email *</label>
                                                <input type="email" required name="email" >
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12">
                                            <div class="billing-info input-style mb-35">
                                                <label>Phone *</label>
                                                <input type="number" required name="phone" >
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="select-style billing-select mb-35">
                                                <label>Gouvernorat *</label>
                                                <select class="select-active" required name="gouvernorat" >
                                                    <option value="">Séléctionnez votre gouvernorat</option>
                                                    <option value="Ariana">Ariana</option>
                                                    <option value="Beja">Beja</option>
                                                    <option value="Ben Arous">Ben Arous</option>
                                                    <option value="Bizerte">Bizerte</option>
                                                    <option value="Jendouba">Jendouba</option>
                                                    <option value="Gabes">Gabes</option>
                                                    <option value="Gafsa">Gafsa</option>
                                                    <option value="Kairouan">Kairouan</option>
                                                    <option value="Kasserine">Kasserine</option>
                                                    <option value="Kébili">Kébili</option>
                                                    <option value="Kef">Kef</option>
                                                    <option value="Mahdia">Mahdia</option>
                                                    <option value="Manouba">Manouba</option>
                                                    <option value="Medenine">Medenine</option>
                                                    <option value="Monastir">Monastir</option>
                                                    <option value="Nabeul">Nabeul</option>
                                                    <option value="Sfax">Sfax</option>
                                                    <option value="Sidi Bouzid">Sidi Bouzid</option>
                                                    <option value="Siliana">Siliana</option>
                                                    <option value="Sousse">Sousse</option>
                                                    <option value="Tataouine">Tataouine</option>
                                                    <option value="Tozeur">Tozeur</option>
                                                    <option value="Tunis">Tunis</option>
                                                    <option value="Zaghouan">Zaghouan</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="billing-info input-style mb-35">
                                                <label>Ville *</label>
                                                <input class="billing-address" required type="text" name="address" >
                                            </div>
                                        </div>
                                        <div class="grand-total-btn">

                                            @if (!empty($array_cookie_coupon))
                                            <input type="hidden" value="{{$array_cookie_coupon->discount}}" name="coupon_discount" >
                                            @endif

                                            @if ($total <= 99 )
                                                <input type="hidden" value="{{get_setting('prix_livraison')}}" name="prix_livraison" >

                                            @else
                                                <input type="hidden" value="0" name="prix_livraison" >
                                            @endif



                                            <button type="submit" >Confirmer commande</button>
                                        </div>



                                </div>

                        </form>
                    @endauth





                </div>
                <div class="payment-details-area">
                    <h4>Information paiement</h4>
                    <div class="payment-method">

                        <div class="sin-payment mb-20">
                            <input id="payment-method-3" class="input-radio" type="radio" value="cheque" name="payment_method">
                            <label for="payment-method-3">
                                <span>
                                <img class="nomal-img" src="{{asset('frontend/assets/images/icon-img/cash-on-delivery.png')}}" alt="">
                                <img class="active-img" src="{{asset('frontend/assets/images/icon-img/cash-on-delivery-active.png')}}" alt="">
                            </span>
                                Cash on delivery
                            </label>
                            <div class="payment-box payment_method_bacs">
                                <p>Payez en espèces à la livraison.</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="order-summary">
                    <div class="order-summary-title">
                        <h3>Commande</h3>
                    </div>
                    <div class="order-summary-top">
                        @php $total=0; @endphp

                        @foreach ($cart_data as $data)
                        @php
                            $items_list = \App\Models\Product::find($data['item_id']);
                        @endphp
                            @if ($items_list)

                                @php
                                    $photos = explode(',',$items_list->photo);
                                @endphp
                                <div class="order-summary-img-price">
                                    <div class="order-summary-img-title">
                                        <div class="order-summary-img">
                                            <a href="{{route('product.detail',$items_list->slug)}}"><img src="{{$photos[0]}}" alt=""></a>
                                        </div>
                                        <div class="order-summary-title">
                                            <h4>{{$items_list->title}} <span>× {{$data['item_quantity']}}</span></h4>
                                        </div>
                                    </div>
                                    <div class="order-summary-price">
                                        <span>{{number_format((($items_list->price-$items_list->discount)*$data['item_quantity']),3)}} TND</span>
                                    </div>
                                </div>
                                @php
                                 $total= $total +((($items_list->price-$items_list->discount)*$data['item_quantity']));
                                @endphp

                            @endif
                        @endforeach

                    </div>
                    <div class="order-summary-middle">


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

                    </div>
                    <div class="order-summary-bottom">

                        <h4>Total <span>{{number_format($total,3)}} TND</span></h4>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


@endsection
@section('scripts')

@endsection
