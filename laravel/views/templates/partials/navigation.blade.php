<nav class="navbar navbar-default ">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="">Amazon</a>
      </div>
     
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        @if (Auth::check())
        <ul class=" nav navbar-nav">
            <li><a href="">Welcome</a></li>
            <li><a href="">Home</a></li>
        </ul>
        

        @endif
        <ul class="nav navbar-nav navbar-right">
            @if (Auth::check())
            <li><a href="">{{Auth::user()->email}}</a></li>
            <li><a href="{{ route('profile.edit') }}">Update profile</a></li>
            <li>
              <form action="{{ route('auth.signout') }}" method="POST">
                @csrf
              <input type="submit"  value="Sign out" style="border: none;margin-top:10px">
              </form>
            </li>
            @else
            <li><a href="{{ route('auth.getsignup') }}">Sign Up </a></li>
            <li><a href="{{ route('auth.getsignin') }}">Sign In </a></li>
            @endif
        </ul>      
      
      </div>
    </div>
  </nav>