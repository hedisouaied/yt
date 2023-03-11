@extends('backend.layouts.master')

@section('content')

<div id="wrapper">
    <div class="main-content">
        <div class="row small-spacing">
            <div class="col-xs-9">
                @include('backend.layouts.notification')
                <div class="box-content card white">
                    <h4 class="box-title">à propos</h4>

                    <div class="col-md-12">
                        @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{$error}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                        @endif
                    </div>
                    <div class="card-content">
                        <form action="{{route('about.update')}}" method="POST" enctype="multipart/form-data" >
                            @csrf
                            @method('put')

                            <fieldset style="border: solid 5px;padding: 10px;">
                                <legend style="width: max-content;padding: 3px;">Présentation</legend>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Titre</label>
                                    <input type="text" class="form-control" value="{{$about->heading}}" name="heading">
                                </div>

                            </fieldset>

                            <fieldset style="border: solid 5px;padding: 10px;">
                                <legend style="width: max-content;padding: 3px;">Livraison</legend>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Prix de livraison</label>
                                    <input type="number" class="form-control" value="{{number_format($about->prix_livraison,3)}}" name="prix_livraison" step="0.001" >
                                </div>

                            </fieldset>

                            <br>
                            <fieldset style="border: solid 5px;padding: 10px;">

                                <legend style="width: max-content;padding: 3px;">Qui sommes-nous ?</legend>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Photo </label>
                                    <input type="file" name="image" accept="image/*" class="dropify" >
                                    <img src="{{$about->image}}" style="height: 150px;margin-top:15px;margin-bottom:15px;" >
                                </div>

                                <br>
                                <div class="m-t-20" style="margin-top: 25px;">
                                    <label for="exampleInputEmail1">Qui sommes-nous ...</label>
                                    <textarea name="content" class="form-control" id="description" placeholder="...">{{$about->content}}</textarea>
                                </div>
                            </fieldset>
                            <br>
                            <fieldset style="border: solid 5px;padding: 10px;">
                                <legend style="width: max-content;padding: 3px;">Nos Contacts</legend>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="text" class="form-control" placeholder="Email" value="{{$about->email}}" name="email">
                                </div>
                                <div class="form-group">
                                    <label for="phone">Téléphone</label>
                                    <input type="text" class="form-control" placeholder="Téléphone" value="{{$about->phone}}" name="phone">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Adresse</label>
                                    <input type="text" class="form-control" placeholder="Adresse" value="{{$about->address}}" name="address">
                                </div>
                            </fieldset>
                            <br>

                            <fieldset style="border: solid 5px;padding: 10px;">
                                <legend style="width: max-content;padding: 3px;">Nos Social-Medias (Liens des pages)</legend>
                                <div class="form-group">
                                    <label>Facebook</label>
                                    <input type="text" class="form-control" value="{{$about->facebook}}" name="facebook">
                                </div>
                                <div class="form-group">
                                    <label>Instagram</label>
                                    <input type="text" class="form-control" value="{{$about->instagram}}" name="instagram">
                                </div>

                                <div class="form-group">
                                    <label>Youtube</label>
                                    <input type="text" class="form-control" value="{{$about->youtube}}" name="youtube">
                                </div>
                            </fieldset>
                            <br>

                            <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">Enregistrer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>


<script>
    $('#lfm').filemanager('image');
</script>
<script>
    $('#lfm1').filemanager('image');
</script>
<script>
    $('#lfm2').filemanager('image');
</script>
<script>
    $('#lfm3').filemanager('image');
</script>
<script>
    $('#lfm4').filemanager('image');
</script>

<script>
    $('#lfmvideo').filemanager('video');
</script>
<script>
    $('#lfm_mot').filemanager('image');
</script>
<script>
    $('#lfm_cata').filemanager('file');
</script>


<script>
    $(document).ready(function() {
        $('#description').summernote();
    });
  </script>

<script>
    $(document).ready(function() {
        $('#description1').summernote();
    });
  </script>

<script>
    $(document).ready(function() {
        $('#description2').summernote();
    });
  </script>

<script>
    $(document).ready(function() {
        $('#description3').summernote();
    });
  </script>

<script>
    $(document).ready(function() {
        $('#description4').summernote();
    });
  </script>



@endsection
