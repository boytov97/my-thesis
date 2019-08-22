@extends('admin.layouts.content')

@section('content_head')
    <div class="content__heading">
        <h5>Администраторлор</h5>
    </div>

    <div class="section__adm">
        <a href="{{ route(substr_replace($routePrefix, '', -1)) }}"><i class="fa fa-list"></i>Тизме</a>
    </div>
@endsection

@section('content')
    <div class="content__body">
        @if(session()->has('message'))
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
                <div class="common__info">
                    <span>{{ $entity->fullname }}</span> / <span>{{ $entity->position }}</span>
                </div>
                <form action="{{ route('admins_update', ['id' => $entity->id ]) }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input__wrapper">
                                <label class="input__label">Кызмат орду</label>
                                <input type="text" name="position" class="form_input__adm" value="{{ $entity->position }}">
                                @if ($errors->has('position'))
                                    <span class="error__message">{{ $errors->first('position') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="input__wrapper">
                                <label class="input__label">Супер Админ</label>
                                <div class="checkbox__wrapper">
                                    <input type="hidden" name="super_admin" value="0">
                                    <input type="checkbox" name="super_admin" class="checkbox__adm"
                                            {{ $entity->super_admin ? 'checked' : ''}} value="1">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="input__wrapper">
                                <label class="input__label">Админ</label>
                                <div class="checkbox__wrapper">
                                    <input type="hidden" name="type" value="default">
                                    <input type="checkbox" name="type" class="checkbox__adm"
                                            {{ ($entity->type === 'admin') ? 'checked' : ''}} value="admin">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary btn-sm">сактоо</button>
                        </div>
                    </div>
                </form>
            </div>
        @endif
    </div>
@endsection