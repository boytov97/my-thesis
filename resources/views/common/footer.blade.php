<footer class="ownFooter">
    <div class="footer_wrapper">
        <div class="row">
            <div class="col-md-2 footer_menu">
                <ol>
                    <li><a href="{{ route('home') }}">Башкы баракча</a></li>
                    <li><a href="{{ route('images.index') }}">Сүрөттөр</a></li>
                    <li><a href="{{ route('blog.index') }}">Блог</a></li>
                    <li><a href="{{ route('video.index') }}">Видео</a></li>
                </ol>
            </div>

            <div class="col-md-7" style="background: #F8E8B7;">

            </div>

            <div class="col-md-3 footer_right">
                {!! widget('adress') !!}

                <div class="header_social_icon">
                    {!! widget('social-link') !!}
                </div>
            </div>
        </div>
    </div>
</footer>