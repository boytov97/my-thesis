@if(count($exeCategories) > 0)
    <div class="exercises">
        <h5>Көнүгүүлөр:</h5>
        <div class="exercise-link">
            Алган билимиңизди төмөнкү ссылкалар аркылуу өтүп, практикада бекемдеңиз:
            <span class="exercise-links">
                @foreach($exeCategories as $exeCategory)
                    <a href="{{ route('exercise.index', ['id' => $exeCategory->id]) }}">{{ $exeCategory->title }}</a>
                @endforeach
            </span>
        </div>
    </div>
@endif