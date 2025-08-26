<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{ Log };
use App\Models\{
    Ticket,
    Company,
    SolicitationType,
    Priority,
    ResponsibleTeam
};
use App\Http\Requests\Ticket\{ StoreRequest, UpdateRequest, SoftUpdateRequest };

class TicketController extends Controller
{
    public function index(Request $request)
    {
        return view('tickets.index');
    }

    public function create(Request $request)
    {
        $companies = Company::all();
        $solicitation_types = SolicitationType::all();
        $priorities = Priority::all();
        $responsible_teams = ResponsibleTeam::all();

        return view('tickets.create', compact('companies', 'solicitation_types', 'priorities', 'responsible_teams'));
    }

    public function store(StoreRequest $request)
    {
        $validatedData = $request->validated();

        $attachments = [];
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $path = $file->store('public/attachments');
                $attachments[] = $path;
            }
        }

        $ticket = loggedUser()->tickets()->create([
            'title'                => $validatedData['title'],
            'company_id'           => $validatedData['company'],
            'description'          => $validatedData['description'],
            'solicitation_type_id' => $validatedData['solicitation_type'],
            'responsible_team_id'  => $validatedData['responsible_team'],
            'priority_id'          => $validatedData['priority'],
            'attachments'          => $attachments,
        ]);

        return redirect()->route('tickets.show', $ticket->id);
    }

    public function show(Request $request, Ticket $ticket)
    {
        $user = loggedUser();
        $isEditable = $user->id === $ticket->user_id || $user->id === $ticket->user->employee_of;
        $solicitation_types = SolicitationType::all();
        $priorities = Priority::all();
        $responsible_teams = ResponsibleTeam::all();

        return view('tickets.show', compact(
            'ticket',
            'isEditable',
            'solicitation_types',
            'priorities',
            'responsible_teams'
        ));
    }

    public function edit(Request $request, Ticket $ticket)
    {

    }

    public function update(UpdateRequest $request, Ticket $ticket)
    {

    }

    public function soft_update(SoftUpdateRequest $request, $ticket)
    {

    }

    public function destroy(Request $request, Ticket $ticket)
    {

    }
}
