<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $players = Player::all();
            return response()->json($players,200,options:JSON_UNESCAPED_UNICODE);
        } catch (\Throwable $th) {
            return response()->json(['uzenet' => 'Nem sikrült lekérni a játékosokat'],500,options:JSON_UNESCAPED_UNICODE);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:1|max:50',
            'email' => 'required|email|min:1|max:50'
        ],[]
        ,[
            'name' => 'A játékos neve',
            'email' => 'A játékos emailje'
        ]);
        try {
            Player::create($validated);
            return response()->json([
                "uzenet" => "Létrejött az adat",
            ],201,options:JSON_UNESCAPED_UNICODE);
        } catch (\Throwable $th) {
            return response()->json([
                "uzenet" => "Nem sikerült"
            ],500,options:JSON_UNESCAPED_UNICODE);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Player $player)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Player $player)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Player $player)
    {
        //
    }
}
