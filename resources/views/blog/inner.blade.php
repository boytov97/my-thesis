@extends('layouts.inner_blog')

@section('h1')
    {{ $entity->title }}
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/show-blog.css') }}">
@endpush

@section('inner_content')
    <div class="content__0">
        <div class="content-header">
            <div class="row">
                <div class="col">
                    @if(widget('blog-title-text'))
                        {!! widget('blog-title-text') !!}
                    @endif
                </div>
            </div>
        </div>

        <div class="content__body">
            <div class="сontent__body_wrapper">
                <div class="blog-wrapper">
                    <div class="audio-block">
                        <audio controls class="blog-audio">
                            <source src="{{ $entity->getFilePath('file', 'audio') }}" type="audio/mpeg">
                            Your browser does not support the audio tag.
                        </audio>
                    </div>
                    <div class="blog-title">
                        <h4>{{ $entity->title }}</h4>
                    </div>
                    <div class="blog-info">
                        <div class="blog-authorDate text-muted">
                            Автор: {{ $entity->author }} / {{ $entity->created_at }}
                        </div>
                        <div class="blog-category text-muted">
                            {{ $entity->parent->title }}
                        </div>
                    </div>
                    <div class="blog-text">
                        {!! $entity->content !!}
                    </div>

                    @if($entity->unf_words)
                        <div class="unfamiliar-words">
                            <ul>
                                {!! $entity->unf_words !!}
                            </ul>
                        </div>
                    @endif

                    <div class="blog-catLink">
                        <div class="link-to-back">
                            <a href="{{ url()->previous() }}">&larr; Артка</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="right__side">

            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('/js/show-blog.js') }}"></script>
@endpush