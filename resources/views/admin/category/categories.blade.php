@extends('layouts.adminlayout.adminlayout')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Category</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Categories</li>
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
              <h3 class="card-title">Categories table</h3>
            </div>
            <a href="{{ route('category.modify') }}" class="btn btn-success">Add category</a><br>
            <!-- /.card-header -->
            @include('layouts.adminlayout.adminpartials.alerts')
            <div class="card-body">
              <table id="categories" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>category </th>
                  <th>category level</th>
                  <th>section</th>
                  <th>status</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                        @foreach ($categories as $category)
                          <tr>
                            <td>{{$category->categoryname}}</td>
                            <td>{{(isset($category->parentcategory->categoryname)?$category->parentcategory->categoryname:'Parent')}}</td>
                            <td>{{$category->section->section}}</td>
                            <td>@if ($category->status==1)
                               <a class="updatecategorystatus" id="category-{{$category->id}}" category_id="{{$category->id}}" href="javascript:void(0)">Active</a>
                                @else
                              <a class="updatecategorystatus" id="category-{{$category->id}}" category_id="{{$category->id}}" href="javascript:void(0)">In active</a>
                            @endif</td>
                            <td>
                              <a href="{{ route('category.getedit', $category->id) }}" class="fas fa-edit"></a>
                              <a   href="javascript:void(0)" class="fas fa-trash confirmdelete" record="category" recordid="{{$category->id}}"></a>
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