@extends('dash.base')
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/  SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="icon" type="image/x-icon" href="
        /img/logos/bluebook-high-resolution-logo-white-on-transparent-background.png">
    <title>BlueBook</title>
</head>
<body>

@section('dash-nav')
@endsection


@section('dash-conteudo')
<div class="container pt-5">

    <div class="row">
        <div class="col-8 offset-2">
            <h3 class="h3 border-bottom">
                <i class="bi bi-list-task"></i>
                Usuários
            </h3 class="h3">
        </div>           
    </div>

    <div class="row">
        <div class="col-6 offset-3">
            <ul class="list-group list-group-flush mt-4">
                @foreach ($users as $user)
                <li class="list-group-item d-flex flex-wrap align-items-center">                            
                    <p class="flex-grow-1">
                        <a href="{{url('users/show', ['user'=>$user->id])}}" class="flex-grow-1">
                           {{$user->name}}
                        </a>
                    </p>
                    @if ($user->admin)
                    <span class="badge bg-success">Admin</span>    
                    @else
                    <span>
                        <a class="btn btn-link" href="{{url('users/admin', ['user'=>$user->id])}}">
                            Promover
                        </a>
                    </span>
                    @endif                    
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>    
@endsection


</body>
</html>
