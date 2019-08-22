@extends('admin.layouts.content')

@section('content_head')
    <div class="content__heading">
        <h5>{{ $title }}</h5>
    </div>

    <div class="section__adm">
        <a href="{{ route(substr_replace($routePrefix, '', -1)) }}"><i class="fa fa-list"></i>Тизме</a>
    </div>
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
                                <label class="input__label">Орточо жакындык</label>
                                <input type="text" name="zoom" class="form_input__adm {{ $errors->has('zoom') ? 'error_i' : '' }} "
                                       value="{{ $entity->zoom ?: old('zoom') ?: 0}}">
                                @if ($errors->has('zoom'))
                                    <span class="error__message">{{ $errors->first('zoom') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="input__wrapper">
                                <label class="input__label">Кеңдик</label>
                                <input type="text" name="lat" class="form_input__adm {{ $errors->has('lat') ? 'error_i' : '' }} "
                                       value="{{ $entity->lat ?: old('lat') ?: 0}}">
                                @if ($errors->has('lat'))
                                    <span class="error__message">{{ $errors->first('lat') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row col__wrapper">
                        <div class="col-md-6">
                            <div class="input__wrapper">
                                <label class="input__label">Алыстык</label>
                                <input type="text" name="lng" class="form_input__adm {{ $errors->has('lng') ? 'error_i' : '' }} "
                                       value="{{ $entity->lng ?: old('lng') ?: 0 }}">
                                @if ($errors->has('lng'))
                                    <span class="error__message">{{ $errors->first('lng') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="input__wrapper">
                                <label class="input__label">Адрес</label>
                                <textarea name="address" class="textarea__adm_min {{ $errors->has('address') ? 'error_i' : '' }}">{!! $entity->address ?: old('address') !!}</textarea>
                                @if ($errors->has('address'))
                                    <span class="error__message">{{ $errors->first('address') }}</span>
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