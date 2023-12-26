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


@if(count($book)==0)

<div class="container-fluid" style="margin-top: 15px; flex-direction: column; display:flex; align-items:center; justify-content:center;">
	<div class="jumbotron jumbotron-fluid">
	  <div class="container">
	    <h1 class="display-4">BlueBook Vaults</h1>
	    <p class="lead">O BlueBook Vaults, permite confidencialidade por suas anotações. Para ativar a função cofre para um caderno, você deve procurar pelo icone <i class="fa-solid fa-vault"></i>  dentro das opções do caderno, lá será redirecionado aos passos que deve realizar para adicionar o seu caderno a um vault. É permitido apenas um caderno por vault (cofre). Lembre-se que a senha padrão é a sua senha de login.
	    </p>
	  </div>
	</div>

</div>

@else

@section('dash-conteudo')
<div class="button-group" style="margin-bottom: 20px;">
</div>

<div class="container-fluid">
	@foreach($book->chunk(3) as $chunk)
	  <div class="card-columns">
	    @foreach($chunk as $book)
	      <div class="card">
	      	<div class="card-header card-title"> 
	      		Vault de {{$book->title}}
	      		<hr>

	      		<div  style="display:flex; justify-content: center;"> 
	      			<img style="height: 200px; display:" src="https://www.svgrepo.com/show/223039/vault.svg">
	      		</div>

	      		<hr>
	      		<div class="button-group">

	      			@if($book->open==1)
		      			<a href="/dash/vault/insertPassword/{{$book->id}}" class="btn btn-outline-primary">
	      					<i class="fa-solid fa-book-open"></i> Acessar
		      			</a>	      			
						<a href="/defCloseVault/{{$book->id}}" class="btn btn-outline-primary"><i class="fa-sharp fa-solid fa-unlock-keyhole"></i> Trancar </a>
	      			@else
		      			<a href="/dash/vault/insertPassword/{{$book->id}}" class="btn btn-outline-primary">
							<i class="fa-sharp fa-solid fa-unlock-keyhole"></i> Destrancar
		      			</a>
	      			@endif

	      		</div>
	      	</div>
	      </div>
	    @endforeach
	  </div>
	@endforeach
</div>


@endsection



@endif

@endsection





</body>
</html>

