<?php

namespace App\Http\Controllers;

use App\Models\TrainingSession;
use Illuminate\Http\Request;

class AdminTrainingSessionController extends Controller
{
    public function index()
    {
        $sessions = TrainingSession::orderBy('start_time')->get();
        return view('admin.training', compact('sessions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'trainer_id' => 'required|exists:users,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'max_clients' => 'required|integer|min:1',
        ]);

        TrainingSession::create($validated);

        return back()->with('success', 'Sesión creada correctamente');
    }

    public function update(Request $request, TrainingSession $session)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'trainer_id' => 'required|exists:users,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'max_clients' => 'required|integer|min:1',
        ]);

        $session->update($validated);

        return back()->with('success', 'Sesión actualizada correctamente');
    }


    public function destroy(TrainingSession $session)
    {
        $session->delete();
        return back()->with('success', 'Sesión eliminada correctamente');
    }
}
