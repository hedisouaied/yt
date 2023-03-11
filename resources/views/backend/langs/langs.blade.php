@extends('backend.layouts.master')


@section('content')


<div class="main-content">
<div class="col-lg-12">
    @include('backend.layouts.notification')
</div>

<h4 class="box-title"><a class="btn btn-secondary" href="{{route('langs.create')}}" ><i class="fa fa-plus-circle"></i> Ajouter Membre</a></h4>
    <table class="table table-striped table-bordered display" style="width:100%">
        <thead>
            <tr>
                <th>S.N</th>
                <th>Code</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>S.N</th>
                <th>Code</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </tfoot>
        <tbody>
            @foreach ($langs as $item)



                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$item->code}}</td>
                    <td>{{$item->name}}</td>

                    <td>

                    <form action="{{route('langs.destroy',$item->id)}}" method="POST">
                        @csrf
                        @method('delete')
                        <button type="button" data-id="{{$item->id}}" class="float-left dltBtn btn btn-danger btn-sm waves-effect waves-light" style="color:#fff;background-color:#000;"><i class="fa fa-trash" aria-hidden="true"></i></button>
                    </form>

                        <a class="float-left" href="{{route('languages.index')}}"><i class="btn btn-warning btn-sm waves-effect waves-light fas fa-pencil-alt" aria-hidden="true"></i></a>
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
                text: "Une fois supprimé, vous ne pourrez pas récupérer ce Témoignage!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                    form.submit();
                    swal("Poof! Votre Témoignage a été supprimée!", {
                    icon: "success",
                    });
                } else {
                    swal("Votre Témoignage n'est pas supprimée!");
                }
                });
        });
</script>
@endsection
