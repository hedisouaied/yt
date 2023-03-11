@extends('backend.layouts.master')


@section('content')


<div class="main-content">
<div class="col-lg-12">
    @include('backend.layouts.notification')
</div>
<h4 class="box-title text-center">Liste des commandes @if (isset($_GET['gouvernorat']) && ($_GET['gouvernorat'] != ''))
    <b class="text-success" >({{$_GET['gouvernorat']}})</b>
    @endif @if (isset($_GET['etat_filtre']) && ($_GET['etat_filtre'] != ''))
    <b class="text-success" >({{$_GET['etat_filtre']}})</b>
    @endif @if (isset($_GET['date_debut']) && ($_GET['date_debut'] != ''))
    <b class="text-success" >(Min date : {{$_GET['date_debut']}})</b>
    @endif @if (isset($_GET['date_fin']) && ($_GET['date_fin'] != ''))
    <b class="text-success" >(Max date : {{$_GET['date_fin']}})</b>
    @endif</h4>
@if (count($devis) != 0)

<div class="alert alert-info text-center">
*vous ne pouvez pas accepter une commande si un de ces produits est <b>out of stock</b>
</div>

<div class="card-content">
    <form action="" method="GET">


        <div class="form-group margin-bottom-20">
            <label for="exampleInputEmail1">Filtrer Par Ville</label>

            <div class="row">
                <div class="col-md-6">
                    <select class="form-control"  name="etat_filtre"  >
                        <option  value="">Dans tous états de commande</option>
                        <option @if (isset($_GET['etat_filtre']) && ($_GET['etat_filtre'] == "encours"))
                            selected
                        @endif value="encours" >En cours de traitement</option>
                        <option @if (isset($_GET['etat_filtre']) && ($_GET['etat_filtre'] == "accepte"))
                        selected
                        @endif value="accepte" >Accepter</option>
                        <option @if (isset($_GET['etat_filtre']) && ($_GET['etat_filtre'] == "refuse"))
                        selected
                        @endif value="refuse" >Réfuser</option>
                        <option @if (isset($_GET['etat_filtre']) && ($_GET['etat_filtre'] == "delivred"))
                        selected
                        @endif value="delivred" >Délivrer</option>
                    </select>
                </div>


                <div class="col-md-6">
                    <select class="form-control"  name="gouvernorat"  >
                        <option value="">Dans tous les gouvernorats</option>
                        <option @if (isset($_GET['gouvernorat']) && ($_GET['gouvernorat'] == "Ariana"))
                        selected
                        @endif value="Ariana">Ariana</option>
                        <option @if (isset($_GET['gouvernorat']) && ($_GET['gouvernorat'] == "Beja"))
                        selected
                        @endif value="Beja">Beja</option>
                        <option @if (isset($_GET['gouvernorat']) && ($_GET['gouvernorat'] == "Ben Arous"))
                        selected
                        @endif value="Ben Arous">Ben Arous</option>
                        <option @if (isset($_GET['gouvernorat']) && ($_GET['gouvernorat'] == "Bizerte"))
                        selected
                        @endif value="Bizerte">Bizerte</option>
                        <option @if (isset($_GET['gouvernorat']) && ($_GET['gouvernorat'] == "Jendouba"))
                        selected
                        @endif value="Jendouba">Jendouba</option>
                        <option @if (isset($_GET['gouvernorat']) && ($_GET['gouvernorat'] == "Gabes"))
                        selected
                        @endif value="Gabes">Gabes</option>
                        <option @if (isset($_GET['gouvernorat']) && ($_GET['gouvernorat'] == "Gafsa"))
                        selected
                        @endif value="Gafsa">Gafsa</option>
                        <option @if (isset($_GET['gouvernorat']) && ($_GET['gouvernorat'] == "Kairouan"))
                        selected
                        @endif value="Kairouan">Kairouan</option>
                        <option @if (isset($_GET['gouvernorat']) && ($_GET['gouvernorat'] == "Kasserine"))
                        selected
                        @endif value="Kasserine">Kasserine</option>
                        <option @if (isset($_GET['gouvernorat']) && ($_GET['gouvernorat'] == "Kébili"))
                        selected
                        @endif value="Kébili">Kébili</option>
                        <option @if (isset($_GET['gouvernorat']) && ($_GET['gouvernorat'] == "Kef"))
                        selected
                        @endif value="Kef">Kef</option>
                        <option @if (isset($_GET['gouvernorat']) && ($_GET['gouvernorat'] == "Mahdia"))
                        selected
                        @endif value="Mahdia">Mahdia</option>
                        <option @if (isset($_GET['gouvernorat']) && ($_GET['gouvernorat'] == "Manouba"))
                        selected
                        @endif value="Manouba">Manouba</option>
                        <option @if (isset($_GET['gouvernorat']) && ($_GET['gouvernorat'] == "Medenine"))
                        selected
                        @endif value="Medenine">Medenine</option>
                        <option @if (isset($_GET['gouvernorat']) && ($_GET['gouvernorat'] == "Monastir"))
                        selected
                        @endif value="Monastir">Monastir</option>
                        <option @if (isset($_GET['gouvernorat']) && ($_GET['gouvernorat'] == "Nabeul"))
                        selected
                        @endif value="Nabeul">Nabeul</option>
                        <option @if (isset($_GET['gouvernorat']) && ($_GET['gouvernorat'] == "Sfax"))
                        selected
                        @endif value="Sfax">Sfax</option>
                        <option @if (isset($_GET['gouvernorat']) && ($_GET['gouvernorat'] == "Sidi Bouzid"))
                        selected
                        @endif value="Sidi Bouzid">Sidi Bouzid</option>
                        <option @if (isset($_GET['gouvernorat']) && ($_GET['gouvernorat'] == "Siliana"))
                        selected
                        @endif value="Siliana">Siliana</option>
                        <option @if (isset($_GET['gouvernorat']) && ($_GET['gouvernorat'] == "Sousse"))
                        selected
                        @endif value="Sousse">Sousse</option>
                        <option @if (isset($_GET['gouvernorat']) && ($_GET['gouvernorat'] == "Tataouine"))
                        selected
                        @endif value="Tataouine">Tataouine</option>
                        <option @if (isset($_GET['gouvernorat']) && ($_GET['gouvernorat'] == "Tozeur"))
                        selected
                        @endif value="Tozeur">Tozeur</option>
                        <option @if (isset($_GET['gouvernorat']) && ($_GET['gouvernorat'] == "Tunis"))
                        selected
                        @endif value="Tunis">Tunis</option>
                        <option @if (isset($_GET['gouvernorat']) && ($_GET['gouvernorat'] == "Zaghouan"))
                        selected
                        @endif value="Zaghouan">Zaghouan</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label>date min de filtrage</label>
                    <input class="form-control" type="date" @if (isset($_GET['date_debut']))
                        value="{{$_GET['date_debut']}}"
                    @endif name="date_debut" >
                </div>

                <div class="col-md-6">
                    <label>date max de filtrage</label>
                    <input class="form-control" type="date"  @if (isset($_GET['date_fin']))
                    value="{{$_GET['date_fin']}}"
                @endif name="date_fin" >
                </div>


                <div class="col-md-4" style="margin-top:10px; ">
                    <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">Filtrer</button>
                    <a href="{{route('devis.index')}}" class="btn btn-primary btn-sm waves-effect waves-light">Reset</a>
                 </div>


            </div>

        </div>

    </form>
</div>


<p>
    <a href="{{route('tous-liste-excel')}}?try<?php if(isset($_GET['date_debut'])){ echo "&date_debut=".$_GET['date_debut'] ; } ?><?php if(isset($_GET['date_fin'])){ echo "&date_fin=".$_GET['date_fin'] ; } ?><?php if(isset($_GET['etat_filtre'])){ echo "&etat_filtre=".$_GET['etat_filtre'] ; } ?><?php if(isset($_GET['gouvernorat'])){ echo "&gouvernorat=".$_GET['gouvernorat'] ; } ?>" class="btn btn-success waves-effect waves-light color-muted text-white" >
        <i class="fa fa-file-excel-o "></i> Tous les commande excel
    </a>
</p>
    <table class="table table-striped table-bordered display" style="width:100%">
        <thead>
            <tr>
                <th>Num_commande</th>
                <th>Clients</th>
                <th>Produits</th>
                <th>Etat de commande</th>
                <th>Subtotal</th>
                <th>Réductions</th>
                <th>Total</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($devis as $item)

            @if ( $item->sess_id != NULL)
                @php
                    $user = \App\Models\User::where('id',$item->sess_id)->first();
                @endphp
            @endif


            @if ( $item->pass_id != NULL)
                @php
                    $user = \App\Models\Passager::where('id',$item->pass_id)->first();
                @endphp
            @endif


                <tr>
                    <td>
                        <p>#{{$item->id}}</p>
                        <p>{{$item->created_at}}</p>

                    </td>
                    <td>
                        <p><i class="fa fa-user" ></i> {{$user->full_name}}

                        @if ( $item->sess_id != NULL)
                            @if ($user->role == "admin")
                            <span class="badge badge-success" style="background: rgb(191, 52, 233);margin-left:5px;" >C'est un admin</span>
                            @else
                            <span class="badge badge-success" style="background: rgb(8, 109, 22);margin-left:5px;" >C'est un client (a un compte)</span>

                            @endif
                        @endif


                        @if ( $item->pass_id != NULL)
                            <span class="badge badge-success" style="background: rgb(10, 102, 163);margin-left:5px;" >C'est un passager</span>
                        @endif

                    </p>
                        <p><i class="fa fa-phone" ></i> {{$user->phone}}</p>
                        <p><i class="fa fa-envelope" ></i> {{$user->email}}</p>
                        <p><i class="fa fa-map-marker" ></i> {{$user->gouvernorat}}</p>
                        <p><i class="fa fa-map" ></i> {{$user->address}}</p>

                        @if ( $item->sess_id != NULL)
                            @if ($user->role == "seller")
                            <p><a class="btn btn-xs btn-primary" href="{{route('devis.client',$user->id)}}" >Commandes de {{$user->full_name}} ({{count(\App\Models\Checkout::where('sess_id',$user->id)->orderby('id', 'DESC')->get())}})</a></p>
                            @endif
                        @endif


                    </td>
                    <td>
                        @php
                            $array_prod = explode('/',$item->prod_ids);
                            $array_quantite = explode('/',$item->quantite);
                            $array_prix = explode('/',$item->prix);
                            $total = 0 ;

                            $check_stock = 0 ;
                        @endphp
                        <ul>

                        @if($item->prod_ids != "")
                            @for ($i = 0; $i < count($array_prod); $i++)
                                <li>
                                    @php

                                        $product = (\App\Models\Product::where('id',$array_prod[$i])->first());



                                        $slug = (\App\Models\Product::where('id',$array_prod[$i])->value('slug')) ;
                                       // echo $slug;
                                    @endphp

                                    @if ($product)
                                        <b><a target="_blank" href="{{route('product.detail',$slug)}}" >{{\App\Models\Product::where('id',$array_prod[$i])->value('title')}}</a> </b> : {{number_format($array_prix[$i],3)}}TND (Quantité : {{$array_quantite[$i]}})

                                        @if (($item->etat == 'encours') )

                                            @if ($array_quantite[$i] > (\App\Models\Product::where('id',$array_prod[$i])->value('stock')) )
                                                @php
                                                    $check_stock = 1 ;
                                                @endphp

                                                <b><span class="text-danger" >*Attention il y a {{(\App\Models\Product::where('id',$array_prod[$i])->value('stock'))}} dans le stock</span></b>
                                                @else
                                                <b><span class="text-success" ><i class="fa fa-check" ></i> il y a {{(\App\Models\Product::where('id',$array_prod[$i])->value('stock'))}} dans le stock</span></b>
                                            @endif

                                        @endif

                                        @php
                                            $total = $total + ($array_prix[$i]*$array_quantite[$i]) ;
                                        @endphp


                                    @else

                                        <span class="text-danger" >Ce produit a été supprimer modifier la commande s'il vous plait ! </span>

                                    @endif

                                </li>

                            @endfor
                            @else
                            no products : commande à supprimer
                        @endif
                        </ul>
                        @if (($item->etat == 'encours'))

                        <p><a class="btn btn-warning" href="{{route('devis.edit',$item->id)}}" >Modifier Commande</a></p>
                        @endif
                    </td>

                    <td>
                        @if ($item->operations_admin != "")
                        Operations :
                            <ol style="border: 1px solid" >

                                @php
                                    $operations = explode('/',$item->operations_admin);
                                @endphp

                                @foreach ($operations as $operation)

                                    @php

                                    $oper = explode('-',$operation);

                                    @endphp

                                    <li>{{\App\Models\User::where('id',$oper[0])->value('full_name')}}:<b>{{$oper[1]}}</b></li>

                                @endforeach
                            </ol>

                        @endif


                        <form action="{{route('devis.remarque',$item->id)}}" method="POST" >
                            @csrf
                            <textarea placeholder="Remarque" class="form-control" name="remarque" >{{$item->remarque}}</textarea>

                            <input type="submit" value="changer remarque" class="btn btn-xs btn-primary" >
                        </form>
                        <br>
                        @if ($item->etat !== "delivred")


                        <form action="{{route('devis.update',$item->id)}}" method="POST" >
                            @csrf
                            @method('patch')

                            <select name="etat">
                                @if (($item->etat == "refuse"))
                                    <option value="encours" >En cours de traitement</option>
                                @endif

                                @if (($item->etat == "encours") )
                                <option value="accepte" <?php if($check_stock !== 0){ echo "disabled" ; } ?> >Accepter</option>
                                @endif

                                @if (($item->etat == "encours") )
                                    <option value="refuse" >Réfuser</option>
                                @endif

                                @if (($item->etat == "accepte") )
                                    <option value="delivred" >Délivrer</option>
                                @endif


                                @if (($item->etat == "accepte") )
                                <option value="encours" >En cours de traitement + retour stock</option>
                            @endif



                            </select>
                            <input type="submit" value="changer" class="btn btn-xs btn-primary" >
                        </form>

                        @endif

                        <p>
                            Etat De Commande :
                            @if (($item->etat == "encours") )
                            <b class="text-warning" >Commande en cours de traitement</b>
                            @endif
                            @if (($item->etat == "refuse") )
                            <b class="text-danger" >Commande réfusée</b>
                            @endif
                            @if (($item->etat == "accepte") )
                            <b class="text-success" >Commande acceptée</b>
                            @endif
                            @if (($item->etat == "delivred") )
                            <b class="text-info">Commande délivrée</b>
                            @endif

                        </p>



                    </td>

                    <td>{{number_format($total,3)}}TND</td>
                    <td>
                        <p>Prix de livraison : +{{number_format(($item->prix_livraison),3)}}TND</p>
                        @php
                        $total = $total+($item->prix_livraison)
                        @endphp
                        <p>réduction points fidélité : -{{number_format(($item->reduction_points),3)}}TND</p>
                        @php
                        $total = $total-($item->reduction_points)
                        @endphp
                        <p>réduction coupon : -{{number_format((($total*$item->coupon_discount)/100),3)}}TND</p>
                        @php
                        $total = $total-(($total*$item->coupon_discount)/100)
                        @endphp

                    </td>

                    <td><span class="text-white p-5 bg-success" style="padding: 8px;" >{{number_format($total,3)}}TND</span></td>


                    <td>

                    <form action="{{route('devis.destroy',$item->id)}}" method="POST">
                        @csrf
                        @method('delete')
                        <button type="button" data-id="{{$item->id}}" class="float-left dltBtn btn btn-danger btn-sm waves-effect waves-light" style="color:#fff;background-color:#000;"><i class="fa fa-trash" aria-hidden="true"></i> Supprimer commande </button>
                        <br>
                        <u> La suppression ça ne signifie pas la retour de stock !</u>
                    </form>

                    <p>
                        <a href="{{route('liste-excel',$item->id)}}" class="btn btn-success waves-effect waves-light color-muted text-white" >
                            <i class="fa fa-file-excel-o "></i> Excel commande
                        </a>
                    </p>


                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <h2 class="text-center">Il n'y a pas de commande pour le moment!</h2>
    @endif
</div>

@endsection

@section('scripts')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.dltBtn').click(function(e){
            var form=$(this).closest('form');
            var dataID=$(this).data('id');
            e.preventDefault();

            swal({
                title: "Êtes-vous sûr?",
                text: "Une fois supprimé, vous ne pourrez pas récupérer!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                    form.submit();
                    swal("Poof! supprimée!", {
                    icon: "success",
                    });
                } else {
                    swal("N'est pas supprimée!");
                }
                });
        });
</script>

@endsection
