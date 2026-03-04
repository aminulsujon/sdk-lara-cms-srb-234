<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Admin') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
        <style>
            a{text-decoration: none;color:#000}
            .form-group{margin-bottom: 20px}
            .form-group label{width: 200px;display:inline-block;}
            .form-group .cke_chrome{width:500px;}
            .d-inline-block{display:inline-block}
            .mr-2{margin-right:10px}
            .table {width:100%}
            #details{min-height:400px}
        </style>
        <style>
            .vertical-nav-menu ul {
              display: none;
              padding-left: 1rem;
            }
          
            .vertical-nav-menu li.open > ul {
              display: block;
            }
          
            .vertical-nav-menu li > a {
              display: flex;
              justify-content: space-between;
              align-items: center;
              cursor: pointer;
            }
          
            /* Arrow icons using HTML characters */
            .vertical-nav-menu li > a::after {
              content: '▼';
              font-size: 0.7rem;
              margin-left: auto;
              transition: transform 0.3s ease;
            }
          
            .vertical-nav-menu li.open > a::after {
              content: '▲';
            }
          
            /* Remove arrow for items with no submenu */
            .vertical-nav-menu li:not(:has(ul)) > a::after {
              content: '';
            }
          </style>
          
          
          <script>
            document.addEventListener("DOMContentLoaded", function () {
              const itemsWithSubmenu = document.querySelectorAll(".vertical-nav-menu > li > a");
          
              itemsWithSubmenu.forEach(link => {
                const parentLi = link.parentElement;
                const submenu = parentLi.querySelector("ul");
          
                if (submenu) {
                  link.addEventListener("click", function (e) {
                    e.preventDefault();
                    parentLi.classList.toggle("open");
                  });
                }
              });
            });
          </script>
          
          

    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="px-4 sm:px-6 lg:px-8 mt-4">
            <div class="grid grid-cols-5 gap-4">
                    <div class="px-2 bg-gray-200 border-r">@include('components.nav')
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
        
                            <x-responsive-nav-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-responsive-nav-link>
                        </form>
                    </div>
                    <div class="col-span-4">
                        @yield('content')
                    </div>
                </div>
                <div class="flex"></div>
                
            </main>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
        
    </body>
</html>
