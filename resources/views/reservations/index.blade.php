@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Liste des Réservations</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Utilisateur</th>
                <th>Chambre</th>
                <th>Date Arrivée</th>
                <th>Date Départ</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reservations as $res)
            <tr>
                <td>{{ $res->user->name }}</td>
                <td>{{ $res->room->title }}</td>
                <td>{{ $res->check_in }}</td>
                <td>{{ $res->check_out }}</td>
                <td>{{ ucfirst($res->status) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
