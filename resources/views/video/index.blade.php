@extends('layouts.app')

@section('h1')
    Видео сабактар
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/video.css') }}">
@endpush

@section('content')
    <div class="ownContent">
        <div class="content_blc">
            <div class="row">
                <div class="col">
                    {!! widget('video-title-text') !!}
                </div>
            </div>
        </div>

        <div class="row content_blc line-top">
            <div class="col-md-10">
                <div class="wrapper">
                    @if(count($entities) > 0)
                        @foreach($entities as $entity)
                            <div class="inline_block">
                                <a href="{{ route('video.show', ['id' => $entity->id]) }}">
                                    <div class="video-card">
                                        <div class="video-block inline_blk">
                                            <video poster="{{ $entity->getImagePath('image', 'mini') }}" class="video">
                                                <source src="{{ $entity->getFilePath('file', 'video') }}" type="video/mp4">
                                            </video>
                                            <span class="video-time">{{ $entity->duration }}</span>
                                            <img class="v-play" src="{{ asset('/img/video_p.png') }}">
                                        </div>
                                        <div class="video-card-body inline_blk">
                                            <p class="video-title">{{ $entity->title }}</p>
                                            <span class="full-video-title">{{ $entity->title }}</span>
                                            <span class="video-author">{{ $entity->author }}</span>
                                            <p class="video-date text-muted">{{ $entity->created_at }}</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @else
                        <p>Запис жок</p>
                    @endif
                </div>
            </div>
            <div class="col-md-2 reclama">

            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('/js/video.js') }}"></script>
@endpush