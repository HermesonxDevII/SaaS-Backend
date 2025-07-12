<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;

class TicketController extends Controller
{
    public function index(Request $request)
    {
        return view('tickets.index');
    }

    public function create(Request $request)
    {

    }

    public function store(Request $request)
    {

    }

    public function show(Request $request, Ticket $ticket)
    {

    }

    public function edit(Request $request, Ticket $ticket)
    {

    }

    public function update(Request $request, Ticket $ticket)
    {

    }

    public function destroy(Request $request, Ticket $ticket)
    {

    }
}
