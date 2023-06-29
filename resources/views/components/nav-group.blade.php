@props([
    'iconLink' => '',

    'title' => '',
])
<li class="nav-group">
    <a class="nav-link nav-group-toggle" href="#">
        <svg class="nav-icon">
            <use xlink:href="{{ asset($iconLink) }}"></use>
        </svg> {{ $title }}
    </a>
    <ul class="nav-group-items">
        {{ $slot }}
    </ul>
</li>


