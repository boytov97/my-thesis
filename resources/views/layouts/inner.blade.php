@extends('layouts.app')

@section('content')
    @include('grammar.hid_side_menu')

    <div class="page__lby">
        @include('grammar.side_menu')

        @yield('inner_content')
    </div>
@endsection

@push('js')
    <script src="{{ asset('/js/categories.js') }}"></script>
@endpush