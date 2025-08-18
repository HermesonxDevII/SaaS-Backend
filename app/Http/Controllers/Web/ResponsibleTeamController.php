<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{ ResponsibleTeam };
use App\Http\Requests\ResponsibleTeam\{ StoreRequest, UpdateRequest };

class ResponsibleTeamController extends Controller
{
    public function index(Request $request)
    {
        $responsible_teams = ResponsibleTeam::all();

        return view('responsible-teams.index', compact('responsible_teams'));
    }

    public function create(Request $request)
    {
        return view('responsible-teams.create');
    }

    public function store(StoreRequest $request)
    {
        $validatedData = $request->validated();

        loggedUser()->responsibleTeams()->create([
            'name' => $validatedData['name']
        ]);

        return redirect()
            ->route('responsible-teams.index')
            ->with(['message' => 'Equipe Responsável criada com sucesso!']);
    }

    public function show(Request $request, ResponsibleTeam $responsible_team)
    {
        return view('responsible-teams.show', compact('responsible_team'));
    }

    public function edit(Request $request, ResponsibleTeam $responsible_team)
    {
        return view('responsible-teams.edit', compact('responsible_team'));
    }

    public function update(UpdateRequest $request, ResponsibleTeam $responsible_team)
    {
        $validatedData = $request->validated();

        $responsible_team->update([
            'name'   => $validatedData['name'],
            'active' => filter_var($validatedData['active'], FILTER_VALIDATE_BOOLEAN)
        ]);

        return redirect()
            ->route('responsible-teams.index')
            ->with(['message' => 'Equipe Responsável editada com sucesso!']);
    }

    public function destroy(Request $request, ResponsibleTeam $responsible_team)
    {
        $responsible_team->update([
            'deleted' => true
        ]);

        return redirect()
            ->route('responsible-teams.index')
            ->with(['message' => 'Equipe Responsável deletada com sucesso!']);
    }
}
