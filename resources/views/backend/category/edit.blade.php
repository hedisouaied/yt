@extends('backend.layouts.master')


@section('content')


<div id="wrapper">
    <div class="main-content">
        <div class="row small-spacing">
            <div class="col-xs-12">
                <div class="box-content card white">
                    <h4 class="box-title">Modifier sous catégorie</h4>
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
                        <form action="{{route('category.update',$category->id)}}" method="POST">
                            @csrf
                            @method('patch')

                            <div class="form-group">
                                <label for="exampleInputEmail1">Nom <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" value="{{$category->title}}" name="title">
                            </div>


                            <div class="form-group margin-bottom-20" id="parent_cat_div">
                                <label for="parent_id">Grand catégorie</label>
                                <select class="form-control" name="grand_cat_id" required >
                                        <option value="">-- Selectionner grand catégorie ---</option>
                                    @foreach ($parent_cats as $pcats)
                                        <option value="{{$pcats->id}}" {{$pcats->id==$category->grand_cat_id ? 'selected' : ''}}>{{$pcats->title}}</option>
                                    @endforeach
                                </select>
                            </div>




                            <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">Enregistrer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')


@endsection
