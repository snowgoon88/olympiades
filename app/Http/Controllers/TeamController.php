<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    /**
     * Show the form to change/edit team.
     *
     * @return \Illuminate\Http\Response
     */
    public function showTeamForm()
    {
        return view('team_edit');
    }

    public function editTeam(Request $request)
    {
        
        $player = Auth::user();
        $player->team = $request->input('team');
        $player->faction = $request->input('faction');
        $player->race = $request->input('race');
        $player->save();

        return redirect('/home');
    }
}
