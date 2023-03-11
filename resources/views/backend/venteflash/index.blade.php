@extends('backend.layouts.master')


@section('content')


<div class="main-content">
<div class="col-lg-12">
    @include('backend.layouts.notification')
</div>
<h4 class="box-title"><a class="btn btn-secondary" href="{{route('vente-flash.create')}}" ><i class="fa fa-plus-circle"></i> Ajouter Vente flash</a></h4>
    <table class="table table-striped table-bordered display" style="width:100%">
        <thead>
            <tr>
                <th>S.N</th>
                <th>Produit en vente flash</th>
                <th>Début</th>
                <th>Fin</th>
                <th>état</th>
                <th>quantité max par personne</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($flashs as $item)



                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>
                        @php
                            $photos = explode(',',(\App\Models\Product::where('id',$item->product_id)->value('photo')));
                        @endphp
                        <p>{{\App\Models\Product::where('id',$item->product_id)->value('title')}}</p>
                        <p><img src="{{$photos[0]}}" style="width: 100px;" ></p>
                    </td>
                    <td>{{$item->time_debut}}</td>
                    <td>{{$item->time_fin}}</td>
                    <td>
                    @php
                        $start = new DateTime($item->time_debut);
                        $end = new DateTime($item->time_fin);
                        $now = new DateTime();
                    @endphp

                    @if ($now < $start)
                        <span class="text-info" >non-commencer</span>
                    @elseif ($now >= $start && $now <= $end)
                        <span class="text-warning" >en cours</span>
                    @else
                        <span class="text-danger" >expiré</span>
                    @endif

                    </td>

                    <td>{{$item->quantity_max}}</td>
                    <td>
                        <div class="switch success">

                           <input name="toogle" value="{{$item->id}}" type="checkbox" {{$item->status=='active' ? 'checked': ''}} id="switch-{{$item->id}}">
                            <label for="switch-{{$item->id}}">active</label>
                        </div>
                    </td>
                    <td>

                        <form action="{{route('vente-flash.destroy',$item->id)}}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="button" data-id="{{$item->id}}" class="float-left dltBtn btn btn-danger btn-sm waves-effect waves-light" style="color:#fff;background-color:#000;"><i class="fa fa-trash" aria-hidden="true"></i></button>
                        </form>

                        <a class="float-left" href="{{route('vente-flash.edit',$item->id)}}"><i class="btn btn-warning btn-sm waves-effect waves-light fas fa-pencil-alt" aria-hidden="true"></i></a>
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
                    swal("Poof! supprimé !", {
                    icon: "success",
                    });
                } else {
                    swal("N'est pas supprimé !");
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
                url:"{{route('venteflash.status')}}",
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
