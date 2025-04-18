@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Add a New Room</h2>

    <form action="{{ route('rooms.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" class="form-control" id="title" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control" id="description" rows="4" required></textarea>
        </div>

        <div class="mb-3">
            <label for="price_per_night" class="form-label">Price per Night (€)</label>
            <input type="number" name="price_per_night" class="form-control" id="price_per_night" step="0.01" required>
        </div>

        <div class="mb-3">
            <label for="available_rooms" class="form-label">Available Rooms</label>
            <input type="number" name="available_rooms" class="form-control" id="available_rooms" required>
        </div>

        <button type="submit" class="btn btn-primary">Add Room</button>
        <a href="{{ route('rooms.index') }}" class="btn btn-secondary ml-2">Back to Room List</a>
    </form>
</div>
@endsection
