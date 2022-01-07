<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        {{Auth::user()->name}}
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{request()->is('home') ? 'active' : ''}}" aria-current="page" href="{{url('/home')}}">
                    <span data-feather="home"></span>
                    Dashboard
                </a>
            </li>
            
            @canany(['HDiv','HDept1', 'MDept1', 'HDept2', 'MDept2', 'HDept3', 'MDept3', 'HDept4', 'MDept4'])
            <li class="nav-item">
                <a class="nav-link {{request()->is('projects/*') ? 'active' : ''}}" href="{{route('projects')}}">
                    <span data-feather="file"></span>
                    Projects
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{request()->is('*/about') ? 'active' : ''}}" href="/user/{{Auth::user()->username}}/about">
                    <span data-feather="user"></span>
                    Profile
                </a>
            </li>
            @endcanany
            @canany(['HDiv','HDept1', 'HDept2', 'HDept3', 'HDept4'])
            <li class="nav-item">
                <a class="nav-link {{request()->is('user/index') ? 'active' : ''}}" href="/user/index">
                    <span data-feather="users"></span> 
                    List Users
                </a>
            </li>
            @endcanany
            @can('Admin')
            <li class="nav-item">
                <a class="nav-link {{request()->is('admin/index') ? 'active' : ''}}" href="/admin/index">
                    <span data-feather="users"></span> 
                    List Users
                </a>
            </li>
            @endcan
            <li class="nav-item">
                <a class="nav-link px-3" href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();"> 
                    <span data-feather="log-out"></span>
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</nav>