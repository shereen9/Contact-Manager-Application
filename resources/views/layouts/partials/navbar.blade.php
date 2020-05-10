<nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>

          <a class="navbar-brand text-uppercase" href="#">
            My contact
          </a>
        </div>
        <!-- /.navbar-header -->
        <div class="collapse navbar-collapse" id="navbar-collapse">
        
          <!-- Left Side Of Navbar -->
          @if (! Auth::guest())
            <ul class="nav navbar-nav ">
              <li class="{{ Request::segment(1)== 'home' ? 'active':''}}"><a href="{{ url('/home')}}">Home</a></li>
              <li class="{{ Request::segment(1)== 'contacts' ? 'active' : ''}}"><a href="{{ route('contacts.index')}}">Contacts</a></li>
            </ul>
          @endif

          <!-- Right Side Of Navbar -->
          <ul class="nav navbar-nav navbar-right">
              <!-- Authentication Links -->
              @guest
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                  </li>
                  @if (Route::has('register'))
                      <li class="nav-item">
                          <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                      </li>
                  @endif
              @else
                  <li class="nav-item dropdown">
                      <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                          {{ Auth::user()->name }} <span class="caret"></span>
                      </a>

                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                          <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();">
                              {{ __('Logout') }}
                          </a>

                          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                              @csrf
                          </form>
                      </div>
                  </li>
              @endguest
          </ul>
          @if (! Auth::guest())
            <form action="{{route('contacts.index')}}" class="navbar-form navbar-right" role="search">
            <div class="input-group">
              <input name="term" value="{{Request::get('term')}}" type="text" class="form-control" placeholder="Search..." />
              <span class="input-group-btn">
                <button class="btn btn-default" type="submit">
                      <i class="glyphicon glyphicon-search"></i>
                </button>
              </span>
              </div>
            </form> 
          @endif
        <div class="input-group">
             
                <!-- <button class="btn btn-default" type="submit">
                  <i class="glyphicon glyphicon-search"></i>
                </button> -->
              </span>
            </div>
         
        </div>
      </div>
    </nav>
