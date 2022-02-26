@extends('layouts.adminlayout.adminlayout')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>cmspages page</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">cmspages</li>
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
              <h3 class="card-title">cmspages table</h3><br>
              <a class="btn btn-success float-right" href="{{ route('cmspage.modify') }}">Add cmspage</a>
            </div>
            <!-- /.card-header -->
            @if(Session::has('success_message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top: 10px" >{{Session::get('success_message')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            @endif
            <div class="card-body">
              <table id="cmspages" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Title</th>
                  <th>Date created</th>
                  <th>status</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                        @foreach ($cmspages as $cmspage)
                          <tr>
                            <td>{{$cmspage['title']}}</td>
                            <td>{{$cmspage['created_at']->format('D,d M Y H:i:s A')}}</td>
                            <td>@if ($cmspage['status']==1)
                               <a class="updatecmspagestatus" id="cmspage-{{$cmspage['id']}}" cmspage_id="{{$cmspage['id']}}" href="javascript:void(0)"><i title="Active" class="fas fa-toggle-on" aria-hidden="true" status="Active"></i></a>
                                @else
                              <a class="updatecmspagestatus" id="cmspage-{{$cmspage['id']}}" cmspage_id="{{$cmspage['id']}}" href="javascript:void(0)"><i title="In active" class="fas fa-toggle-off " aria-hidden="true" status="In active"></i></a>
                            @endif</td>
                            <td>
                                <a href="{{ route('cmspage.modify', $cmspage) }}" class="fas fa-edit"></a>
                                <a   href="javascript:void(0)" class="fas fa-trash confirmdelete" record="cmspage" recordid="{{$cmspage['id']}}"></a>
                              </td>
                        </tr>
                        @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">DataTable with default features</h3>
            </div>

          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection
