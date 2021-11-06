<header class="navbar navbar-light sticky-top bg-danger flex-md-nowrap p-0  ">
    <a class="navbar col-md-3 col-lg-2 me-0 px-3" href="{{url('/home')}}"><img src="{{asset('img/logo.png')}}" width="120px"
            height="30px" alt=""></a>
    {{-- <input class="form-control form-control-light w-100" type="text" placeholder="Search" aria-label="Search"> --}}
    <div class="navbar-nav">
        <div class="nav-item text-nowrap">
            <a class="nav-link px-3 text-white" href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
            {{-- <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle text-white " href="#" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }}
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li> --}}
        </div>
    </div>
    
</header>