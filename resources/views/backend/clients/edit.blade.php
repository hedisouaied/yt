@extends('backend.layouts.master')


@section('content')


<div id="wrapper">
    <div class="main-content">
        <div class="row small-spacing">
            <div class="col-xs-9">
                <div class="box-content card white">
                    <h4 class="box-title">Edit clients</h4>
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
                        <form action="{{route('clients.update',$user->id)}}" method="POST">
                            @csrf
                            @method('patch')
                            <div class="form-group">
                                <label for="exampleInputEmail1">Full name</label>
                                <input type="text" class="form-control" placeholder="Full name" value="{{$user->full_name}}" name="full_name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="text" class="form-control" placeholder="Email" value="{{$user->email}}" name="email" >
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Phone</label>
                                <input type="text" class="form-control" placeholder="Phone" value="{{$user->phone}}" name="phone">
                            </div>


                            <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">Update</button>
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
