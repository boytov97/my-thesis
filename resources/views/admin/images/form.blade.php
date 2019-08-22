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
                                <label class="input__label">Категория</label>
                                <select class="form_input__adm select__adm {{ $errors->has(0) ? 'error_i' : '' }}" name="category_id">
                                    @if(count($categories) > 0)
                                        @foreach($categories as $key => $category)
                                            <option value="{{ $key }}" {{ $key === $entity->category_id ? 'selected' : '' }}>{{ $category }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row col__wrapper">
                        <div class="col-md-6">
                            @include('admin.common.forms.image', ['field' => 'image', 'slug' => 'mini'])
                        </div>

                        <div class="col-md-3">
                            <div class="input__wrapper">
                                <label class="input__label">Жарыялоо</label>
                                <div class="checkbox__wrapper">
                                    <input type="hidden" name="active" value="0">
                                    <input type="checkbox" name="active" class="checkbox__adm"
                                           {{ ($entity->active === 1) || old('active') ? 'checked' : ''}} value="1">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="input__wrapper">
                                <label class="input__label">Башкы баракчага</label>
                                <div class="checkbox__wrapper">
                                    <input type="hidden" name="on_main" value="0">
                                    <input id="on_main" type="checkbox" name="on_main" class="checkbox__adm"
                                           {{ ($entity->on_main === 1) || old('on_main') ? 'checked' : ''}} value="1">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row col__wrapper hidden__wrapper {{ $entity->route ? '' : 'hidden__block' }}">
                        <div class="col-md-6">
                            <div class="input__wrapper">
                                <label class="input__label">Адрестик аты</label>
                                <input type="text" name="route" class="img-route_field form_input__adm {{ $errors->has('route') ? 'error_i' : '' }} "
                                       value="{{ $entity->route ?: old('route') }}">
                                <span class="help__block">grammar, video, tests, images, blog</span>
                                @if ($errors->has('route'))
                                    <span class="error__message">{{ $errors->first('route') }}</span>
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

@push('js')
    <script>
        document.querySelector('#on_main').onchange = showRouteField;

        function showRouteField() {
            $('.img-route_field').val('');
            $('.hidden__wrapper').toggleClass('hidden__block');
        }
    </script>
@endpush