<div class="site-mobile-menu site-navbar-target">
    <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
            <span class="icon-close2 js-menu-toggle"></span>
        </div>
    </div>
    <div class="site-mobile-menu-body"></div>
</div>


<div class="py-2 bg-light">
    <div class="container">
    <div class="row align-items-center">
        <div class="col-lg-9 d-none d-lg-block">
        <a href="/" class="btn btn-primary btn-lg" style="background-color: dodgerblue">Main System</a>
        </div>
        <div class="col-lg-3 text-right">
            @if(Session()->has('member'))
                <div class="dropdown">
                    <button class="small btn btn-primary px-4 py-2 rounded-0 dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{Session()->get('member')['username']}}
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="/logout">Logout</a>
                    </div>
                </div>
            @elseif (Session()->has('teacherStatus'))
                <div class="dropdown">
                    <button class="small btn btn-primary px-4 py-2 rounded-0 dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{Session()->get('teacherStatus')['username']}}
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="/admin_board">Dashboard</a>
                        <a class="dropdown-item" href="/logout">Logout</a>
                    </div>
                </div>
            @else
                <!-- <a href="/login" class="small mr-3"><span class="icon-unlock-alt"></span> Log In</a> -->
                <a href="/login" class="small btn btn-primary px-4 py-2 rounded-0"><span class="icon-users"></span> Login</a>
            @endif
        </div>
    </div>
    </div>
</div>
<header class="site-navbar py-4 js-sticky-header site-navbar-target" role="banner">

    <div class="container">
    <div class="d-flex align-items-center">
        <div class="site-logo">
        <a href="/main" class="d-block">
            <!-- <img src="images/logo.png" alt="Image" class="img-fluid"> -->
            <p>Eduvance - Video Management System</p>
        </a>
        </div>
        <div class="ml-auto">
        <nav class="site-navigation position-relative text-right" role="navigation">
            <ul class="site-menu main-menu js-clone-nav ms-auto d-none d-lg-block">
            <li class="active">
                <a href="/" class="nav-link text-left">Home</a>
                
            </li>
            <!-- <li class="has-children">
                <a href="/about" class="nav-link text-left">About Us</a>
                <ul class="dropdown">
                <li><a href="/teachers">Our Teachers</a></li>
                <li><a href="/school">Our School</a></li>
                </ul>
            </li> -->
            <li>
                @if (Session()->get('teacherStatus'))
                    <a href="/admin_board" class="nav-link text-left">Dashboard</a>
                @endif
                <a href="/lessons" class="nav-link text-left">Lessons</a>
            </li>
            <li>
                <a href="/contact" class="nav-link text-left">Contact Us</a>
                </li>
            </ul>                                                                                                                                                                                                                                                                                          </ul>
        </nav>

        </div>
        <div class="ml-auto">
        <div class="social-wrap">
            <a href="https://www.facebook.com/profile.php?id=100086794281981"><span class="icon-facebook"></span></a>
            <a href="https://www.youtube.com/channel/UCxfkDZSDPo7UdeGHXMFNyLw"><span class="icon-youtube"></span></a>
            <a href="mailto:eduvanceschoolms@gmail.com"><span class="icon-google"></span></a>

            <a href="#" class="d-inline-block d-lg-none site-menu-toggle js-menu-toggle text-black"><span
            class="icon-menu h3"></span></a>
        </div>
        </div>
        
    </div>
    </div>

</header>