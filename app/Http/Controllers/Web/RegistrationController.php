<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{ Priority, ResponsibleTeam, SolicitationType };

class RegistrationController extends Controller
{
    public function index(Request $request)
    {
        $priorities = Priority::get();
        $responsibleTeams = ResponsibleTeam::get();
        $solicitationTypes = SolicitationType::get();

        return view('registrations.index', compact('priorities', 'responsibleTeams', 'solicitationTypes'));
    }
}
