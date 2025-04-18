@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create Reservation</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('reservations.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="room_id" class="form-label">Select Room</label>
            <select name="room_id" class="form-control" required>
                <option value="">Choose a room</option>
                @foreach ($rooms as $room)
                    <option value="{{ $room->id }}">{{ $room->title }} - ${{ $room->price_per_night }}/night</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="check_in" class="form-label">Check-in Date</label>
            <input type="date" name="check_in" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="check_out" class="form-label">Check-out Date</label>
            <input type="date" name="check_out" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="guests" class="form-label">Number of Guests</label>
            <input type="number" name="guests" class="form-control" min="1" required>
        </div>

        <button type="submit" class="btn btn-primary">Reserve</button>
    </form>
</div>
@endsection
