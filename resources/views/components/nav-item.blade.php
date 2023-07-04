@props(['route'])
<li class="nav-item">
    <a class="nav-link"  href="{{ route($route) }}"> 
        {{ $slot }}
    </a>
</li>