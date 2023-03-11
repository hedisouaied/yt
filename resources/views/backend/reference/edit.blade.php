@extends('backend.layouts.master')


@section('content')


<div id="wrapper">
    <div class="main-content">
        <div class="row small-spacing">
            <div class="col-xs-9">
                <div class="box-content card white">
                    <h4 class="box-title">Modifier reference</h4>
                    <!-- /.box-title -->
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
                        <form action="{{route('reference.update',$product->id)}}" method="POST">
                            @csrf
                            @method('patch')
                            <div class="form-group">
                                <label>Titre</label>
                                <input type="text" class="form-control" value="{{$product->title}}" name="title">
                            </div>

                            <div class="m-t-20">
                                <label>Photos</label>

                                <div class="input-group">
                                    <span class="input-group-btn">
                                      <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                        <i class="fa fa-picture-o"></i> Choose
                                      </a>
                                    </span>
                                    <input id="thumbnail" class="form-control" type="text" name="photo" value="{{$product->photo}}">
                                  </div>
                                <div id="holder" style="margin-top:15px;">
                                @php
                                    $ph = explode(',',$product->photo);

                                @endphp
                                @foreach ($ph as $p)
                                    <img src="{{$p}}" style="margin-top:15px;max-height:100px;" />
                                @endforeach
                                </div>
                            </div>

                            <div class="form-group margin-bottom-20">
                                <label for="exampleInputEmail1">Domaine d'activité</label>
                                <select class="form-control" name="domaine_id">
                                    @foreach (\App\Models\Domaineactivite::get() as $brand)

                                    <option value="{{$brand->id}}" {{$product->domaine_id==$brand->id? 'selected' : ''}}>{{$brand->title}}</option>


                                    @endforeach

                                </select>
                            </div>


                            <div class="form-group">
                                <label for="exampleInputEmail1">Pays</label>
                                <input type="text" class="form-control" id="exampleInputEmail1"" value="{{$product->pays}}" name="pays">
                            </div>




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
    $(document).ready(function() {
        $('#description').summernote();
    });
  </script>


@endsection
