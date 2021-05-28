<div id="header">
	<div class="container">
		<div id="welcomeLine" class="row">
			<div class="span6">Welcome!<strong> User</strong></div>
			<div class="span6">
				<div class="pull-right">
					<a href="{{ route('cart.show') }}"><span class="btn btn-mini btn-primary"><i class="icon-shopping-cart icon-white"></i> [ <span class="ttcartitems"> {{TotalCartItems()}}{{Str::plural(' item',TotalCartItems())}} </span> ] in your cart </span> </a>
				</div>
			</div>
		</div>
		<!-- Navbar ================================================== -->
		<section id="navbar">
		  <div class="navbar">
		    <div class="navbar-inner">
		      <div class="container">
		        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
		          <span class="icon-bar"></span>
		          <span class="icon-bar"></span>
		          <span class="icon-bar"></span>
		        </a>
		        <a class="brand" href="#">ndiritu edwin</a>
		        <div class="nav-collapse">
		          <ul class="nav">
		            <li class="active"><a href="{{ route('frontend.index') }}">Home</a></li>
		         @if (empty($sections))
                       <h5 class="text-danger">Section is empty</h5>
				 @else
				 @foreach ($sections as $section)
				 <li class="dropdown">
				  <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{$section->section}} <b class="caret"></b></a>
				  <ul class="dropdown-menu">
					@if (empty($section->categories))
					<h1> empty</h1>
                        	@else
						  @foreach ($section->categories as $category)
						  <li class="divider"></li>
						  <li class="nav-header"><a href="{{ route('category.products',$category) }}">{{$category->categoryname}}</a></li>
						  @if (empty($category->subcategories))
						   <h1>Empty</h1>
						   @else
						   @foreach ($category->subcategories as $subcategory)
						   <li class="nav-header"><a href="{{ route('category.products', $subcategory) }}">&nbsp;&raquo;{{$subcategory->categoryname}}</a></li>
						   
						   @endforeach
					   @endif	
						
						  @endforeach					
					@endif
				     
				</ul>
				</li>
				 @endforeach					 
				 @endif
		           
		            <li><a href="#">About</a></li>
		          </ul>
		          <form class="navbar-search pull-left" action="#">
		            <input type="text" class="search-query span2" placeholder="Search"/>
		          </form>
		          <ul class="nav pull-right">
		            <li><a href="{{ route('user.orders') }}">Orders</a></li>
		            <li class="divider-vertical"></li>
					@if (Auth::check())
		            <li><a href="{{ route('user.account') }}">My Account</a></li>
		            <li>
						<form action="{{ route('auth.clientlogout') }}" method="POST" >
							@csrf
							<button class="btn btn-primary" type="submit" style="border: none;margin-top:8px">Logout</button>
						</form>
                     @else
					 <li><a href="{{ route('auth.registeruser') }}">Login</a></li>	
					@endif
		          </ul>
		        </div><!-- /.nav-collapse -->
		      </div>
		    </div><!-- /navbar-inner -->
		  </div><!-- /navbar -->
		</section>
	</div>
</div>