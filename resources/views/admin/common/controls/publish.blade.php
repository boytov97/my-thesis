<form action="{{ route($routePrefix.'update', ['id' => $id ]) }}" method="get">
    <input type="hidden" name="active" value="{{ $value ? 0 : 1 }}">
    <button type="submit" class="co__lb a_fa-ban" title="{{ $value ? 'Жашыруу' : 'Жарыялоо' }}">
        <i class="fas fa-ban"></i>
    </button>
</form>