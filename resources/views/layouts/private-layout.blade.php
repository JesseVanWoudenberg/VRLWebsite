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

                <ul>
                    <li>
                        <div class="private-nav-button-container">
                            <button>
                                <img class="icon-svg" src="{{ asset('resources/media/svgs/person-circle.svg') }}" alt="X">
                                <span>FIA</span>
                                <img class="arrow-down-svg" src="{{ asset('resources/media/svgs/arrow-down.svg') }}" alt="X">
                            </button>
                        </div>

                        <div class="private-nav-dropdown-content">
                            <ul>
                                @can('race index')
                                    <li>
                                        <a href="{{ route('race') }}">Races</a>
                                    </li>
                                @endcan

                                @can('season index')
                                    <li>
                                        <a href="{{ route('season') }}">Seasons</a>
                                    </li>
                                @endcan

                                @can('penaltypoint index')
                                    <li>
                                        <a href="{{ route('penaltypoint') }}">Penalty Points</a>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    </li>

                    <li>
                        <div class="private-nav-button-container">
                            <button>
                                <span>Admin</span>
                                <img class="arrow-down-svg"  src="{{ asset('resources/media/svgs/arrow-down.svg') }}" alt="X">
                            </button>
                        </div>

                        <div class="private-nav-dropdown-content">
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
                            </ul>
                        </div>
                    </li>
{{--                    @can('article index')--}}
{{--                        <li>--}}
{{--                            <a href="{{ route('article') }}">Articles</a>--}}
{{--                        </li>--}}
{{--                    @endcan--}}

{{--                    @can('constructorchampionship index')--}}
{{--                        <li>--}}
{{--                            <a href="{{ route('constructorchampionship') }}">Constructor Champs.</a>--}}
{{--                        </li>--}}
{{--                    @endcan--}}

{{--                    @can('driverchampionship index')--}}
{{--                        <li>--}}
{{--                            <a href="{{ route('driverchampionship') }}">Driver Champs.</a>--}}
{{--                        </li>--}}
{{--                    @endcan--}}

{{--                    @can('driver index')--}}
{{--                        <li>--}}
{{--                            <a href="{{ route('driver') }}">Drivers</a>--}}
{{--                        </li>--}}
{{--                    @endcan--}}

{{--                    @can('powerunit index')--}}
{{--                        <li>--}}
{{--                            <a href="{{ route('powerunit') }}">Power-units</a>--}}
{{--                        </li>--}}
{{--                    @endcan--}}

{{--                    @can('race index')--}}
{{--                        <li>--}}
{{--                            <a href="{{ route('race') }}">Races</a>--}}
{{--                        </li>--}}
{{--                    @endcan--}}

{{--                    @can('season index')--}}
{{--                        <li>--}}
{{--                            <a href="{{ route('season') }}">Seasons</a>--}}
{{--                        </li>--}}
{{--                    @endcan--}}

{{--                    @can('team index')--}}
{{--                        <li>--}}
{{--                            <a href="{{ route('team') }}">Teams</a>--}}
{{--                        </li>--}}
{{--                    @endcan--}}

{{--                    @can('tier index')--}}
{{--                        <li>--}}
{{--                            <a href="{{ route('tier') }}">Tiers</a>--}}
{{--                        </li>--}}
{{--                    @endcan--}}

{{--                    @can('track index')--}}
{{--                        <li>--}}
{{--                            <a href="{{ route('track') }}">Tracks</a>--}}
{{--                        </li>--}}
{{--                    @endcan--}}

{{--                    @can('user index')--}}
{{--                        <li>--}}
{{--                            <a href="{{ route('user') }}">User</a>--}}
{{--                        </li>--}}
{{--                    @endcan--}}

{{--                    @can('role index')--}}
{{--                        <li>--}}
{{--                            <a href="{{ route('role') }}">Role</a>--}}
{{--                        </li>--}}
{{--                    @endcan--}}

{{--                    @can('penaltypoint index')--}}
{{--                        <li>--}}
{{--                            <a href="{{ route('penaltypoint') }}">Penalty Points</a>--}}
{{--                        </li>--}}
{{--                    @endcan--}}

{{--                    <li>--}}
{{--                        <a href="{{ route('home') }}">Open page</a>--}}
{{--                    </li>--}}

                </ul>
            </nav>
        </header>

        <main class="main-container">

            <div class="top-bar">

            </div>

            @yield('content')

        </main>

        <script src="{{ asset('resources/javascript/app.js') }}"></script>
    </body>
</html>
