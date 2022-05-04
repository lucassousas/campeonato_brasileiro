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
	<table class="table table-striped">
		<colgroup>
			<col width="300">
			<col width="300">
			<col width="100">
			<col width="100">
		</colgroup>
		<thead>
			<tr>
				<th>Nome</th>
				<th>Escudo</th>
				<th>Editar</th>
				<th>Excluir</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($clubes as $clube)
				<tr>
					<td>{{ $clube->nome }}</td>
					<td>
						@if ($clube->escudo != null)
							<img src='{{ str_replace("public/", "storage/", $clube->foto) }}' width="100"></img>
						@endif
					</td>
					<td>
						<a href="/clube/{{ $clube->id }}/edit" class="btn btn-warning">
							<i class="bi bi-pencil-square"></i> Editar
						</a>
					</td>
					<td>
						<form method="POST" action="/clube/{{ $clube->id }}">
							@csrf
							<input type="hidden" name="_method" value="DELETE" />
							<button type="button" class="btn btn-danger" onclick="excluir(this);">
								<i class="bi bi-trash"></i> Excluir
							</button>
						</form>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endsection

<script>
	function excluir(btn) {
		Swal.fire({
			"title": "Deseja realmente excluir?",
			"icon": "warning",
			"showCancelButton": true,
			"cancelButtonText": "Cancelar",
			"confirmButtonText": "Confirmar",
			"confirmButtonColor": "#3085d6",
			"cancelButtonColor": "#d33"
		}).then(function(result) {
			if (result.isConfirmed) {
				$(btn).parents("form").submit();
			}
		});
	}
</script>