@extends('layouts.inner_test')

@section('h1')
    Тестик көнүгүүлөр
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/test.css') }}">
@endpush

@section('inner_content')
    <div class="content__0">
        <div class="content-header">
            <div class="row">
                <div class="col">
                    {!! widget('test-title-text') !!}
                </div>
            </div>
        </div>

        <div class="content__body">
            <div class="сontent__body_wrapper">
                <div style="width: 100%; line-height: 2;">
                    <div style="width: 100%; text-align: center;">
                        <h5>Тесттер бөлүмүнө кош келдиңиз...</h5>
                    </div>

                    <p>
                        Каптал менюдан тест бөлүмүн тандап, бөлүмдөр боюнча даярдалган тесттерге күбө болуңуз.
                        Тесттин ар бир суроосуна жооп берүүңүз керек, антпесе сиз берген жоопторуңузду текшере албайсыз.
                        Сизге албан-албан ийгиликтерди каалайбыз.
                    </p>

                    <p style="display: block; text-align: right;"> Learn BY YOURSELF </p>

                    <div style="width: 60%; margin: 50px auto;">
                        <img src="{{ asset('/img/english_new.jpg') }}" alt="" style="width: 100%;">

                        <div style="width: 30%; margin: 0 auto;">
                            <img src="{{ asset('/img/under_text_image.jpg') }}" alt="" style="width: 100%;">
                        </div>
                    </div>
                </div>
            </div>
            <div class="right__side"></div>
        </div>
    </div>
@endsection