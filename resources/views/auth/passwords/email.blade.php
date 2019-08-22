@extends('layouts.login_register')

@section('content')
<div class="form-wrapper">
    <div id="formBlock">
        <div class="in-formBlock">
            <div class="hd-text">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        <span>{{ session('status') }}</span>
                    </div>
                @else
                    <span>Көрсөтүлгөн адреске паролду алмаштыруучу баракчага жөнөтүүчү ссылка жөнөтүлөт.</span>
                @endif
            </div>

            <form action="{{ route('password.email') }}" method="post">
                @csrf
                <div id="input_block">
                    <div class="blockEachInput">
                        <input type="email" name="email" id="email" placeholder="e-mail дарек" class="input_class {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" required>
                    </div>

                    @if ($errors->has('email'))
                        <span class="errors-message">{{ $errors->first('email') }}</span>
                    @endif

                </div>
                <div id="button_block">
                    <button type="submit" id="button">Ж ө н ө т ү ү</button>
                </div>
            </form>
        </div>
    </div>
    <div class="widget-wrapper">
        <div class="invite-wrapper">
            <p class="invite-text">Азырка учурда колдонуп жаткан email адресиңизди жазып, жөнөтүү кнопкасын басыңыз.</p>
        </div>
    </div>
</div>
@endsection
