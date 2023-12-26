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
      <div class="col-lg-7 mx-auto">
        <div class="card mt-2 mx-auto p-4 bg-light">       
	       <div class="container">
			    <div class="row">
			        <div class="col-6 offset-3 text-center pt-4">
			            <h3 class="border-bottom border-dark p-2">Novo Caderno</h3>                
			        </div>            
				</div>
			</div>
            <div class="card-body bg-light">
            <div class = "container">
			<form id="contact-form" role="form" class="form-group" method="POST" action="/newBook">
				@csrf
            <div class="controls">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="form_name">Titulo</label>
                            <input id="form_name" type="text" name="title" class="form-control" placeholder="Titulo" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="form_message">Descrição</label>
                            <textarea id="form_message" name="description" class="form-control" placeholder="Descrição" rows="4" required></textarea>
                            </div>
                        </div>
                    <div class="col-md-12">
                        <button class="btn btn-primary"> Criar </button>
        	        </div>
                </div>
        </div>
         </form>
        </div>
            </div>
        
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach

    </div>
        <!-- /.8 -->

    </div>
    <!-- /.row-->

</div>
</div>


@endsection


</body>
</html>