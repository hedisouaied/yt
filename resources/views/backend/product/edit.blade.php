@extends('backend.layouts.master')


@section('content')


<div id="wrapper">
    <div class="main-content">
        <div class="row small-spacing">
            <div class="col-xs-9">
                <div class="box-content card white">
                    <h4 class="box-title">Modifier produit</h4>

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
                        <form action="{{route('product.update',$product->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <div class="form-group">
                                <label>Nom de produit <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" value="{{$product->title}}" name="title">
                            </div>


                            <div class="form-group">
                                <label for="exampleInputEmail1">Photo(s) </label>
                                <input type="file" name="newphoto[]" multiple accept="image/*" class="dropify" >
                            </div>

                            @php
                                $ph = explode(',',$product->photo);

                            @endphp
                            @foreach ($ph as $p)
                                <img src="{{$p}}" style="margin-top:15px;margin-bottom:15px;height:100px;" />
                            @endforeach


                            <div class="form-group margin-bottom-20">
                                <label for="exampleInputEmail1">Marque (Brand/Laboratoire)</label>
                                <select class="form-control" name="marque_id">
                                    <option value="0">--Il n'a pas une marque --</option>
                                    @foreach (\App\Models\Partenaire::orderby('title','ASC')->get() as $cat)
                                    <option value="{{$cat->id}}" {{$product->marque_id==$cat->id ? 'selected' : ''}}>{{$cat->title}}</option>
                                    @endforeach

                                </select>
                            </div>




                            <div class="form-group margin-bottom-20">
                                <label for="exampleInputEmail1">Grand Catégories</label>
                                <select id="cat_id" class="form-control" name="grand_cat_id">
                                    <option value="0">--Grand Catégories--</option>
                                    @foreach (\App\Models\Grandcategory::get() as $cat)
                                    <option value="{{$cat->id}}" {{$product->grand_cat_id==$cat->id ? 'selected' : ''}}>{{$cat->title}}</option>
                                    @endforeach

                                </select>
                            </div>



                            <div id="child_cat_div" class="form-group margin-bottom-20 display-none">
                                <label for="exampleInputEmail1">Sous-Catégories</label>
                                <select id="child_cat_id" class="form-control" name="cat_id">

                                </select>
                            </div>
                            <div id="gamme_div" class="form-group margin-bottom-20 display-none">
                                <label for="exampleInputEmail1">Sous sous catégorie</label>
                                <select id="gamme_id" class="form-control" name="child_cat_id" >

                                </select>
                            </div>


                            <div class="m-t-20">
                                <label for="exampleInputEmail1">Description</label>
                                <textarea name="description" id="description" class="form-control" maxlength="225" rows="2" placeholder="...">{{$product->description}}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Prix (TND)<span class="text-danger">*</span></label>
                                <input type="number" class="form-control" value="{{$product->price}}" name="price" required step="0.001" >
                            </div>

                            <div class="row">

                                <div class="col-md-6" >
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Discount <span class="text-danger">(-x)TND</span></label>
                                        <input type="number" class="form-control" value="{{$product->discount}}" name="discount" step="0.001" required  >
                                    </div>
                                </div>

                                <div class="col-md-6" >
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Date d'expiration de Discount</label>
                                        <input type="date" class="form-control" name="expiration_discount" required value="{{$product->expiration_discount}}"  >
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Stock</label>
                                <input type="number" class="form-control" value="{{$product->stock}}" name="stock" required  >
                            </div>


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


<script>
    $(document).ready(function() {
        $('#description').summernote();
    });
</script>

  <script>
      var child_cat_id = {{$product->cat_id}};
      $('#cat_id').change(function(){
        var cat_id=$(this).val();
       // alert(cat_id);
        if(cat_id != null){
            $.ajax({
                url: "/admin/souscategory/"+cat_id+"/child",
                type: "POST",
                data:{
                    _token:"{{csrf_token()}}",
                    cat_id:cat_id
                },
                success:function(response){
                    var html_option="";
                    if(response.status){
                        $('#child_cat_div').removeClass('display-none');
                        $.each(response.data,function(id,title){
                            html_option +="<option value='"+id+"' "+(child_cat_id==id ? 'selected' : '')+">"+title+"</option>"
                        });
                    }
                    else{
                        $('#child_cat_div').addClass('display-none');
                    }
                    $('#child_cat_id').html(html_option);
                    $('#child_cat_id').change();
                }
            });
        }


      });
      if(child_cat_id !=null){
         $('#cat_id').change();
     }
</script>


<script>
var gamme_id = {{$product->child_cat_id}};
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
                                    html_option += "<option value='"+id+"' "+(gamme_id==id ? 'selected' : '')+" >"+title+"</option>";
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



@endsection
