<div class="commit-block">
    <div class="commit-header">
        <span class="commit-count">{{ $count }} комментарий</span>
    </div>
    <div class="commit-form">
        <form action="{{ route('video.commit') }}" method="POST" id="commit-form">
            <input type="hidden" name="parent_id" id="parent_id" value="">
            <input type="hidden" name="getter_name" id="getter_name" value="">
            <input type="hidden" name="video_id" value="{{ $entity->id }}">
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            <div class="clone-textarea-commit"></div>
            <div class="textarea-block">
                <textarea type="text" name="text" class="commit-input" placeholder="Өз комментарийиңизди калтырыңыз"></textarea>
            </div>
            <div class="commit-button-blk">
                <input type="button" id="commit-button" class="btn btn-primary btn-sm" value="Жөнөтүү" disabled>
            </div>
        </form>
    </div>

    <div class="commits-block">
        @include('video._commits')
    </div>
</div>