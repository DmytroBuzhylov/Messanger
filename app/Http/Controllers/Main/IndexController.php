<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\User_Contact;
use Illuminate\Http\Request;

class IndexController extends BaseController
{
    public function __invoke()
    {

        $contacts = $this->service->indexContact();
        $messages = session('messages');




        return view('main.main', compact(['contacts', 'messages']));
    }
}
