<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JogadorController extends Controller
{
    public function index(){
        return view("jogador.index");
    }

}
