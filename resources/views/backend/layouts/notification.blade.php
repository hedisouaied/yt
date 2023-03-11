
@if(session('success'))
    <div class="alert alert-success" role="alert">
        {{session('success')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
@elseif (session('error'))
    <div class="alert alert-danger" role="alert">
        <strong>Holy guacamole!</strong> {{session('error')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
