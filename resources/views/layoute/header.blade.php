<ul class="nav">
    <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="/">Home</a>
    </li>
    @if(auth()->user())
        @if(auth()->user()->is_admin)
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.users') }}">Users</a>
            </li>
        @endif
            <li class="nav-item">
                <a class="nav-link" href="{{ route('profile') }}">Profile</a>
            </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}">Logout</a>
        </li>
    @else
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{ route('login') }}">Login</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('registration') }}">Registration</a>
        </li>
    @endif
</ul>
