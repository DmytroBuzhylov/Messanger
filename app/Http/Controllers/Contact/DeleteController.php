<?php

namespace App\Http\Controllers\Contact;

use App\Http\Controllers\Controller;

use App\Models\User_Contact;
use Illuminate\Http\Request;

class DeleteController extends BaseController
{
    public function __invoke(Request $request)
    {
        $contactId = $request->input('contact_id');

        $contact = User_Contact::find($contactId);

        if (!$contact) {
            return redirect()->back();
        }

        $contact->delete();

        return redirect()->back();




//        return redirect()->route('profile');
    }
}
