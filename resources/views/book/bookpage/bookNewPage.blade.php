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
			            <h3 class="border-bottom border-dark p-2">Nova Página</h3>                
			        </div>            
				</div>
			</div>

            <div class="card-body bg-light">
                <div class = "container">
        			<form id="contact-form" role="form" class="form-group" method="POST" action="/defnewpage/{{$book->id}}">
        				@csrf
                        <div class="controls">
                            <div class="row">
                                <label> Titulo </label>
                                <input type="text" class="form-control" required name="title" value="" placeholder="Titulo">
                                <label> Subtitulo </label>
                                <input type="text" class="form-control" required name="subtitle" value="" placeholder="Subtitulo">
                                <label>Anotação</label>
                                <textarea rows="40" class="form-control" required name="text" value="" placeholder="Anotação"></textarea>
                            </div>
                        </div>
                </div>
            </div>
            <div class="card-footer"> 
                <div class="row">
                    <div class="button-group text-center">
                        <button class="btn btn-primary"> Ok </button>
                    </form>     
                        <!-- <a href="" class="btn btn-outline-primary">Ola</a> -->
        	        </div>
                </div>
            </div>

            </div>
        <!-- /.8 -->
        </div>
    <!-- /.row-->
    </div>
</div>


@endsection


</body>
</html>