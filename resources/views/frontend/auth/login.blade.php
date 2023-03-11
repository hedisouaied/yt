@extends('frontend.layouts.master')

@section('content')


<div class="breadcrumb-area breadcrumb-area-padding-2 bg-gray-2">
    <div class="custom-container">
        <div class="breadcrumb-content text-center">
            <ul>
                <li>
                    <a href="{{route('home')}}">Accueil</a>
                </li>
                <li class="active">Se connecter / S'inscrire </li>
            </ul>
        </div>
    </div>
</div>

<div class="login-register-area pt-75 pb-75">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">

                <div class="login-register-wrap login-register-gray-bg">
                    <div class="login-register-title">
                        <h1>Se connecter</h1>
                    </div>
                    <div class="login-register-form">

                        <form action="{{route('seller.login')}}" method="POST" >
                            @csrf

                            @if (session()->has('errorpass'))
                            <span class="text-danger mb-3">{{session()->get('errorpass')}}</span>
                            @endif
                            <div class="login-register-input-style input-style input-style-white">
                                <label>Email *</label>
                                <input type="email" name="email" required >
                            </div>
                            <div class="login-register-input-style input-style input-style-white">
                                <label>Mot de passe *</label>
                                <input type="password" name="password" required>
                            </div>
                            <div class="lost-remember-wrap">

                                <div class="lost-wrap">
                                    <a href="{{route('seller.password.forget')}}">Mot de passe oublié?</a>
                                </div>
                            </div>
                            
                            <div class="login-register-btn">
                                <button type="submit">Se connecter</button>
                            </div>
                        </form>

                    </div>
                </div>

            </div>

            <div class="col-lg-6">
                <div class="login-register-wrap">
                    <div class="login-register-title">
                        <h1>S'inscrire</h1>
                    </div>
                    <div class="login-register-form">

                        <form action="{{route('seller.register')}}" method="POST"  >
                            @csrf

                            <div class="login-register-input-style input-style">
                                <label>Nom & prénom *</label>
                                @error('full_name')
                                    <p class="text-danger">vérifier votre nom et prènom</p>
                                @enderror
                                <input type="text" name="full_name" required value="{{old('full_name')}}" >
                            </div>
                            <div class="login-register-input-style input-style">
                                <label>Téléphone *</label>
                                @error('phone')
                                    <p class="text-danger">Numèro de téléphone doit avoir 8 chiffres</p>
                                @enderror
                                <input type="tel" name="phone" required value="{{old('phone')}}">
                            </div>

                            <div class="select-style billing-select mb-35">
                                <label>Gouvernorat *</label>
                                <select class="select-active"  name="gouvernorat"  required >
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

                            <div class="col-lg-12">
                                <div class="billing-info input-style mb-35">
                                    <label>Ville *</label>
                                    <input class="billing-address" required type="text" name="address" >
                                </div>
                            </div>

                            <div class="login-register-input-style input-style">
                                <label>Email *</label>
                                @error('email')
                                <p class="text-danger">Email déja utilisé</p>
                                @enderror
                                <input type="email" name="email" required value="{{old('email')}}" >
                            </div>
                            <div class="login-register-input-style input-style">
                                <label>Mot de passe *</label>
                                @error('password')
                                    <p class="text-danger">Mot de passe doit avoir au minimum 4 caractères</p>
                                @enderror
                                <input type="password" name="password" required>
                            </div>


                            <div class="login-register-btn">
                                <button type="submit">S'inscrire</button>
                            </div>
                        </form>
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
