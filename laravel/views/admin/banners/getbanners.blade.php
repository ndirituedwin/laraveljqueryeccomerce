@extends('layouts.adminlayout.adminlayout')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>banners page</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Banners</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Banners table</h3><br>
              @include('layouts.adminlayout.adminpartials.alerts')
              <a class="btn btn-success float-right" href="{{ route('banner.getadd') }}">Add Banner</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="brands" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Image</th>
                    <th>status</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                        @foreach ($banners as $banner)
                          <tr>
                            <td>{{$banner['title']}}</td>
                            <td>
                                <?php $smallpath='frontend/themes/banner_images/'.$banner['image']?>
                                @if (!empty($banner['image']) && file_exists($smallpath))
                                    <img style="height: 50px; width: 170px;" src="{{asset('frontend/themes/banner_images/'.$banner['image'])}}" alt="{{$banner['title']}}">
                               @else
                               <img style="width: 50px;height: 50px;" src="{{asset('adminlte/adminimages/noimage/noimage.jpg')}}" alt="{{$banner['title']}}">
                            
                                    @endif
                              </td>
                            <td>@if ($banner['status']==1)
                               <a class="updatebannerstatus" id="banner-{{$banner['id']}}" banner_id="{{$banner['id']}}" href="javascript:void(0)"><i title="Active" class="fas fa-toggle-on" aria-hidden="true" status="Active"></i></a>
                                @else
                              <a class="updatebannerstatus" id="banner-{{$banner['id']}}" banner_id="{{$banner['id']}}" href="javascript:void(0)"><i title="In active" class="fas fa-toggle-off " aria-hidden="true" status="In active"></i></a>
                            @endif</td>
                            <td>
                                <a href="{{ route('banner.edit', $banner['id']) }}" class="fas fa-edit"></a>
                                <a   href="javascript:void(0)" class="fas fa-trash confirmdelete" record="banner" recordid="{{$banner['id']}}"></a>
                              </td>
                        </tr>
                        @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
    
@endsection