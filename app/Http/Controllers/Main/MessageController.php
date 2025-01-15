<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use App\Models\User_Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MessageController extends BaseController
{
    public function __invoke()
    {

        $userId = auth()->user()->id;
        $friendId = request('friendId');

        request()->session()->put('friendId', $friendId);
        $messages = DB::transaction(function () use ($userId, $friendId) {
           return Message::with(['sender', 'recipient'])
           ->whereIn('user_id', [$friendId, $userId])
           ->whereIn('sender_id', [$friendId, $userId])
               ->orderBy('created_at', 'asc')->get();
        });




        return redirect()->route('main')->with('messages', $messages);
    }
}
