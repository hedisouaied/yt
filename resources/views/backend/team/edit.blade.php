@extends('backend.layouts.master')


@section('content')


<div id="wrapper">
    <div class="main-content">
        <div class="row small-spacing">
            <div class="col-xs-9">
                <div class="box-content card white">
                    <h4 class="box-title">Modifier Membre</h4>
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
                        <form action="{{route('equipe.update',$team->id)}}" method="POST">
                            @csrf
                            @method('patch')
                            <div class="form-group">
                                <label>Nom et Prénom</label>
                                <input type="text" class="form-control" placeholder="Nom et Prénom" value="{{$team->title}}" name="title">
                            </div>

                            <div class="form-group">
                                <label>Poste</label>
                                <input type="text" class="form-control" placeholder="Poste" value="{{$team->post}}" name="post">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" placeholder="Email" value="{{$team->email}}" name="email">
                            </div>
                            <div class="form-group">
                                <label>Télephone</label>
                                <input type="text" class="form-control" placeholder="+33 9853 324 378" value="{{$team->phone}}" name="phone">
                            </div>
                            <div class="form-group">
                                <label>Compte facebook</label>
                                <input type="text" class="form-control" placeholder="https://www.facebook.com/...." value="{{$team->fb}}" name="fb">
                            </div>
                            <div class="m-t-20">
                                <label>Photo</label>

                                <div class="input-group">
                                    <span class="input-group-btn">
                                      <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                        <i class="fa fa-picture-o"></i> Choose
                                      </a>
                                    </span>
                                    <input id="thumbnail" class="form-control" type="text" name="photo" value="{{$team->photo}}">
                                  </div>
                                <div id="holder" style="margin-top:15px;max-height:100px;">
                                    <img src="{{$team->photo}}" style="margin-top:15px;max-height:100px;" />
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
@endsection
