@extends('dash.base')
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<title>BlueBook</title>
</head>
<body>

@section('dash-nav')
@endsection


@section('dash-conteudo')
<div class="jumbotron alert alert-warning">
  <h1 class="display-4">BlueBook Vaults</h1>
  <div class="container">
	<p class="lead">
		Antes de continuar, atente-se aos alertas iniciais sobre o função cofre:
	</p>
	<ul>
		<li>A primeiro momento, a senha padrão do cofre é a sua senha de login. Contudo, é possível alterar depois.</li>
		<li>O caderno que tiver a função cofre ativada, não deverá aparecer na aba 'Cadernos'.</li>
		<li>O caderno que tiver a função cofre ativada, aparecerá somente na aba 'Cofre'.</li>
	</ul>

	<hr class="my-4">

	<a class="btn btn-outline-warning btn-lg" href="/defconfigurevault/{{$book->id}}" role="button">
		<i class="fa-sharp fa-solid fa-arrow-right"></i> Continuar
	</a>
  </div>
</div>
@endsection





</body>
</html>

