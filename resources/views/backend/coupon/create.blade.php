@extends('backend.layouts.master')


@section('content')


<div id="wrapper">
    <div class="main-content">
        <div class="row small-spacing">
            <div class="col-xs-9">
                <div class="box-content card white">
                    <h4 class="box-title">Ajouter Coupon</h4>
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
                        <form action="{{route('coupon.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf


                            <div class="form-group">
                                <label for="exampleInputEmail1">Coupon code</label>
                                <input type="text" class="form-control" value="{{old('code_coupon')}}" name="code_coupon">
                                @error('code_coupon')
                                    <p class="text-danger">Code coupon déja existé</p>
                                @enderror

                            </div>

                            <div>

                                <label for="exampleInputEmail1">
                                    Discount (-%)
                                </label>

                                <div class="input-group">

                                    <div class="input-group-btn">
                                        <label for="ig-3" class="btn btn-default">-<i class="fa fa-percent"></i></label>
                                    </div>
                                    <input type="number" max="100" min="0" id="ig-3" class="form-control" name="discount" required value="{{old('discount')}}" >
                                </div>

                                <br>

                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Date d'expiration</label>
                                <input class="form-control" type="date" name="expiration" value="{{old('expiration')}}" required  />
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



@endsection
