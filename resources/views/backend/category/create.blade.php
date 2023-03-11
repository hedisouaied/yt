@extends('backend.layouts.master')


@section('content')


<div id="wrapper">
    <div class="main-content">
        <div class="row small-spacing">
            <div class="col-xs-12">
                <div class="box-content card white">
                    <h4 class="box-title">Ajouter sous catégorie</h4>

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
                        <form action="{{route('category.store')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nom <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" value="{{old('title')}}" name="title">
                            </div>


                            <div class="form-group margin-bottom-20" id="parent_cat_div">
                                <label for="parent_id">Selectionner grand categorie</label>
                                <select class="form-control" name="grand_cat_id" required >
                                    <option value="">Selectionner grand categorie</option>
                                    @foreach ($parent_cats as $pcats)
                                        <option value="{{$pcats->id}}" {{old('parent_id')==$pcats->id ? 'selected' : ''}}>{{$pcats->title}}</option>
                                    @endforeach
                                </select>
                            </div>



                            <div class="form-group margin-bottom-20">
                                <label for="status">Status</label>
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

@endsection
