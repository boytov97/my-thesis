@extends('layouts.inner')

@section('h1')
    Грамматика
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/grammar.css') }}">
@endpush

@section('inner_content')
    <div class="content__0">
        <div class="content-header">
            <div class="row">
                <div class="col">
                     {!! widget('grammar-title-text') !!}
                </div>
            </div>
        </div>

        <div class="content__body">
            <div class="сontent__body_wrapper">
                @if(count($entities))
                    @foreach($entities as $entity)
                        @if($entity->getImagePath('image', 'full'))
                            <div class="grammar_img_blk">
                                <img src="{{ $entity->getImagePath('image', 'full') }}"
                                     class="grammar_img" alt="{{ $entity->parent->title }}">
                            </div>
                        @endif

                        {!! $entity->content !!}

                        @include('grammar.exercise_links', ['exeCategories' => $entity->exeCategories])
                    @endforeach
                @else
                    @include('grammar.welcome')
                @endif
            </div>

            <div class="right__side">

            </div>
        </div>
    </div>
@endsection