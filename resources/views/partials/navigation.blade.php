<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="/">Lotto Lottery</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{route('lotto.index')}}">Lotto</a>
                </li>
                <li class="nav-item">
                    @if(Illuminate\Support\Facades\Auth::check())
                    <a class="nav-link" href="/profile">My account</a>
                    @else
                        <a class="nav-link" href="/login">My account</a>
                        @endif
                </li>


            </ul>

            @if(Illuminate\Support\Facades\Auth::check())
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                </form>
            @endif



        </div>
    </div>
</nav>
