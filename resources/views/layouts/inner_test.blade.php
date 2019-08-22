@extends('layouts.app')

@section('content')
    @include('test.hid_side_menu')

    <div class="page__lby">
        @include('test.side_menu')

        @yield('inner_content')
    </div>
@endsection

@push('js')
    <script src="{{ asset('/js/categories.js') }}"></script>
@endpush