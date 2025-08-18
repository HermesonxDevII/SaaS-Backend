<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{ CompanyGroup };
use App\Http\Requests\CompanyGroup\{ StoreRequest, UpdateRequest };

class CompanyGroupController extends Controller
{
    public function index(Request $request)
    {
        $company_groups = CompanyGroup::all();

        return view('company-groups.index', compact('company_groups'));
    }

    public function create(Request $request)
    {
        return view('company-groups.create');
    }

    public function store(StoreRequest $request)
    {
        $validatedData = $request->validated();

        loggedUser()->companyGroups()->create([
            'name' => $validatedData['name']
        ]);

        return redirect()
            ->route('company-groups.index')
            ->with(['message' => 'Grupo de Empresas criado com sucesso!']);
    }

    public function show(Request $request, CompanyGroup $company_group)
    {
        return view('company-groups.show', compact('company_group'));
    }

    public function edit(Request $request, CompanyGroup $company_group)
    {
        return view('company-groups.edit', compact('company_group'));
    }

    public function update(UpdateRequest $request, CompanyGroup $company_group)
    {
        $validatedData = $request->validated();

        $company_group->update([
            'name'   => $validatedData['name'],
            'active' => filter_var($validatedData['active'], FILTER_VALIDATE_BOOLEAN)
        ]);

        return redirect()
            ->route('company-groups.index')
            ->with(['message' => 'Grupo de Empresas atualizado com sucesso!']);
    }

    public function destroy(Request $request, CompanyGroup $company_group)
    {
        $company_group->update([
            'deleted' => true
        ]);

        return redirect()
            ->route('company-groups.index')
            ->with(['message' => 'Grupo de Empresas deletado com sucesso!']);
    }
}
