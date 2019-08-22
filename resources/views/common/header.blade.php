<header class="ownHeader">
    <div class="header__wrapper">
        <div class="header__top">
            <div class="header__logo">
                <a href="{{ route('home') }}">Learn by<span id="company">YOURSELF</span></a>
            </div>

            <div class="header__top_left">
                <div class="h__top_mid_wrapper">
                    <span class="feedback_num">тел: {!! widget('phone-number') !!}</span>
                    <p class="feedback_num">&#8195;&#8195; {!! widget('phone-number2') !!}</p>
                </div>
            </div>

            <div class="header__top_mid">
                <div class="header_social_icon">
                    {!! widget('social-link') !!}
                </div>
            </div>

            <div class="header__top_right">
                {!! widget('header-right-text') !!}
            </div>
        </div>

        <div class="header_menu_wrapper">
            <div class="header__menu">
                <div class="ownNav">
                    <div class="ownTopnav" id="myTopnav">
                        <ul>
                            <li><a href="{{ route('home') }}">Башкы</a></li>
                            <li id="dropDownLby"><a>Көнүгүү</a>&emsp;<span id="arrow">&#9668;</span>
                                <ul id="exeDDM" class="">
                                    <li><a href="{{ route('grammar.index') }}">Грамматика</a></li>
                                    <li><a href="{{ route('video.index') }}">Видео</a></li>
                                    <li><a href="{{ route('tests.index') }}">Тест</a></li>
                                </ul>
                            </li>
                            <li><a href="{{ route('images.index') }}">Сүрөттөр</a></li>
                            <li><a href="{{ route('blog.index') }}">Блог</a></li>
                            <li><a href="{{ route('feedback.index') }}">Дареги</a></li>
                        </ul>
                    </div>
                </div>
                <div>
                    <div id="current_user" class="current-user">
                        <div class="img-cuser">
                            @if(Auth::user()->getImagePath('image', 'micro'))
                                <img class="user-image" src="{{ Auth::user()->getImagePath('image', 'micro') }}" alt="{{ Auth::user()->fullname }}" class="user-avatar">
                            @else
                                <img class="user-image" src="{{ asset('/img/current-user.png') }}" alt="{{ Auth::user()->fullname }}" class="user-avatar">
                            @endif
                        </div>
                        <span class="cuser-arrow">&#9660;</span>
                    </div>
                    <div id="current_user_profile" class="current-user-profile">
                        <ol>
                            <li>
                                <div class="">
                                    <a href="{{ route('profile.index', ['id' => Auth::user()->id]) }}">{{ Auth::user()->fullname }}</a>
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
                <div>
                    <a id="menu" class="icon">&#9776;</a>
                </div>
            </div>
        </div>
    </div>
</header>