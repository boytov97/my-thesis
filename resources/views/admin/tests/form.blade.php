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
                                <label class="input__label">Тема (Грамматикалык бөлүм)</label>
                                <select class="form_input__adm select__adm {{ $errors->has(0) ? 'error_i' : '' }}" name="category_id">
                                    @if(count($categories) > 0)
                                        @foreach($categories as $key => $category)
                                            <option value="{{ $key }}" {{ $key === $entity->category_id ? 'selected' : '' }}>{{ $category }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="input__wrapper">
                                <label class="input__label">Приоритет</label>
                                <input type="text" name="priority" class="form_input__adm {{ $errors->has('priority') ? 'error_i' : '' }} "
                                       value="{{ $entity->priority ?: old('priority') ?: 0}}">
                                @if ($errors->has('priority'))
                                    <span class="error__message">{{ $errors->first('priority') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row col__wrapper">
                        <div class="col-md-6">
                            <div class="input__wrapper">
                                <label class="input__label">Варианттар ("-" менен бөлүп)</label>
                                <textarea name="options" class="textarea__adm_min {{ $errors->has('options') ? 'error_i' : '' }}">{!! $entity->options ?: old('options') !!}</textarea>
                                @if ($errors->has('options'))
                                    <span class="error__message">{{ $errors->first('options') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="input__wrapper">
                                <label class="input__label">Суроо</label>
                                <input type="text" name="question" class="form_input__adm {{ $errors->has('question') ? 'error_i' : '' }} "
                                       value="{{ $entity->question ?: old('question') }}">
                                @if ($errors->has('question'))
                                    <span class="error__message">{{ $errors->first('question') }}</span>
                                @endif
                            </div>
                            <br>
                            <div class="input__wrapper">
                                <label class="input__label">Туура жооп</label>
                                <input type="text" name="answer" class="form_input__adm {{ $errors->has('answer') ? 'error_i' : '' }} "
                                       value="{{ $entity->answer ?: old('answer') }}">
                                @if ($errors->has('answer'))
                                    <span class="error__message">{{ $errors->first('answer') }}</span>
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