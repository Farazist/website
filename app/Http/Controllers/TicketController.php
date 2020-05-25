<?php

namespace App\Http\Controllers;

use App\Events\commentCreated;
use App\Ticket;
use App\Degree;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function getAll()
    {
        $tickets = Ticket::orderBy('created_at', 'desc')->get();

        return view('admin.tickets', [
            'tickets' => $tickets,
        ]);
    }

    public function getMessages($id)
    {
        $ticket = Ticket::find($id);

        if (!$ticket) {
            return redirect()->back()->with([
                'message' => 'تیکت پیدا نشد',
            ]);
        }

        return view('admin.ticket_messages', [
            'ticket' => $ticket,
        ]);
    }

    public function AddGet()
    {
        return view('admin.ticket_form');
    }

    public function AddPost(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:120',
            'email' => 'required|email',
        ]);

        $ticket = new Ticket();
        $ticket->name = $request['name'];
        $ticket->explanation = $request['explanation'];
        $ticket->email = $request['email'];
        $ticket->telegram = $request['telegram'];
        $ticket->instagram = $request['instagram'];
        $ticket->image = $request['image'];
        $ticket->save();

        return redirect('/admin/tickets')->with([
            'message' => 'همکار افزوده شد',
        ]);
    }

    public function EditGet($id)
    {
        $ticket = Ticket::find($id);

        if (!$ticket) {
            return redirect('/admin/ticket')->with([
                'message' => 'همکار پیدا نشد',
            ]);
        }

        return view('admin.ticket_form', [
            'ticket' => $ticket,
        ]);
    }

    public function EditPost(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:120',
            'email' => 'required|email',
        ]);

        $ticket = Ticket::find($request['id']);

        $ticket->name = $request['name'];
        $ticket->explanation = $request['explanation'];
        $ticket->email = $request['email'];
        $ticket->telegram = $request['telegram'];
        $ticket->instagram = $request['instagram'];
        $ticket->image = $request['image'];

        $ticket->update();

        return redirect('/admin/tickets')->with([
            'message' => 'همکار ویرایش شد',
        ]);
    }

    public function DeleteGet($topic_id)
    {
        $ticket = Ticket::find($topic_id);

        if (!$ticket) {
            return redirect()->back()->with([
                'message' => 'همکار پیدا نشد',
            ]);
        }

        $ticket->delete();

        return redirect()->back()->with([
            'message' => 'همکار حذف شد',
        ]);
    }
}
