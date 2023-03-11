@extends('backend.layouts.master')


@section('content')


<div class="main-content">
<div class="col-lg-12">
    @include('backend.layouts.notification')
</div>
<h4 class="box-title"><a class="btn btn-secondary" href="{{route('partenaire.create')}}" ><i class="fa fa-plus-circle"></i> Ajouter marque</a></h4>
    <table class="table table-striped table-bordered display" style="width:100%">
        <thead>
            <tr>
                <th>S.N</th>
                <th>Marque</th>
                <th>Photo</th>
                <th>Discount (-%)</th>
                <th>Date expiration discount</th>
                <th>Nb de produits</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($feedback as $item)



                <tr>
                    <td>{{$loop->iteration}}</td>

                    <td>{{$item->title}}</td>
                    <td>
                        <img src="{{$item->photo}}" alt="" style="width:100px;" />
                    </td>

                    <td>-{{$item->discount}}%</td>
                    <td>{{$item->expiration_discount}}
                    @php
                        if(strtotime($item->expiration_discount) <= strtotime(date('y-m-d')) ){
                            echo " (expiré)";
                        }
                    @endphp
                    </td>
                    <td>
                        <span class="badge badge-success" style="background: rgb(11, 141, 17);margin-left:5px;">{{count(\App\Models\Product::where('marque_id',$item->id)->get())}}</span>
                    </td>
                    <td>
                        <div class="switch success">
                           <input name="toogle" value="{{$item->id}}" type="checkbox" {{$item->status=='active' ? 'checked': ''}} id="switch-{{$item->id}}">
                           <label for="switch-{{$item->id}}">active</label>
                        </div>
                    </td>

                    <td>
                        <form action="{{route('partenaire.destroy',$item->id)}}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="button" data-id="{{$item->id}}" class="float-left dltBtn btn btn-danger btn-sm waves-effect waves-light" style="color:#fff;background-color:#000;"><i class="fa fa-trash" aria-hidden="true"></i></button>
                        </form>
                        <a class="float-left" href="{{route('partenaire.edit',$item->id)}}"><i class="btn btn-warning btn-sm waves-effect waves-light fas fa-pencil-alt" aria-hidden="true"></i></a>
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
                text: "Une fois supprimé, vous ne pourrez pas récupérer !",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                    form.submit();
                    swal("Poof! supprimée!", {
                    icon: "success",
                    });
                } else {
                    swal("Non supprimée!");
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
                url:"{{route('partenaire.status')}}",
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
