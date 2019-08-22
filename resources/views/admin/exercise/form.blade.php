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
                                <select class="form_input__adm select__adm {{ $errors->has(0) ? 'error_i' : '' }}" name="exe_category_id">
                                    @if(count($exe_categories) > 0)
                                        @foreach($exe_categories as $key => $category)
                                            <option value="{{ $key }}" {{ $key === $entity->exe_category_id ? 'selected' : '' }}>{{ $category }}</option>
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
                        <div class="col-md-4">
                            <div class="input__wrapper">
                                <label class="input__label">Башкы бөлүм</label>
                                <input type="text" name="part_one" class="form_input__adm {{ $errors->has('part_one') ? 'error_i' : '' }} "
                                       value="{{ $entity->part_one ?: old('part_one') }}">
                                @if ($errors->has('part_one'))
                                    <span class="error__message">{{ $errors->first('part_one') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="input__wrapper">
                                <label class="input__label">Туура жооп</label>
                                <input type="text" name="answer" class="form_input__adm {{ $errors->has('answer') ? 'error_i' : '' }} "
                                       value="{{ $entity->answer ?: old('answer') }}">
                                @if ($errors->has('answer'))
                                    <span class="error__message">{{ $errors->first('answer') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="input__wrapper">
                                <label class="input__label">Акыркы бөлүм</label>
                                <input type="text" name="part_two" class="form_input__adm {{ $errors->has('part_two') ? 'error_i' : '' }} "
                                       value="{{ $entity->part_two ?: old('part_two') }}">
                                @if ($errors->has('part_two'))
                                    <span class="error__message">{{ $errors->first('part_two') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row col__wrapper">
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
                                <label class="input__label">Кийинки сапчага</label>
                                <div class="checkbox__wrapper">
                                    <input type="hidden" name="transition" value="0">
                                    <input type="checkbox" name="transition" class="checkbox__adm"
                                           {{ ($entity->transition === 1) || old('transition') ? 'checked' : ''}} value="1">
                                </div>
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