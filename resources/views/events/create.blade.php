@extends('layouts.app')

@section('title', 'Ajouter un événement')

@section('content')
<div class="bg-white shadow-lg rounded-lg p-6 max-w-md mx-auto">
    <h1 class="text-2xl font-bold mb-4">Ajouter un événement</h1>
    <form action="{{ route('events.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="name" class="block">Nom de l'événement</label>
            <input type="text" name="name" id="name" class="w-full p-2 border rounded" required>
        </div>
        <div class="mb-4">
            <label for="date" class="block">Date</label>
            <input type="date" name="date" id="date" class="w-full p-2 border rounded" required>
        </div>
        <div class="mb-4">
            <label for="location" class="block">Lieu</label>
            <input type="text" name="location" id="location" class="w-full p-2 border rounded" required>
        </div>
        <div class="mb-4">
            <label for="description" class="block">Description</label>
            <textarea name="description" id="description" class="w-full p-2 border rounded" rows="4" required></textarea>
        </div>
        <div class="mb-4">
            <label for="rsvp_limit" class="block">Limite RSVP</label>
            <input type="number" name="rsvp_limit" id="rsvp_limit" class="w-full p-2 border rounded" required>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Ajouter</button>
    </form>
</div>
@endsection
