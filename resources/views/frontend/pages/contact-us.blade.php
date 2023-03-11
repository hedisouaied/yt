@extends('frontend.layouts.master')

@section('content')


<div class="breadcrumb-area breadcrumb-area-padding-2 bg-gray-2">
    <div class="custom-container">
        <div class="breadcrumb-content text-center">
            <ul>
                <li>
                    <a href="{{route('home')}}">Accueil</a>
                </li>
                <li class="active">Contacter-nous</li>
            </ul>
        </div>
    </div>
</div>
<div class="contact-us-area pt-65 pb-55">
    <div class="container">

        <div class="contact-info-wrap-2 mb-40">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-12 col-sm-5 wow tmFadeInUp">
                    <div class="single-contact-info3-wrap mb-30">
                        <div class="single-contact-info3-icon">
                            <i class="fal fa-map-marker-alt"></i>
                        </div>
                        <div class="single-contact-info3-content">
                            <h3>Visitez-nous</h3>
                            <p class="width-1"> {{get_setting('address')}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12 col-sm-7 wow tmFadeInUp">
                    <div class="single-contact-info3-wrap mb-30">
                        <div class="single-contact-info3-icon">
                            <i class="fal fa-phone"></i>
                        </div>
                        <div class="single-contact-info3-content">
                            <h3>Appelez-nous</h3>
                            <p> Mobile: <span>{{get_setting('phone')}}</span></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12 col-sm-12 wow tmFadeInUp">
                    <div class="single-contact-info3-wrap mb-30">
                        <div class="single-contact-info3-icon">
                            <i class="fal fa-clock"></i>
                        </div>
                        <div class="single-contact-info3-content">
                            <h3>Contactez-nous</h3>
                            <p> Email: <span>{{get_setting('email')}}</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-8 col-lg-10 ml-auto mr-auto">
                <div class="contact-from-area  padding-20-row-col wow tmFadeInUp">
                    <h3>Envoyez-nous un message</h3>
                    <form class="contact-form-style text-center" id="contact-form" action="{{route('contact.submit')}}" method="post">
                        @csrf
                        <x-honey/>
                        <input type="checkbox" name="contact_me_by_fax_only" value="1" style="display:none !important" tabindex="-1" autocomplete="off">
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="input-style mb-20">
                                    <input  type="text" name="name" placeholder="Nom" value="{{old('name')}}" required>
                                    @error('name')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="input-style mb-20">
                                    <input  type="text" name="lastname" placeholder="Prénom" value="{{old('lastname')}}" required>
                                    @error('lastname')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="input-style mb-20">
                                    <input  type="email" name="email" placeholder="Email" value="{{old('email')}}" required>
                                    @error('email')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="input-style mb-20">
                                    <input type="tel" name="phone" placeholder="Numéro de télephone" value="{{old('phone')}}" required>
                                    @error('phone')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="textarea-style mb-30">
                                    <input  type="hidden" name="subject" value="Message depuis MSPARA" required>
                                    <textarea name="content" required placeholder="Message">{{old('content')}}</textarea>
                                </div>
                                <button class="submit submit-auto-width" type="submit">Envoyez message</button>
                            </div>
                        </div>
                    </form>
                    <p class="form-messege" style="color:#19da19;" ></p>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection

@section('scripts')
    @if(session()->has('success'))

    <script>
    $(document).ready(function () {
    alertify.set('notifier','position','bottom-left');
    alertify.success('{{session()->get('success')}}');
    });
    </script>
    @endif
@endsection
