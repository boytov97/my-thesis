@extends('admin.layouts.content')

@section('content_head')
    @include('admin.common.head', ['title' => $title])
@endsection

@section('content')
    <div class="content__body">
        @if(session()->has('message') && count($errors) == 0)
            <div class="success__message">
                <span>{{ session('message') }}</span>
            </div>
        @endif

        @if(count($errors) > 0)
            <div class="validate__message">
                <span>@lang('admin.form_error')</span>
                <ul class="val__error">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if($entity)
            <div class="form_wrapper">
                <form action="{{ route($route, ['id' => $entity->id]) }}" method="post">
                    {{ csrf_field() }}
                    <div class="row col__wrapper">
                        <div class="col-md-6">
                            <div class="input__wrapper">
                                <label class="input__label">Аталышы</label>
                                <input type="text" name="title" class="form_input__adm {{ $errors->has('title') ? 'error_i' : '' }} "
                                       value="{{ $entity->title ?: old('title') }}">
                                @if ($errors->has('title'))
                                    <span class="error__message">{{ $errors->first('title') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="input__wrapper">
                                <label class="input__label">Грамматика</label>
                                <select class="form_input__adm select__adm {{ $errors->has(0) ? 'error_i' : '' }}" name="grammar_id">
                                    @if(count($grammars) > 0)
                                        @foreach($grammars as $key => $grammar)
                                            <option value="{{ $key }}" {{ $key === $entity->grammar_id ? 'selected' : '' }}>{{ $grammar }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row col__wrapper">
                        <div class="col-md-6">
                            <div class="input__wrapper">
                                <label class="input__label">Баяндама текст</label>
                                <textarea name="description" class="textarea__adm_min {{ $errors->has('description') ? 'error_i' : '' }}">{!! $entity->description ?: old('description') !!}</textarea>
                                @if ($errors->has('description'))
                                    <span class="error__message">{{ $errors->first('description') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary btn-sm">сактоо</button>
                    </div>
                </form>
            </div>
        @endif
    </div>
@endsection