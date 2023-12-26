@extends('dash.base')
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="icon" type="image/x-icon" href="
        /img/logos/bluebook-high-resolution-logo-white-on-transparent-background.png">
    <link rel="stylesheet"  href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js">
    <link rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/3.6.95/css/materialdesignicons.css">

    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">  -->

    <title>BlueBook</title>
    <style type="text/css">
        body {
            background-color: #f9f9fa
        }

        .padding {
            padding: 3rem !important
        }

        .user-card-full {
            overflow: hidden;
        }

        .card {
            border-radius: 5px;
            -webkit-box-shadow: 0 1px 20px 0 rgba(69,90,100,0.08);
            box-shadow: 0 1px 20px 0 rgba(69,90,100,0.08);
            border: none;
            margin-bottom: 30px;
        }

        .m-r-0 {
            margin-right: 0px;
        }

        .m-l-0 {
            margin-left: 0px;
        }

        .user-card-full .user-profile {
            border-radius: 5px 0 0 5px;
        }

        .bg-c-lite-green {
/*            background-image: radial-gradient(circle at 50% -20.71%, #b395e6 0, #9380df 25%, #6c6cd8 50%, #2f5ad1 75%, #004bcb 100%);*/
/*            background: #7386D5;*/
            background: #8DBDFF;

        }

        .user-profile {
            padding: 20px 0;
        }

        .card-block {
            padding: 1.25rem;
        }

        .m-b-25 {
            margin-bottom: 25px;
        }

        .img-radius {
            border-radius: 5px;
        }


         
        h6 {
            font-size: 14px;
        }

        .card .card-block p {
            line-height: 25px;
        }

        @media only screen and (min-width: 1400px){
        p {
            font-size: 14px;
        }
        }

        .card-block {
            padding: 1.25rem;
        }

        .b-b-default {
            border-bottom: 1px solid #e0e0e0;
        }

        .m-b-20 {
            margin-bottom: 20px;
        }

        .p-b-5 {
            padding-bottom: 5px !important;
        }

        .card .card-block p {
            line-height: 25px;
        }

        .m-b-10 {
            margin-bottom: 10px;
        }

        .text-muted {
            color: #919aa3 !important;
        }

        .b-b-default {
            border-bottom: 1px solid #e0e0e0;
        }

        .f-w-600 {
            font-weight: 600;
        }

        .m-b-20 {
            margin-bottom: 20px;
        }

        .m-t-40 {
            margin-top: 20px;
        }

        .p-b-5 {
            padding-bottom: 5px !important;
        }

        .m-b-10 {
            margin-bottom: 10px;
        }

        .m-t-40 {
            margin-top: 20px;
        }

        .user-card-full .social-link li {
            display: inline-block;
        }

        .user-card-full .social-link li a {
            font-size: 20px;
            margin: 0 10px 0 0;
            -webkit-transition: all 0.3s ease-in-out;
            transition: all 0.3s ease-in-out;
        }
    </style>
</head>
<body>

@section('dash-nav')
@endsection


@section('dash-conteudo')

<div class="page-content page-container" id="page-content">
    <div class="padding">
        <div class="row container d-flex justify-content-center">
<div class="col-xl-12 col-md-12">
    <div class="card user-card-full">
        <div class="row m-l-0 m-r-0">
            <div class="col-sm-4 bg-c-lite-green user-profile">
                <div class="card-block text-center text-white">
                    <div class="m-b-25">
                        @if(Auth::user()->photo!=null)
                            <img src="/img/events/{{Auth::user()->photo}}" class="img-radius" alt="User-Profile-Image">
                        @else 

                        @endif
                    </div>

                    <h6 class="f-w-600">{{$user->name}}</h6>
                    <div style="margin-top: 200px;">
                        <p style="color:white;">BlueBook</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="card-block">
                    <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Perfil</h6>

                    <div class="row">
                        <div class="col-sm-6">
                            <p class="m-b-10 f-w-600">Email</p>
                            <h6 class="text-muted f-w-400">{{$user->email}}</h6>
                        </div>
                        <div class="col-sm-6">
                            <p class="m-b-10 f-w-600">Nome</p>
                            <h6 class="text-muted f-w-400">{{$user->name}}</h6>
                        </div>
                    </div>

                    <h6 class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600">Criação e Atualizações</h6>
                    <div class="row">
                        <div class="col-sm-6">
                            <p class="m-b-10 f-w-600">Criado em</p>
                            <h6 class="text-muted f-w-400">{{$user->created_at}}</h6>
                        </div>
                        <div class="col-sm-6">
                            <p class="m-b-10 f-w-600">Última atualização</p>
                            <h6 class="text-muted f-w-400">{{$user->update_at}}</h6>
                        </div>
                    </div>
                    <h6 class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600">Controles</h6>
                    <div class="row">
                        <div class="container-fluid button-group">
                            <a href="{{url('/users/edit',['user'=>Auth::id()])}}" class="btn btn-outline-primary">Editar</a>
                        </div>
                    </div>
                </div>

                <h6 class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600">Definir foto de perfil</h6>
                <div class="container-fluid" style="margin-top: 20px;"> 

                        <form action="/defProfile/" method="POST" enctype="multipart/form-data">
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
    </div>
</div>
 </div>
    </div>
</div>

@endsection

</body>
</html>