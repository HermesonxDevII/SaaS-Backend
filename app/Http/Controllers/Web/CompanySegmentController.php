<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{ CompanySegment };
use App\Http\Requests\CompanySegment\{ StoreRequest, UpdateRequest };

class CompanySegmentController extends Controller
{
    public function index(Request $request)
    {
        $company_segments = CompanySegment::all();

        return view('company-segments.index', compact('company_segments'));
    }

    public function create(Request $request)
    {
        return view('company-segments.create');
    }

    public function store(StoreRequest $request)
    {
        $validatedData = $request->validated();

        loggedUser()->companySegments()->create([
            'name'        => $validatedData['name'],
            'description' => $validatedData['description'],
        ]);

        return redirect()
            ->route('company-segments.index')
            ->with(['message' => 'Segmento de Empresas criado com sucesso!']);
    }

    public function show(Request $request, CompanySegment $company_segment)
    {
        return view('company-segments.show', compact('company_segment'));
    }

    public function edit(Request $request, CompanySegment $company_segment)
    {
        return view('company-segments.edit', compact('company_segment'));
    }

    public function update(UpdateRequest $request, CompanySegment $company_segment)
    {
        $validatedData = $request->validated();

        $company_segment->update([
            'name'          => $validatedData['name'],
            'description'   => $validatedData['description'],
            'active' => filter_var($validatedData['active'], FILTER_VALIDATE_BOOLEAN)
        ]);

        return redirect()
            ->route('company-segments.index')
            ->with(['message' => 'Segmento de Empresas atualizado com sucesso!']);
    }

    public function destroy(Request $request, CompanySegment $company_segment)
    {
        $company_segment->update([
            'deleted' => true
        ]);

        return redirect()
            ->route('company-segments.index')
            ->with(['message' => 'Segmento de Empresas deletado com sucesso!']);
    }
}
