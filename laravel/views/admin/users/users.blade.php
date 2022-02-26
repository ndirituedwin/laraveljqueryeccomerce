@extends('layouts.adminlayout.adminlayout')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>users page</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">users</li>
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
              <h3 class="card-title">users table</h3><br>
              {{-- <a class="btn btn-success float-right" href="{{ route('admin.modifyuser') }}">Add user</a> --}}
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="userstablee" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Full name</th>
                  <th>mobile</th>
                  <th>email</th>
                  <th>Date Registered</th>
                  <th>Status</th>
                </tr>
                </thead>
                <tbody>
                        @foreach ($users as $user)
                          <tr>
                            <td>{{$user['first_name']}} {{ $user['last_name'] }}</td>
                            <td>{{$user['mobile']}}</td>
                            <td>{{$user['email']}}</td>
                            <td>{{$user['created_at']->format('D,d M Y H:i:s A')}}</td>
                            <td>@if ($user['status']==1)
                               <a class="updateuserstatus" id="user-{{$user['id']}}" user_id="{{$user['id']}}" href="javascript:void(0)"><i title="Active" class="fas fa-toggle-on" aria-hidden="true" status="Active"></i></a>
                                @else
                              <a class="updateuserstatus" id="user-{{$user['id']}}" user_id="{{$user['id']}}" href="javascript:void(0)"><i title="In active" class="fas fa-toggle-off " aria-hidden="true" status="In active"></i></a>
                            @endif</td>
                            <td>
                                {{-- <a href="{{ route('user.edit', $user) }}" class="fas fa-edit"></a> --}}
                                {{-- <a   href="javascript:void(0)" class="fas fa-trash confirmdelete" record="user" recordid="{{$user['id']}}"></a> --}}
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
