@extends('backend.layouts.master')


@section('content')


<div id="wrapper">
    <div class="main-content">
        <div class="row small-spacing">
            <div class="col-xs-9">
                <div class="box-content card white">
                    <h4 class="box-title">Modifier Admin</h4>
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
                        <form action="{{route('user.update',$user->id)}}" method="POST">
                            @csrf
                            @method('patch')
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nom d'admin</label>
                                <input type="text" class="form-control" value="{{$user->full_name}}" name="full_name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="text" class="form-control" value="{{$user->email}}" name="email" >
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Téléphone</label>
                                <input type="text" class="form-control" value="{{$user->phone}}" name="phone">
                            </div>


                            <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">Modifier</button>
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

@endsection
