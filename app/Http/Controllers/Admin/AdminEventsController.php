<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProgramEvent;
use Illuminate\Http\Request;

class AdminEventsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = ProgramEvent::orderBy('event_date', 'desc')
            ->orderBy('event_time', 'desc')
            ->paginate(20);
        
        return view('admin.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'event_date' => 'required|date',
            'event_time' => 'nullable|date_format:H:i',
            'location' => 'nullable|string|max:255',
            'type' => 'required|in:workshop,reuniao,capacitacao,avaliacao,outro',
            'is_published' => 'boolean',
        ]);

        $validated['is_published'] = $request->has('is_published');

        ProgramEvent::create($validated);

        return redirect()->route('admin.events.index')
            ->with('success', 'Evento criado com sucesso!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProgramEvent $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProgramEvent $event)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'event_date' => 'required|date',
            'event_time' => 'nullable|date_format:H:i',
            'location' => 'nullable|string|max:255',
            'type' => 'required|in:workshop,reuniao,capacitacao,avaliacao,outro',
            'is_published' => 'boolean',
        ]);

        $validated['is_published'] = $request->has('is_published');

        $event->update($validated);

        return redirect()->route('admin.events.index')
            ->with('success', 'Evento atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProgramEvent $event)
    {
        $event->delete();

        return redirect()->route('admin.events.index')
            ->with('success', 'Evento excluído com sucesso!');
    }
}
