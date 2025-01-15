<?php

namespace App\Services\Contact;

use App\Models\Contact;
use App\Models\User;
use App\Models\User_Contact;
use Dflydev\DotAccessData\Data;
use Illuminate\Support\Facades\DB;


class Service
{
    public function crate($data)
    {
        DB::transaction(function () use ($data) {

            $email = $data['email'];
            $contact = User::where('email', $email)->first();

            if (!$contact) {
                return redirect()->route('profile');
            }

            if ($contact->id == auth()->user()->id) {
                return redirect()->route('profile');
            }

            $existingRequest = User_Contact::where(function ($query) use ($contact) {
                $query->where('user_id', auth()->user()->id)
                    ->where('contact_id', $contact->id);
            })->orWhere(function ($query) use ($contact) {
                $query->where('user_id', $contact->id)
                    ->where('contact_id', auth()->user()->id);
            })->first();

            if ($existingRequest) {
                return redirect()->route('profile');
            }

            User_Contact::create([
                'user_id' => auth()->user()->id,
                'contact_id' => $contact->id,
                'email' => $contact->email,
                'status' => 'pending',
            ]);

        });


    }

    public function update()
    {

        $userId = auth()->user()->id;
        $userEmail = auth()->user()->email;


        $userContact = User_Contact::where('email', $userEmail)
            ->where('status', 'pending')
            ->first();

        if ($userContact) {
            $userContact->status = 'accepted';
            $userContact->save();
        }

    }

    public function delete()
    {
        $userId = auth()->user()->id;
        $userEmail = auth()->user()->email;


        $userContact = User_Contact::where('email', $userEmail)
            ->where('status', 'pending')
            ->first();

        if ($userContact) {
            $userContact->status = 'rejected';
            $userContact->save();
        }
    }


}
