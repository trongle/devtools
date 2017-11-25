<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DevToolsController extends Controller
{
    public function timestamp(){
        return view('dev-tools.timestamp');
    }

}
