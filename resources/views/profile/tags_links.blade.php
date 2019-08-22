<div class="profile_commands">
    <a href="{{ route('profile.index', ['id' => $user->id]) }}"
       class="command_link {{ $tag === 'index' ? 'active__form' : '' }}">Анкета</a>
    <a href="{{ route('profile.index', ['id' => $user->id, 'tag' => 'change_pass']) }}"
       class="command_link {{ $tag === 'change_pass' ? 'active__form' : '' }}">Парольду алмаштыруу</a>
</div>