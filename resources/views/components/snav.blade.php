@if($href != '#' || $href != '')
<div class="nav-item">
    <a href="{{ Request::url() == $href ? "#" : $href }}" class="btn btn-dark d-flex gap-2 {{ $active ? 'active' : '' }}">
        <span class="material-symbols-outlined">{{ $icon }}</span>
        {{ $slot }}
    </a>
</div>
@endif