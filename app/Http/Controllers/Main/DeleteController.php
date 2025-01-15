<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User_Contact;
use Illuminate\Http\Request;

class DeleteController extends BaseController
{
    public function __invoke($id)
    {
        $message = Message::find($id);

        if ($message->sender_id == auth()->user()->id) {

            $user_id = $message->user_id;

            $message->delete();
            return redirect()->route('messages', $user_id);
        }


        return redirect()->route('main');

    }
}
