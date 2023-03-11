@extends('backend.layouts.master')


@section('content')


<div id="wrapper">
    <div class="main-content">
        <div class="row small-spacing">
            <div class="col-xs-9">
                <div class="box-content card white">
                    <h4 class="box-title">Ajouter moyen industriel</h4>
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
                        <form action="{{route('moyen.store')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Moyen industriel</label>
                                <input type="text" class="form-control" value="{{old('title')}}" name="title">
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea id="description" class="form-control" name="description">{{old('description')}}</textarea>
                            </div>


                            <div class="m-t-20">
                                <label>Photo de moyen industriel</label>

                                <div class="input-group">
                                    <span class="input-group-btn">
                                      <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                        <i class="fa fa-picture-o"></i> Choose
                                      </a>
                                    </span>
                                    <input id="thumbnail" class="form-control" type="text" name="photo">
                                  </div>
                                <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                            </div>

<br>

<div class="m-t-20">
    <label>Extra Photos</label>

    <div class="input-group">
        <span class="input-group-btn">
          <a id="lfmgalerie" data-input="thumbnailgalerie" data-preview="holdergalerie" class="btn btn-primary">
            <i class="fa fa-picture-o"></i> Choose
          </a>
        </span>
        <input id="thumbnailgalerie" class="form-control" type="text" name="galerie">
      </div>
    <div id="holdergalerie" style="margin-top:15px;max-height:100px;"></div>
</div>


                            <div class="form-group margin-bottom-20">
                                <label for="exampleInputEmail1">Status</label>
                                <select class="form-control" name="status">
                                        <option value="active" {{old('status')=='active' ? 'selected' : ''}}>Active</option>
                                        <option value="inactive" {{old('status')=='inactive' ? 'selected' : ''}}>Inactive</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">Ajouter</button>
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
