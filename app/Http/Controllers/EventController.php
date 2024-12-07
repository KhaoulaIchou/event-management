<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    /*public function __construct()
    {
        $this->middleware('auth:sanctum');
    }*/

    /*public function index()
    {
        $events = Event::all();
        return response()->json($events);
    }*/
    public function index(Request $request)
{
    $query = Event::query();

    if ($request->has('date') && !empty($request->date)) {
        $query->whereDate('date', $request->date);
    }

    if ($request->has('location') && !empty($request->location)) {
        $query->where('location', 'LIKE', '%' . $request->location . '%');
    }

    $events = $query->get();

    return view('events.index', compact('events'));
}


public function create()
{
    return view('events.create'); 
}

public function store(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'date' => 'required|date',
        'location' => 'required|string|max:255',
        'description' => 'required|string',
        'rsvp_limit' => 'required|integer|min:1',
    ]);

    Event::create($validatedData);

    return redirect()->route('admin.events.index')->with('success', 'Événement ajouté avec succès!');
}


public function edit($id)
{
    $event = Event::findOrFail($id); 
    return view('events.edit', compact('event')); 
}

public function update(Request $request, $id)
{
    $event = Event::findOrFail($id);

    $validatedData = $request->validate([
        'name' => 'sometimes|string|max:255',
        'date' => 'sometimes|date',
        'location' => 'sometimes|string|max:255',
        'description' => 'sometimes|string',
        'rsvp_limit' => 'sometimes|integer|min:1',
    ]);

    $event->update($validatedData);

    return redirect()->route('admin.events.index')->with('success', 'Événement mis à jour avec succès!');
}


    public function destroy($id)
    {
        $event = Event::findOrFail($id); 
        $event->delete(); 

        return redirect()->route('events.index')->with('success', 'Événement supprimé avec succès!');
    }

    /*public function rsvp($id, Request $request)
    {
        $event = Event::findOrFail($id);

        if ($event->rsvps()->count() >= $event->rsvp_limit) {
            return response()->json(['message' => 'RSVP limit reached.'], 400);
        }

        $user = $request->user(); // Utilisateur connecté

        $event->rsvps()->create([
            'user_id' => $user->id,
        ]);

        return response()->json(['message' => 'RSVP successful.']);
    }*/

    public function rsvp($id)
    {
        if (!auth()->check()) {
            return response()->json(['error' => 'Vous devez être connecté pour RSVP.'], 401);
        }
    
        $event = Event::findOrFail($id);
    
        if ($event->rsvps()->where('user_id', auth()->id())->exists()) {
            return response()->json(['error' => 'Vous avez déjà RSVP pour cet événement.'], 400);
        }
    
        if ($event->rsvps()->count() >= $event->rsvp_limit) {
            return response()->json(['error' => 'La limite de RSVP a été atteinte.'], 400);
        }
    
        $event->rsvps()->create([
            'user_id' => auth()->id(),
        ]);
    
        return response()->json(['message' => 'RSVP réussi!'], 200);
    }
    
    
    

    public function show($id)
    {
        $event = Event::findOrFail($id);
        return view('events.show', compact('event'));
    }
}
