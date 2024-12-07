@extends('layouts.app')

@section('title', 'Détails de l\'événement')

@section('content')
<div class="container mx-auto p-4">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h1 class="text-3xl font-bold mb-4">{{ $event->name }}</h1>
        <p class="mb-2"><strong>Date : </strong>{{ $event->date }}</p>
        <p class="mb-2"><strong>Lieu : </strong>{{ $event->location }}</p>
        <p class="mb-2"><strong>Description : </strong>{{ $event->description }}</p>
        <p class="mb-4"><strong>Places restantes : </strong>{{ $event->rsvp_limit - $event->rsvps->count() }}</p>
    </div>

    <form action="{{ route('events.rsvp', $event->id) }}" method="POST" id="rsvpForm" class="mt-6">
        @csrf
        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded shadow hover:bg-blue-800">
            RSVP
        </button>
    </form>

    <div id="popupMessage" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50">
        <div class="bg-white p-6 rounded shadow-lg text-center">
            <h2 id="popupTitle" class="text-xl font-bold mb-4"></h2>
            <p id="popupText" class="mb-4"></p>
            <button onclick="closePopup()" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">
                OK
            </button>
        </div>
    </div>
</div>


<script>
    document.getElementById('rsvpForm').addEventListener('submit', function(event) {
        event.preventDefault();

        fetch(this.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
            },
        })
        .then(response => {
            if (response.ok) {
                return response.json();
            } else {
                return response.json().then(errorData => {
                    throw new Error(errorData.error || 'Erreur inconnue.');
                });
            }
        })
        .then(data => {
            showPopup('Succès', data.message);
        })
        .catch(error => {
            showPopup('Erreur', error.message);
        });
    });

    function showPopup(title, message) {
        document.getElementById('popupTitle').innerText = title;
        document.getElementById('popupText').innerText = message;
        document.getElementById('popupMessage').classList.remove('hidden');
    }

    function closePopup() {
        document.getElementById('popupMessage').classList.add('hidden');
    }
</script>
@endsection
