<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('chat');
    }

    public function fetchMessages()
    {
        return Message::with('user')->get();
    }

    public function sendMessage(Request $request)
    {
        $message = new Message();

        $message->message = $request['message'];
        $message->user_id = Auth::user()->id;
        $message->save();

		broadcast(new MessageSent(Auth::user(), $message))->toOthers();

        return ['status' => 'Message Sent!'];
    }
}
