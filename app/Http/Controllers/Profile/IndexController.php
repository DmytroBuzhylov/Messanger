<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\User;
use App\Models\User_Contact;
use Illuminate\Http\Request;

class IndexController extends BaseController
{
    public function __invoke()
    {


//       $contacts = $this->service->indexProfile();
//        dd($contacts);

        $userId = auth()->user()->id;


        $outgoingContacts = User_Contact::with('contact')
            ->where('user_id', $userId)
            ->get();

        $incomingContacts = User_Contact::with('user')
            ->where('contact_id', $userId)
            ->get();

        return view('main.profile', compact(['outgoingContacts', 'incomingContacts']));
    }
}
