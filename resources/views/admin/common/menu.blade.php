@if(isset($items))
    @foreach($items as $key => $item)
        <div class="panel__adm">
            <div class="panel_heading">
                <span>
                    <i class="fa {{ $item['icon'] }}"></i>{{ $item['title'] }}
                </span>
            </div>

            <div class="panel_collapse">
                <ul>
                    @foreach($item['children'] as $key => $child)
                        <li>
                            <a href="{{ route($child['route']) }}"><i class="fa {{ $child['icon'] }}"></i>{{ $child['title'] }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endforeach
@endif