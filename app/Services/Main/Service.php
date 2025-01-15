<?php

namespace App\Services\Main;

use App\Models\Message;
use App\Models\User;
use App\Models\User_Contact;
use Illuminate\Support\Facades\DB;

class Service
{

    public function indexProfile()
    {
        $userId = auth()->user()->id;


        $outgoingContacts = User_Contact::with('contact')
            ->where('user_id', $userId)
            ->get();

        $incomingContacts = User_Contact::with('user')
            ->where('contact_id', $userId)
            ->get();



        return [$outgoingContacts, $incomingContacts];
    }

    public function indexContact()
    {
        $userId = auth()->user()->id;
        $users = User_Contact::with(['user', 'contact'])
            ->where(function ($query) use ($userId) {
                $query->where('user_id', $userId)
                    ->orWhere('contact_id', $userId);
            })
            ->where('status', 'accepted')
            ->get();



        return $users;
    }




    public function create($message, $friendId)
    {
        $userId = auth()->user()->id;
        $exist = User_Contact::whereIn('user_id', [$friendId, $userId])->whereIn('contact_id', [$friendId, $userId])->exists();

        if (!$exist) {
            return redirect()->route('main');
        }
        DB::transaction(function () use ($message, $friendId, $userId) {
            Message::create([
                'user_id' => $friendId,
                'sender_id' => $userId,
                'message' => $message['message'],
            ]);

        });
    }


}
