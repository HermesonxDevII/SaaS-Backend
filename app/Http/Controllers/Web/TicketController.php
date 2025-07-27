<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Http\Requests\Ticket\{ StoreRequest, UpdateRequest };

class TicketController extends Controller
{
    public function index(Request $request)
    {
        return view('tickets.index');
    }

    public function create(Request $request)
    {

    }

    public function store(StoreRequest $request)
    {

    }

    public function show(Request $request, Ticket $ticket)
    {

    }

    public function edit(Request $request, Ticket $ticket)
    {

    }

    public function update(UpdateRequest $request, Ticket $ticket)
    {

    }

    public function destroy(Request $request, Ticket $ticket)
    {

    }
}
