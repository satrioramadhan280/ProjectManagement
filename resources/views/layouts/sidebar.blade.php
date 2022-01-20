<style>
    

    .numberCircle {
        width: 23px;
        line-height: 18px;
        border-radius: 50%;
        text-align: center;
        font-size: 14px;
        border: 2px solid rgb(114, 114, 114);
        font-weight: bold;
    }
</style>

<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <div class="ml-auto mt-auto">
            <li class="nav-item d-inline">
                <div class="d-flex justify-content-center">
                    <div class="d-flex flex-column justify-content-center ">
                        <div class="d-flex justify-content-center"><img class="rounded-circle border border-3 d-inline" src="{{asset("uploads/users_photo/".Auth::user()->photo)}}" height="100px" width="100px" alt=""></div>   
                        <div class="text-center mt-1 h5">{{Auth::user()->name}}</div>
                        @cannot('Admin')
                        <div class="text-center mt-1">
                            <a class="nav-link" href="/user/{{Auth::user()->username}}/about">
                                See Profile
                            </a>
                        </div>  
                        @endcannot
                    </div>
                </div>
            </li>
        </div>
        <hr>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{request()->is('home') ? 'active' : ''}}" aria-current="page" href="{{url('/home')}}">
                    <span data-feather="home"></span>
                    Dashboard
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{request()->is('notifications') ? 'active' : ''}}" aria-current="page" href="{{url('/notifications')}}">
                    
                    <div class="d-flex flex-row">
                        <div><span data-feather="bell"></span>Notifications</div>
                    
                    
                        <?php
                            $count = 0;
                        ?>
                        @foreach (Auth::user()->notifications as $item)
                            @if ($item->status == 0)
                                <?php
                                    $count = $count+1;
                                ?>
                            @endif
                        @endforeach
                        
                    
                        @if ($count > 0)
                            <div class="ml-2 numberCircle" style="color: red">
                                <?php
                                    echo $count
                                ?>
                            </div>
                        @endif
                    </div>
                </a>
            </li>
            
            @canany(['HDiv','HDept1', 'MDept1', 'HDept2', 'MDept2', 'HDept3', 'MDept3', 'HDept4', 'MDept4'])
            <li class="nav-item">
                <a class="nav-link {{request()->is('projects/*') ? 'active' : ''}}" href="{{route('projects')}}">
                    <span data-feather="file"></span>
                    Projects
                </a>
            </li>
            @endcanany
            
            <li class="nav-item">
                <a class="nav-link {{request()->is('user/index') ? 'active' : ''}}" href="/user/index">
                    <span data-feather="users"></span> 
                    List Users
                </a>
            </li>
            
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