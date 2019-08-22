@extends('admin.layouts.content')

@section('content_head')
    <div class="content__heading">
        <h5>Администраторлор</h5>
    </div>
@endsection

@section('content')
    <div class="content__body">
        @if(count($entities) > 0)
            <div class="table_wrapper">
                <table class="date__list">
                    <tr>
                        <th>Аты-жөнү</th>
                        <th>Супер-админ</th>
                        <th>Кызмат орду</th>
                        <th>Аракеттер</th>
                    </tr>

                    @foreach($entities as $entity)
                        <tr>
                            <td>{{ $entity->fullname }}</td>
                            <td>{{ $entity->super_admin ? 'Ооба' : 'Жок' }}</td>
                            <td>{{ $entity->position }}</td>
                            <td>
                                <div class="commands__adm_list">
                                    <a href="{{ route('admins_edit', ['id' => $entity->id ]) }}" class="co__lb a_fa-pencil-alt" title="Оңдоо">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        @else
            <p>Запис жок</p>
        @endif
    </div>
@endsection