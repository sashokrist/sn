<nav class="navbar navbar-default" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ route('home') }}">BrandHouse-vConnect-Shippii</a>
        </div>
        <div class="collapse navbar-collapse">
            @if (Auth::check())
                <ul class="nav navbar-nav">
                    <li><a href="{{ route('home') }}">Timeline</a></li>
                    <li><a href="{{ route('friend.index') }}">Friends</a></li>
                    <li><a href="{{ route('event/index') }}">Event</a></li>
                    <li><a href="{{ route('poll') }}">Poll</a></li>
                    <li><a href="{{ route('poll/create') }}">Poll Create</a></li>
                </ul>

            @endif
            <ul class="nav navbar-nav navbar-right">
                @if (Auth::check())
                    <img src="{{asset('images/'.Auth::user()->avatar)}}" width="50" height="50" class="img-circle"
                         alt="profile picture" title="{{ Auth::user()->name }}">
                    <li>
                        <a href="{{ route('profile.index', ['username' => Auth::user()->username]) }}">{{ Auth::user()->getNameOrUsername() }}</a>
                    </li>
                    <li><a href="{{ route('profile.edit') }}">Update profile</a></li>
                    <li><a href="{{ route('auth.signout') }}">Sign out</a></li>
                    <form class="navbar-form navbar-left" role="search" action="{{ route('search.results') }}">
                        <div class="form-group">
                            <input type="text" name="query" class="form-control" placeholder="Find people">
                        </div>
                        <button type="submit" class="btn btn-default">Search</button>
                    </form>
                @else
                    <li><a href="{{ route('auth.signup') }}">Sign up</a></li>
                    <li><a href="{{ route('auth.signin') }}">Sign in</a></li>
                @endif
            </ul>
        </div>
        <div class="col-md12">
            <div class="row">
                <div class="col-xs-4">
                    <img src="{{ asset('images/img_12.png') }}" alt="..." height="100px" width="250px">

                </div>
                <div class="col-xs-4">
                    <img src="{{ asset('images/img_13.png') }}" alt="..." height="100px" width="250px">
                </div>
                <div class="col-xs-4">
                    <img src="{{ asset('images/img_14.png') }}" alt="..." height="100px" width="250px">
                </div>
                <br>
                <hr>
                <hr>
            </div>
{{--            <h1 class="text-center">BrandHouse Vconnect Shippii Network</h1>--}}
        </div>
    </div>
</nav>
