@extends('admin.layouts.content')

@section('content_head')
    <div class="content__heading">
        <h5>{{ $title }}</h5>
    </div>

    <div class="section__adm">
        <a href="{{ route(substr_replace($routePrefix, '', -1)) }}"><i class="fa fa-list"></i>Тизме</a>
    </div>
@endsection

@section('content')
    <div class="content__body">
        @if(session()->has('message') && count($errors) == 0)
            <div class="success__message">
                <span>{{ session('message') }}</span>
            </div>
        @endif

        @if(count($entities) > 0)
            <div class="table_wrapper">
                <table class="date__list">
                    <tr>
                        <th>Орточо жакындык</th>
                        <th>Кеңдик</th>
                        <th>Алыстык</th>
                        <th>Аракеттер</th>
                    </tr>

                    @foreach($entities as $entity)
                        <tr>
                            <td>{{ $entity->zoom }}</td>
                            <td>{{ $entity->lat }}</td>
                            <td>{{ $entity->lng }}</td>
                            <td>
                                <div class="commands__adm_list">
                                    <a href="{{ route($routePrefix .'edit', ['id' => $entity->id ]) }}" class="co__lb a_fa-pencil-alt" title="Оңдоо">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>

            <div class="pagination">
                {{ $entities->links() }}
            </div>
        @else
            <p>Запис жок</p>
        @endif
    </div>
@endsection