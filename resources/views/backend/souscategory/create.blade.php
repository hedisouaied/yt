@extends('backend.layouts.master')


@section('content')


<div id="wrapper">
    <div class="main-content">
        <div class="row small-spacing">
            <div class="col-xs-9">
                <div class="box-content card white">
                    <h4 class="box-title">Ajouter sous sous-catégorie</h4>
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
                        <form action="{{route('souscategory.store')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nom sous sous-catégorie <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" value="{{old('title')}}" name="title" required >
                            </div>

                            <div class="form-group margin-bottom-20 " id="parent_cat_div">
                                <label>Selectionner grand categorie</label>
                                <select class="form-control" id="cat_id" name="grand_cat_id" required >
                                    <option value="0">Selectionner grand categorie</option>
                                    @foreach ($parent_cats as $pcats)
                                        <option value="{{$pcats->id}}" {{old('parent_id')==$pcats->id ? 'selected' : ''}}>{{$pcats->title}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div id="child_cat_div" class="form-group margin-bottom-20 display-none">
                                <label for="exampleInputEmail1">Selectionner grand Sous-Catégories</label>
                                <select id="child_cat_id" class="form-control" name="sous_cat_id" required>

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
@endsection
