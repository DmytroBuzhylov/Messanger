<?php

namespace App\Http\Controllers\Contact;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\User_Contact;
use Illuminate\Http\Request;

class CreateController extends BaseController
{
    public function __invoke(\App\Http\Requests\Contact\Request $request)
    {
        $data = $request->validated();

        $this->service->crate($data);




        return redirect()->route('profile');
    }
}
