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

                        <form action="{{ route('profile.update', ['id' => $user->id]) }}"
                              method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="avatar-block">
                                <div class="avatar-wrapper">
                                    @if($user->getImagePath('image', 'mini'))
                                        <img src="{{ $user->getImagePath('image', 'mini') }}" alt="" class="user-avatar">
                                    @else
                                        <img src="{{ asset('/img/current-user.png') }}" alt="" class="user-avatar">
                                    @endif
                                </div>
                                <label for="upload-file" class="upload-file-label">Жаңы сүрөт</label><span class="check_img_name"></span>
                                <input type="file" name="image" class="check-img" id="upload-file">
                            </div>

                            <div class="form-group">
                                <label for="formGroupExampleInput">Толук аты - жөнүңүз:</label>
                                <input type="text" name="fullname"
                                       class="form-control {{ $errors->has('fullname') ? 'error_input' : '' }}"
                                       id="formGroupExampleInput" placeholder="аты - жөнүңүз" value="{{ $user->fullname }}">

                                @if ($errors->has('fullname'))
                                    <span class="errors-message">{{ $errors->first('fullname') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput">Сиздин шаарыңыз:</label>
                                <input type="text" name="city"
                                       class="form-control {{ $errors->has('city') ? 'error_input' : '' }}"
                                       id="formGroupExampleInput" placeholder="cиздин шаарыңыз" value="{{ $user->city }}">

                                @if ($errors->has('city'))
                                    <span class="errors-message">{{ $errors->first('city') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput">Туулган күнүңүз:</label>
                                <input type="date" name="birthday"
                                       class="form-control {{ $errors->has('birthday') ? 'error_input' : '' }}"
                                       id="formGroupExampleInput" placeholder="күн.ай.жыл" value="{{ $user->birthday }}">

                                @if ($errors->has('birthday'))
                                    <span class="errors-message">{{ $errors->first('birthday') }}</span>
                                @endif
                            </div>

                            <div class="button-block">
                                <button type="submit" class="btn btn-primary profile-save">Сактоо</button>
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

@push('js')
    <script>
        var changeImg = function (){
            $('.check_img_name').html($('#upload-file').get(0).files[0].name);
        }

        $('#upload-file').change(changeImg);
    </script>
@endpush