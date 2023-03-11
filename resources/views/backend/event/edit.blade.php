@extends('backend.layouts.master')


@section('content')


<div id="wrapper">
    <div class="main-content">
        <div class="row small-spacing">
            <div class="col-xs-9">
                <div class="box-content card white">
                    <h4 class="box-title">Modifier événement</h4>
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
                        <form action="{{route('event.update',$feedback->id)}}" method="POST">
                            @csrf
                            @method('patch')
                            <div class="form-group">
                                <label>Titre d'événement</label>
                                <input type="text" class="form-control" value="{{$feedback->title}}" name="title">
                            </div>


                            <div class="m-t-20">
                                <label>Photo</label>

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
                            <div class="form-group">
                                <label>Pays</label>
                                <input type="text" class="form-control" value="{{$feedback->pays}}" name="pays">
                            </div>
                            <div class="form-group">
                                <label>Date début</label>
                                <input type="date" class="form-control" value="{{$feedback->date_debut}}" name="date_debut">
                            </div>

                            <div class="form-group">
                                <label>Date fin</label>
                                <input type="date" class="form-control" value="{{$feedback->date_fin}}" name="date_fin">
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
