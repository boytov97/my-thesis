@extends('layouts.login_register')

@section('content')
<div class="form-wrapper">
    <div id="formBlock">
        <div class="in-formBlock">
            <div class="hd-text">
                <span>Биздин сайтка катталып англис тилин оңой жана акысыз үйрөнүңүз</span>
            </div>
            <form action="{{ route('password.update') }}" method="post">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <div id="input_block">
                    <div class="blockEachInput">
                        <input type="email" name="email" id="email" placeholder="e-mail дарек" class="input_class {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ $email ?? old('email') }}" required autofocus>
                    </div>

                    @if ($errors->has('email'))
                        <span class="errors-message">{{ $errors->first('email') }}</span>
                    @endif

                    <div class="blockEachInput">
                        <input type="password" id="password" name="password" placeholder="жаңы пароль" class="input_class {{ $errors->has('password') ? ' is-invalid' : '' }}" required>
                    </div>

                    @if ($errors->has('password'))
                        <span class="errors-message">{{ $errors->first('password') }}</span>
                    @endif

                    <div class="blockEachInput">
                        <input id="password-confirm" type="password" name="password_confirmation" placeholder="паролду тастыктаңыз" class="input_class" required>
                    </div>
                </div>
                <div id="button_block">
                    <button type="submit" id="button">А л м а ш т ы р у у</button>
                </div>
            </form>
        </div>
    </div>
    <div class="widget-wrapper">
        <div class="invite-wrapper">
            <p class="invite-text">Биздин сайтка катталып англис тилин оңой жана акысыз үйрөнүңүз</p>
        </div>
    </div>
</div>
@endsection
