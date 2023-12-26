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
<div style="margin-bottom:20px;" class="container">
    <div class="row">
        <div class="col-6 offset-3 text-center pt-4">    
            <h3 class="border-bottom border-dark p-2">Páginas Arquivadas de {{$book->title}}</h3>                
        </div>            
    </div>
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

                    <!-- desarquivar folha -->
                    <a href="/defDesarchived/{{$pages->id}}" class="btn btn-outline-primary">
                        <i class="fa-solid fa-inbox"></i>
                    </a>

                    <!-- apagar folha -->
                    <a href="/defExcludePage/{{$pages->id}}/{{$book->id}}" class="btn btn-outline-warning">
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