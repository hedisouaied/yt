@extends('backend.layouts.master')


@section('content')


<div id="wrapper">
    <div class="main-content">
        <div class="row small-spacing">
            <div class="col-xs-12">
                <div class="box-content card white">
                    <h4 class="box-title">Ajouter vente flash</h4>

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
                        <form action="{{route('vente-flash.store')}}" method="POST">
                            @csrf

                            <div class="form-group margin-bottom-20" id="parent_cat_div">
                                <label for="parent_id">Produits</label>
                                <select class="form-control" name="product_id" required >
                                    @foreach ($products as $product)
                                        <option value="{{$product->id}}" {{old('product_id')==$product->id ? 'selected' : ''}}>{{$product->title}}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="form-group">
                                <label for="exampleInputEmail1">Quantité max pour client <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="quantity_max" value="1" >
                            </div>


                            <div class="form-group">
                                <label for="exampleInputEmail1">Date et temps début <span class="text-danger">*</span></label>
                                <input type="datetime-local" class="form-control" value="{{old('time_debut')}}" name="time_debut">
                            </div>


                            <div class="form-group">
                                <label for="exampleInputEmail1">Date et temps fin <span class="text-danger">*</span></label>
                                <input type="datetime-local" class="form-control" value="{{old('time_fin')}}" name="time_fin">
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
