<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{ SolicitationType };
use App\Http\Requests\SolicitationType\{ StoreRequest, UpdateRequest };

class SolicitationTypeController extends Controller
{
    public function index(Request $request)
    {
        $solicitation_types = SolicitationType::all();

        return view('solicitation-types.index', compact('solicitation_types'));
    }

    public function create(Request $request)
    {
        return view('solicitation-types.create');
    }

    public function store(StoreRequest $request)
    {
        $validatedData = $request->validated();

        loggedUser()->solicitationTypes()->create([
            'name' => $validatedData['name']
        ]);

        return redirect()
            ->route('solicitation-types.index')
            ->with(['message' => 'Tipo de Solicitação criada com sucesso!']);
    }

    public function show(Request $request, SolicitationType $solicitation_type)
    {
        return view('solicitation-types.show', compact('solicitation_type'));
    }

    public function edit(Request $request, SolicitationType $solicitation_type)
    {
        return view('solicitation-types.edit', compact('solicitation_type'));
    }

    public function update(UpdateRequest $request, SolicitationType $solicitation_type)
    {
        $validatedData = $request->validated();

        $solicitation_type->update([
            'name'   => $validatedData['name'],
            'active' => filter_var($validatedData['active'], FILTER_VALIDATE_BOOLEAN)
        ]);

        return redirect()
            ->route('solicitation-types.index')
            ->with(['message' => 'Tipo de solicitação editada com sucesso!']);
    }

    public function destroy(Request $request, SolicitationType $solicitation_type)
    {
        $solicitation_type->update([
            'deleted' => true
        ]);

        return redirect()
            ->route('solicitation-types.index')
            ->with(['message' => 'Tipo de solicitação deletado com sucesso!']);
    }
}
