<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{ Company };
use App\Http\Requests\Company\{ StoreRequest, UpdateRequest };

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        $companies = Company::all();

        return view('companies.index', compact('companies'));
    }

    public function create(Request $request)
    {
        return view('companies.create');
    }

    public function store(StoreRequest $request)
    {
        $validatedData = $request->validated();
    }

    public function show(Request $request, Company $company)
    {
        return view('companies.show', compact('company'));
    }

    public function edit(Request $request, Company $company)
    {
        return view('companies.edit', compact('company'));
    }

    public function update(UpdateRequest $request, Company $company)
    {
        $validatedData = $request->validated();
    }

    public function destroy(Request $request, Company $company)
    {
        
    }
}
