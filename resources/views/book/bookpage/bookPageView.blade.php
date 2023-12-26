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
    <div class="row ">
      <div class="col-lg-12 mx-auto">
        <div class="card mt-2 mx-auto p-4 bg-light">       
	       <div class="container">
			    <div class="row">
			        <div class="col-6 offset-3 text-center pt-4">
			            <h3 class="border-bottom border-dark p-2">{{$page->title}}</h3>                
			        </div>            
				</div>
			</div>

            <div class="card-body bg-light">
                <div class = "container">
        			<form id="contact-form" role="form" class="form-group" method="POST" action="/defsavepage/{{$page->id}}/{{$book->id}}">
        				@csrf
                        <div class="controls">
                            <div class="row">
                                <label> Titulo </label>
                                <input type="text" class="form-control" required name="title" value="{{$page->title}}" placeholder="Titulo">
                                <label> Subtitulo </label>
                                <input type="text" class="form-control" required name="subtitle" value="{{$page->subtitle}}" placeholder="Subtitulo">
                                <label>Anotação</label>
                                <textarea rows="40" class="form-control" required name="text" placeholder="Anotação">{{$page->text}}
                                </textarea>
                            </div>
                        </div>
                </div>
            </div>
            <div class="card-footer"> 
                <div class="row">
                    <div class="button-group text-center">
                        <button class="btn btn-primary"> Ok </button>
                    </form>


                    <!-- aqruivar folha -->
                    <a href="" class="btn btn-outline-primary">
                        <i class="fa-solid fa-inbox"></i>
                    </a>

                    @if($page->marked==0)
                        <!-- esse icone vai aparecer quando a página não estiver marcada -->
                        <a href="/defMark/{{$page->id}}" class="btn btn-outline-primary">
                            <i class="fa-regular fa-bookmark"></i>
                        </a>
                    @else
                        <!-- esse icone vai aparecer quando a página  estiver marcada -->
                        <a href="/defDesmark/{{$page->id}}" class="btn btn-outline-primary">
                            <i class="fa-sharp fa-solid fa-bookmark"></i>
                        </a>
                    @endif

                    <!-- baixar a folha -->
                    <a href="" class="btn btn-outline-primary">
                        <i class="fa-solid fa-download"></i>
                    </a>

                    <!-- apagar folha -->
                    <a href="/defExcluedPage/{{$page->id}}/{{$book->id}}" class="btn btn-outline-warning">
                        <i class="fa-solid fa-trash"></i>
                    </a>
        	        </div>
                </div>
                    <div class="container-fluid" style="margin-top: 20px;"> 
                        <form action="/defInputImage/{{$page->id}}/{{$book->id}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="container" style="margin-bottom:15px;">
                                  <div class="custom-file">
                                    <input type="file" name="document" class="custom-file-input" id="customFile">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                    <button class="btn btn-outline-primary">Adicionar Documento</button>
                                  </div>
                            </div>  
                        </form>
                    </div>
            </div>
            </div>
        <!-- /.8 -->

            <div class="container-fluid" style="margin-top:20px;">
                @foreach($images->chunk(3) as $chunk)
                <div class="card-columns">
                    @foreach($chunk as $images)
                    <div class="card text-center">
                        <img style="height: 200px;width: 200px;" src="/img/events/{{$images->image}}" >
                        <div class="card-footer">
                            <a class="btn btn-outline-warning" href="/defExcludeImage/{{$images->id}}">Deletar</a>
                        </div>
                    </div>
                    @endforeach 
                </div>
                @endforeach
            </div>
    <!-- /.row-->
    </div>
</div>


@endsection


</body>
</html>