@extends('layouts.app')

@section('content')
    @include('blog.hid_side_menu')

    <div class="page__lby">
        @include('blog.side_menu')

        @yield('inner_content')
    </div>
@endsection

@push('js')
    <script src="{{ asset('/js/categories.js') }}"></script>
@endpush