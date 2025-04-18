@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">Liste des chambres</h2>
        @auth
            @if(auth()->user()->is_admin)
                <a href="{{ route('rooms.create') }}" class="btn btn-success">
                    <i class="bi bi-plus-circle"></i> Ajouter une chambre
                </a>
            @endif
        @endauth
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
        </div>
    @endif

    @if($rooms->count())
        <div class="row g-4">
            @foreach($rooms as $room)
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm h-100 border-0">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-primary">{{ $room->title }}</h5>
                        <p class="card-text text-muted small mb-2">{{ Str::limit($room->description, 100) }}</p>
                        <ul class="list-group list-group-flush mb-3">
                            <li class="list-group-item">💶 Prix : <strong>{{ $room->price_per_night }}€</strong></li>
                            <li class="list-group-item">🛏️ Disponibles : <strong>{{ $room->available_rooms }}</strong></li>
                        </ul>
                        <div class="mt-auto d-flex justify-content-between flex-wrap gap-2">
                            @auth
                                @if(auth()->user()->is_admin)
                                    <a href="{{ route('rooms.edit', $room->id) }}" class="btn btn-sm btn-outline-warning">
                                        <i class="bi bi-pencil-square"></i> Modifier
                                    </a>
                                    <form action="{{ route('rooms.destroy', $room->id) }}" method="POST" onsubmit="return confirm('Supprimer cette chambre ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash"></i> Supprimer
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ route('reservations.create', $room->id) }}" class="btn btn-sm btn-outline-primary w-100">
                                        <i class="bi bi-calendar-plus"></i> Réserver
                                    </a>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info text-center">Aucune chambre ajoutée pour le moment.</div>
    @endif
</div>
@endsection
