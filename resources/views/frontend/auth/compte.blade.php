@extends('frontend.layouts.master')

@section('content')



<div class="breadcrumb-area breadcrumb-area-padding-2 bg-gray-2">
    <div class="custom-container">
        <div class="breadcrumb-content text-center">
            <ul>
                <li>
                    <a href="{{route('home')}}">Accueil</a>
                </li>
                <li class="active">Mon compte</li>
            </ul>
        </div>
    </div>
</div>
<div class="my-account-area pt-75 pb-75">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- My Account Page Start -->
                <div class="myaccount-page-wrapper">
                    <!-- My Account Tab Menu Start -->
                    <div class="row">
                        <div class="col-lg-4 col-md-4">
                            <div class="myaccount-tab-menu nav" role="tablist">
                                <a href="#dashboad" class="active" data-toggle="tab">Tableau de bord</a>
                                <a href="#orders" data-toggle="tab">Mes commandes</a>
                                <a href="#points" data-toggle="tab">Mes points de fidélité</a>
                                <a href="#account-info" data-toggle="tab">Détails de compte</a>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="icofont-logout"></i> Déconnexion</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
                        <!-- My Account Tab Menu End -->
                        <!-- My Account Tab Content Start -->
                        <div class="col-lg-8 col-md-8">
                            <div class="tab-content" id="myaccountContent">
                                <!-- Single Tab Content Start -->
                                <div class="tab-pane fade show active" id="dashboad" role="tabpanel">
                                    <div class="myaccount-content">
                                        <div class="welcome">
                                            <p>Bonjour, <strong>{{Auth::user()->full_name}}</strong> (Ce n'est pas <strong>{{Auth::user()->full_name}} !</strong><a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="icofont-logout"></i> Déconnexion</a>)
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                    @csrf
                                                </form></p>
                                        </div>

                                        <p class="mb-0">Depuis le tableau de bord de votre compte, vous pouvez afficher vos commandes récentes et modifier votre mot de passe et les détails de votre compte</p>
                                    </div>
                                </div>


                                <div class="tab-pane fade" id="orders" role="tabpanel">
                                    <div class="myaccount-content">
                                        <div class="myaccount-table table-responsive text-center">
                                            <table class="table table-bordered">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th>Num_commande</th>
                                                        <th>Date</th>
                                                        <th>Etat de commande</th>
                                                        <th>Total</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($checkouts as $checkout )
                                                    @php
                                                        $array_prod = explode('/',$checkout->prod_ids);
                                                        $array_quantite = explode('/',$checkout->quantite);
                                                        $array_prix = explode('/',$checkout->prix);
                                                        $total = 0 ;
                                                    @endphp
                                                    
                                                   @if ($checkout->prod_ids  != "")
                                                        @for ($i = 0; $i < count($array_prod); $i++)
                                                            @php
                                                                $total = $total + ($array_prix[$i]*$array_quantite[$i]) ;


                                                            @endphp
                                                        @endfor
                                                    @endif


                                                    @php
                                                        $total = $total-($checkout->reduction_points);
                                                        $total = $total-(($total*$checkout->coupon_discount)/100);
                                                    @endphp
                                                            <td>{{$checkout->id}}</td>
                                                            <td>{{date('M d,Y',strtotime($checkout->created_at))}}</td>
                                                            <td>
                                                                @if (($checkout->etat == "encours") )
                                                                <b class="text-warning" >Commande en cours de traitement</b>
                                                                @endif
                                                                @if (($checkout->etat == "refuse") )
                                                                <b class="text-danger" >Commande réfusée</b>
                                                                @endif
                                                                @if (($checkout->etat == "accepte") )
                                                                <b class="text-success" >Commande acceptée</b>
                                                                @endif
                                                                @if (($checkout->etat == "delivred") )
                                                                <b class="text-info">Commande délivrée</b>
                                                                @endif
                                                            </td>
                                                            <td>{{$total}} TND</td>
                                                            <td><a href="{{route('commande.detail',$checkout->id)}}" class="check-btn sqr-btn ">Voir</a></td>
                                                        </tr>
                                                    @endforeach


                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <!-- Single Tab Content Start -->
                                <div class="tab-pane fade" id="points" role="tabpanel">
                                    <div class="myaccount-content">
                                        <div class="welcome">
                                            <h2>Vous avez <u>{{$user->points}} points</u> actuellement</h2>
                                        </div>

                                        <p class="mb-0 alert alert-warning ">
                                            Achetez des produits maintenant et gagnez des Points,100 points de fidélité peuvent être convertis en un bon de 2 TND !
                                        </p>
                                    </div>
                                </div>


                                <div class="tab-pane fade" id="account-info" role="tabpanel">
                                    <div class="myaccount-content">
                                        <div class="account-details-form">
                                            <form action="{{route('seller.compte-update')}}" method="post">
                                                @csrf
                                                <div class="row">

                                                    <div class="login-register-input-style input-style">
                                                        <label>Nom & prénom *</label>
                                                        @error('full_name')
                                                            <p class="text-danger">vérifier votre nom et prènom</p>
                                                        @enderror
                                                        <input type="text" name="full_name" required value="{{$user->full_name}}" >
                                                    </div>
                                                    <div class="login-register-input-style input-style">
                                                        <label>Téléphone *</label>
                                                        @error('phone')
                                                            <p class="text-danger">Numèro de téléphone doit avoir 8 chiffres</p>
                                                        @enderror
                                                        <input type="tel" name="phone" required value="{{$user->phone}}">
                                                    </div>

                                                    <div class="select-style billing-select mb-35">
                                                        <label>Gouvernorat *</label>
                                                        <select class="select-active"  name="gouvernorat"  required >
                                                            <option value="Ariana" @if($user->gouvernorat == "Ariana") selected @endif>Ariana</option>
                                                            <option value="Beja" @if($user->gouvernorat == "Beja") selected @endif>Beja</option>
                                                            <option value="Ben Arous" @if($user->gouvernorat == "Ben Arous") selected @endif>Ben Arous</option>
                                                            <option value="Bizerte" @if($user->gouvernorat == "Bizerte") selected @endif>Bizerte</option>
                                                            <option value="Jendouba" @if($user->gouvernorat == "Jendouba") selected @endif>Jendouba</option>
                                                            <option value="Gabes" @if($user->gouvernorat == "Gabes") selected @endif>Gabes</option>
                                                            <option value="Gafsa" @if($user->gouvernorat == "Gafsa") selected @endif>Gafsa</option>
                                                            <option value="Kairouan" @if($user->gouvernorat == "Kairouan") selected @endif>Kairouan</option>
                                                            <option value="Kasserine" @if($user->gouvernorat == "Kasserine") selected @endif>Kasserine</option>
                                                            <option value="Kébili" @if($user->gouvernorat == "Kébili") selected @endif>Kébili</option>
                                                            <option value="Kef" @if($user->gouvernorat == "Kef") selected @endif>Kef</option>
                                                            <option value="Mahdia" @if($user->gouvernorat == "Mahdia") selected @endif>Mahdia</option>
                                                            <option value="Manouba" @if($user->gouvernorat == "Manouba") selected @endif>Manouba</option>
                                                            <option value="Medenine" @if($user->gouvernorat == "Medenine") selected @endif>Medenine</option>
                                                            <option value="Monastir" @if($user->gouvernorat == "Monastir") selected @endif>Monastir</option>
                                                            <option value="Nabeul" @if($user->gouvernorat == "Nabeul") selected @endif>Nabeul</option>
                                                            <option value="Sfax" @if($user->gouvernorat == "Sfax") selected @endif>Sfax</option>
                                                            <option value="Sidi Bouzid" @if($user->gouvernorat == "Sidi Bouzid") selected @endif>Sidi Bouzid</option>
                                                            <option value="Siliana" @if($user->gouvernorat == "Siliana") selected @endif>Siliana</option>
                                                            <option value="Sousse" @if($user->gouvernorat == "Sousse") selected @endif>Sousse</option>
                                                            <option value="Tataouine" @if($user->gouvernorat == "Tataouine") selected @endif>Tataouine</option>
                                                            <option value="Tozeur" @if($user->gouvernorat == "Tozeur") selected @endif>Tozeur</option>
                                                            <option value="Tunis" @if($user->gouvernorat == "Tunis") selected @endif>Tunis</option>
                                                            <option value="Zaghouan" @if($user->gouvernorat == "Zaghouan") selected @endif>Zaghouan</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-lg-12">
                                                        <div class="billing-info input-style mb-35">
                                                            <label>Ville *</label>
                                                            <input class="billing-address" required type="text" name="address" value="{{$user->address}}" >
                                                        </div>
                                                    </div>

                                                    <div class="login-register-input-style input-style">
                                                        <label>Email *</label>
                                                        @error('email')
                                                        <p class="text-danger">Email déja utilisé</p>
                                                        @enderror
                                                        <input type="email" name="email" required value="{{$user->email}}" >
                                                    </div>

                                                </div>


                                                <fieldset>
                                                    <legend>Modifier mot de passe</legend>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="account-info input-style mb-30">
                                                                <label>Mot de passe (Laisser vide pour ne se change pas)</label>
                                                                <input type="text" name="newpass" placeholder="Laisser vide pour ne se change pas" >
                                                            </div>
                                                        </div>

                                                    </div>
                                                </fieldset>



                                                <div class="account-info-btn">
                                                    <button type="submit" >Enregistrer Modifications</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




@endsection

@section('scripts')


@if (session()->has('success'))
<script>
    $(document).ready(function(){
        alertify.set('notifier','position','bottom-right');
        alertify.success('{{session()->get('success')}}');
    })
</script>
@endif


@endsection
