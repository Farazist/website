<?php

namespace App\Http\Controllers;

use App\Message;
use App\Information;
use App\SocialNetwork;
use App\Events\commentCreated;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function Index()
    {
        $contact = Information::where('name', '=', 'contact')->firstOrFail();
        $address_full = Information::where('name', '=', 'address_full')->firstOrFail()->value;
        $telegram = SocialNetwork::where('name', '=', 'telegram admin')->firstOrFail()->link;

        return view('client.contact', [
            'contact' => $contact,
            'address_full' => $address_full,
            'telegram' => $telegram,
        ]);
    }

    public function getAll()
    {
        $messages_for_show = Message::orderBy('created_at', 'desc')->paginate(20);

        $messages = Message::orderBy('created_at', 'desc')->paginate(20);

        foreach ($messages as $message) {
            $message->new = 0;
            $message->save();
        }

        return view('admin.messages', [
            'messages' => $messages_for_show
        ]);
    }

    public function AddPost(Request $request)
    {
        $this->validate($request, [
            'sender' => 'required|max:64',
            'body' => 'required|max:256',
            'phone' => 'required'
        ]);

        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $remoteip = $_SERVER['REMOTE_ADDR'];
        $data = [
            'secret' => config('services.recaptcha.secret'),
            'response' => $request->get('recaptcha'),
            'remoteip' => $remoteip
        ];

        $options = [
            'http' => [
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($data)
            ]
        ];

        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        $resultJson = json_decode($result);

        if ($resultJson->success != true) {
            return back()->withErrors(['captcha' => 'ReCaptcha Error1']);
        }

        if ($resultJson->score >= 0.5) {
            $message = new Message();
            $message->sender = $request['sender'];
            $message->phone = $request['phone'];
            $message->body = $request['body'];
            $message->save();

            return redirect()->back()->with([
                'message' => 'پیام شما فرستاده شد',
            ]);
        } else {
            return back()->withErrors(['captcha' => 'ReCaptcha Error2']);
        }
    }

    public function DeleteGet($id)
    {
        $message = Message::find($id);
        $message->delete();

        return redirect()->back()->with([
            'message' => 'پیام حذف شد',
        ]);
    }
}
