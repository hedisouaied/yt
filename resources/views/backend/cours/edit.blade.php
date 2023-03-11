@extends('backend.layouts.master')


@section('content')


<div id="wrapper">
    <div class="main-content">
        <div class="row small-spacing">
            <div class="col-xs-9">
                <div class="box-content card white">
                    <h4 class="box-title">Modifier cours</h4>
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
                        <form action="{{route('cours.update',$feedback->id)}}" method="POST">
                            @csrf
                            @method('patch')
                            <div class="form-group">
                                <label>Cours</label>
                                <input type="text" class="form-control" value="{{$feedback->title}}" name="title">
                            </div>

                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" id="description" name="description">{{$feedback->description}}</textarea>
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

                            <div class="m-t-20">
                                <label>Prix</label>
                                <div class="input-group">

                                    <div class="input-group-btn"><labe class="btn btn-default">DT</label></div>

                                    <input type="number" class="form-control" name="price" value="{{$feedback->price}}" >

                                </div>
                                <br>
                            </div>

                            <div class="m-t-20">
                                <label>Discount</label>
                                <div class="input-group">

                                    <div class="input-group-btn"><label class="btn btn-default">DT</label></div>

                                    <input type="number" class="form-control" name="discount" value="{{$feedback->discount}}" >

                                </div>
                                <br>
                            </div>

                            <div class="m-t-20">
                                <label>Nb Seances</label>
                                <div class="input-group">

                                    <div class="input-group-btn"><label class="btn btn-default"><i class="fa fa-book" ></i></label></div>

                                    <input type="number" class="form-control" name="nb_seance" value="{{$feedback->nb_seance}}" >

                                </div>
                                <br>
                            </div>

                            <div class="form-group">
                                <label>Langue</label>
                                <input type="text" class="form-control" value="{{$feedback->langue}}" name="langue">
                            </div>


                            <br>

                            <div class="form-group">
                                <label>Date début </label>
                                <input type="date" class="form-control" value="{{$feedback->date_debut}}" name="date_debut">
                            </div>

                            <br>


                            <div class="form-group">
                                <label>Lien Zoom</label>
                                <input type="text" class="form-control" value="{{$feedback->zoom}}" name="zoom">
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
    $('#lfmv').filemanager('video');
</script>
<script>
    $(document).ready(function() {
        $('#description').summernote();
    });
  </script>
@endsection
