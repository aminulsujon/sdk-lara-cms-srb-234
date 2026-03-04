<nav class="navbar navbar-expand-lg navbar-dark fixed-top border-bottom p-0">
    <div class="container">
        <!-- Brand -->
        <a class="navbar-brand" href="{{ $websettings['cms_url'] ?? '#' }}"><span><img src="images/logo.png" width="50" alt="logo" class="rounded"></span> Admin</a>

        <!-- Toggler/collapsibe Button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar links -->
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ $websettings['cms_url'] ?? '#' }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about">About us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ $websettings['cms_url'] }}case-study">
                        Works
                    </a>
                </li>
                <li class="nav-item dropdown dropdown-hover position-static">
                    <a class="nav-link" href="{{ $websettings['cms_url'] }}services">
                        Services
                    </a>
                    <!-- Dropdown menu -->
                    <div class="dropdown-menu w-100 mt-0" aria-labelledby="navbarDropdown" style="border-top-left-radius: 0;border-top-right-radius: 0;">

                        <div class="container">
                            <div class="row my-4">
                                @if(!empty($services))
                                @forelse ($services as $content)
                                <div class="col-md-4">
                                    <a class="p-2 d-block" href="{{ $content->slug }}">{{ $content->name }}</a>
                                </div>
                                @empty
                                    
                                @endforelse
                                @endif
                            </div>
                        </div>
                    </div>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="{{ $websettings['cms_url'] }}contact">Contact</a>
                </li>
            </ul>
        </div>
    </div>
</nav>