@if($entity->getImagePath($field, $slug))
    <div class="input__wrapper">
        <label class="input__label">Сүрөт</label>
        <div class="img_block__adm">
            <img src="{{ $entity->getImagePath($field, $slug) }}" class="image__adm">
            <button type="button" title="Өчүрүү" class="co__lb a_fa_trash_img destroyImageIcon">
                <i class="fa fa-trash"></i>
            </button>
        </div>
    </div>

    <div class="destroy_image_modal">
        <div class="destroy_text">
            <p>Аракетти тастыктаңыз.</p>
        </div>
        <p>Бул сүрөт өчүрүлсүнбү?</p>

        <div class="destroy_action">
            <button type="submit" class="dbtn destroy_btn" title="Өчүрүү">
                <a href="{{ route($routePrefix . 'destroyPosterUpload', ['id' => $entity->id]) }}">Ооба</a>
            </button>
            <button type="button" class="dbtn stop_ImageAction" title="Аракетти токтотуу">
                Жок
            </button>
        </div>
    </div>
@else
    <div class="input__wrapper">
        <label class="input__label">Сүрөт</label>
        <input type="file" name="image" accept="image/*" class="check_img_input" id="input_image">
        <div class="wrapper_btn__adm">
            <label for="input_image" class="check_img_lb">Cүрөттү тандаңыз</label><span class="check_img_name">сүрөт тандалган жок</span>
        </div>
        @if ($errors->has('image'))
            <span class="error__message">{{ $errors->first('image') }}</span>
        @endif
    </div>
@endif