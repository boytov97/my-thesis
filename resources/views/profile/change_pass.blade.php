@extends('layouts.app')

@section('h1')
    Жеке бөлмө
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/profile01.css') }}">
@endpush

@section('content')
    <div class="ownContent">
        @include('profile.heading')

        <div class="row content_blc">
            <div class="col-md-10">
                <div class="profile-wrapper">
                    @include('profile.tags_links')

                    <div class="profile-my_form">
                        @if(session()->has('message') && count($errors) == 0)
                            <div class="success__message">
                                <span>{{ session('message') }}</span>
                            </div>
                        @endif

                        <form action="{{ route('profile.reset_pass', ['id' => $user->id]) }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="formGroupExampleInput">Жаңы пароль:</label>
                                <input type="password" name="password"
                                       class="form-control {{ $errors->has('password') ? 'error_input' : '' }}"
                                       id="formGroupExampleInput" placeholder="жаңы пароль">

                                @if ($errors->has('password'))
                                    <span class="errors-message">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput">Паролду тастыктаңыз:</label>
                                <input type="password" name="password_confirmation"
                                       class="form-control {{ $errors->has('password') ? 'error_input' : '' }}"
                                       id="formGroupExampleInput" placeholder="паролду тастыктаңыз">
                                @if ($errors->has('password_confirmation'))
                                    <span class="errors-message">{{ $errors->first('password_confirmation') }}</span>
                                @endif
                            </div>

                            <div class="button-block">
                                <button type="submit" class="btn btn-primary profile-save">өзгөртүү</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
            <div class="col-md-2">

            </div>
        </div>
    </div>
@endsection