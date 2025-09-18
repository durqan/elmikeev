<?php

namespace App\Http\Controllers;

use App\Api\Elmikeev;

class ApiController extends Controller
{
    public function index()
    {
        dd(Elmikeev::get_stocks());
    }
}
