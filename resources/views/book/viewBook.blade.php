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
<div class="container">
    <div class="row">
        <div class="col-6 offset-3 text-center pt-4">
            <h3 class="">{{$book->title}}</h3>                
            <h5 class="border-bottom border-dark p-2">{{$book->description}}</h5>                
        </div>            
	</div>
</div>
<div class="button-group text-center" style="margin-top:10px; margin-bottom:20px;">

	<!-- editar caderno -->
	<a href="/dash/editbook/{{$book->id}}" class="btn btn-outline-primary"><i class="fa-solid fa-pen-to-square"></i></a>

	<!-- nova folha -->
	<a href="/dash/book/newpage/{{$book->id}}" class="btn btn-outline-primary"><i class="fa-solid fa-file-circle-plus"></i></a>

	<!-- folhas marcadas, o icone só aparece se houver alguma folha marcada registrada com o id desse caderno -->
	@if(count($markpages)==0)
	@else
		<a href="/dash/book/markpage/{{$book->id}}" class="btn btn-outline-primary"><i class="fa-solid fa-book-bookmark"></i></a>
	@endif

	<!-- caso o caderno possuia segurança -->
	@if($book->vault==1)

		<!-- caso o caderno esteja destrancado -->
		@if($book->open==1)
			<!-- esse icone indica fechar o cofre. -->
			<a href="/defCloseVault/{{$book->id}}" class="btn btn-outline-primary"><i class="fa-sharp fa-solid fa-unlock-keyhole"></i></a>
			<!-- esse icone indica editar informações do cofre. -->
			<a href="/dash/vault/vaultConfigure/{{$book->id}}" class="btn btn-outline-primary"><i class="fa-sharp fa-solid fa-shield"></i></a>
		@endif

	@elseif($book->vault==0)
	<!-- ativar função cofre-->
		<!-- <a href="/defconfigurevault/{{$book->id}}" class="btn btn-outline-primary"> -->
		<a href="/dash/vault/vaultAlert{{$book->id}}" class="btn btn-outline-primary">
			<i class="fa-solid fa-vault"></i>
		</a>
	@endif

	<!-- folhas arquivadas -->
	@if(count($archiveds)==0)
	@else
	<a href="/dash/book/archived/{{$book->id}}" class="btn btn-outline-primary"><i class="fa-solid fa-box-archive"></i></a>
	@endif

	<!-- deletar caderno -->
	<!-- <a href="/delBook/{{$book->id}}" class="btn btn-outline-warning"><i class="fa-solid fa-trash"></i></a> -->
	<a href="/defExcluedBook/{{$book->id}}" class="btn btn-outline-warning"><i class="fa-solid fa-trash"></i></a>

</div>

<div class="container-fluid">
	@foreach($pages->chunk(3) as $chunk)
	  <div class="card-columns">
	    @foreach($chunk as $pages)
	      <div class="card">
	      	<div class="card-header card-title"> 
	      		{{$pages->title}} | {{$pages->created_at}}
	      		<hr>
	      			<div class="card-subtitle">
	      				{{$pages->subtitle}}
	      			</div>
	      		<hr>
	      		<div class="button-group">

	      			<!-- abrir folha -->
	      			<a href="/dash/book/pageview/{{$pages->id}}/{{$book->id}}" class="btn btn-outline-primary">
						<i class="fa-sharp fa-solid fa-file"></i>
	      			</a>

	      			<!-- aqruivar folha -->
	      			<a href="/defArchived/{{$pages->id}}" class="btn btn-outline-primary">
						<i class="fa-solid fa-inbox"></i>
	      			</a>

	      			@if($pages->marked==0)
		      			<!-- esse icone vai aparecer quando a página não estiver marcada -->
		      			<a href="/defMark/{{$pages->id}}" class="btn btn-outline-primary">
							<i class="fa-regular fa-bookmark"></i>
		      			</a>
	      			@else
		      			<!-- esse icone vai aparecer quando a página  estiver marcada -->
		      			<a href="/defDesmark/{{$pages->id}}" class="btn btn-outline-primary">
							<i class="fa-sharp fa-solid fa-bookmark"></i>
		      			</a>
	      			@endif

	      			<!-- baixar a folha -->
	      			<a href="" class="btn btn-outline-primary">
						<i class="fa-solid fa-download"></i>
	      			</a>

	      			<!-- apagar folha -->
	      			<a href="/defExcluedPage/{{$pages->id}}/{{$book->id}}" class="btn btn-outline-warning">
						<i class="fa-solid fa-trash"></i>
	      			</a>
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