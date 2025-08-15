<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{ Company, CompanySegment, CompanyGroup };
use App\Http\Requests\Company\{ StoreRequest, UpdateRequest };
use Illuminate\Support\Facades\{ Log };

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        $companies = Company::all();

        return view('companies.index', compact('companies'));
    }

    public function create(Request $request)
    {
        $companies_segments = CompanySegment::all();
        $companies_groupies = CompanyGroup::all();

        return view('companies.create', compact('companies_segments', 'companies_groupies'));
    }

    public function store(StoreRequest $request)
    {
        $validatedData = $request->validated();
        
        loggedUser()->companies()->create([
            'corporate_reason'   => $validatedData['corporate_reason'],
            'fantasy_name'       => $validatedData['fantasy_name'],
            'cpf_cnpj'           => removeEspecialChar($validatedData['cpf_cnpj']),
            'street'             => $validatedData['street'],
            'number'             => $validatedData['number'],
            'neighborhood'       => $validatedData['neighborhood'],
            'city'               => $validatedData['city'],
            'state'              => $validatedData['state'],
            'postal_code'        => removeEspecialChar($validatedData['postal_code']),
            'company_segment_id' => $validatedData['company_segment'],
            'company_group_id'   => $validatedData['company_group'],
            'latitude'           => $validatedData['latitude'],
            'longitude'          => $validatedData['longitude'],
        ]);

        return redirect()
            ->route('companies.index')
            ->with(['message' => 'Empresa cadastrada com sucesso!']);
    }

    public function show(Request $request, Company $company)
    {
        return view('companies.show', compact('company'));
    }

    public function edit(Request $request, Company $company)
    {
        $companies_segments = CompanySegment::all();
        $companies_groupies = CompanyGroup::all();

        return view('companies.edit', compact('company', 'companies_segments', 'companies_groupies'));
    }

    public function update(UpdateRequest $request, Company $company)
    {
        $validatedData = $request->validated();

        $company->update([
            'corporate_reason'   => $validatedData['corporate_reason'],
            'fantasy_name'       => $validatedData['fantasy_name'],
            'cpf_cnpj'           => removeEspecialChar($validatedData['cpf_cnpj']),
            'street'             => $validatedData['street'],
            'number'             => $validatedData['number'],
            'neighborhood'       => $validatedData['neighborhood'],
            'city'               => $validatedData['city'],
            'state'              => $validatedData['state'],
            'postal_code'        => removeEspecialChar($validatedData['postal_code']),
            'company_segment_id' => $validatedData['company_segment'],
            'company_group_id'   => $validatedData['company_group'],
            'latitude'           => $validatedData['latitude'],
            'longitude'          => $validatedData['longitude'],
            'active'             => filter_var($validatedData['active'], FILTER_VALIDATE_BOOLEAN),
        ]);

        return redirect()
            ->route('companies.index')
            ->with(['message' => 'Empresa atualizada com sucesso!']);
    }

    public function destroy(Request $request, Company $company)
    {
        $company->update(['deleted' => true]);

        return redirect()
            ->route('companies.index')
            ->with(['message' => 'Empresa deletada com sucesso!']);
    }
}
