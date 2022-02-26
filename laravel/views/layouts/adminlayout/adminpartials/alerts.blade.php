@if (Session::has('info'))
    <div class="alert alert-info alert-dismissible fade show" role="alert">{{Session::get('info')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
    </div>
@endif
@if (Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">{{Session::get('success')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
</div>
@endif

@if (Session::has('danger'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">{{Session::get('danger')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>

    </div>
@endif
