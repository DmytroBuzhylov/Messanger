<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User_Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CreateController extends BaseController
{
    public function __invoke()
    {


        $message = request()->validate([
            'message' => 'required',
        ]);
        $friendId = request()->session()->get('friendId');

        $this->service->create($message, $friendId);

        return redirect()->route('messages', $friendId);
    }
}
