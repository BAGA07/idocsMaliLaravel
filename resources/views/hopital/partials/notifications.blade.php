<div class="relative inline-block text-left mb-4">
    <audio id="notificationSound" src="{{ asset('sounds/notification.mp3') }}" preload="auto"></audio>

    <button id="notificationDropdownButton" type="button" class="relative focus:outline-none">
        <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
        </svg>

        @php
            $unreadCount = isset($notificationsDropdown) ? $notificationsDropdown->where('is_read', false)->count() : 0;
        @endphp

        @if($unreadCount > 0)
            <span id="notificationBadge"
                  class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-red-600 rounded-full">
                {{ $unreadCount }}
            </span>
        @endif
    </button>

    <div id="notificationDropdownMenu"
         class="hidden absolute right-0 mt-2 w-80 bg-white border border-gray-200 rounded shadow-lg z-50">
        <div class="p-4 font-semibold border-b">Notifications</div>
        <ul class="max-h-80 overflow-y-auto">
            @forelse($notificationsDropdown as $notif)
                <li class="px-4 py-2 border-b hover:bg-gray-100">
                    <a href="{{ route('hopital.notifications.show', $notif->id) }}"
                       class="block notification-link"
                       data-id="{{ $notif->id }}"
                       data-is-read="{{ $notif->is_read ? 'true' : 'false' }}">

                        <div class="text-sm text-gray-800 {{ !$notif->is_read ? 'font-semibold' : '' }}">
                            {{ $notif->message }}
                        </div>
                        <div class="text-xs text-gray-500 mt-1">
                            {{ $notif->created_at->format('d/m/Y H:i') }}
                            @if($notif->from_mairie)
                                <span class="ml-2 text-green-600">De: {{ $notif->from_mairie }}</span>
                            @endif
                            @if(!$notif->is_read)
                                <span class="ml-2 text-red-600 text-xs">●</span>
                            @endif
                        </div>
                    </a>
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
        const badge = document.getElementById('notificationBadge');

        function updateNotificationBadge(count) {
            if (count > 0) {
                if (badge) {
                    badge.textContent = count;
                } else {
                    const newBadge = document.createElement('span');
                    newBadge.id = 'notificationBadge';
                    newBadge.className = 'absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-red-600 rounded-full';
                    newBadge.textContent = count;
                    btn.appendChild(newBadge);
                }
            } else {
                if (badge) {
                    badge.remove();
                }
            }
        }

        function markAllNotificationsAsRead() {
            fetch('/hopital/notifications/mark-all-read', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({})
            }).then(response => {
                if (response.ok) {
                    updateNotificationBadge(0);
                    document.querySelectorAll('.notification-link').forEach(link => {
                        link.dataset.isRead = 'true';
                        const messageDiv = link.querySelector('.text-sm');
                        if (messageDiv) messageDiv.classList.remove('font-semibold');
                        const unreadDot = link.querySelector('.text-red-600');
                        if (unreadDot && unreadDot.textContent === '●') unreadDot.remove();
                    });
                }
            }).catch(error => console.error('Erreur de lecture des notifications:', error));
        }

        btn.addEventListener('click', function (e) {
            e.stopPropagation();
            const isHidden = menu.classList.contains('hidden');
            menu.classList.toggle('hidden');

            if (isHidden && badge) {
                markAllNotificationsAsRead();
            }
        });

        document.addEventListener('click', function () {
            menu.classList.add('hidden');
        });

        const hasUnread = {{ $notificationsDropdown->contains(fn($n) => !$n->is_read) ? 'true' : 'false' }};
        if (hasUnread && !sessionStorage.getItem('notifSoundPlayed')) {
            const audio = document.getElementById('notificationSound');
            if (audio) {
                audio.play().then(() => {
                    sessionStorage.setItem('notifSoundPlayed', 'true');
                }).catch(e => {
                    console.warn("Lecture audio bloquée:", e);
                });
            }
        }

        document.querySelectorAll('.notification-link').forEach(link => {
            link.addEventListener('click', function (e) {
                e.preventDefault();
                const notificationId = this.dataset.id;
                const url = this.getAttribute('href');
                const isRead = this.dataset.isRead === 'true';

                if (!isRead) {
                    fetch(`/hopital/notifications/${notificationId}/mark-read`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({})
                    }).then(response => {
                        if (response.ok) {
                            const currentCount = badge ? parseInt(badge.textContent) : 0;
                            updateNotificationBadge(Math.max(0, currentCount - 1));
                            window.location.href = url;
                        }
                    }).catch(error => {
                        console.error('Erreur lors du clic notification:', error);
                        window.location.href = url;
                    });
                } else {
                    window.location.href = url;
                }
            });
        });
    });
</script>
