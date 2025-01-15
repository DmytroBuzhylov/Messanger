<?php

namespace App\Http\Controllers\Contact;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class UpdateController extends BaseController
{
    public function __invoke()
    {
        $request = request()->validate([
            'accepted' => 'required',
        ]);



        $this->service->update();
        return redirect()->route('profile');
    }
}
