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
                @if(count($entities) > 0)
                    <div class="test-wrapper left-margin">
                        <div class="title">
                            <h5>{{ $category->title }}</h5>
                        </div>
                        <p class="error__message"></p>
                        <div class="test-body">
                            <form action="{{ route('tests.check', ['id' => $category->id]) }}"
                                  method="POST" id="test_form">
                                <ol>
                                    @foreach($entities as $entity)
                                        <input type="hidden" name="answ{{ $entity->id }}">

                                        <li>
                                            @if(isset($entity->user_answer))
                                                @if($entity->user_answer === $entity->answer)
                                                    <b class="q-answ{{ $entity->id }} correct-answ">{{ $entity->question }}</b>
                                                    <i class="fas fa-check"></i><br>
                                                @else
                                                    <b class="q-answ{{ $entity->id }} uncorrect_answ">{{ $entity->question }}</b>
                                                    <i class="fas">туура жооп: {{ $entity->answer }}</i><br>
                                                @endif
                                            @else
                                                <b class="q-answ{{ $entity->id }}">{{ $entity->question }}</b>
                                                <i class="fas"></i><br>
                                            @endif

                                            @php $options = explode("-", $entity->options) @endphp

                                            @foreach($options as $key => $option)
                                                <input type="radio" class="radio_input"
                                                       name="answ{{ $entity->id }}" value="{{ $option }}"
                                                        {{ (isset($entity->user_answer) && $entity->user_answer === $option) ? 'checked' : '' }}>{{ $option }}<br>
                                            @endforeach
                                        </li>
                                    @endforeach
                                </ol>
                            </form>
                        </div>
                    </div>

                    <div class="test-result" @if($results) style="display: block;" @endif>
                        <ul>
                            <li>Суроолор: <span class="question_count">@if($results) {{ $results->question_count }} @endif</span></li>
                            <li>Туура жооп: <span class="corrects">@if($results) {{ $results->corrects }} @endif</span></li>
                            <li>Жыйынтык: <span class="percent">@if($results) {{ $results->percent }}%@endif</span></li>
                        </ul>
                    </div>

                    <div class="check-button-blk">
                        @if($results)
                            <button class="check-button btn btn-primary btn-sm" disabled>Текшерилген</button>
                        @else
                            <button id="test_chaeck" class="check-button btn btn-primary btn-sm">Текшерүү</button>
                        @endif
                    </div>
                @endif
            </div>
            <div class="right__side"></div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $('#test_chaeck').on('click', function(event) {
                event.preventDefault();

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: $('#test_form').attr('method'),
                    url: $('#test_form').attr('action'),
                    data: $('#test_form').serialize(),
                    beforeSend: function() {
                        $('#test_chaeck').prop('disabled', true);
                        $('#test_chaeck').val('Текшерүүдө...');
                    },
                    success: function (data) {
                        $('#test_chaeck').html('Текшерилди');
                        $('.error__message').html('');

                        $.each(data.result, function (key, value) {
                            var q_class = '.q-' + key;
                            if(value === 1) {
                                $(q_class).next().addClass('fa-check');
                                $(q_class).addClass('correct-answ');
                            } else {
                                $(q_class).next().html('туура жооп: ' + value);
                                $(q_class).addClass('uncorrect_answ');
                            }
                        });

                        $.each(data.common_result, function (key, value) {
                            var common_res = '.' + key;

                            if(key === 'percent') {
                                $(common_res).html(value + '%');
                            } else {
                                $(common_res).html(value);
                            }
                        });

                        $('.test-result').css('display', 'block');
                    },
                    error: function (errors) {
                        $('#test_chaeck').prop('disabled', false);
                        $('#test_chaeck').val('Текшерүү');

                        $.each(errors.responseJSON.errors, function (key, value) {
                            $('.error__message').html(value);
                        });
                    },
                });
            });
        });
    </script>
@endpush