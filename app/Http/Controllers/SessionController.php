<?php

namespace App\Http\Controllers;

use App\Models\Session;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $sessions = Session::all();
            return response()->json($sessions, 200, options: JSON_UNESCAPED_UNICODE);
        } catch (\Throwable $th) {
            return response()->json(['uzenet' => 'Hiba a szerveren.'], 500, options: JSON_UNESCAPED_UNICODE);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'game_id' => 'required|exists:games,id',
            'player_id' => 'required|exists:players,id',
            'scheduled_at' => 'required|date',
            'location' => 'required|string'
        ], [], [
            'game_id' => 'Játék azonosító',
            'player_id' => 'Játékos azonosító',
            'scheduled_at' => 'Időpont',
            'location' => 'Helyszín'
        ]);

        try {
            Session::create($validated);

            return response()->json(['uzenet' => 'Sikeresen létrehozva.'], 201, options: JSON_UNESCAPED_UNICODE);
        } catch (\Throwable $th) {
            return response()->json(['uzenet' => 'Hiba a rögzítés során.'], 500, options: JSON_UNESCAPED_UNICODE);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Session $session)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $session = Session::find($id);
        } catch (\Throwable $th) {
            return response()->json(["uzenet" => "Hiba a frissítés során"], 500, options: JSON_UNESCAPED_UNICODE);
        }
        if (!$session) {
            return response()->json(["uzenet" => "Nincs ilyen id-val rendelkező session"], 400, options: JSON_UNESCAPED_UNICODE);
        }
        $request->validate([
            'scheduled_at' => 'required|date',
        ], [], [
            'scheduled_at' => 'Időpont',
        ]);

        try {
            $session->update([
                'scheduled_at' => $request->scheduled_at
            ]);
        } catch (\Throwable $th) {
            return response()->json(["uzenet" => "Hiba a frissítés során"], 500, options: JSON_UNESCAPED_UNICODE);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Session $session)
    {
        //
    }
}
