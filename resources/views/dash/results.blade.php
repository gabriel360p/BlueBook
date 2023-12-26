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

@if(count($book)==0)
@else
<div class="container-fluid">
  @foreach($book->chunk(3) as $chunk)
    <div class="card-columns">
      @foreach($chunk as $book)
        <div class="card">

          <!-- cadernos com segurança -->
          @if($book->vault==1)

            <div class="card-header card-title"> 
              {{$book->title}}
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

              <!-- cadernos sem segurança -->
              @else

            <div class="card-header card-title"> 
                        {{$book->title}}
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
@endif

<hr>

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
                  <a href="/dash/edittask/{{$task->id}}"> <button class="btn btn-outline-primary"><i class="fa-solid fa-eye"></i></button> </a> 
                  <a href="/defExcluedTask/{{$task->id}}"> <button class="btn btn-outline-warning"><i class="fa-sharp fa-solid fa-trash"></i></button> </a> 
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




<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
@endsection


</body>
</html>
