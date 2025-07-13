@props(['icon', 'label', 'route'])

@php
$isActive = request()->routeIs($route);
@endphp

<a href="{{ route($route) }}" class="flex items-center gap-3 px-4 py-2 rounded-md transition
        {{ $isActive ? 'bg-blue-100 text-blue-700 font-semibold' : 'hover:bg-gray-100' }}">
    <i class="fa {{ $icon }} text-sm {{ $isActive ? 'text-blue-600' : 'text-gray-500' }}"></i>
    <span>{{ $label }}</span>
</a>