@extends('layouts.app')

@section('h1')
    @if($entity)
        {{ $entity->title }}
    @else
        Видео сабактар
    @endif
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/show-video.css') }}">
@endpush

@section('content')
    <div class="row content_blc">
        <div class="col-md-12">
            <div class="show-wrapper">
                @if($entity)
                    <div class="show-video-card">
                        <div class="video-block">
                            <video poster="{{ $entity->getImagePath('image', 'full') }}" controls class="show-video">
                                <source src="{{ $entity->getFilePath('file', 'video') }}" type="video/mp4">
                            </video>
                        </div>
                        <div class="video-card-body inline_blk">
                            <p class="video-title">{{ $entity->title }}</p>
                            <span class="video-author">{{ $entity->author }}</span>
                            <p class="video-date text-muted">{{ $entity->created_at }}</p>
                            <p class="preview">{!! $entity->description !!}</p>
                        </div>
                    </div>

                    @include('video.commits')
                @endif
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('/js/show.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#commit-button').on('click', function(event) {
                event.preventDefault();

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: $('#commit-form').attr('method'),
                    url: $('#commit-form').attr('action'),
                    data: $('#commit-form').serialize(),
                    beforeSend: function() {
                        $('#commit-button').val('Жөнөтүлүүдө...');
                        $('#commit-button').prop('disabled', true);
                    },
                    success: function (data) {
                        if(data.success) {
                            $('.commits-block').html(data.html);
                            $('.commit-count').html(data.count + ' комментарий');
                            $('.commit-input').val(' ').attr('placeholder', 'Өз комментарийиңизди калтырыңыз');
                            $('#commit-button').val('Жөнөтүү');
                            buildFormFields();
                        }
                    },
                    error: function (errors) {
                        buildFormFields();
                    },
                });
            });

            function buildFormFields() {
                var answer_link = document.querySelectorAll('.answer-link');
                var commit_input = document.querySelector('.commit-input');

                for(var i = 0; i < answer_link.length; i++) {
                    answer_link[i].onclick = input_focus;
                }

                function input_focus() {
                    document.querySelector('#getter_name').value = this.nextElementSibling.innerHTML;

                    if($(this).hasClass('child')) {
                        document.querySelector('#parent_id').value = this.previousElementSibling.innerHTML;
                    } else {
                        document.querySelector('#parent_id').value = this.nextElementSibling.nextElementSibling.innerHTML;
                    }

                    commit_input.focus();
                }

                var commit_button = document.querySelector('#commit-button');
                commit_input.onkeyup = function () {
                    if (this.value.length > 0) {
                        commit_button.disabled = false;
                    } else {
                        commit_button.disabled = true;
                    }

                    var x = this.value.replace(/&/g, '&amp;')
                        .replace(/>/g, '&gt;')
                        .replace(/</g, '&lt;')
                        .replace(/ /g, '&nbsp;')
                        .replace(/\n/g, '<br>');

                    document.querySelector('.clone-textarea-commit').innerHTML =  x + '&nbsp;';
                    this.style.height = (document.querySelector('.clone-textarea-commit').offsetHeight) + "px";
                }

                commit_input.onfocus = function () {
                    document.querySelector('.textarea-block').style.borderBottomColor = '#0068B3';
                }

                commit_input.addEventListener('blur', function () {
                    document.querySelector('.textarea-block').style.borderBottomColor = '#C5E2DE';
                });

            }

            buildFormFields();
        });
    </script>
@endpush