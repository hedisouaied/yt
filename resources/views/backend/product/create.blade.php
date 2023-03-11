@extends('backend.layouts.master')


@section('content')


<div id="wrapper">
    <div class="main-content">
        <div class="row small-spacing">
            <div class="col-xs-9">
                <div class="box-content card white">
                    <h4 class="box-title">Ajouter produit</h4>
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
                        <form action="{{route('product.store')}}" method="POST" enctype="multipart/form-data" >
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nom de produit <span class="text-danger">*</span></label>
                                <input type="text" class="form-control"  value="{{old('title')}}" name="title">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Photo(s) <span class="text-danger">*</span></label>
                                <input type="file" name="photo[]" multiple accept="image/*" class="dropify" required >
                            </div>


                            <div class="form-group margin-bottom-20">
                                <label for="exampleInputEmail1">Marque (Brand/Laboratoire)</label>
                                <select class="form-control" name="marque_id" id="marque_id" required>
                                    <option value="0">--Il n'a pas une marque --</option>
                                    @foreach (\App\Models\Partenaire::orderby('title','ASC')->get() as $cat)
                                    <option

                                    value="{{$cat->id}}" {{old('marque_id')== $cat->id ? 'selected' : ''}}
                                    @if ($cat->discount !== 0)
                                    data-discount="yes"
                                    @else
                                    data-discount="no"
                                    @endif

                                    >
                                        {{$cat->title}}
                                        @if ($cat->discount !== 0)
                                            (Cette marque a -{{$cat->discount}}% réduction sur toutes les produits ajoutés)
                                        @endif
                                    </option>
                                    @endforeach

                                </select>
                            </div>



                            <div class="form-group margin-bottom-20">
                                <label for="exampleInputEmail1">Grand Catégories</label>
                                <select id="cat_id" class="form-control" name="grand_cat_id" required>
                                    <option value="0">--Grand Catégories--</option>
                                    @foreach (\App\Models\Grandcategory::get() as $cat)
                                    <option value="{{$cat->id}}" {{old('cat_id')==$cat->id? 'selected' : ''}}>{{$cat->title}}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div id="child_cat_div" class="form-group margin-bottom-20 display-none">
                                <label for="exampleInputEmail1">Sous-Catégories</label>
                                <select id="child_cat_id" class="form-control" name="cat_id" required>

                                </select>
                            </div>

                            <div id="gamme_div" class="form-group margin-bottom-20 display-none">
                                <label for="exampleInputEmail1">Sous sous catégorie</label>
                                <select id="gamme_id" class="form-control" name="child_cat_id" >
                                </select>
                            </div>




                            <div class="m-t-20">
                                <label for="exampleInputEmail1">Description</label>

                                <textarea name="description" id="description" class="form-control" maxlength="225" rows="2" placeholder="...">{{old('description')}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Prix (TND)<span class="text-danger">*</span></label>
                                <input type="number" class="form-control" value="{{old('price')}}" name="price" required step="0.001" >
                            </div>
                            <div class="row" id='discount_date_dis' >

                                <div class="col-md-6" >
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Discount <span class="text-danger">(-x)TND</span></label>
                                        <input type="number" class="form-control" value="0" name="discount"  required step="0.001"   >
                                    </div>
                                </div>

                                <div class="col-md-6" >
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Date d'expiration de Discount</label>
                                        <input type="date" class="form-control" name="expiration_discount" required value="{{date('Y-m-d')}}"  >
                                    </div>
                                </div>

                            </div>


                            <div class="form-group">
                                <label for="exampleInputEmail1">Stock</label>
                                <input type="number" class="form-control" value="0" name="stock"  required >
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
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')

<script>
    $(document).ready(function() {
        $('#description').summernote();
    });
  </script>





<script>
$(function() {
    $("#marque_id").change(function(){

        //alert($('option:selected', this).attr('data-discount'));

        if(($('option:selected', this).attr('data-discount'))== "yes"){
            $('#discount_date_dis').html('');
        }else{
            $('#discount_date_dis').html('<div class="col-md-6" ><div class="form-group"><label for="exampleInputEmail1">Discount <span class="text-danger">(-x)TND</span></label><input type="number" class="form-control" value="0" name="discount"  required step="0.001"   ></div></div><div class="col-md-6" ><div class="form-group"><label for="exampleInputEmail1">Date d\'expiration de Discount</label><input type="date" class="form-control" name="expiration_discount" required value="{{date('Y-m-d')}}"  ></div></div>');
        }


    });
});




</script>



















<script>

    $("#cat_id").change(function(){


            var cat_id=$(this).val();


            if(cat_id != null){
                //alert(cat_id);
                $.ajax({
                    url:"/admin/souscategory/"+cat_id+"/child",
                    type:"POST",
                    data:{
                        _token:"{{csrf_token()}}",
                        cat_id:cat_id
                    },
                    success:function(response){
                        var html_option = "";
                        if(response.status){
                        //alert(cat_id);
                        $('#child_cat_div').removeClass('display-none');
                        $.each(response.data,function(id,title){
                            html_option += "<option value='"+id+"'>"+title+"</option>";
                        });

                        }else{
                            $('#child_cat_div').addClass('display-none');
                        }
                        $('#child_cat_id').html(html_option);
                        $('#child_cat_id').change();
                    }
                });
            }
    });

    if(child_cat_id != null){
        $('#cat_id').change();
    }

</script>

<script>

    $("#child_cat_id").change(function(){


            var child_cat_id=$(this).val();


                if(child_cat_id != null){
                    //alert(cat_id);
                    $.ajax({
                        url:"/admin/soussouscategory/"+child_cat_id+"/child",
                        type:"POST",
                        data:{
                            _token:"{{csrf_token()}}",
                            child_cat_id:child_cat_id
                        },
                        success:function(response){
                            var html_option = "";
                            if(response.status){
                        //alert(cat_id);
                            $('#gamme_div').removeClass('display-none');
                            $.each(response.data,function(id,title){
                                html_option += "<option value='"+id+"'>"+title+"</option>";
                            });
                            }else{
                                $('#gamme_div').addClass('display-none');

                            }
                            $('#gamme_id').html(html_option);
                            $('#gamme_id').change();

                        }
                    });
                }
            });





</script>
<script>

    $("#gamme_id").change(function(){


            var child_cat_id=$(this).val();


                if(child_cat_id != null){
                    //alert(cat_id);
                    $.ajax({
                        url:"/admin/sousgamme/"+child_cat_id+"/child",
                        type:"POST",
                        data:{
                            _token:"{{csrf_token()}}",
                            child_cat_id:child_cat_id
                        },
                        success:function(response){
                            var html_option = "";
                            if(response.status){
                        //alert(cat_id);
                            $('#sous_gamme_div').removeClass('display-none');
                            $.each(response.data,function(id,title){
                                html_option += "<option value='"+id+"'>"+title+"</option>";
                            });
                            }else{
                                $('#sous_gamme_div').addClass('display-none');

                            }
                            $('#sous_gamme_id').html(html_option);

                        }
                    });
                }
            });





</script>

@endsection
