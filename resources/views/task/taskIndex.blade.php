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

<div class="button-group" style="margin-bottom: 20px;">
	<a href="/dash/newtask" class="btn btn-outline-primary">Nova Tarefa</a>
	<a href="/dash/concluedTasks" class="btn btn-outline-primary">Tarefas Concluídas</a>
</div>

@if(count($tasks)==0)
@else

  <div class="content">
    <div class="container" >
      <div class="table-responsive custom-table-responsive" >
        <table class="table custom-table">
          <!-- <thead> -->
<!--             <tr>  
              <th scope="col"></th>
              <th scope="col">Order</th>
              <th scope="col">Name</th>
              <th scope="col">Occupation</th>
              <th scope="col">Contact</th>
              <th scope="col">Education</th>
            </tr> -->
          <!-- </thead> -->
          <tbody>
@foreach($tasks as $task)
            <tr scope="row">
              <th scope="row">
                <label class="control control--checkbox">
                  <!-- <input type="checkbox"/> -->

                  <a href="/defConlued/{{$task->id}}">
                  	<button style="border:none;" class="btn btn-outline-primary">
						            <i class="fa-solid fa-circle-check"></i>
                  	</button>
                  </a>

                  <div class="control__indicator"></div>
                </label>
              </th>
              <td>
                Titulo:
                <small class="d-block">{{$task->title}}</small>
              </td>
              <!-- <td><a href="#">James Yates</a></td> -->
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
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>

@endif

@endsection


</body>
</html>
