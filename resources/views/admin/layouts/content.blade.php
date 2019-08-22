@extends('admin.layouts.app')

@section('page_content')
    <div class="content__adm">
        @hasSection('content_head')
            @yield('content_head')
        @endif

        @yield('content')
    </div>
@endsection