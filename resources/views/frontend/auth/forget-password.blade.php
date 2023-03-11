@extends('frontend.layouts.master')

@section('content')


<div class="breadcrumb-area breadcrumb-area-padding-2 bg-gray-2">
    <div class="custom-container">
        <div class="breadcrumb-content text-center">
            <ul>
                <li>
                    <a href="{{route('home')}}">Accueil</a>
                </li>
                <li class="active">Mot de passe oublié</li>
            </ul>
        </div>
    </div>
</div>

<div class="login-register-area pt-75 pb-75">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">

                <div class="login-register-wrap login-register-gray-bg">
                    <div class="login-register-title">
                        <h1>Modifier mot de passe</h1>
                    </div>
                    <div class="login-register-form">

                        <form action="{{route('seller.password')}}" method="POST" >
                            @csrf

                            @if (session()->has('errorpass'))
                            <span class="text-danger mb-3">{{session()->get('errorpass')}}</span>
                            @endif
                            @if (session()->has('success'))
                            <span class="text-danger mb-3">{{session()->get('success')}}</span>
                            @endif
                            <div class="login-register-input-style input-style input-style-white">
                                <label>Email *</label>
                                <input type="email" name="email" required >
                            </div>

                            <div class="login-register-btn">
                                <button type="submit">Changer</button>
                                
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
