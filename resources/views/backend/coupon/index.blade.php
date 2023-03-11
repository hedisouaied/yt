@extends('backend.layouts.master')


@section('content')


<div class="main-content">
<div class="col-lg-12">
    @include('backend.layouts.notification')
</div>
<h4 class="box-title"><a class="btn btn-secondary" href="{{route('coupon.create')}}" ><i class="fa fa-plus-circle"></i> Ajouter Coupon</a></h4>
    <table id="example" class="table table-striped table-bordered display" style="width:100%">
        <thead>
            <tr>
                <th>S.N</th>
                <th>Code coupon</th>
                <th>Discount (-%)</th>
                <th>Date d'expiration</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($banners as $item)



                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$item->code_coupon}}</td>
                    <td>-{{$item->discount}}%</td>
                    <td>

                    @if (strtotime($item->expiration) > strtotime(date('y-m-d')))
                    {{($item->expiration)}}
                    @else
                        <span class="text-danger" >Expiré</span>
                    @endif

                    </td>

                    <td>
                        <div class="switch success">

                           <input name="toogle" value="{{$item->id}}" type="checkbox" {{$item->status == 'active' ? 'checked': ''}} id="switch-{{$item->id}}">
                            <label for="switch-{{$item->id}}">active</label>
                        </div>
                    </td>
                    <td>

                    <form action="{{route('coupon.destroy',$item->id)}}" method="POST">
                        @csrf
                        @method('delete')
                        <button type="button" data-id="{{$item->id}}" class="float-left dltBtn btn btn-danger btn-sm waves-effect waves-light" style="color:#fff;background-color:#000;"><i class="fa fa-trash" aria-hidden="true"></i></button>
                    </form>

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
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this imaginary file!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                    form.submit();
                    swal("Poof! Your imaginary file has been deleted!", {
                    icon: "success",
                    });
                } else {
                    swal("Your imaginary file is safe!");
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
                url:"{{route('coupon.status')}}",
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
