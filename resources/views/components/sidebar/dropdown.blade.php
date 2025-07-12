@props(['icon', 'label'])

<div x-data="{ open: false }" class="space-y-1">
    <button @click="open = !open"
        class="flex items-center justify-between w-full px-3 py-2 rounded text-gray-700 hover:bg-primary hover:text-white transition">
        <span><i class="fa {{ $icon }} mr-2"></i> {{ $label }}</span>
        <i :class="open ? 'fa fa-chevron-up' : 'fa fa-chevron-down'"></i>
    </button>
    <div x-show="open" class="pl-6 space-y-1">
        {{ $slot }}
    </div>
</div>