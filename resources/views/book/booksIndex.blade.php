@extends('dash.base')
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="icon" type="image/x-icon" href="
        /img/logos/bluebook-high-resolution-logo-white-on-transparent-background.png">
	<title>BlueBook</title>
</head>
<body>

@section('dash-nav')
@endsection


@section('dash-conteudo')
<div class="button-group" style="margin-bottom: 20px;">
	<a href="/dash/newbook" class="btn btn-outline-primary">Novo Caderno</a>
</div>

<div class="container-fluid">
	@foreach($allmybooks->chunk(2) as $chunk)
	  <div class="card-columns">
	    @foreach($chunk as $book)
	      <div class="card">

	      	<!-- cadernos com segurança -->
	      	@if($book->vault==1)

		      	<div class="card-header card-title"> 
		      		{{$book->title}}
		      		<hr>

		      		<div  style="display:flex; justify-content: center;"> 
		      			<img style="height: 200px;" src="https://www.svgrepo.com/show/223039/vault.svg">
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

	      			<!-- cadernos sem segurança -->
	      			@else

						<div class="card-header card-title" style="flex-direction: column;">  
							      		<p class="text-center" >{{$book->title}}</p>
							      		<div class="text-center">
							      			<img style="height: 250px;" src="https://static.baixarmod.com/images/en/daldev.android.gradehelper/icon.png">
							      		</div>
							      		<hr>
							      			<div class="card-subtitle">
							      				{{$book->description}}
							      			</div>
							      		<hr>
							      		<div class="button-group">
							      			<a href="/dash/book/{{$book->id}}" class="btn btn-outline-primary">
							      				<i class="fa-solid fa-book-open"></i>
							      			</a>
							      		</div>
							      	</div>
	      			@endif
	      		</div>
	      	</div>
	      </div>
	    @endforeach
	  </div>
	@endforeach
</div>
@endsection


</body>
</html>
