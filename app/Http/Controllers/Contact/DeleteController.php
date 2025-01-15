<?php

namespace App\Http\Controllers\Contact;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class DeleteController extends BaseController
{
    public function __invoke()
    {
        $request = request()->validate([
            'rejected' => 'required',
        ]);


        $this->service->delete();


        return redirect()->route('profile');
    }
}
