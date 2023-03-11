@extends('backend.layouts.master')


@section('content')


<div id="wrapper">
    <div class="main-content">
        <div class="row small-spacing">
            <div class="col-xs-9">
                <div class="box-content card white">
                    <h4 class="box-title">Modifier moyen industriel</h4>
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
                        <form action="{{route('moyen.update',$feedback->id)}}" method="POST">
                            @csrf
                            @method('patch')
                            <div class="form-group">
                                <label>Moyen industriel</label>
                                <input type="text" class="form-control" value="{{$feedback->title}}" name="title">
                            </div>

                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" id="description" name="description">{{$feedback->description}}</textarea>
                            </div>

                            <div class="m-t-20">
                                <label>Photo de moyen industriel</label>

                                <div class="input-group">
                                    <span class="input-group-btn">
                                      <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                        <i class="fa fa-picture-o"></i> Choose
                                      </a>
                                    </span>
                                    <input id="thumbnail" class="form-control" type="text" name="photo" value="{{$feedback->photo}}">
                                  </div>
                                <div id="holder" style="margin-top:15px;max-height:100px;">
                                    <img src="{{$feedback->photo}}" style="margin-top:15px;max-height:100px;" />
                                </div>

                            </div>

                            <br>

                            <div class="m-t-20">
                                <label>Extra Photo</label>

                                <div class="input-group">
                                    <span class="input-group-btn">
                                      <a id="lfmgalerie" data-input="thumbnailgalerie" data-preview="holdergalerie" class="btn btn-primary">
                                        <i class="fa fa-picture-o"></i> Choose
                                      </a>
                                    </span>
                                    <input id="thumbnailgalerie" class="form-control" type="text" name="galerie" value="{{$feedback->galerie}}">
                                  </div>
                                <div id="holdergalerie" style="margin-top:15px;max-height:100px;">
                                    @php
                                        $galeries = explode(',',$feedback->galerie)
                                    @endphp
                                    @foreach ($galeries as $galerie )
                                    <img src="{{$galerie}}" style="margin-top:15px;max-height:100px;" />
                                    @endforeach

                                </div>

                            </div>

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
    $('#lfmgalerie').filemanager('image');
</script>

<script>
    $(document).ready(function() {
        $('#description').summernote();
    });
  </script>
@endsection
