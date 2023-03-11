@extends('backend.layouts.master')


@section('content')


<div id="wrapper">
    <div class="main-content">
        <div class="row small-spacing">
            <div class="col-xs-9">
                <div class="box-content card white">
                    <h4 class="box-title">Ajouter sous gamme</h4>
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
                        <form action="{{route('sous_gamme.store')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nom</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nom" value="{{old('title')}}" name="title">
                            </div>


                            <div class="form-group margin-bottom-20">
                                <label for="exampleInputEmail1">Categories</label>
                                <select id="cat_id" class="form-control" name="cat_id" required>
                                    <option value="">--Categorie Parente--</option>
                                    @foreach (\App\Models\Category::where('is_parent',1)->get() as $cat)
                                    <option value="{{$cat->id}}" {{old('cat_id')==$cat->id? 'selected' : ''}}>{{$cat->title}}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div id="child_cat_div" class="form-group margin-bottom-20 display-none">
                                <label for="exampleInputEmail1">Sous-Catégories</label>
                                <select id="child_cat_id" class="form-control" name="child_cat_id" required>

                                </select>
                            </div>

                            <div id="gamme_div" class="form-group margin-bottom-20 display-none">
                                <label for="exampleInputEmail1">Gamme</label>
                                <select id="gamme_id" class="form-control" name="gamme_id" >

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

  <script>

        $("#cat_id").change(function(){


                var cat_id=$(this).val();


                if(cat_id != null){
                    //alert(cat_id);
                    $.ajax({
                        url:"/admin/localisation/"+cat_id+"/child",
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
                        url:"/admin/gamme/"+child_cat_id+"/child",
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

                        }
                    });
                }
            });





</script>
@endsection
