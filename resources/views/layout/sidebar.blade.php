

<ul class="nav flex-column pt-3">
    <li class="nav-item">
        <a class="nav-link {{ request()->is('worklogs*') ? 'active fw-bold' : '' }}" href="/worklog">
            📝 WorkLog
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->is('hobbies*') ? 'active fw-bold' : '' }}" href="/hobbie">
            🎮 Hobbies
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->is('moods*') ? 'active fw-bold' : '' }}" href="/mood">
            😊 Mood
        </a>
    </li>
</ul>
