@extends('backend.layouts.master')


@section('content')


<div id="wrapper">
    <div class="main-content">
        <div class="row small-spacing">
            <div class="col-xs-9">
                <div class="box-content card white">
                    <h4 class="box-title">Modifier article</h4>
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
                        <form action="{{route('actualite.update',$blog->id)}}" method="POST" enctype="multipart/form-data" >
                            @csrf
                            @method('patch')
                            <div class="form-group">
                                <label>Titre</label>
                                <input type="text" class="form-control" placeholder="Titre" value="{{$blog->title}}" name="title">
                            </div>

                            <div class="m-t-20">
                                <label for="exampleInputEmail1">Paragraphe</label>

                                <textarea name="description" id="description" class="form-control" maxlength="225" rows="2" placeholder="...">{{$blog->description}}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Photo </label>
                                <input type="file" name="photo" accept="image/*" class="dropify" >
                                <img src="{{$blog->photo}}" style="height: 150px;margin-top:15px;margin-bottom:15px;" >
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
    $(document).ready(function() {
        $('#description').summernote();
    });
  </script>
@endsection
