<ul class="nav">
    @if(auth()->user())
        <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}">Logout</a>
        </li>
    @else
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/">Login</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('registration') }}">Registration</a>
        </li>
    @endif
</ul>
