<!doctype html>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
        <link rel="stylesheet" href="{{ asset('resources/css/style.css') }}">
        <link rel="shortcut icon" href="">
        <link rel="icon" type="image/x-icon" href="{{ asset('resources/media/adminfavicon.png') }}">
        <title>@yield('page-title')</title>
    </head>

    <body class="@yield('page') private-body">
        <header class="private-navigation">
            <nav>

                <div class="menu-button">
                    <div class="line1"></div>
                    <div class="line2"></div>
                    <div class="line3"></div>
                </div>

                <ul class="private-nav-list">

                    <li>
                        <div class="link-container">
                            <a href="{{ route('admin') }}">
                                <img class="icon-svg" src="{{ asset('resources/media/svgs/house-fill.svg') }}" alt="X">
                                <span>Home</span>
                            </a>
                        </div>
                    </li>

                    <li>
                        <div class="private-nav-button-container">
                            <button id="reporter-button">
                                <img class="icon-svg" src="{{ asset('resources/media/svgs/book-fill.svg') }}" alt="X">
                                <span>Media</span>
                                <img class="arrow-down-svg" src="{{ asset('resources/media/svgs/arrow-down.svg') }}" alt="X">
                            </button>
                        </div>

                        <div class="private-nav-dropdown-content" id="reporter-dropdown">
                            <ul>
                                @can('article index')
                                    <li>
                                        <a href="{{ route('article') }}">Articles</a>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    </li>

                    <li>
                        <div class="private-nav-button-container">
                            <button id="championships-button">
                                <img class="icon-svg" src="{{ asset('resources/media/svgs/trophy-fill.svg') }}" alt="X">
                                <span>Championships</span>
                                <img class="arrow-down-svg" src="{{ asset('resources/media/svgs/arrow-down.svg') }}" alt="X">
                            </button>
                        </div>

                        <div class="private-nav-dropdown-content" id="championships-dropdown">
                            <ul>
                                @can('constructorchampionship index')
                                    <li>
                                        <a href="{{ route('constructorchampionship') }}">Constructor Champs.</a>
                                    </li>
                                @endcan

                                @can('driverchampionship index')
                                    <li>
                                        <a href="{{ route('driverchampionship') }}">Driver Champs.</a>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    </li>

                    <li>
                        <div class="private-nav-button-container">
                            <button id="fia-button">
                                <img class="icon-svg" src="{{ asset('resources/media/svgs/flag-fill.svg') }}" alt="X">
                                <span>FIA</span>
                                <img class="arrow-down-svg" src="{{ asset('resources/media/svgs/arrow-down.svg') }}" alt="X">
                            </button>
                        </div>

                        <div class="private-nav-dropdown-content" id="fia-dropdown">
                            <ul>
                                @can('race index')
                                    <li>
                                        <a href="{{ route('race') }}">Races</a>
                                    </li>
                                @endcan

                                @can('penaltypoint index')
                                    <li>
                                        <a href="{{ route('penaltypoint') }}">Penalty Points</a>
                                    </li>
                                @endcan

                                @can('request index')
                                    <li>
                                        <a href="{{ route('admin.requests') }}">Requests</a>
                                    </li>
                                @endcan

                                @can('availability index')
                                    <li>
                                        <a href="{{ route('admin.availability') }}">Availability</a>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    </li>

                    <li>
                        <div class="private-nav-button-container">
                            <button id="admin-button">
                                <img class="icon-svg" src="{{ asset('resources/media/svgs/lock-fill.svg') }}" alt="X">
                                <span>Admin</span>
                                <img class="arrow-down-svg"  src="{{ asset('resources/media/svgs/arrow-down.svg') }}" alt="X">
                            </button>
                        </div>

                        <div class="private-nav-dropdown-content" id="admin-dropdown">
                            <ul>

                                @can('driver index')
                                    <li>
                                        <a href="{{ route('driver') }}">Drivers</a>
                                    </li>
                                @endcan

                                @can('team index')
                                    <li>
                                        <a href="{{ route('team') }}">Teams</a>
                                    </li>
                                @endcan

                                @can('season index')
                                    <li>
                                        <a href="{{ route('season') }}">Seasons</a>
                                    </li>
                                @endcan

                                @can('tier index')
                                    <li>
                                        <a href="{{ route('tier') }}">Tiers</a>
                                    </li>
                                @endcan

                                @can('track index')
                                    <li>
                                        <a href="{{ route('track') }}">Tracks</a>
                                    </li>
                                @endcan

                                @can('powerunit index')
                                    <li>
                                        <a href="{{ route('powerunit') }}">Power-units</a>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    </li>

                    <li>
                        <div class="private-nav-button-container">
                            <button id="auth-button">
                                <img class="icon-svg" src="{{ asset('resources/media/svgs/lock-fill.svg') }}" alt="X">
                                <span>Auth</span>
                                <img class="arrow-down-svg"  src="{{ asset('resources/media/svgs/arrow-down.svg') }}" alt="X">
                            </button>
                        </div>

                        <div class="private-nav-dropdown-content" id="auth-dropdown">
                            <ul>
                                @can('user index')
                                    <li>
                                        <a href="{{ route('user') }}">User</a>
                                    </li>
                                @endcan

                                @can('role index')
                                    <li>
                                        <a href="{{ route('role') }}">Role</a>
                                    </li>
                                @endcan

                                @can('permission index')
                                    <li>
                                        <a href="{{ route('permission') }}">Permission</a>
                                    </li>
                                @endcan

                                @can('log index')
                                    <li>
                                        <a href="{{ route('log') }}">Log</a>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    </li>
                </ul>
            </nav>

            <div class="open-page-link">
                <a href="{{ route('home') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-door-open-fill" viewBox="0 0 16 16">
                        <path d="M1.5 15a.5.5 0 0 0 0 1h13a.5.5 0 0 0 0-1H13V2.5A1.5 1.5 0 0 0 11.5 1H11V.5a.5.5 0 0 0-.57-.495l-7 1A.5.5 0 0 0 3 1.5V15H1.5zM11 2h.5a.5.5 0 0 1
                        .5.5V15h-1V2zm-2.5 8c-.276 0-.5-.448-.5-1s.224-1 .5-1 .5.448.5 1-.224 1-.5 1z"/>
                    </svg>
                    <span>Homepage</span>
                </a>
            </div>
        </header>

        <main class="main-container">

            <div class="top-bar">

            </div>

            @yield('content')

        </main>

        <script src="{{ asset('resources/javascript/app.js') }}"></script>
    </body>
</html>
