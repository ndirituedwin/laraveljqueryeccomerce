            
            @if (Session::has('info'))
            <div class="alert alert-info " role="alert">{{Session::get('info')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
            </div>
        @endif
        @if (Session::has('success'))
            <div class="alert alert-success " role="alert">{{Session::get('success')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
        </div>
        @endif
        
        @if (Session::has('danger'))
            <div class="alert alert-danger" role="alert">{{Session::get('danger')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
        
            </div>
        @endif
        