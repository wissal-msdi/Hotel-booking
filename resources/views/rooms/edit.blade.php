@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Modifier la chambre</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('rooms.update', $room->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Titre</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $room->title) }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description', $room->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="price_per_night" class="form-label">Prix par nuit</label>
            <input type="number" class="form-control" id="price_per_night" name="price_per_night" value="{{ old('price_per_night', $room->price_per_night) }}" required>
        </div>

        <div class="mb-3">
            <label for="available_rooms" class="form-label">Nombre de chambres disponibles</label>
            <input type="number" class="form-control" id="available_rooms" name="available_rooms" value="{{ old('available_rooms', $room->available_rooms) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="{{ route('rooms.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
