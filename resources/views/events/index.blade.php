@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-semibold mb-4">Liste des événements</h1>

    <div class="flex justify-between items-center mb-6">
        <form method="GET" action="{{ route('admin.events.index') }}" class="flex gap-4 items-center">
            <div>
                <label for="location" class="block text-gray-700 text-sm font-medium">Lieu</label>
                <input type="text" name="location" id="location" 
                       class="border border-gray-300 rounded px-2 py-1 w-48" 
                       value="{{ request('location') }}" 
                       placeholder="Entrez un lieu">
            </div>
            <div>
                <label for="date" class="block text-gray-700 text-sm font-medium">Date</label>
                <input type="date" name="date" id="date" 
                       class="border border-gray-300 rounded px-2 py-1 w-48" 
                       value="{{ request('date') }}">
            </div>
        </form>

        @if(Auth::user()->role === 'admin')
        <a href="{{ route('admin.events.create') }}"
           class="bg-green-500 text-white py-2 px-4 rounded shadow hover:bg-green-700 inline-flex items-center">
            <span class="text-xl mr-2">+</span> Ajouter un événement
        </a>
        @endif
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($events as $event)
            <div class="bg-white p-4 shadow-lg rounded-lg relative">
                <h3 class="text-xl font-semibold">{{ $event->name }}</h3>
                <p>{{ $event->date }} - {{ $event->location }}</p>
                <p class="text-gray-600">{{ $event->description }}</p>
                <p>Places restantes : {{ $event->rsvp_limit - $event->rsvps->count() }}</p>

                <a href="{{ route('events.show', $event->id) }}" 
                   class="bg-blue-500 text-white px-4 py-2 rounded shadow hover:bg-blue-700 mt-2 inline-block">
                    Voir plus
                </a>

                @if(Auth::user()->role === 'admin')
                <div class="absolute top-2 right-2">
                    <div class="relative">
                        <button class="bg-gray-200 text-gray-700 px-4 py-2 rounded shadow hover:bg-gray-300 dropdown-btn">
                            ...
                        </button>
                        <div
                            class="hidden dropdown-content absolute right-0 bg-white border border-gray-200 rounded shadow-lg w-48">
                            <a href="{{ route('admin.events.edit', $event->id) }}"
                               class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Modifier</a>
                            <button onclick="confirmDeletion({{ $event->id }})"
                                    class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">
                                Supprimer
                            </button>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        @endforeach
    </div>
</div>


<div id="confirmationModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded shadow-lg w-1/3">
        <h2 class="text-lg font-semibold mb-4">Confirmer la suppression</h2>
        <p class="mb-6">Êtes-vous sûr de vouloir supprimer cet événement ? Cette action est irréversible.</p>
        <div class="flex justify-end gap-4">
            <button onclick="closeModal()"
                    class="bg-gray-200 text-gray-700 px-4 py-2 rounded shadow hover:bg-gray-300">
                Annuler
            </button>
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded shadow hover:bg-red-700">
                    Supprimer
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    function confirmDeletion(eventId) {
        const modal = document.getElementById('confirmationModal');
        const deleteForm = document.getElementById('deleteForm');
        deleteForm.action = `/admin/events/${eventId}`;
        modal.classList.remove('hidden');
    }

    function closeModal() {
        const modal = document.getElementById('confirmationModal');
        modal.classList.add('hidden');
    }

    document.querySelectorAll('.dropdown-btn').forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            const dropdown = this.nextElementSibling;
            if (dropdown.classList.contains('hidden')) {
                dropdown.classList.remove('hidden');
            } else {
                dropdown.classList.add('hidden');
            }
        });
    });

    document.addEventListener('click', function (event) {
        document.querySelectorAll('.dropdown-content').forEach(dropdown => {
            if (!dropdown.contains(event.target) && !dropdown.previousElementSibling.contains(event.target)) {
                dropdown.classList.add('hidden');
            }
        });
    });
</script>
@endsection
