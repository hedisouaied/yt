@extends('frontend.layouts.master')

@section('content')




<div class="my-propertiestt" >

                 @php
                $total=0;

                @endphp

                <div class="cart-area pt-75 pb-35 ">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <form action="#">
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
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @php
                                                    $array_prod = explode('/',$checkout->prod_ids);
                                                    $array_quantite = explode('/',$checkout->quantite);
                                                    $array_prix = explode('/',$checkout->prix);
                                                    $total = 0 ;
                                                    @endphp

                                                    @for ($i = 0; $i < count($array_prod); $i++)
                                                        @php
                                                            $items_list = \App\Models\Product::find($array_prod[$i]);
                                                        @endphp
                                                            @if ($items_list)

                                                                @php
                                                                    $photos = explode(',',$items_list->photo);
                                                                @endphp

                                                                <tr class="cartpage" >


                                                                    <td class="product-thumbnail">
                                                                        <a href="{{route('product.detail',$items_list->slug)}}"><img src="{{$photos[0]}}" alt=""></a>
                                                                    </td>
                                                                    <td class="product-name">
                                                                        <h5><a href="{{route('product.detail',$items_list->slug)}}">{{$items_list->title}}</a></h5>
                                                                    </td>



                                                                    <td class="product-price">
                                                                        <span class="amount">{{number_format($array_prix[$i],3)}} TND</span>


                                                                        @php
                                                                        $total= $total +($array_prix[$i]*$array_quantite[$i]);
                                                                        @endphp

                                                                    </td>
                                                                    <td class="cart-quality">
                                                                        <div class="">
                                                                            <p class="text-center" >{{$array_quantite[$i]}}</p>
                                                                        </div>
                                                                    </td>
                                                                    <td class="product-total"><span>{{number_format(($array_prix[$i]*$array_quantite[$i]),3)}} TND</span></td>
                                                                </tr>
                                                            @endif
                                                    @endfor
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 col-md-12 col-12">

                                        </div>
                                        <div class="col-lg-8 col-md-12 col-12">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-12">

                                                </div>
                                                <div class="col-lg-6 col-md-6 col-12">
                                                    <div class="grand-total-wrap mb-40">
                                                        @if (($checkout->coupon_discount !== NULL) OR ($checkout->reduction_points > 0))
                                                        <ul>
                                                            <li>Subtotal <h4>{{number_format($total,3)}} TND</h4></li>
                                                            @if ($checkout->reduction_points > 0)
                                                            <li>Réduction points fidélité <h4>-{{$checkout->reduction_points}} TND</h4></li>
                                                            @php
                                                                $total = $total-($checkout->reduction_points);
                                                            @endphp
                                                            @endif
                                                            @if ($checkout->coupon_discount !== NULL)
                                                            <li>Réduction coupon <h4>-{{number_format((($total*$checkout->coupon_discount)/100),3)}} TND</h4></li>
                                                            @php
                                                                $total = $total-(($total*$checkout->coupon_discount)/100);
                                                            @endphp
                                                            @endif
                                                        </ul>
                                                        @endif
                                                        <div class="grand-total">
                                                            <h4>Total <span class="basket-item-prix" >{{number_format($total,3)}} TND</span></h4>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>


</div>




@endsection

@section('scripts')


@endsection
