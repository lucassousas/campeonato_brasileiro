<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jogador;
use App\Models\Clube;
use Illuminate\Support\Facades\DB;

class JogadorController extends Controller
{
    public function listaJogadores(){
        return DB::table("jogador AS j")
            ->join("clube AS c", "j.clube_id", "=", "c.id")
            ->select("j.*", "c.nome AS clube")
            ->get();
    }

    public function index(){
        $jogador = new Jogador();
        $jogadores = $this->listaJogadores();
        $clubes = Clube::All();
        return view("jogador.index", [
            "jogador" => $jogador,
            "jogadores" => $jogadores,
            "clubes" => $clubes
        ]);
    }

    public function store(Request $request)
    {
        if ($request->get("id") != "") {
            $jogador = Jogador::Find($request->get("id"));
        } else {
            $jogador = new Jogador();
        }
        
        $jogador->nome = $request->get("nome");
        $jogador->dataNasc = $request->get("dataNasc");
        $jogador->clube_id = $request->get("clube_id");
        $jogador->posicao_jogador_id = $request->get("posicao_jogador_id");
        
        if ($request->file("foto") != null) {
            $jogador->foto = $request->file("foto")->store("public/jogador");
        }
        
        $jogador->save();
        
        $request->session()->flash("status", "salvo");
        
        return redirect("/jogador");
        
    }

    public function edit($id)
    {
        $jogador = Jogador::Find($id);
        $jogadores = $this->listaJogadores();
        $clubes = Clube::All();
        return view("jogador.index", [
            "jogador" => $jogador,
            "jogadores" => $jogadores,
            "clubes" => $clubes
        ]);
    }

    public function destroy($id, Request $request)
    {
        Jogador::Destroy($id);
        $request->session()->flash("status", "excluido");
        return redirect("/jogador");
    }

}
