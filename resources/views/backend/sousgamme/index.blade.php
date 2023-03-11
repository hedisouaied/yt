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
<h4 class="box-title"><a class="btn btn-secondary" href="{{route('sous_gamme.create')}}" ><i class="fa fa-plus-circle"></i> Ajouter sous gamme</a></h4>
    <table class="table table-striped table-bordered display" style="width:100%">
        <thead>
            <tr>
                <th>S.N</th>
                <th>Nom</th>
                <th>Catégorie</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>S.N</th>
                <th>Nom</th>
                <th>Catégorie</th>
                <th>Actions</th>
            </tr>
        </tfoot>
        <tbody>
            @foreach ($products as $item)

                    @php
                    $photo= explode(',',$item->photo);
                    @endphp

                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$item->title}}</td>
                    <td>{{\App\Models\Category::where('id',$item->cat_id)->value('title')}} -> {{\App\Models\Category::where('id',$item->child_cat_id)->value('title')}} -> {{\App\Models\Gamme::where('id',$item->gamme_id)->value('title')}}</td>


                    <td>

                    <form action="{{route('sous_gamme.destroy',$item->id)}}" method="POST">
                        @csrf
                        @method('delete')
                        <button type="button" data-id="{{$item->id}}" class="float-left dltBtn btn btn-danger btn-sm waves-effect waves-light" style="color:#fff;background-color:#000;"><i class="fa fa-trash" aria-hidden="true"></i></button>
                    </form>


                        <a class="float-left" href="{{route('sous_gamme.edit',$item->id)}}"><i class="btn btn-warning btn-sm waves-effect waves-light fas fa-pencil-alt" aria-hidden="true"></i></a>
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
                text: "Une fois supprimé, vous ne pourrez pas récupérer cette sous gamme!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                    form.submit();
                    swal("Poof! Votre sous gamme a été supprimée!", {
                    icon: "success",
                    });
                } else {
                    swal("Votre sous gamme n'est pas supprimée!");
                }
                });
        });
</script>


@endsection
