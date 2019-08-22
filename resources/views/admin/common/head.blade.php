<div class="content__heading">
    <h5>{{ $title }}</h5>
</div>

<div class="section__adm">
    <a href="{{ route(substr_replace($routePrefix, '', -1)) }}"><i class="fa fa-list"></i>Тизме</a>
    <a href="{{ route($routePrefix.'create') }}"><i class="fa fa-plus"></i>Кошуу</a>
</div>