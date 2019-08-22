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
                <form action="{{ route($route, ['id' => $entity->id]) }}" method="post" enctype="multipart/form-data">
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
                                <label class="input__label">Автор</label>
                                <input type="text" name="author" class="form_input__adm {{ $errors->has('author') ? 'error_i' : '' }} "
                                       value="{{ $entity->author ?: old('author') }}">
                                @if ($errors->has('author'))
                                    <span class="error__message">{{ $errors->first('author') }}</span>
                                @endif
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

                        <div class="col-md-6">
                            @include('admin.common.forms.files', ['field' => 'file', 'slug' => 'video', 'accept' => 'video/*'])
                        </div>
                    </div>

                    <div class="row col__wrapper">
                        <div class="col-md-6">
                            <div class="input__wrapper">
                                <label class="input__label">Жарыялоо</label>
                                <div class="checkbox__wrapper">
                                    <input type="hidden" name="active" value="0">
                                    <input type="checkbox" name="active" class="checkbox__adm"
                                           {{ ($entity->active === 1) || old('active') ? 'checked' : ''}} value="1">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            @include('admin.common.forms.poster_image', ['field' => 'image', 'slug' => 'mini'])
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