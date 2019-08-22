@if(count($items))
    @foreach($items as $item)
        <div class="commit commit1 {{ ($item->getter_name) ? 'answer' : '' }}">
            <div class="user-avatar-block">
                <div class="avatar-circle">
                    @if($item->user->getImagePath('image', 'mini'))
                        <img src="{{  $item->user->getImagePath('image', 'mini') }}" alt="{{ Auth::user()->fullname }}" class="user-avatar">
                    @else
                        <img src="{{ asset('/img/current-user.png') }}" alt="{{ Auth::user()->fullname }}" class="user-avatar" style="background: #ccc;">
                    @endif
                </div>
            </div>
            <div class="user-commit-message">
                <p class="name">{{ $item->user->fullname }} <span class="text-muted">{{ $item->created_at }}</span></p>
                <p><span class="to-whom">{{ ($item->getter_name) ?: '' }}</span>{{ $item->text }}</p>
                <div class="answer-link-block">
                    <span class="answer-link">жооп берүү</span>
                    <span class="hidden-element">{{ $item->user->fullname }}</span>
                    <span class="hidden-element">{{ $item->id }}</span>
                </div>
            </div>
        </div>

        @if(count($item->children))
            @foreach($item->children as $child)
                <div class="commit commit1 {{ ($child->getter_name) ? 'answer' : '' }}">
                    <div class="user-avatar-block">
                        <div class="avatar-circle">
                            @if($child->user->getImagePath('image', 'mini'))
                                <img src="{{  $child->user->getImagePath('image', 'mini') }}" alt="{{ Auth::user()->fullname }}" class="user-avatar">
                            @else
                                <img src="{{ asset('/img/current-user.png') }}" alt="{{ Auth::user()->fullname }}" class="user-avatar" style="background: #ccc;">
                            @endif
                        </div>
                    </div>
                    <div class="user-commit-message">
                        <p class="name">{{ $child->user->fullname }} <span class="text-muted">{{ $child->created_at }}</span></p>
                        <p><span class="to-whom">{{ ($child->getter_name) ?: '' }}</span>{{ $child->text }}</p>
                        <div class="answer-link-block">
                            <span class="hidden-element">{{ $child->parent_id }}</span>
                            <span class="answer-link child">жооп берүү</span>
                            <span class="hidden-element">{{ $child->user->fullname }}</span>
                            <span class="hidden-element">{{ $child->id }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    @endforeach
@endif