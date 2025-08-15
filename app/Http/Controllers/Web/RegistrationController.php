<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    Company,
    CompanyGroup,
    CompanySegment,
    Priority,
    ResponsibleTeam,
    SolicitationType
};

class RegistrationController extends Controller
{
    public function index(Request $request)
    {
        $values = collect([
            [
                'name'     => 'Empresas',
                'quantity' => Company::count(),
                'route'    => route('companies.index')
            ],
            [
                'name'     => 'Grupos de Empresas',   
                'quantity' => CompanyGroup::count(),
                'route'    => route('company-groups.index')
            ],
            [
                'name'     => 'Segmentos de Empresas',
                'quantity' => CompanySegment::count(),
                'route'    => route('company-segments.index')
            ],
            [
                'name'     => 'Equipes Responsáveis', 
                'quantity' => ResponsibleTeam::count(),
                'route'    => route('responsible-teams.index')
            ],
            [
                'name'     => 'Prioridades',          
                'quantity' => Priority::count(),
                'route'    => route('priorities.index')
            ],
            [
                'name'     => 'Tipos de Solicitações',
                'quantity' => SolicitationType::count(),
                'route'    => route('solicitation-types.index')
            ],
        ])->map(function ($item) {
            return (object) $item;
        });


        return view('registrations.index', compact('values'));
    }
}
