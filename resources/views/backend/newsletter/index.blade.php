@extends('backend.layouts.master')


@section('content')


<div class="main-content">
<div class="col-lg-12">
    @include('backend.layouts.notification')
</div>
<h4 class="box-title text-center">Liste des emails</h4>
@if (count($news) != 0)


    <table class="table table-striped table-bordered display" style="width:100%">
        <thead>
            <tr>
                <th>S.N</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>S.N</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </tfoot>
        <tbody>
            @foreach ($news as $item)



                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$item->email}}</td>

                    <td>

                    <form action="{{route('newsletter.destroy',$item->id)}}" method="POST">
                        @csrf
                        @method('delete')
                        <button type="button" data-id="{{$item->id}}" class="float-left dltBtn btn btn-danger btn-sm waves-effect waves-light" style="color:#fff;background-color:#000;"><i class="fa fa-trash" aria-hidden="true"></i></button>
                    </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <h2 class="text-center">Il n'y a pas d'Emails pour le moment!</h2>
    @endif
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
                text: "Une fois supprimé, vous ne pourrez pas récupérer ce Email!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                    form.submit();
                    swal("Poof! Email a été supprimée!", {
                    icon: "success",
                    });
                } else {
                    swal("Email n'est pas supprimée!");
                }
                });
        });
</script>

@endsection
