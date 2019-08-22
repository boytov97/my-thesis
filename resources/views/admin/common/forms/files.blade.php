@if($entity->getFilePath($field, $slug))
    <div class="input__wrapper">
        @if($slug == 'audio')
            <div class="audio-block">
                <audio controls style="width: 96%;">
                    <source src="{{ $entity->getFilePath($field, $slug) }}" type="audio/mpeg">
                    <source src="{{ $entity->getFilePath($field, $slug) }}" type="audio/ogg">
                    Сиздин браузер бул типтерги файлды окуй албайт.
                </audio>
            </div>
            <button type="button" title="Өчүрүү" class="co__lb a_fa_trash_img destroyImageIcon">
                <i class="fa fa-trash"></i>
            </button>
        @elseif($slug === 'video')
            <div class="video-card">
                <div class="video-block inline_blk">
                    <video controls class="video">
                        <source id="video" src="{{ $entity->getFilePath($field, $slug) }}" type="video/mp4">
                    </video>
                    <button type="button" title="Өчүрүү" class="co__lb a_fa_trash_img destroyFileIcon">
                        <i class="fa fa-trash"></i>
                    </button>
                </div>
            </div>
        @endif
    </div>

    <div class="destroy_file_modal">
        <div class="destroy_text">
            <p>Аракетти тастыктаңыз.</p>
        </div>
        <p>Бул файл өчүрүлсүнбү?</p>

        <div class="destroy_action">
            <button type="submit" class="dbtn destroy_btn" title="Өчүрүү">
                <a href="{{ route($routePrefix . 'destroyUpload', ['id' => $entity->id]) }}">Ооба</a>
            </button>
            <button type="button" class="dbtn stop_ImageAction" title="Аракетти токтотуу">
                Жок
            </button>
        </div>
    </div>
@else
    <div class="input__wrapper">
        <label class="input__label">Файл</label>
        <input type="file" name="file" accept="{{ $accept }}" class="check_img_input" id="input_file">
        <div class="wrapper_btn__adm">
            <label for="input_file" class="check_img_lb">Файлды тандаңыз</label><span class="check_file_name">файл тандалган жок</span>
        </div>
        @if ($errors->has('file'))
            <span class="error__message">{{ $errors->first('file') }}</span>
        @endif
    </div>
@endif