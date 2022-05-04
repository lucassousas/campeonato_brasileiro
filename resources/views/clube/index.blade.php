@extends("templates.main")

@section("titulo", "Cadastro de clubes")

@section("formulario")
	<br />
	<h1>Cadastro de clubes</h1>
	<form method="POST" action="/clube" class="row" enctype="multipart/form-data">
		<div class="form-group col-6">
			<label for="nome">Nome: </label>
			<input type="text" id="nome" name="nome" class="form-control" value="{{ $clube->nome }}" required />
		</div>
		<div class="form-group col-4">
			<label for="foto">Foto: </label>
			<input type="file" id="foto" name="foto" class="form-control" />
		</div>
		<div class="form-group col-2">
			@csrf
			<input type="hidden" id="id" name="id" value="{{ $clube->id }}" />
			<a href="/clube" class="btn btn-sm btn-primary" style="margin-top: 29px;">
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