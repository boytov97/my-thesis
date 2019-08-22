@extends('layouts.inner')

@section('h1')
    Көнүгүүлөр
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/grammar.css') }}">
@endpush

@section('inner_content')
    <div class="content__0">
        <div class="content-header">
            <div class="row">
                <div class="col">
                    {!! widget('exercise-title-text') !!}
                </div>
            </div>
        </div>

        <div class="content__body">
            <div class="сontent__body_wrapper">
                <div class="exercise-wrapper">
                    @if(count($entities))
                        <div class="explanation">
                            <div class="explanation-text">
                                <h6>{{ $entities[0]->parent->description }}</h6>
                            </div>
                        </div>
                        <p class="error_ans_mes error_answer"></p>
                        <form action="{{ route('exercise.check', ['id' => $categoryId]) }}" method="POST" id="exercise_form">
                            <div class="exe-s">
                                <ul>
                                    @foreach($entities as $entity)
                                        @if($entity->transition)
                                            @if(isset($entity->user_answer))
                                                <li class="answer{{ $entity->id }} @if($entity->user_answer === $entity->answer) correct @else uncorrect @endif">
                                                    <i class="fas {{ ($entity->user_answer === $entity->answer) ? 'fa-check' : 'fa-times' }}"></i>
                                                    {{ $entity->part_one }}<input type="text" value="{{ $entity->user_answer }}"
                                                                                  name="answer{{ $entity->id }}" class="answer inp_answer{{ $entity->id }}">{{ $entity->part_two }}
                                                    <i>{!! ($entity->user_answer !== $entity->answer) ? '(Туура жооп: <span style="color: green;">'.$entity->answer.'</span>)' : '' !!}</i>
                                                </li>
                                            @else
                                                <li class="answer{{ $entity->id }}"><i class="fas"></i>
                                                    {{ $entity->part_one }}<input type="text" value="{{ ($checked) ? $entity->answer : '' }}"
                                                                                  name="answer{{ $entity->id }}" class="answer inp_answer{{ $entity->id }}">{{ $entity->part_two }}
                                                    <i></i>
                                                </li>
                                            @endif
                                        @else
                                            @if(isset($entity->user_answer))
                                                <span class="answer{{ $entity->id }} @if($entity->user_answer === $entity->answer) correct @else uncorrect @endif">
                                                    <i class="fas {{ ($entity->user_answer === $entity->answer) ? 'fa-check' : 'fa-times' }}"></i>
                                                    {{ $entity->part_one }}<input type="text" value="{{ $entity->user_answer }}"
                                                                                  name="answer{{ $entity->id }}" class="answer inp_answer{{ $entity->id }}">{{ $entity->part_two }}
                                                <i>{{ ($entity->user_answer !== $entity->answer) ? '(Туура жооп: '.$entity->answer.')' : '' }}</i>
                                                </span>
                                            @else
                                                <span class="answer{{ $entity->id }}"><i class="fas"></i>
                                                    {{ $entity->part_one }}<input type="text"
                                                                                  name="answer{{ $entity->id }}" class="answer inp_answer{{ $entity->id }}">{{ $entity->part_two }}
                                                <i></i>
                                                </span>
                                            @endif
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                            <div class="check-btn">
                                @if($checked)
                                    <input type="submit" class="btn btn-primary btn-sm check__button" value="Текшерилген" disabled>
                                @else
                                    <input type="submit" class="btn btn-primary btn-sm check__button check" value="Текшерүү">
                                @endif
                            </div>
                        </form>
                    @endif
                    <div class="commands">
                        @if($prevNextExeCategoryId['prev'])
                            <span>
                                <a href="{{ route('exercise.index', ['id' => $prevNextExeCategoryId['prev']]) }}"><i class="fa fa-arrow-left"></i></a>
                            </span>
                        @endif

                        @if($prevNextExeCategoryId['next'])
                            <span>
                                <a href="{{ route('exercise.index', ['id' => $prevNextExeCategoryId['next']]) }}"><i class="fa fa-arrow-right"></i></a>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="right__side">

            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $('.check').on('click', function(event) {
                event.preventDefault();

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: $('#exercise_form').attr('method'),
                    url: $('#exercise_form').attr('action'),
                    data: $('#exercise_form').serialize(),
                    beforeSend: function() {
                        $('.check').prop('disabled', true);
                        $('.check').val('Текшерүүдө...');
                    },
                    success: function (data) {
                        if(data.checked) {
                            $('.check').prop('disabled', true);
                            $('.check').val('Текшерилген');
                            $('.error_answer').html('Сиз бул көнүгүүнү аткаргансыз!!!');

                            return;
                        }

                        $('.check').val('Текшерилди');
                        $('.error_answer').html('');

                        $.each(data.result, function (key, value) {
                            var er_span_class = '.error_' + key;
                            $(er_span_class).html('');

                            $('.answer').removeClass('input_validate_error');

                            var each = '.' + key;
                            var input_class = '.inp_' + key;
                            if(value === 1 ) {
                                $(each).children(':first').addClass('fa-check');
                                $(each).addClass('correct');
                            } else {
                                $(input_class).next().html('(туура жооп: <span style="color: green;">' + value + '</span>)');
                                $(each).children(':first').addClass('fa-times');
                                $(each).addClass('uncorrect');
                            }

                        });
                    },
                    error: function (errors) {
                        $('.check').prop('disabled', false);
                        $('.check').val('Текшерүү');
                        $('.answer').removeClass('input_validate_error');
                        $.each(errors.responseJSON.errors, function (key, value) {
                            var input_class = '.inp_' + key;
                            $('.error_answer').html(value);
                            $(input_class).addClass('input_validate_error');
                        });
                    },
                });
            });
        });
    </script>
@endpush