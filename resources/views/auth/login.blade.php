@extends('layouts.login_register')

@section('content')
<div class="form-wrapper">
    <div id="formBlock">
        <div class="in-formBlock">
            <div class="hd-text">
                <span>Биздин сайтка катталып англис тилин оңой жана акысыз үйрөнүңүз</span>
            </div>
            <form action="{{ route('login') }}" method="post">
                @csrf
                <div id="input_block">
                    <div class="blockEachInput"> 
                        <input type="email" name="email" id="email" placeholder="e-mail дарек" class="input_class {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" required>
                    </div>

                    @if ($errors->has('email'))
                        <span class="errors-message">{{ $errors->first('email') }}</span>
                    @endif
                
                    <div class="blockEachInput">
                        <input type="password" id="password" name="password" placeholder="пароль" class="input_class {{ $errors->has('password') ? ' is-invalid' : '' }}" required>
                       @if ($errors->has('password'))
                            <span class="errors-message">{{ $errors->first('password') }}</span>
                        @endif
                    </div>

                    <div class="remember-forgot">
                        <div class="form-check remember-me-blk">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                <span class="remember-me">{{ __('Эстеп калуу') }}</span>
                            </label>
                        </div>
                        @if (Route::has('password.request'))
                        <div class="forgot-blk">
                            <a href="{{ route('password.request') }}">
                                Паролуңузду унутуңузбу?
                            </a>
                        </div>    
                        @endif
                    </div>    
                </div>
                <div id="button_block">
                    <button type="submit" id="button">К и р ү ү</button>
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
