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
  <a href="/defReadNotifications/" class="btn btn-outline-primary">Marcar Todas como lidas</a>
  <a href="/defDeleteNotifications/" class="btn btn-outline-primary">Deletar Todas</a>
</div>


@if(count($notificationUnread)==0)
@else
  <div class="content">
    <div class="container" >
      <div class="table-responsive custom-table-responsive" >
        <table class="table custom-table">
          <tbody>
<h4>Novas Mensagens</h4>
@foreach($notificationUnread as $notificationUnread)
            <tr scope="row">
              <th scope="row">
                <label class="control control--checkbox">
                  <div class="control__indicator"></div>
                </label>
              </th>
              <td>
                Notificação:
                <small class="d-block">{{$notificationUnread->data['descriptionNotify']}}</small>
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

@if(count($notificationRead)==0)
@else
<h4>Mensagens Lidas</h4>
  <div class="content">
    <div class="container" >
      <div class="table-responsive custom-table-responsive" >
        <table class="table custom-table">
          <tbody>
@foreach($notificationRead as $$notificationRead)
            <tr scope="row">
              <th scope="row">
                <label class="control control--checkbox">
                  <div class="control__indicator"></div>
                </label>
              </th>
              <td>
                Notificação:
                <small class="d-block">{{$$notificationRead->data['descriptionNotify']}}</small>
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
