<div class="relative inline-block text-left mb-4">
    <button id="notificationDropdownButton" type="button" class="relative focus:outline-none">
        <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
        </svg>
        @if(isset($notifications) && count($notifications) > 0)
            <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-red-600 rounded-full">
                {{ count($notifications) }}
            </span>
        @endif
    </button>
    <!-- Dropdown -->
    <div id="notificationDropdownMenu" class="hidden absolute right-0 mt-2 w-80 bg-white border border-gray-200 rounded shadow-lg z-50">
        <div class="p-4 font-semibold border-b">Notifications</div>
        <ul class="max-h-80 overflow-y-auto">
            @forelse($notifications as $notif)
                <li class="px-4 py-2 border-b hover:bg-gray-100">
                    <div class="text-sm text-gray-800">{{ $notif->message }}</div>
                    <div class="text-xs text-gray-500 mt-1">
                        {{ $notif->created_at->format('d/m/Y H:i') }}
                        @if(isset($notif->from_hopital))
                            <span class="ml-2 text-blue-600">De: {{ $notif->from_hopital }}</span>
                        @endif
                    </div>
                </li>
            @empty
                <li class="px-4 py-2 text-gray-500">Aucune notification</li>
            @endforelse
        </ul>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const btn = document.getElementById('notificationDropdownButton');
        const menu = document.getElementById('notificationDropdownMenu');
        btn.addEventListener('click', function (e) {
            e.stopPropagation();
            menu.classList.toggle('hidden');
        });
        document.addEventListener('click', function () {
            menu.classList.add('hidden');
        });
    });
</script>
