@extends('layouts.inner_blog')

@section('h1')
    Блог
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/blogs.css') }}">
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
                @if(count($entities) > 0)
                    <div class="reset_entities">
                        <a href="{{ route('blog.index') }}" class="reset_link">Баштапкы абал</a>
                    </div>

                    <div class="blogs-wrapper">
                        @foreach($entities as $entity)
                            <div class="blogs">
                                <div class="blog-title">
                                    <h4>
                                        <a href="{{ route('blog.show', ['slug' => $entity->parent->slug, 'id' => $entity->id]) }}">
                                            {{ $entity->title }}
                                        </a>
                                    </h4>
                                </div>
                                <div class="blog-info">
                                    <span class="blog-authorDate text-muted">
                                        Автор: {{ $entity->author }} / {{ $entity->created_at }}
                                    </span>
                                </div>
                                <div class="blog-text">
                                    <p>{!! $entity->content !!}</p>
                                </div>
                                <div class="blog-catLink">
                                    <div class="blog-category">
                                        <a href="{{ route('blog.index', ['slug' => $entity->parent->slug]) }}">
                                            {{ $entity->parent->title }}
                                        </a>
                                    </div>
                                    <div class="link-to-fullText">
                                        <a href="{{ route('blog.show', ['slug' => $entity->parent->slug, 'id' => $entity->id]) }}">
                                            Толук окуу &#8594;
                                        </a>
                                    </div>
                                </div>
                            </div>
                         @endforeach
                    </div>

                    <div class="entity_pagination">
                        {{ $entities->links() }}
                    </div>
                @else
                    <p>Запис жок</p>
                @endif
            </div>
            <div class="right__side">

            </div>
        </div>
    </div>
@endsection