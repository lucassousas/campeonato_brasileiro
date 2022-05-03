<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClubeController extends Controller
{
    public function index(){
        return view("clube.index");
    }

}
