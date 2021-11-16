<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{url('/home')}}">
                    <span data-feather="home"></span>
                    Dashboard
                </a>
            </li>
            
            @canany(['HDiv','HDept1', 'MDept1', 'HDept2', 'MDept2', 'HDept3', 'MDept3', 'HDept4', 'MDept4'])
            <li class="nav-item">
                <a class="nav-link" href="{{route('projects')}}">
                    <span data-feather="file"></span>
                    Projects
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/user/{{Auth::user()->username}}/about">
                    <span data-feather="user"></span>
                    Profile
                </a>
            </li>
            @endcanany
        </ul>
    </div>
</nav>