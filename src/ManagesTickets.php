<?php

use App\Models\Ticket;
use Aujicini\Moderation\TicketRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

trait ManagesTickets
{
    /**
     * Store a newly created ticket.
     *
     * @param  \Aujicini\Moderation\TicketRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TicketRequest $request)
    {
         Ticket::create([
             'user_id' => Auth::user()->id,
             'message' => $request->message,
             'data'    => $request->data,
         ]);
         return $request->wantsJson()
             ? response()->json(['status' => __('moderation.ticket_created')], 200)
             : back()->with('status', __('moderation.ticket_created'));
    }
}
