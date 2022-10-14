<!doctype html>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
        <link rel="stylesheet" href="{{ asset('resources/css/style.css') }}">
        <link rel="shortcut icon" href="">
        <link rel="icon" type="image/x-icon" href="{{ asset('resources/media/favicon.jpg') }}">
        <title>@yield('page-title')</title>
    </head>

    <body class="@yield('page')">
        <header class="public-navigation">
            <nav>
                <ul class="nav-links-container">
                    <li>
                        <div class="dropdown">
                            <a href="">Tier 1</a>

                            <div class="dropdown-content">
                                <a href="{{ route('tier1.lineup') }}">Lineup</a>
                                <a href="{{ route('tier1.standings') }}">Standings</a>
                                <a href="{{ route('tier1.calendar') }}">Calendar</a>
                                <a href="{{ route('tier1.leaderboard') }}">Leaderboard</a>
                            </div>
                        </div>
                    </li>

                    {{--                    <li>--}}
                    {{--                        <div class="dropdown">--}}
                    {{--                            <a href="">Tier 2</a>--}}

                    {{--                            <div class="dropdown-content">--}}
                    {{--                                <a href="{{ route('tier2.lineup') }}">Lineup</a>--}}
                    {{--                                <a href="{{ route('tier2.standings') }}">Standings</a>--}}
                    {{--                                <a href="{{ route('tier2.calendar') }}">Calendar</a>--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                    </li>--}}

                    {{--                    <li>--}}
                    {{--                        <div class="dropdown">--}}
                    {{--                            <a href="">Tier 3</a>--}}

                    {{--                            <div class="dropdown-content">--}}
                    {{--                                <a href="{{ route('tier3.lineup') }}">Lineup</a>--}}
                    {{--                                <a href="{{ route('tier3.standings') }}">Standings</a>--}}
                    {{--                                <a href="{{ route('tier3.calendar') }}">Calendar</a>--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                    </li>--}}

                    <li>
                        <a class="non-dropdown-link" href="{{ route('news') }}">News</a>
                    </li>

                    <li>
                        <a class="non-dropdown-link" href="{{ route('the-team') }}">The team</a>
                    </li>

                    <li>
                        <a class="non-dropdown-link" target="_blank" href="https://discord.gg/xn2gcnJb">Discord</a>
                    </li>
                </ul>

                <div class="user-links-container">
                    <ul>
                        @guest

                            <li>
                                <a href="{{ route('login') }}">Login</a>
                            </li>

                        @endguest

                        @if(Auth::check())
                            @if(Auth::user()->getRoleNames()->first() == "admin")

                                <li>
                                    <a href="{{ route('admin') }}">Admin</a>
                                </li>

                            @endif
                        @endif

                        @if(Auth::check())
                            @if(Auth::user()->getRoleNames()->first() == "reporter")

                                <li>
                                    <a href="{{ route('article') }}">Articles</a>
                                </li>

                            @endif
                        @endif

                        @auth

                            <li>
                                <a href="{{ route('profile') }}">Profile</a>
                            </li>

                            <li>
                                <a href="{{ route('signout') }}">Sign out</a>
                            </li>

                        @endauth
                    </ul>
                </div>
            </nav>
        </header>

        <main>

            @yield('content')

        </main>
    </body>
</html>
