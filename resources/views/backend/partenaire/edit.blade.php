@extends('backend.layouts.master')


@section('content')


<div id="wrapper">
    <div class="main-content">
        <div class="row small-spacing">
            <div class="col-xs-9">
                <div class="box-content card white">
                    <h4 class="box-title">Modifier marque</h4>
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
                        <form action="{{route('partenaire.update',$blog->id)}}" method="POST" enctype="multipart/form-data" >
                            @csrf
                            @method('patch')
                            <div class="form-group">
                                <label>Titre</label>
                                <input type="text" class="form-control" value="{{$blog->title}}" name="title">
                            </div>



                            <div class="form-group">
                                <label for="exampleInputEmail1">Photo </label>
                                <input type="file" name="photo" accept="image/*" class="dropify" >
                                <img src="{{$blog->photo}}" style="height: 150px;margin-top:15px;margin-bottom:15px;" >
                            </div>
                            <div class="row">

                                <div class="col-md-6" >
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Discount <span class="text-danger">(-x)%</span></label>
                                        <input type="number" class="form-control" value="{{$blog->discount}}" name="discount" step="0.001" required  >
                                    </div>
                                </div>

                                <div class="col-md-6" >
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Date d'expiration de Discount</label>
                                        <input type="date" class="form-control" name="expiration_discount" required value="{{$blog->expiration_discount}}"  >
                                    </div>
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


@endsection
