@extends('layouts.app')

@section('h1')
    Грамматика маалыматтарын камтыган сүрөттөр
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/images.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/modal-view.css') }}">
@endpush

@section('content')
    <div class="ownContent">
        <div class="content_blc content-header">
            <div class="row">
                <div class="col">
                    {!! widget('images-title-text') !!}
                </div>
            </div>
        </div>

        <div class="row content_blc">
            <div class="col-md-10">
                <div class="image-wrapper">
                    @if(count($entities) > 0)
                        <div class="reset_entities">
                            <a href="{{ route('images.index') }}" class="reset_link">Баштапкы абал</a>
                        </div>

                        @foreach($entities as $entity)
                            <div class="img-card">
                                @if($entity->getImagePath('image', 'mini'))
                                    <div class="img-blk">
                                        <img class="image" src="{{ $entity->getImagePath('image', 'mini') }}"
                                             id="myImg" alt="{{ $entity->title }}"
                                             name="{{ $entity->getImagePath('image', 'full') }}">
                                        <img class="hidden_image" src="{{ $entity->getImagePath('image', 'full') }}"
                                              alt="{{ $entity->title }}">
                                    </div>

                                    <div class="img-body">
                                        <div class="img-title">
                                            <span>
                                                @if(strlen($entity->title) > 50)
                                                    {{ substr($entity->title, 0, 51) }}...
                                                @else
                                                    {{ $entity->title }}
                                                @endif
                                            </span>
                                        </div>
                                        <div class="hidden-title">
                                            <span>{{ $entity->title }}</span>
                                        </div>
                                        <div class="category">
                                            <a href="{{ route('images.index', ['slug' => $entity->parent->slug]) }}">
                                                {{ $entity->parent->title }}
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endforeach

                        <div class="entity_pagination">
                            {{ $entities->links() }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-md-2"></div>
        </div>
    </div>

    @include('images.modal')
@endsection

@push('js')
    <script src="{{ asset('/js/modal-view.js') }}"></script>
    <script src="{{ asset('/js/images.js') }}"></script>
@endpush