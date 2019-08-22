@extends('admin.layouts.content')

@section('content_head')
    @include('admin.common.head', ['title' => $title])
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
                        <th>Кыскача текст</th>
                        <th>Сүрөт</th>
                        <th>Приоритет</th>
                        <th>Аракеттер</th>
                    </tr>

                    @foreach($entities as $entity)
                        <tr class="{{ $entity->active ? '' : 'unpublished' }}">
                            <td>{{ $entity->text }}</td>
                            <td>
                                @if($entity->getImagePath('image', 'micro'))
                                    <img src="{{ $entity->getImagePath('image', 'micro') }}" alt="{{ $entity->title }}">
                                @endif
                            </td>
                            <td>{{ $entity->priority }}</td>
                            <td>
                                <div class="commands__adm_list">
                                    @include('admin.common.controls.publish',
                                    ['routePrefix' => $routePrefix, 'id' => $entity->id, 'value' => $entity->active ])

                                    <a href="{{ route($routePrefix.'edit', ['id' => $entity->id ]) }}" class="co__lb a_fa-pencil-alt" title="Оңдоо">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>

                                    @include('admin.common.controls.destroy', ['routePrefix' => $routePrefix, 'id' => $entity->id])
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