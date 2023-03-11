@extends('backend.layouts.master')


@section('content')


<div id="wrapper">
    <div class="main-content">
        <div class="row small-spacing">
            <div class="col-xs-9">
                <div class="box-content card white">
                    <h4 class="box-title">Ajouter marque</h4>
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
                        <form action="{{route('partenaire.store')}}" method="POST" enctype="multipart/form-data" >
                            @csrf

                            <div class="form-group">
                                <label>Titre</label>
                                <input type="text" class="form-control" value="{{old('title')}}" name="title">
                            </div>


                            <div class="m-t-20">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Photo <span class="text-danger">*</span></label>
                                    <input type="file" name="photo" accept="image/*" class="dropify" required>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-md-6" >
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Discount <span class="text-danger">(-x%)</span></label>
                                        <input type="number" class="form-control" value="0" name="discount"  required max="100" min="0"  >
                                    </div>
                                </div>

                                <div class="col-md-6" >
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Date d'expiration de Discount</label>
                                        <input type="date" class="form-control" name="expiration_discount" required value="{{date('Y-m-d')}}"  >
                                    </div>
                                </div>

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
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script>
    $('#lfm').filemanager('image');
</script>
@endsection
