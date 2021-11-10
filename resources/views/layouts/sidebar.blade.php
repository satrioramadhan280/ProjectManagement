<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{url('/home')}}">
                    <span data-feather="home"></span>
                    Dashboard
                </a>
            </li>
            
            @can('HDiv')
            <li class="nav-item">
                <a class="nav-link" href="{{route('projects')}}">
                    <span data-feather="file"></span>
                    Projects
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/{{Auth::user()->username}}">
                    <span data-feather="user"></span>
                    Profile
                </a>
            </li>
            @endcan

            @can('HDept1')
            <li class="nav-item">
                <a class="nav-link" href="{{route('projects')}}">
                    <span data-feather="file"></span>
                    Projects
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/{{Auth::user()->username}}">
                    <span data-feather="user"></span>
                    Profile
                </a>
            </li>
            @endcan
            @can('HDept2')
            <li class="nav-item">
                <a class="nav-link" href="{{route('projects')}}">
                    <span data-feather="file"></span>
                    Projects
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/{{Auth::user()->username}}">
                    <span data-feather="user"></span>
                    Profile
                </a>
            </li>
            @endcan
            @can('HDept3')
            <li class="nav-item">
                <a class="nav-link" href="{{route('projects')}}">
                    <span data-feather="file"></span>
                    Projects
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/{{Auth::user()->username}}">
                    <span data-feather="user"></span>
                    Profile
                </a>
            </li>
            @endcan
            @can('HDept4')
            <li class="nav-item">
                <a class="nav-link" href="{{route('projects')}}">
                    <span data-feather="file"></span>
                    Projects
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/{{Auth::user()->username}}">
                    <span data-feather="user"></span>
                    Profile
                </a>
            </li>
            @endcan
        </ul>
    </div>
</nav>