@extends('layouts.app')

@section('content')
    @include('slider.slider')

    <hr>
    @if(count($cards) > 0)
        <div class="ownContainer">
            <div class="cards__wrapper">
                @foreach($cards as $card)
                    <div class="card__wrapper">
                        <div class="card card-adaptive">
                            <img class="card-img-top" src="{{ $card->getImagePath('image', 'mini') }}" alt="{{ $card->title }}">
                            <div class="card-body" style="text-align: center;">
                                <a href="{{ $card->route ? route($card->route.'.index') : ''}}" class="card-text">{{ $card->title }}</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
@endsection

@push('js')
    <script src="{{ asset('/js/slide.js') }}"></script>
@endpush
