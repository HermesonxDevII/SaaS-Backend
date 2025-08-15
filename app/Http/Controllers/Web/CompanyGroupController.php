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
        $companies_groups = CompanyGroup::all();

        return view('companies-groups.index', compact('companies_groups'));
    }

    public function create(Request $request)
    {
        return view('companies-groups.create');
    }

    public function store(StoreRequest $request)
    {

    }

    public function show(Request $request, CompanyGroup $company_group)
    {

    }

    public function edit(Request $request, CompanyGroup $company_group)
    {

    }

    public function update(UpdateRequest $request, CompanyGroup $company_group)
    {

    }

    public function destroy(Request $request, CompanyGroup $company_group)
    {
        
    }
}
