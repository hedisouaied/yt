@extends('backend.layouts.master')


@section('content')


<div id="wrapper">
    <div class="main-content">
        <div class="row small-spacing">
            <div class="col-xs-9">
                <div class="box-content card white">
                    <h4 class="box-title">Modifier service</h4>
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
                        <form action="{{route('service.update',$blog->id)}}" method="POST">
                            @csrf
                            @method('patch')
                            <div class="form-group">
                                <label>Titre</label>
                                <input type="text" class="form-control" placeholder="Titre" value="{{$blog->title}}" name="title">
                            </div>

                            <div class="m-t-20">
                                <label for="exampleInputEmail1">Description</label>

                                <textarea name="description" id="description" class="form-control" maxlength="225" rows="2" placeholder="Write some text....">{{$blog->description}}</textarea>
                            </div>
                            <div class="m-t-20">
                                <label>Photo</label>

                                <div class="input-group">
                                    <span class="input-group-btn">
                                      <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                        <i class="fa fa-picture-o"></i> Choose
                                      </a>
                                    </span>
                                    <input id="thumbnail" class="form-control" type="text" name="photo" value="{{$blog->photo}}">
                                  </div>
                                <div id="holder" style="margin-top:15px;max-height:100px;">
                                    <img src="{{$blog->photo}}" style="margin-top:15px;max-height:100px;" />
                                </div>

                            </div>
                            <br>
                            <div class="m-t-20">
                                <label>Document de service (optionnel)</label>

                                <div class="input-group">
                                    <span class="input-group-btn">
                                      <a id="lfmdoc" data-input="thumbnaildoc" data-preview="holderdoc" class="btn btn-primary">
                                        <i class="fa fa-picture-o"></i> Choose
                                      </a>
                                    </span>
                                    <input id="thumbnaildoc" class="form-control" type="text" name="doc" value="{{$blog->doc}}">
                                  </div>
                                <div id="holderdoc" style="margin-top:15px;max-height:100px;">
                                    @if ($blog->doc != null)
                                    <a href="{{$blog->doc}}" target="_blank" style="margin-top:15px;max-height:100px;font-size:25px;" ><i class="fa fa-file"></i></a>
                                    @endif

                                </div>

                            </div>

                        <br>
                            <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">Enregistrer</button>
                        </form>
                    </div>
                    <!-- /.card-content -->
                </div>
                <!-- /.box-content -->
            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.main-content -->
</div>

@endsection
@section('scripts')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script>
    $('#lfm').filemanager('image');
</script>
<script>
    $('#lfmdoc').filemanager('file');
</script>
<script>
    $(document).ready(function() {
        $('#description').summernote();
    });
  </script>
@endsection
