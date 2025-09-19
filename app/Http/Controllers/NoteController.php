<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class NoteController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $user = auth()->user();
        
        if ($user->isAdmin()) {
            // Admin can see all notes with user information
            $notes = Note::with('user')->latest()->paginate(10);
        } else {
            // Regular users can only see their own notes
            $notes = $user->notes()->latest()->paginate(10);
        }
        
        return view('notes.index', compact('notes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('notes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $validated['user_id'] = auth()->id();
        
        Note::create($validated);
        
        return redirect()->route('notes.index')
            ->with('success', 'Note created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note): View
    {
        // Check if user can view this note
        if (!auth()->user()->isAdmin() && $note->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
        
        return view('notes.show', compact('note'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note): View
    {
        // Check if user can edit this note
        if (!auth()->user()->isAdmin() && $note->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
        
        return view('notes.edit', compact('note'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note): RedirectResponse
    {
        // Check if user can update this note
        if (!auth()->user()->isAdmin() && $note->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $note->update($validated);
        
        return redirect()->route('notes.index')
            ->with('success', 'Note updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note): RedirectResponse
    {
        // Check if user can delete this note
        if (!auth()->user()->isAdmin() && $note->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $note->delete();
        
        return redirect()->route('notes.index')
            ->with('success', 'Note deleted successfully!');
    }
}
