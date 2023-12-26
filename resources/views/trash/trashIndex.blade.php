@extends('dash.base')
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="icon" type="image/x-icon" href="
        /img/logos/bluebook-high-resolution-logo-white-on-transparent-background.png">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="fonts/icomoon/style.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">    
    <!-- Style -->
    <link rel="stylesheet" href="css/style.css">

	<title>BlueBook</title>
</head>
<body>

@section('dash-nav')
@endsection


@section('dash-conteudo')
<div class="jumbotron alert alert-danger">
  <h1 class="display-4">BlueBook</h1>
  <div class="container">
    <p class="lead">
      Ei,psiu!
    </p>
    <ul>
      <li>Tudo que for deletado nessa aba, será permanente <i class="fa-solid fa-triangle-exclamation"></i></li>
      <li>Se o caderno tiver sido apagado, não será capaz de recuperar a folha, recupere o caderno primeiro.</li>
      <li>Se o caderno tiver sido apagado, todas as suas páginas também serão apagadas!</li>
    </ul>
    <hr class="my-4">
  </div>
</div>

@if(count($book)==0)
@else
  <div class="content">
    <div class="container" >
      <div class="table-responsive custom-table-responsive" >
        <table class="table custom-table">
          <tbody
          >
<h4>Livros</h4>

@foreach($book as $book)
            <tr scope="row">
              <th scope="row">
                <label class="control control--checkbox">
                  <div class="control__indicator"></div>
                </label>
              </th>
              <td>
                Titulo:
                <small class="d-block">{{$book->title}}</small>
              </td>
              <td>
                Descrição:
                <small class="d-block">{{$book->description}}</small>
              </td>
              <td>
                  <a href="/defRecoveryBook/{{$book->id}}">
                    <button style="border:none;" class="btn btn-outline-primary">
                      <i class="fa-solid fa-arrow-rotate-left"></i>
                    </button>
                  </a>
                  <a href="/defDeleteBook/{{$book->id}}">
                    <button style="border:none;" class="btn btn-outline-danger">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                  </a>
              </td>
            </tr>
            <tr class="spacer"><td colspan="100"></td></tr>
@endforeach            
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endif
<!-- <hr> -->

@if(count($page)==0)
@else
  <div class="content">
    <div class="container" >
      <div class="table-responsive custom-table-responsive" >
        <table class="table custom-table">
          <tbody>

<h4>Paginas</h4>

@foreach($page as $page)
            <tr scope="row">
              <th scope="row">
                <label class="control control--checkbox">
                  <div class="control__indicator"></div>
                </label>
              </th>
              <td>
                Titulo:
                <small class="d-block">{{$page->title}}</small>
              </td>
              <td>
                Subtitulo:
                <small class="d-block">{{$page->subtitle}}</small>
              </td>
              <td>
                  <a href="/defRecoveryPage/{{$page->id}}">
                    <button style="border:none;" class="btn btn-outline-primary">
                      <i class="fa-solid fa-arrow-rotate-left"></i>
                    </button>
                  </a>

                  <a href="/defDeletePage/{{$page->id}}">
                    <button style="border:none;" class="btn btn-outline-danger">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                  </a>
              </td>
            </tr>
            <tr class="spacer"><td colspan="100"></td></tr>
@endforeach            
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endif

<!-- <hr> -->

@if(count($task)==0)
@else
  <div class="content">
    <div class="container" >
      <div class="table-responsive custom-table-responsive" >
        <table class="table custom-table">
          <tbody>

<h4>Tarefas</h4>

@foreach($task as $task)
            <tr scope="row">
              <th scope="row">
                <label class="control control--checkbox">
                  <div class="control__indicator"></div>
                </label>
              </th>
              <td>
                Titulo:
                <small class="d-block">{{$task->title}}</small>
              </td>
              <td>
              	Tarefa:
                <small class="d-block">{{$task->task}}</small>
              </td>
              <td>
              	Descrição:
                <small class="d-block">{{$task->description}}</small>
              </td>
              <td>
              	Data de finalização:
                <small class="d-block">{{$task->date_finish}}</small>
              </td>
              <td>
              	Hora de finalização:
                <small class="d-block">{{$task->hour_finish}}</small>
              </td>
              <td> 
                  <a href="/defRecoveryTask/{{$task->id}}">
                    <button style="border:none;" class="btn btn-outline-primary">
                      <i class="fa-solid fa-arrow-rotate-left"></i>
                    </button>
                  </a>

                  <a href="/defDeleteTask/{{$task->id}}">
                    <button style="border:none;" class="btn btn-outline-danger">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                  </a>
              </td>
            </tr>
            <tr class="spacer"><td colspan="100"></td></tr>
@endforeach            
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endif

<div class="container-fluid" style="margin-top:20px;">
    @foreach($images->chunk(3) as $chunk)
    <div class="card-columns">
        @foreach($chunk as $images)
        <div class="card text-center">
            <img style="height: 200px;width: 200px;" src="/img/events/{{$images->image}}" >
            <div class="card-footer">
                <a class="btn btn-outline-danger" href="/defDeleteImage/{{$images->id}}">Deletar</a>
            </div>
        </div>
        @endforeach 
    </div>
    @endforeach
</div>


<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
@endsection


</body>
</html>
