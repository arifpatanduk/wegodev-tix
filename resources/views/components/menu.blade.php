<nav class="nav flex-column">
    @foreach ($list as $row)
    <a class="nav-link @if($row['label'] == $active) active @endif" href="#">
        {{ $row['label'] }}
    </a>
    @endforeach
</nav>