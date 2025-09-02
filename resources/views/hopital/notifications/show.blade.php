@extends('layouts.app')

@section('content')
<div class="container">
  <a href="{{ route('hopital.notifications.index') }}" class="btn btn-outline-secondary mb-3">
    <i class="fa fa-arrow-left"></i> Retour
</a>

<hr>
<br>
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <strong>{{ $notification->from_hopital ?? 'Hôpital inconnu' }}</strong>
            <span class="text-muted">{{ $notification->created_at->format('d/m/Y H:i') }}</span>
        </div>
        <div class="card-body">
            <p>{{ $notification->message }}</p>
        </div>
    </div>
</div>
@endsection
