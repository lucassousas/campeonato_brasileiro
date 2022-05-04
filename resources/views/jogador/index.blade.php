@extends("templates.main")

@section("titulo", "Cadastro de jogadores")

@section("formulario")
	<br />
	<h1>Cadastro de jogadores</h1>
	<form method="POST" action="/jogador" class="row" enctype="multipart/form-data">
		<div class="form-group col-6">
			<label for="nome">Nome: </label>
			<input type="text" id="nome" name="nome" class="form-control" value="{{ $jogador->nome }}" required />
		</div>
		<div class="form-group col-6">
			<label for="dataNasc">Data de nascimento: </label>
			<input type="datetime" name="dataNasc" />
		</div>
		<div class="form-group col-6">
			<label for="clube_id">Clube: </label>
			<select id="clube_id" name="clube_id" class="form-control" required>
				<option value=""></option>
				@foreach ($clubes as $clube) 
					<option value="{{ $clube->id }}" @if ($clube->id == $jogador->clube_id) selected @endif>{{ $clube->nome }}</option>
				@endforeach
			</select>
		</div>
		<div class="form-group col-6">
			<label for="posicao_jogador_id">Posição do jogador: </label>
			<select id="posicao_jogador_id" name="posicao_jogador_id" class="form-control" required>
				<option value=""></option>
				@foreach ($jogadores as $jogador) 
					<option value="{{ $jogador->id }}" @if ($jogador->posicao_jogador_id == $posicao_jogador->id) selected @endif>{{ $posicao_jogador->posicao }}</option>
				@endforeach
			</select>
		</div>
		<div class="form-group col-2">
			@csrf
			<input type="hidden" id="id" name="id" value="{{ $jogador->id }}" />
			<a href="/jogador" class="btn btn-sm btn-primary" style="margin-top: 29px;">
				<i class="bi bi-plus-square"></i> Novo
			</a>
			<button type="submit" class="btn btn-sm btn-success" style="margin-top: 29px;">
				<i class="bi bi-save"></i> Salvar
			</button>
		</div>
	</form>

@endsection

@section("tabela")
	<br />

	<h1>Lista de Clubes</h1>
	
@endsection