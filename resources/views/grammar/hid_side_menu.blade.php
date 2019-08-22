<div class="hidden-sideMenu">
    <div class="action__blk">
        <span class="categories-show-button">
            <i class="fa fa-caret-right"></i>
        </span>
    </div>
    <div class="sideMenu-header">
        <div class="sideMenuIn sideMenu-title">Бөлүмдөр</div>
    </div>
    <div class="hidden__sideMenu_body" id="scroll__blk">
        <div class="wrapper_menu">
            @if(count($categories) > 0)
                <div class="panel__list">
                    <ul>
                        @foreach($categories as $category)
                            @if($category->depth)
                                <li class="list_children child{{ $category->parent->id }}">
                                    <a class="children_link" href="{{ route('grammar.index', ['slug' => $category->slug]) }}">
                                        <i class="fa fa-angle-right"></i>
                                        {{ $category->title }}
                                    </a>
                                </li>
                            @else
                                <li class="parent_list {{ $category->id }}">
                                    <a><i class="fa"></i>
                                        {{ $category->title }}
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
    <div class="hidden__sideMenu_ft"></div>
</div>