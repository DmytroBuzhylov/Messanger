<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User_Contact;
use Illuminate\Http\Request;

class UpdateController extends BaseController
{
    public function __invoke($id, \App\Http\Requests\Message\Request $message)
    {
        $messageUpdate = $message->validated();

        $message = Message::find($id);

        if ($message->sender_id == auth()->user()->id) {
            $friendId = $message->user_id;
            $message->message = $messageUpdate['message'];
            $message->save();
            return redirect()->route('messages', $friendId);

        }

        return redirect()->route('messages');

    }
}
