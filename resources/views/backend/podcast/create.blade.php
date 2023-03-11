@extends('backend.layouts.master')


@section('content')


<div id="wrapper">
    <div class="main-content">
        <div class="row small-spacing">
            <div class="col-xs-9">
                <div class="box-content card white">
                    <h4 class="box-title">Ajouter podcast</h4>
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
                        <form action="{{route('podcast.store')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Podcast</label>
                                <input type="text" class="form-control" value="{{old('title')}}" name="title">
                            </div>

                            <div class="form-group">
                                <label>Description</label>
                                <textarea id="description" class="form-control" name="description">{{old('description')}}</textarea>
                            </div>

                            <div class="form-group">
                                <label>Radio</label>
                                <input type="text" class="form-control" value="{{old('radio')}}" name="radio">
                            </div>

                            <div class="m-t-20">
                                <label>Photo</label>

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
                                <label>Video</label>

                                <div class="input-group">
                                    <span class="input-group-btn">
                                      <a id="lfmv" data-input="thumbnailv" data-preview="holderv" class="btn btn-primary">
                                        <i class="fa fa-picture-o"></i> Choose
                                      </a>
                                    </span>
                                    <input id="thumbnailv" class="form-control" type="text" name="video">
                                  </div>
                                <div id="holderv" style="margin-top:15px;max-height:100px;"></div>
                            </div>
                            <br>




                            <div class="form-group">
                                <label>Date</label>
                                <input type="date" class="form-control" value="{{old('date')}}" name="date">
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

<script>

    $(".js-example-tokenizer").select2({
        tags: true
    });

</script>

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
