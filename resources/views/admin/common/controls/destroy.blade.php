<div class="destroy">
    <button type="button" class="co__lb a_fa-trash destroyIcon" title="Өчүрүү">
        <i class="fa fa-trash"></i>
    </button>

    <form action="{{ route($routePrefix.'destroy', ['id' => $id ]) }}"
          method="get" id="destroyModalForm" class="destroy_modal">
        <div class="destroy_text">
            <p>Аракетти тастыктаңыз.</p>
        </div>
        <p>Бул запис өчүрүлсүнбү?</p>

        <div class="destroy_action">
            <button type="submit" class="dbtn destroy_btn" title="Өчүрүү">
                Ооба
            </button>
            <button type="button" class="dbtn stop_action" title="Аракетти токтотуу">
                Жок
            </button>
        </div>
    </form>
</div>