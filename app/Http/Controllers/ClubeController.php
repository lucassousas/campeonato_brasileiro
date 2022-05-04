<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Clube;

class ClubeController extends Controller
{
    
    public function listaClubes() {
    
        // SELECT c.*, COUNT(a.id) AS total_alunos FROM curso AS c LEFT JOIN aluno AS a ON c.id = a.curso_id GROUP BY c.id
    
        return DB::table("clube AS c")
            ->leftJoin("jogador AS j", "c.id", "=", "j.clube_id")
            ->select("c.id", "c.nome", DB::raw("COUNT(j.id) AS total_jogadores"))
            ->groupBy("c.id", "c.nome")
            ->get();
    }
    
    public function index()
    {
        $clube = new Clube();
        $clubes = $this->listaClubes();
        return view("clube.index", [
            "clube" => $clube,
            "clubes" => $clubes
        ]);
    }
    
    public function store(Request $request)
    {
        $request->validate([
            "nome" => "required|max:100"
        ], [
            "nome.required" => "O campo nome é obrigatório",
            "nome.max" => "O campo nome aceita no máximo :max caracteres"
        ]);
        
        if ($request->get("id") != "") {
            $clube = Clube::Find($request->get("id"));
        } else {
            $clube = new Clube();
        }
        $clube->nome = $request->get("nome");
        $clube->save();
        $request->session()->flash("status", "salvo");
        return redirect("/clube");
    }

    public function edit($id)
    {
        $clube = Clube::Find($id);
        $clubes = $this->listaClubes();
        return view("clube.index", [
            "clube" => $clube,
            "clubes" => $clubes
        ]);
    }

    public function destroy($id, Request $request)
    {
        Clube::Destroy($id);
        $request->session()->flash("status", "excluido");
        return redirect("/clube");
    }
}
