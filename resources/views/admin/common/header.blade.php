<header class="ownHeader">
    <div class="header__wrapper">
        <div class="header__logo">
            <p><a href="{{ url('/admin') }}">Learn byYOURSELF</a></p>
        </div>
        <div>
            <div class="return_to_site"><a href="{{ route('home') }}">Сайтка кайтуу</a></div>
            <div id="current_user" class="current-user">
                <div class="img-cuser">
                    @if(Auth::user()->getImagePath('image', 'micro'))
                        <img class="user-image" src="{{ Auth::user()->getImagePath('image', 'micro') }}">
                    @else
                        <img class="user-image" src="{{ asset('/img/current-user.png') }}">
                    @endif
                </div>
                <span class="cuser-arrow">&#9660;</span>
            </div>
            <div id="current_user_profile" class="current-user-profile">
                <ol>
                    <li>
                        <div class="">
                            <a href="{{ route('profile.index', ['id' => Auth::user()->id]) }}">{{ Auth::user()->fullname }}</a><br>
                            <span class="email">{{ Auth::user()->email }}</span>
                        </div>
                    </li>
                    <li>
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">Чыгуу
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ol>
            </div>
        </div>
    </div>
</header>