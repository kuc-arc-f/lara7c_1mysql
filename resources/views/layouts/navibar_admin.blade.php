<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
  <div class="container">
    <a class="navbar-brand" href="/admin">
      Admin
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <!--
        <li class="nav-item dropdown">
          <a href="#" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown"
          id="navbarDropdownMenuLink" aria-haspopup="true" aria-expanded="false">Master</a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="/category">Category</a>
              <a class="dropdown-item" href="/tags">Tags</a>
          </div>
        </li>
        -->
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
      @if (session('admin_user'))
        <li class="nav-item dropdown">
          <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#"
           role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
              AdminUser <span class="caret"></span>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="/admin/logout" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">{{ __('Logout') }}
              </a>
              <form id="logout-form" action="/admin/logout" method="POST" style="display: none;">
                @csrf
              </form>
          </div>
        </li>      
      @else
        <li class="nav-item">
          <a class="nav-link" href="/admin/login">{{ __('Login') }}</a>
        </li> 
        <li class="nav-item">
          <a class="nav-link" href="/admin/register">{{ __('Register') }}</a>
        </li>
      @endif          
      </ul>                
    </div>

  </div><!-- end_container -->
</nav>
