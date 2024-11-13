<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SpatieController extends Controller
{
    public function index(){
        return view('spatie-permissions');
    }
}
