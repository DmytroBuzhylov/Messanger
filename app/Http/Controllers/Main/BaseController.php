<?php

namespace App\Http\Controllers\Main;

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
