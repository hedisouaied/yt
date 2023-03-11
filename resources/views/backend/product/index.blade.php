@extends('backend.layouts.master')


@section('content')

<style>
    .modal-backdrop {
        position: fixed;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        z-index: 0;
        background-color: #000;
    }
</style>
<div class="main-content">
<div class="col-lg-12">
    @include('backend.layouts.notification')
</div>
<h4 class="box-title"><a class="btn btn-secondary" href="{{route('product.create')}}" ><i class="fa fa-plus-circle"></i> Ajouter produit</a></h4>
    <table class="table table-striped table-bordered display" style="width:100%">
        <thead>
            <tr>
                <th>S.N</th>
                <th>Produit</th>
                <th>Stock</th>
                <th>Photo</th>
                <th>Catégorie</th>
                <th>Marque</th>
                <th>Prix</th>
                <th>Offre quotidien</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $item)

                    @php
                    $photo= explode(',',$item->photo);
                    @endphp

                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$item->title}}</td>
                    <td>
                        @if ($item->stock == 0)
                            <span class="badge badge-danger" style="background: rgb(253, 24, 24);margin-left:5px;" >OUT OF STOCK</span>
                        @else
                        {{$item->stock}}
                        @endif

                    </td>
                    <td><img src="{{$photo[0]}}" alt="{{$item->title}}" style="width:100px;" /></td>
                    <td>
                        {{\App\Models\Grandcategory::where('id',$item->grand_cat_id)->value('title')}} -> {{\App\Models\Category::where('id',$item->cat_id)->value('title')}} -> {{\App\Models\Souscategory::where('id',$item->child_cat_id)->value('title')}}

                    </td>
                    <td>
                        @if ($item->marque_id == 0)
                            -
                        @else
                        <span class="badge badge-success" style="background: rgb(11, 141, 17);margin-left:5px;" >{{\App\Models\Partenaire::where('id',$item->marque_id)->value('title')}}</span>
                        @endif
                    </td>
                    <td>
                        @if ($item->discount == 0)
                            <span class="badge badge-danger" >{{number_format($item->price,3)}} TND</span>
                        @else
                        <del class="badge badge-danger" >{{number_format($item->price,3)}} TND</del><span class="badge badge-success" style="background: red;margin-left:5px;" >{{number_format(($item->price-$item->discount),3)}} TND</span>
                        @endif
                    </td>


                    <td>
                        @if ($item->discount == 0)

                        @else
                        <div class="switch info">

                           <input name="toogle_offre" value="{{$item->id}}" type="checkbox" {{$item->offre=='active' ? 'checked': ''}} id="switchoffre-{{$item->id}}">
                            <label for="switchoffre-{{$item->id}}">Affiché</label>
                        </div>
                        @endif
                    </td>


                    <td>
                        <div class="switch success">

                           <input name="toogle" value="{{$item->id}}" type="checkbox" {{$item->status=='active' ? 'checked': ''}} id="switch-{{$item->id}}">
                            <label for="switch-{{$item->id}}">active</label>
                        </div>
                    </td>
                    <td>

                    <form action="{{route('product.destroy',$item->id)}}" method="POST">
                        @csrf
                        @method('delete')
                        <button type="button" data-id="{{$item->id}}" class="float-left dltBtn btn btn-danger btn-sm waves-effect waves-light" style="color:#fff;background-color:#000;"><i class="fa fa-trash" aria-hidden="true"></i></button>
                    </form>


                        <a class="float-left" href="{{route('product.edit',$item->id)}}"><i class="btn btn-warning btn-sm waves-effect waves-light fas fa-pencil-alt" aria-hidden="true"></i></a>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection

@section('scripts')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.dltBtn').click(function(e){
            var form=$(this).closest('form');
            var dataID=$(this).data('id');
            e.preventDefault();

            swal({
                title: "Êtes-vous sûr?",
                text: "Une fois supprimé, vous ne pourrez pas récupérer!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                    form.submit();
                    swal("Poof! Bien supprimé!", {
                    icon: "success",
                    });
                } else {
                    swal(" n'est pas supprimé!");
                }
                });
        });
</script>

    <script>
        $('input[name=toogle]').change(function(){
            var mode = $(this).prop('checked');
            var id = $(this).val();
            //alert(id);
            $.ajax({
                url:"{{route('product.status')}}",
                type:"POST",
                data:{
                    _token:'{{csrf_token()}}',
                    mode:mode,
                    id:id,
                },
                success:function(response){
                    if(response.status){
                        alert(response.msg);
                    }
                    else{
                        alert('Please try again!');
                    }
                }
            });
        });
    </script>



<script>
    $('input[name=toogle_offre]').change(function(){
        var mode = $(this).prop('checked');
        var id = $(this).val();
        //alert(id);
        $.ajax({
            url:"{{route('product.offre')}}",
            type:"POST",
            data:{
                _token:'{{csrf_token()}}',
                mode:mode,
                id:id,
            },
            success:function(response){
                if(response.status){
                    alert(response.msg);
                }
                else{
                    alert('Please try again!');
                }
            }
        });
    });
</script>



@endsection
