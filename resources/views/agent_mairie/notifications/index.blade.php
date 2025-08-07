

@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4 d-flex align-items-center gap-2">
        <i class="fa fa-bell text-primary"></i> Mes notifications
        @if($notifications->where('is_read', false)->count() > 0)
            <span class="badge bg-danger ms-2">
                {{ $notifications->where('is_read', false)->count() }}
            </span>
            <form action="{{ route('notifications.markAllRead') }}" method="POST" class="d-inline ms-3">
                @csrf
                <button class="btn btn-outline-secondary btn-sm">
                    <i class="fa fa-check-double me-1"></i> Tout marquer comme lu
                </button>
            </form>
        @endif
    </h2>

    <div class="list-group shadow-sm">
        @forelse($notifications as $notif)
            <a href="{{ route('notifications.show', $notif->id) }}"
                class="list-group-item list-group-item-action d-flex justify-content-between align-items-center
                {{ $notif->is_read ? '' : 'bg-light fw-bold' }}">

                <div>
                    <div class="mb-1">
                        <i class="fa fa-hospital {{ $notif->is_read ? 'text-secondary' : 'text-primary' }}"></i>
                        <span>{{ $notif->from_hopital ?? 'Hôpital inconnu' }}</span>
                        @if(!$notif->is_read)
                            <span class="badge bg-success ms-2">Non lu</span>
                        @else
                            <span class="badge bg-secondary ms-2">Lu</span>
                        @endif
                    </div>
                    <div>
                        <span class="message-text">{{ $notif->message }}</span>
                    </div>
                </div>

                <small class="text-muted">
                    {{ $notif->created_at->diffForHumans() }}
                </small>
            </a>
        @empty
            <div class="text-center py-4 text-muted">
                <i class="fa fa-inbox fa-2x mb-2"></i><br>
                Aucune notification.
            </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-3">
        {{ $notifications->links() }}
    </div>
</div>

<style>
    .message-text {
        display: block;
        font-size: 1rem;
        color: #333;
    }
    .bg-light.fw-bold {
        border-left: 5px solid #007bff;
    }
</style>
@endsection
