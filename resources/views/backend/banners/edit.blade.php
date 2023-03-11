@extends('backend.layouts.master')

@section('content')

<div id="wrapper">
    <div class="main-content">
        <div class="row small-spacing">
            <div class="col-xs-9">
                <div class="box-content card white">
                    <h4 class="box-title">Modifier Bannière</h4>

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
                        <form action="{{route('banner.update',$banner->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('patch')

                            <div class="form-group">
                                <label for="exampleInputEmail1">Titre</label>
                                <input type="text" class="form-control" value="{{$banner->title}}" name="title">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Photo </label>
                                <input type="file" name="photo" accept="image/*" class="dropify" >
                                <img src="{{$banner->photo}}" style="height: 150px;margin-top:15px;margin-bottom:15px;" >
                            </div>

                            <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">Modifier</button>

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
@endsection
