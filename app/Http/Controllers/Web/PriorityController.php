<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{ Priority };
use App\Http\Requests\Priority\{ StoreRequest, UpdateRequest };

class PriorityController extends Controller
{
    public function index(Request $request)
    {
        $priorities = Priority::all();

        return view('priorities.index', compact('priorities'));
    }

    public function create(Request $request)
    {
        return view('priorities.create');
    }

    public function store(StoreRequest $request)
    {
        $validatedData = $request->validated();

        loggedUser()->priorities()->create([
            'name'        => $validatedData['name'],
            'description' => $validatedData['description'],
        ]);

        return redirect()
            ->route('priorities.index')
            ->with(['message' => 'Prioridade criada com sucesso!']);
    }

    public function show(Request $request, Priority $priority)
    {
        return view('priorities.show', compact('priority'));
    }

    public function edit(Request $request, Priority $priority)
    {
        return view('priorities.edit', compact('priority'));
    }

    public function update(UpdateRequest $request, Priority $priority)
    {
        $validatedData = $request->validated();

        $priority->update([
            'name'          => $validatedData['name'],
            'description'   => $validatedData['description'],
            'active' => filter_var($validatedData['active'], FILTER_VALIDATE_BOOLEAN)
        ]);

        return redirect()
            ->route('priorities.index')
            ->with(['message' => 'Prioridade editada com sucesso!']);
    }

    public function destroy(Request $request, Priority $priority)
    {
        $priority->update([
            'deleted' => true
        ]);
        
        return redirect()
            ->route('priorities.index')
            ->with(['message' => 'Prioridade deletada com sucesso!']);
    }
}
