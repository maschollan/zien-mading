<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom border-2 shadow">
    <div class="container d-flex justify-center">
        <button class="navbar-toggler box-shadow-none border-0" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mb-2 mb-lg-0  mx-auto">
                <li class="nav-item mx-md-none mx-4">
                    <a class="nav-link active" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item mx-md-none mx-4">
                    <a class="nav-link active" href="{{ route('tag') }}">Tag</a>
                </li>
                @auth
                    <li class="nav-item mx-md-none mx-4">
                        <a class="nav-link active" href="{{ route('profile') }}">Profile</a>
                    </li>
                @else
                    <li class="nav-item mx-md-none mx-4">
                        <a class="nav-link active" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item mx-md-none mx-4">
                        <a class="nav-link active" href="{{ route('register') }}">Register</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
