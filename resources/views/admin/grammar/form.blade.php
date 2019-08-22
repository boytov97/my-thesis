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
                                <label class="input__label">Тема (Категория)</label>
                                <select class="form_input__adm select__adm {{ $errors->has(0) ? 'error_i' : '' }}" name="category_id">
                                    @if(count($categories) > 0)
                                        @foreach($categories as $key => $category)
                                            <option value="{{ $key }}"
                                                    {{ ($key === $entity->category_id || $key === (int)old('category_id')) ? 'selected' : '' }}>
                                                {{ $category }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="input__wrapper">
                                <label class="input__label">Жарыялоо</label>
                                <div class="checkbox__wrapper">
                                    <input type="hidden" name="active" value="0">
                                    <input type="checkbox" name="active" class="checkbox__adm"
                                           {{ ($entity->active === 1) || old('active') ? 'checked' : ''}} value="1">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            @include('admin.common.forms.image', ['field' => 'image', 'slug' => 'mini'])
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="input__wrapper">
                            <label class="input__label">Мазмундук текст</label>
                            <textarea name="content" class="textarea__adm {{ $errors->has('content') ? 'error_i' : '' }}">{!! $entity->content ?: old('content') !!}</textarea>
                            @if ($errors->has('content'))
                                <span class="error__message">{{ $errors->first('content') }}</span>
                            @endif
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