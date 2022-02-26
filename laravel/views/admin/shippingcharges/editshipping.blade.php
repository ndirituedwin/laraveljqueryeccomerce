@extends('layouts.adminlayout.adminlayout')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Catalogues</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Shipping</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Shipping charges form</h3>
          
            @include('layouts.adminlayout.adminpartials.alerts')
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
            </div>
          </div>
          <!-- /.card-header -->
          <form action="{{ route('shippingcharge.edit',$shipping['id']) }}" name="editshippingform" method="POST" role="form" enctype="multipart/form-data">
          @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-grop{{$errors->has('country')?' has-error text-danger':''}}">
                            <label for="country" class="control-label">country</label>
                            <input type="text" name="country" readonly value="{{$shipping['country_name']}}" id="country" class="form-control" placeholder="enter shipping charges">
                            @if ($errors->has('country'))
                            <span class="help-block text-danger">{{$errors->first('country')}}</span>
                        @endif
                        </div>       
                    </div>
                    <!-- /.col -->
                 
                    <!-- /.col -->
                  </div>
            <div class="row">
              <div class="col-md-3">
                  <div class="form-grop{{$errors->has('zero_500g')?' has-error text-danger':''}}">
                      <label for="zero_500g" class="control-label">shipping charges(0-500g)</label>
                      <input type="text" name="zero_500g" value="{{$shipping['zero_500g']}}" id="zero_500g" class="form-control" placeholder="enter shipping charges(zero_500g)">
                      @if ($errors->has('zero_500g'))
                      <span class="help-block text-danger">{{$errors->first('zero_500g')}}</span>
                  @endif
                  </div>       
              </div>
              <div class="col-md-3">
                <div class="form-grop{{$errors->has('fivezeroone_1000g')?' has-error text-danger':''}}">
                    <label for="fivezeroone_1000g" class="control-label">shipping charges(501-1000g)</label>
                    <input type="text" name="fivezeroone_1000g" value="{{$shipping['fivezeroone_1000g']}}" id="fivezeroone_1000g" class="form-control" placeholder="enter shipping charges(fivezeroone_1000g)">
                    @if ($errors->has('fivezeroone_1000g'))
                    <span class="help-block text-danger">{{$errors->first('fivezeroone_1000g')}}</span>
                @endif
                </div>       
            </div>
            <div class="col-md-3">
              <div class="form-grop{{$errors->has('onezerozeroone_2000g')?' has-error text-danger':''}}">
                  <label for="onezerozeroone_2000g" class="control-label">shipping charges(onezerozeroone_2000g)</label>
                  <input type="text" name="onezerozeroone_2000g" value="{{$shipping['onezerozeroone_2000g']}}" id="onezerozeroone_2000g" class="form-control" placeholder="enter shipping charges(onezerozeroone_2000g)">
                  @if ($errors->has('onezerozeroone_2000g'))
                  <span class="help-block text-danger">{{$errors->first('onezerozeroone_2000g')}}</span>
              @endif
              </div>       
          </div>
          <div class="col-md-3">
            <div class="form-grop{{$errors->has('twozerozeroone_5000g')?' has-error text-danger':''}}">
                <label for="twozerozeroone_5000g" class="control-label">shipping charges(2001-5000g)</label>
                <input type="text" name="twozerozeroone_5000g" value="{{$shipping['twozerozeroone_5000g']}}" id="twozerozeroone_5000g" class="form-control" placeholder="enter shipping charges(twozerozeroone_5000g)">
                @if ($errors->has('twozerozeroone_5000g'))
                <span class="help-block text-danger">{{$errors->first('twozerozeroone_5000g')}}</span>
            @endif
            </div>       
        </div>
        <div class="col-md-3">
          <div class="form-grop{{$errors->has('above_5000g')?' has-error text-danger':''}}">
              <label for="above_5000g" class="control-label">shipping charges(above 5000g)</label>
              <input type="text" name="above_5000g" value="{{$shipping['above_5000g']}}" id="above_5000g" class="form-control" placeholder="enter shipping charges(above_5000g)">
              @if ($errors->has('above_5000g'))
              <span class="help-block text-danger">{{$errors->first('above_5000g')}}</span>
          @endif
          </div>       
      </div>
              <!-- /.col -->
           
              <!-- /.col -->
            </div>
           
            <!-- /.row -->

            
            <!-- /.row -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
           <button type="submit" class="btn btn-primary">update shipping charges</button>
          </div>
        </form>
        </div>
        <!-- /.card -->

       
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection