<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Services\Main\Service;

class BaseController extends Controller
{
    public $service;

    public function __construct(Service $service)
    {

        $this->service = $service;
    }
}
