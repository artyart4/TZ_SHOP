<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function __invoke()
    {
        flash()->info('test');
        return view('index');
    }
}
