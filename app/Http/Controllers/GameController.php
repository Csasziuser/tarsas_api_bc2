<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $games = Game::all();
            return response()->json($games,200,options:JSON_UNESCAPED_UNICODE);
        } catch (\Throwable $th) {
            return response()->json(['uzenet' => 'Hiba az adatok lekérdezése során! Hiba a szerver elérésekor!'],500,options:JSON_UNESCAPED_UNICODE);
        }
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'max_player' => 'required|integer|between:2,6',
            'difficulty' => 'required|string'
        ],[
            'string' => ':attribute szöveges értéket vár!',
            'integer' => ':attribute egész értéket vár!',
            'between' => ':attribute mező értéke :min - :max között kell, hogy legyen!'
        ],[
            'title' => 'A játék címe',
            'max_player' => 'Játékosszám',
            'difficulty' => 'Nehézség'
        ]);

        try 
        {
            Game::create($validated);
            return response()->json(['uzenet' => 'A játék sikeresen rögzítve!'],201,options:JSON_UNESCAPED_UNICODE);
        } catch (\Throwable $th) 
        {
           return response()->json(['uzenet' => 'Hiba az adat rögzítése során! Hiba a szerver elérésekor!'],500,options:JSON_UNESCAPED_UNICODE);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Game $game)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $game = Game::find($id);

        if (!$game) 
        {
            return response()->json(['uzenet' => 'Nincs ilyen játék az adatbázisban.'],404,options:JSON_UNESCAPED_UNICODE);
        }

        $validated = $request->validate(
            [
            'difficulty' => 'required|string'
            ],[],
            ['difficulty' => 'nehézség']
        );

        try {
            $game->update($validated);

            return response()->json(['uzenet' => 'A játék nehézsége sikeresen módosítva!'],200,options:JSON_UNESCAPED_UNICODE);
        } catch (\Throwable $th) {
            return response()->json(['uzenet' => 'A játék nehézségének módosítása sikertelen! Hiba a szerver elérésekor!'],500,options:JSON_UNESCAPED_UNICODE);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $game = Game::find($id);
        } catch (\Throwable $th) {
            return response()->json(['uzenet' => 'Hiba a szerver elérésekor!'],500,options:JSON_UNESCAPED_UNICODE);
        }
        

        if (!$game) {
            return response()->json(['uzenet' => 'Nincs ilyen játék az adatbázisban.'],404,options:JSON_UNESCAPED_UNICODE);
        }

        try {
            $game->delete();
            return response()->json(['uzenet' => 'A játék sikresen törölve!'],200,options:JSON_UNESCAPED_UNICODE);
        } catch (\Throwable $th) {
            return response()->json(['uzenet' => 'A játék törlése sikertelen! Hiba a szerver elérésekor!'],500,options:JSON_UNESCAPED_UNICODE);
        }
        
    }
}
