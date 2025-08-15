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

    }

    public function store(StoreRequest $request)
    {

    }

    public function show(Request $request, Company $company)
    {

    }

    public function edit(Request $request, Company $company)
    {

    }

    public function update(UpdateRequest $request, Company $company)
    {

    }

    public function destroy(Request $request, Company $company)
    {
        
    }
}
