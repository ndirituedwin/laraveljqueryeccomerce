@extends('layouts.adminlayout.adminlayout')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>admins page</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">admins</li>
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
              <h3 class="card-title">admins table</h3><br>
              @include('layouts.adminlayout.adminpartials.alerts')
              @if(Session::has('success_message'))
              <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top: 10px" >{{Session::get('success_message')}}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
              </div>
              @endif
              <a class="btn btn-success float-right" href="{{ route('admin.addedit') }}">Add admin</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="adminstablee" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Full name</th>
                  <th>type</th>
                  <th>mobile</th>
                  <th>email</th>
                  <th>Date Registered</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                        @foreach ($admins as $admin)
                          <tr>
                            <td>{{$admin['name']}}</td>
                            <td>{{$admin['type']}}</td>
                            <td>{{$admin['mobile']}}</td>
                            <td>{{$admin['email']}}</td>
                            <td>{{$admin['created_at']->format('D,d M Y H:i:s A')}}</td>
                            @if ($admin['type'] !=="superadmin")
                            <td>@if ($admin['status']==1)
                               <a class="updateadminstatus" id="admin-{{$admin['id']}}" admin_id="{{$admin['id']}}" href="javascript:void(0)"><i title="Active" class="fas fa-toggle-on" aria-hidden="true" status="Active"></i></a>
                                @else
                              <a class="updateadminstatus" id="admin-{{$admin['id']}}" admin_id="{{$admin['id']}}" href="javascript:void(0)"><i title="In active" class="fas fa-toggle-off " aria-hidden="true" status="In active"></i></a>
                            @endif</td>
                            @else
                            <td></td>
                            @endif

                            <td>
                                @if ($admin['type'] !=="superadmin")
                                <a title="set Roles/ Permissions" href="{{ route('admin.updateroles', $admin) }}" class="fas fa-unlock"></a>
                                <a  href="{{ route('admin.addedit', $admin['admin_id']) }}" class="fas fa-edit"></a>
                                
                                 <a   href="javascript:void(0)" class="fas fa-trash confirmdelete" record="admin" recordid="{{$admin['id']}}"></a>
                                @else

                                 @endif
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
