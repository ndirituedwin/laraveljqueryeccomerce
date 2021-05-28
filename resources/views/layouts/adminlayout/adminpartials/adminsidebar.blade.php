<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{asset('adminlte/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Admin panel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="/storage/adminlte/adminimages/images/{{Auth::guard('admin')->user()->image}}" class="img-circle elevation-10" style="width: 40px;height: 40px" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ucwords(Auth::guard('admin')->user()->name)}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li class="nav-item">
                 @if (Session::get('page')=="dashboard")
                 <?php $active="active";?>
                     @else

                     <?php $active="" ?>
                 @endif
                <a href="{{route('dashboard')}}" class="nav-link {{$active}}">
                  <i class="nav-icon fas fa-th"></i>
                  <p>
                    Dashboard
                  </p>
                </a>
              </li>
              @if (Session::get('page')=="settings"||Session::get('page')=="updateadmindetails")
              <?php $active="active";?>
                  @else

                  <?php $active="" ?>
              @endif
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link {{$active}}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Settings
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @if (Session::get('page')=="settings")
              <?php $active="active";?>
                  @else

                  <?php $active="" ?>
              @endif
              <li class="nav-item">
                <a href="{{ route('admin.settings') }}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Update admin password</p>
                </a>
              </li>
              <li class="nav-item">
                @if (Session::get('page')=="updateadmindetails")
                <?php $active="active";?>
                    @else

                    <?php $active="" ?>
                @endif
                <a href="{{ route('update.admindetails') }}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Update admin details</p>
                </a>
              </li>
             
            </ul>
          </li>


          <!--catalogues-->
          @if (Session::get('page')=="sections"||Session::get('page')=="orders"||Session::get('page')=="coupons"||Session::get('page')=="categories"||Session::get('page')=="products"||Session::get('page')=="brands"||Session::get('page')=="banners")
          <?php $active="active";?>
              @else

              <?php $active="" ?>
          @endif
      <li class="nav-item has-treeview menu-open">
        <a href="#" class="nav-link {{$active}}">
          <i class="nav-icon fas fa-tachometer-alt"></i>
          <p>
            Catalogues
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          @if (Session::get('page')=="sections")
          <?php $active="active";?>
              @else

              <?php $active="" ?>
          @endif
          <li class="nav-item">
            <a href="{{ route('admin.getsections') }}" class="nav-link {{$active}}">
              <i class="far fa-circle nav-icon"></i>
              <p>Sections</p>
            </a>
          </li>
          <li class="nav-item">
            @if (Session::get('page')=="categories")
            <?php $active="active";?>
                @else
                <?php $active="" ?>
            @endif
            <a href="{{ route('admin.categories') }}" class="nav-link {{$active}}">
              <i class="far fa-circle nav-icon"></i>
              <p>categories</p>
            </a>
          </li>
          <li class="nav-item">
            @if (Session::get('page')=="products")
            <?php $active="active";?>
                @else

                <?php $active="" ?>
            @endif
            <a href="{{ route('admin.products') }}" class="nav-link {{$active}}">
              <i class="far fa-circle nav-icon"></i>
              <p>Products</p>
            </a>
          </li>
          <li class="nav-item">
            @if (Session::get('page')=="brands")
            <?php $active="active";?>
                @else
                <?php $active="" ?>
            @endif
            <a href="{{ route('admin.brands') }}" class="nav-link {{$active}}">
              <i class="far fa-circle nav-icon"></i>
              <p>brand</p>
            </a>
          </li>
          <li class="nav-item">
            @if (Session::get('page')=="banners")
            <?php $active="active";?>
                @else
                <?php $active="" ?>
            @endif
            <a href="{{ route('admin.banners') }}" class="nav-link {{$active}}">
              <i class="far fa-circle nav-icon"></i>
              <p>Banners</p>
            </a>
          </li>
          <li class="nav-item">
            @if (Session::get('page')=="coupons")
            <?php $active="active";?>
                @else
                <?php $active="" ?>
            @endif
            <a href="{{ route('admin.coupons') }}" class="nav-link {{$active}}">
              <i class="far fa-circle nav-icon"></i>
              <p>Coupons</p>
            </a>
          </li>
          <li class="nav-item">
            @if (Session::get('page')=="orders")
            <?php $active="active";?>
                @else
                <?php $active="" ?>
            @endif
            <a href="{{ route('admin.orders') }}" class="nav-link {{$active}}">
              <i class="far fa-circle nav-icon"></i>
              <p>Orders</p>
            </a>
          </li>
        </ul>
      </li>
      
        
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>