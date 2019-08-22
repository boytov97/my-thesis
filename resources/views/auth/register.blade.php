@extends('layouts.login_register')

@section('content')
<div class="form-wrapper">
    <div id="formBlock">
        <div class="in-formBlock">
            <div class="hd-text">
                <span>Биздин сайтка катталып англис тилин оңой жана акысыз үйрөнүңүз</span>
            </div>
            <form action="{{ route('register') }}" method="post">
                @csrf
                <div id="input_block">
                    <div class="blockEachInput"> 
                        <input type="email" name="email" id="email" placeholder="e-mail дарек" class="input_class {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" required>
                        @if ($errors->has('email'))
                            <span class="errors-message">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <div class="blockEachInput"> 
                        <input type="text" id="fullname" name="fullname" placeholder="аты - жөнүңүз" class="input_class {{ $errors->has('fullname') ? ' is-invalid' : '' }}" value="{{ old('fullname') }}" required>
                        @if ($errors->has('fullname'))
                            <span class="errors-message">{{ $errors->first('fullname') }}</span>
                        @endif
                    </div>
                    <div class="blockEachInput"> 
                        <input type="date" id="birthday" name="birthday" placeholder="туулган күнүңүз" class="input_class {{ $errors->has('birthday') ? ' is-invalid' : '' }}" value="{{ old('birthday') }}">
                        @if ($errors->has('birthday'))
                            <span class="errors-message">{{ $errors->first('birthday') }}</span>
                        @endif
                    </div>
                    <div class="blockEachInput">
                        <input type="password" id="password" name="password" placeholder="жаңы пароль" class="input_class {{ $errors->has('password') ? ' is-invalid' : '' }}" required>
                        @if ($errors->has('password'))
                            <span class="errors-message">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                    <div class="blockEachInput">
                        <input type="password" id="password-confirm" name="password_confirmation" placeholder="паролду тастыктаңыз" class="input_class"  required>
                    </div>
                </div>
                <div id="button_block">
                    <button type="submit" id="button">К а т т а л у у</button>
                </div>
            </form>
            <!-- <p>же</p> -->
            <div id="iconsSN">
                <i class="fab fa-facebook"></i>
                <i class="fab fa-google"></i>
                <i class="fab fa-vk"></i>
                <p>аркылуу катталыңыз</p>
            </div>
        </div>
    </div>
    <div class="widget-wrapper">
        <div class="invite-wrapper">
            <p class="invite-text">Биздин сайтка катталып англис тилин оңой жана акысыз үйрөнүңүз</p>
        </div>
    </div>
</div>
@endsection
