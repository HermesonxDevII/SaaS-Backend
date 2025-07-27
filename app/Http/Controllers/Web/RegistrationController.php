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
        $fields = ['Nome', 'Quantidade', 'Ações'];
        
        $values = collect([
            ['name' => 'Empresas',              'quantity' => Company::count()],
            ['name' => 'Grupos de Empresas',    'quantity' => CompanyGroup::count()],
            ['name' => 'Segmentos de Empresas', 'quantity' => CompanySegment::count()],
            ['name' => 'Equipes Responsáveis',  'quantity' => ResponsibleTeam::count()],
            ['name' => 'Prioridades',           'quantity' => Priority::count()],
            ['name' => 'Tipos de Solicitações', 'quantity' => SolicitationType::count()]
        ])->map(function ($item) {
            return (object) $item;
        });

        return view('registrations.index', compact('fields', 'values'));
    }
}
